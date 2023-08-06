<!-- To connect to the database via PDO -->
<?php
    class db {
        protected $conn;

        function setConn() {
            try {
                $this->conn = new PDO("mysql:host=localhost; dbname=library_management_system", "root", "password");
            }
            catch(PDOException $e) {
                echo "Error: " . $e;
            }
        }
    }
?>