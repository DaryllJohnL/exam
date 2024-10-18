<?php
include_once '../config/Database.php'; // Path to your database connection file
include_once '../classes/User.php';  // Path to your User class

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if (isset($_GET['user_id'])) {
    $user->user_id = $_GET['user_id'];
    $tableName = $user->getTableName();
    $query = "SELECT * FROM " . $tableName . " WHERE USER_ID = :USER_ID LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':USER_ID', $user->user_id);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
}
require_once '../templates/header.php';
?>


<div class="container">
    <h2>View User</h2>

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" value="<?= $userData['USERNAME']; ?>" name="username" disabled>
        </div>
        <div class="col-md-4">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" value="<?= $userData['FIRST_NAME']; ?>" name="first_name" disabled>
        </div>
        <div class="col-md-4">
            <label for="middle_name" class="form-label">Middle Name</label>
            <input type="text" class="form-control" value="<?= $userData['MIDDLE_NAME']; ?>" name="middle_name" disabled>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" value="<?= $userData['LAST_NAME']; ?>" name="last_name" disabled>
        </div>
        <div class="col-md-4">
            <label for="birthdate" class="form-label">Birthdate</label>
            <input type="date" class="form-control" value="<?= $userData['BIRTHDATE']; ?>" name="birthdate" disabled>
        </div>
        <div class="col-md-4">
            <label for="mobile_no" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" value="<?= $userData['MOBILE_NO']; ?>" name="mobile_no" maxlength="11" disabled>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" value="<?= $userData['EMAIL']; ?>" name="email" disabled>
        </div>
        <div class="col-md-3">
        <label for="company" class="form-label">COMPANY</label>
        <input type="text" class="form-control" value="<?= $userData['COMPANY']; ?>" name="company" disabled>
        </div>
        <div class="col-md-3">
        <label for="storecode" class="form-label">Store Code</label>
        <input type="text" class="form-control" value="<?= $userData['STORE_CODE']; ?>" name="storecode" disabled>
        </div>
    </div>
    <a href="../index.php" class="btn btn-secondary">Back</a>
</div>

<?php
require_once '../templates/footer.php';
?>