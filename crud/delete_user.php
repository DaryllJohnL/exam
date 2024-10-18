<?php
// Include database and User class
include_once '../classes/Database.php'; // Path to your database connection file
include_once '../classes/User.php';  // Path to your User class

// Instantiate database object and User object
$database = new Database();
$db = $database->getConnection();

$user = new User($db);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user_id from the POST request
    $user->user_id = $_POST['user_id'];

    // Call the delete method to remove the user
    if ($user->delete()) {
        echo "User was successfully deleted!";
    } else {
        echo "Unable to delete user. Please try again.";
    }
}

// Redirect or display a message after deletion
// You can redirect to another page if needed, e.g.:
header("Location: ../");
exit();

