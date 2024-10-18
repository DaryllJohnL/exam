<?php
// classes/User.php
class User {
    private $conn;
    private $table_name = "users";

    public $user_id;
    public $username;
    public $password;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $full_name;
    public $birthdate;
    public $mobile_no;
    public $company;
    public $store_code;
    public $env_code;
    public $email;
    public $created_date;
    public $last_update_date;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function getTableName() {
        return $this->table_name;
    }

    // Create a new user
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET username=:username,password=:password, first_name=:first_name, middle_name=:middle_name, last_name=:last_name, full_name=:full_name, 
                      birthdate=:birthdate, mobile_no=:mobile_no, company=:company, store_code=:store_code, email=:email, created_date=NOW(), last_update_date=NOW()";

        $stmt = $this->conn->prepare($query);

        $this->sanitizeData();

        // Bind values
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":middle_name", $this->middle_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":full_name", $this->full_name);
        $stmt->bindParam(":birthdate", $this->birthdate);
        $stmt->bindParam(":mobile_no", $this->mobile_no);
        $stmt->bindParam(":company", $this->company);
        $stmt->bindParam(":store_code", $this->store_code);
        $stmt->bindParam(":email", $this->email);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read all users
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Update a user
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET first_name=:first_name, middle_name=:middle_name, last_name=:last_name, full_name=:full_name,  mobile_no=:mobile_no, 
                       email=:email, last_update_date=NOW()
                  WHERE user_id=:user_id";

        $stmt = $this->conn->prepare($query);
        $this->sanitizeData();

        // Bind values
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":middle_name", $this->middle_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":full_name", $this->full_name);
        $stmt->bindParam(":mobile_no", $this->mobile_no);
        $stmt->bindParam(":email", $this->email);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete a user
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE user_id=:user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $this->user_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Sanitize data
    private function sanitizeData() {
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->middle_name = htmlspecialchars(strip_tags($this->middle_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->birthdate = htmlspecialchars(strip_tags($this->birthdate));
        $this->mobile_no = htmlspecialchars(strip_tags($this->mobile_no));
        $this->company = htmlspecialchars(strip_tags($this->company));
        $this->store_code = htmlspecialchars(strip_tags($this->store_code));
        $this->email = htmlspecialchars(strip_tags($this->email));
    }
}
?>
