<?php
    include("data.php");

    $userid = $_SESSION['userid'];

    if($userid == null) {
        header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"     rel="stylesheet"     integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"     crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"     integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"     crossorigin="anonymous"></script>

    <style>
        .logo{
            margin: auto;
        }
        .innerDiv{
            text-align: center;
            margin: 100px;
        }
        .leftInnerDiv{
            float: left;
            width: 25%;
        }
        .rightInnerDiv{
            float: right;
            width: 75%;
        }
        .btn{
            background-color: rgb(16, 170, 16);
            color: white;
            width: 80%;
            height: 50px;
            margin-top: 8px;
        }
    </style>

    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <div class="innerDiv">
            <!-- For the logo/page heading -->
            <div class="row">
                <img class="logo" src="images/logo.png" />
            </div>

            <!-- For the various buttons -->
            <div class="leftInnerDiv">
                <button class="btn">USER</button>

                <button class="btn" onclick="openpart('viewbook')" >View all books</button>
                <button class="btn" onclick="openpart('issuebook')">Issue a book</button>
                <button class="btn" onclick="openpart('issuereport')">View issued books</button>

                <a href="index.php"><button class="btn" >LOGOUT</button></a>
            </div>

            <!-- To view all the books  -->
            <div class="rightInnerDiv">   
                <div id="viewbook" class="innerRight portion" style="display:none">
                    <Button class="btn" >View all books</Button>
                    
                    <?php
                        $obj = new data;
                        $obj->setConn();
                        $result = $obj->getBook();

                        $table = "<table id='tableViewbooks' style='font-family: Arial, sans-serif; border-collapse: collapse; width: 100%;'>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publication</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Currently available</th>
                            <th>On rent</th>
                        </tr>";

                        foreach($result as $row) {
                            $table .= "<tr>";

                            $table .= "<td>$row[1]</td>";
                            $table .= "<td>$row[2]</td>";
                            $table .= "<td>$row[3]</td>";
                            $table .= "<td>$row[4]</td>";
                            $table .= "<td>$row[5]</td>";
                            $table .= "<td>$row[6]</td>";
                            $table .= "<td>$row[8]</td>";

                            $table .= "</tr>";
                        }

                        $table .= "</table>";
                        echo $table;
                    ?>
                </div>
            </div>

            <!-- To issue a book -->
            <div class="rightInnerDiv">
                <div id="issuebook" class="innerRight portion" style="display: none">
                    <button class="btn">Issue a book</button>

                    <form action="issueBook.php" method="post" enctype="multipart/form-data">
                        <label for="book">Choose Book: </label>
                        <select name="book" >   
                        <?php
                            $obj = new data;
                            $obj->setConn();
                            $obj->getBook();
                            $result = $obj->getBook();
                            foreach($result as $row){
                                echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                            }            
                        ?>
                        </select>

                        Days to issue: <input type="number" name="days" />

                        <input type="submit" value="SUBMIT" />
                    </form>
                </div>
            </div>

            <!-- To view all issued books -->
            <div class="rightInnerDiv">   
                <div id="issuereport" class="innerRight portion" style="display:none">
                    <button class="btn">View all issued books</button>

                    <?php
                        $obj = new data;
                        $obj->setConn();
                        $obj->getIssueReport();
                        $result = $obj->getIssueReport();

                        $table = "<table style='font-family: Arial, sans-serif; border-collapse: collapse; width: 100%;'>
                        <tr>
                            <th>Issuer name</th>
                            <th>Book title</th>
                            <th>Issuer type</th>
                            <th>Issue date</th>
                            <th>Return date</th>
                            <th>Fine</th>
                        </tr>";

                        foreach($result as $row) {
                            $table .= "<tr>";

                            $table .= "<td>$row[2]</td>";
                            $table .= "<td>$row[3]</td>";
                            $table .= "<td>$row[4]</td>";
                            $table .= "<td>$row[6]</td>";
                            $table .= "<td>$row[7]</td>";
                            $table .= "<td>$row[8]</td>";
                        
                            $table .= "</tr>";
                        }

                        $table .= "</table>";
                        echo $table;
                    ?>
                </div>
            </div>

        </div>
    </div>

    <script>
        function openpart(portion) {
            var i;
            var x = document.getElementsByClassName("portion");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(portion).style.display = "block";  
        }
    </script>
</body>
</html>