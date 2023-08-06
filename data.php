<?php
    session_start();
    include("db.php");

    class data extends db {
        function __construct() {
            echo "";
        }

        function loginAdmin($email, $password) {
            $sql = "select * from admin where email='$email' and password='$password';";
            $result = $this->conn->query($sql);
            $count = $result->rowCount();

            if($count > 0) {
                foreach($result->fetchAll() as $row) {
                    $loginid = $row['id'];
                    $_SESSION['adminid'] = $loginid;
                }
                
                header("Location:dashboard_admin.php");
            }
            elseif($count <= 0) {
                header("Location:index.php?msg=Invalid Credentials");
            }
        }

        function loginUser($email, $password) {
            $sql = "select * from user where email='$email' and password='$password';";
            $result = $this->conn->query($sql);
            $count = $result->rowCount();

            if($count > 0) {
                foreach($result->fetchAll() as $row) {
                    $loginid = $row['id'];
                    $_SESSION['userid'] = $loginid;
                }

                header("Location:dashboard_user.php");
            }
            elseif($count <= 0) {
                header("Location:index.php?msg=Invalid Credentials");
            }
        }

        function addBook($title, $author, $publication, $category, $price, $available) {
            $this->$title = $title;
            $this->$author = $author;
            $this->$publication = $publication;
            $this->$category = $category;
            $this->$price = $price;
            $this->$available = $available;

            $sql="INSERT INTO book(id, title, author, publication, category, price, available, rent)VALUES('', '$title', '$author', '$publication', '$category', '$price', '$available', 0)";

            if($this->conn->exec($sql)) {
                header("Location:dashboard_admin.php?msg=done");
            }
            else {
                header("Location:dashboard_admin.php?msg=fail");
            }
        }

        function getBook() {
            $sql = "select * from book;";
            $data = $this->conn->query($sql);
            return $data;
        }

        function getBooksIssued(){
            $sql = "select * from book where bookquan != 0 ";
            $data = $this->conn->query($sql);
            return $data;
        }
    
        function getUser() {
            $sql = "select * from user";
            $data = $this->conn->query($sql);
            return $data;
        }

        function getIssueReport() {
            $sql = "select * from issuebook;";
            $data = $this->conn->query($sql);
            return $data;
        }

        function issueBook($bookid,$userid,$days,$issueDate,$returnDate){
            $this->$userid = $userid;
            $this->$bookid = $bookid;
            $this->$days = $days;
            $this->$issueDate = $issueDate;
            $this->$returnDate = $returnDate;
            
            $sql = "select * from user where id = '$userid'";
            $result1 =  $this->conn->query($sql);
            $count1 = $result1->rowCount();
    
            $sql="select * from book where id = '$bookid'";
            $result2 = $this->conn->query($sql);
            $count2 = $result2->rowCount();
    
            if ($count1 > 0 && $count2 > 0) {
                foreach($result1->fetchAll() as $row) {
                    $issuername = $row['email'];
                    $issuertype = $row['type'];
                }
                
                foreach($result2->fetchAll() as $row) {
                    $booktitle = $row['title'];
    
                    $newavailable = $row['available'] - 1;
                    $newrent = $row['rent'] + 1;
                }

                $sql = "update book set available = '$newavailable', rent = '$newrent' where id = '$bookid'";

                if($this->conn->exec($sql)) {
                    $sql = "insert into issuebook(id, issuerid, issuername, booktitle, issuertype, issuedays, issuedate, returndate, fine) values('','$userid', '$issuername','$booktitle','$issuertype','$days','$issueDate','$returnDate','0')";
    
                    if($this->conn->exec($sql)) {
                        header("Location:dashboard_user.php?msg=done");
                    }
                    else {
                        header("Location:dashboard_user.php?msg=fail");
                    }
                }
                else {
                    header("location:index.php?msg=Invalid Credentials");
                }
            }
        }
    }
?>