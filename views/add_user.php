<?php
include_once '../config/Database.php';
include_once '../classes/CompanyBranch.php';

$database = new Database();
$db = $database->getConnection();
$companyBranch = new CompanyBranch($db);
$companies = $companyBranch->getCompanies();

include_once '../templates/header.php';
?>

<h3>Add/Edit User</h3>
<form action="../crud/add_user.php" method="POST">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="col-md-4">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" required>
        </div>
        <div class="col-md-4">
            <label for="middle_name" class="form-label">Middle Name</label>
            <input type="text" class="form-control" name="middle_name">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" required>
        </div>
        <div class="col-md-4">
            <label for="birthdate" class="form-label">Birthdate</label>
            <input type="date" class="form-control" name="birthdate" required>
        </div>
        <div class="col-md-4">
            <label for="mobile_no" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" name="mobile_no" maxlength="11" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="col-md-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
            <label for="company">Company:</label>
            <select id="company" name="company" class="form-control" onchange="fetchStores()" required>
                <option value="">Select Company</option>
                <?php foreach ($companies as $company): ?>
                    <option value="<?php echo $company['COMPANY']; ?>"><?php echo $company['COMPANY_DESC']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="store_code">Store Code:</label>
            <select id="store_code" name="store_code" class="form-control" required>
                <option value="">Select Store</option>
            </select>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-3">
        <a href="../index.php" class="btn btn-secondary me-2">Back</a>
        <button type="submit" class="btn btn-primary">Save User</button>
    </div>

</form>
<script>
    function fetchStores() {
        var company = document.getElementById("company").value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "get_store.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("store_code").innerHTML = this.responseText;
            }
        };
        xhr.send("company=" + company);
    }
</script>
<?php
include_once '../templates/footer.php';
?>