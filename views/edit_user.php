<?php
include_once '../classes/Database.php';
include_once '../classes/User.php';

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
    <h2>Edit User</h2>
    <form action="../crud/edit_user.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userData['USER_ID']); ?>">

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" class="form-control"
                value="<?php echo htmlspecialchars($userData['USERNAME']); ?>" required>
        </div>
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" class="form-control"
                value="<?php echo htmlspecialchars($userData['FIRST_NAME']); ?>" required>
        </div>
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" name="middle_name" class="form-control"
                value="<?php echo htmlspecialchars($userData['MIDDLE_NAME']); ?>" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" class="form-control"
                value="<?php echo htmlspecialchars($userData['LAST_NAME']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control"
                value="<?php echo htmlspecialchars($userData['EMAIL']); ?>" required>
        </div>
        <div class="form-group">
            <label for="mobile_no">Mobile Number:</label>
            <input type="text" name="mobile_no" class="form-control" maxlength="11"
                value="<?php echo htmlspecialchars($userData['MOBILE_NO']); ?>" required>
        </div>

        <br>
        <div class="d-flex justify-content-end mb-3">
            <a href="../index.php" class="btn btn-secondary me-2">Back</a>
            <button type="submit" class="btn btn-primary">Update User</button>
        </div>

    </form>
</div>

<?php
require_once '../templates/footer.php';
?>