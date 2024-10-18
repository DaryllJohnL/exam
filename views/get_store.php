<?php
include_once '../config/Database.php'; 
include_once '../classes/CompanyBranch.php'; 

$database = new Database();
$db = $database->getConnection();

$companyBranch = new CompanyBranch($db);

if (isset($_POST['company'])) {
    $company = $_POST['company'];

    $stores = $companyBranch->getStores($company);

    $options = '<option value="">Select Store</option>';
    foreach ($stores as $store) {
        $options .= '<option value="' . $store['STORE_CODE'] . '">' . $store['STORE_DESC'] . '</option>';
    }

    echo $options; 
}
?>
