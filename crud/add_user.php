<?php
include_once '../config/Database.php'; 
include_once '../classes/User.php';  
include_once '../classes/CompanyBranch.php'; // Path to your CompanyBranch class

$database = new Database();
$db = $database->getConnection();

$companyBranch = new CompanyBranch($db);
$user = new User($db);
$env_code = $companyBranch->getEnv($_POST['store_code']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user->username = $_POST['username'];
    $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT); 
    $user->first_name = $_POST['first_name'];
    $user->middle_name = $_POST['middle_name'];
    $user->last_name = $_POST['last_name'];
    $user->full_name = $user->last_name . ', ' . $user->first_name . ' ' . substr($user->middle_name, 0, 1) . '.'; // Full name format
    $user->birthdate = $_POST['birthdate'];
    $user->env_code = $env_code[0];
    $user->mobile_no = $_POST['mobile_no'];
    $user->company = $_POST['company'];
    $user->store_code = $_POST['store_code'];
    $user->email = $_POST['email'];
    
    if ($user->create()) {
        header("Location: ../index.php"); 
        exit(); 
    } else {
        // Redirect to an error page or back to the form with an error message
        header("Location: add_user.php?message=Unable to add user."); // Change this to the desired error location
        exit();
    }
}

