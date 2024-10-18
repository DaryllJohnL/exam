<?php
class CompanyBranch {
    private $conn;
    private $table_name = "company_branch";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get distinct companies
    public function getCompanies() {
        $query = "SELECT DISTINCT COMPANY, COMPANY_DESC FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get stores based on company
    public function getStores($company) {
        $query = "SELECT STORE_CODE, STORE_DESC,ENV_CODE FROM " . $this->table_name . " WHERE COMPANY = :company";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':company', $company);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getEnv($storeCode) {
        $query = "SELECT ENV_CODE FROM " . $this->table_name . " WHERE STORE_CODE = :store_code";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':store_code', $storeCode);
        $stmt->execute();
        return $stmt->fetchColumn(); // Fetch the first column of the first row
    }
}
?>
