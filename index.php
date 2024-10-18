<?php
include_once 'classes/Database.php';
include_once 'classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);


$stmt = $user->readAll();
$userCount = $stmt->rowCount();
require_once 'templates/header.php';
?>

<div class="container">
    <h2>User List</h2>
    <div class="d-flex justify-content-end mb-3">
        <a href="generate_pdf.php" class="btn btn-secondary me-2">Generate PDF</a>
        <a href="views/add_user.php" class="btn btn-primary">Add New User</a>
    </div>
    <?php if ($userCount > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['USER_ID']); ?></td>
                        <td><?php echo htmlspecialchars($row['USERNAME']); ?></td>
                        <td><?php echo htmlspecialchars($row['FULL_NAME']); ?></td>
                        <td><?php echo htmlspecialchars($row['EMAIL']); ?></td>
                        <td>
                            <a href="views/view_user.php?user_id=<?php echo $row['USER_ID']; ?>"
                                class="btn btn-info btn-sm">View</a>
                            <a href="views/edit_user.php?user_id=<?php echo $row['USER_ID']; ?>"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="crud/delete_user.php" method="POST" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo $row['USER_ID']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</div>

<script src="../js/bootstrap.min.js"></script>

<?php
require_once "templates/footer.php";
?>