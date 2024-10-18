<?php
// Include database and User class
include_once '../classes/Database.php'; // Path to your database connection file
include_once '../classes/User.php';  // Path to your User class

// Instantiate database object and User object
$database = new Database();
$db = $database->getConnection();

$user = new User($db);
// Handle form submission for updating a user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user->user_id = $_POST['user_id'];
    $user->username = $_POST['username'];
    $user->first_name = $_POST['first_name'];
    $user->middle_name = $_POST['middle_name'];
    $user->last_name = $_POST['last_name'];
    $user->full_name = $user->last_name . ', ' . $user->first_name . ' ' . substr($user->middle_name, 0, 1) . '.'; // Full name format
    $user->email = $_POST['email'];
    $user->mobile_no = $_POST['mobile_no'];
    // Call the update method to modify the user
    if ($user->update()) {
        header("Location: ../index.php"); 
        exit(); 
    } else {
        header("Location: edit_user.php?message=Unable to edit user."); // Change this to the desired error location
        exit();
    }
}
