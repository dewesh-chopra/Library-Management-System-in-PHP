<?php
    include("data.php");
    
    $adminid = $_SESSION['adminid'];

    if($adminid == null) {
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

    <title>Dashboard(Admin)</title>
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
                <button class="btn">ADMIN</button>

                <button class="btn" onclick="openpart('addbook')" >Add a book</button>
                <button class="btn" onclick="openpart('viewbook')" >View all books</button>
                <button class="btn" onclick="openpart('approverequest')">Issue requests</button>
                <button class="btn" onclick="openpart('issuereport')">View issued books</button>

                <a href="index.php"><button class="btn" >LOGOUT</button></a>
            </div>

            <!-- To add a new book -->
            <div class="rightInnerDiv">
                <div id="addbook" class="innerRight portion" style="display:none">
                <!-- <?php  if(!empty($_REQUEST['viewid'])){ echo "display:none";} else {echo ""; } ?> -->
                    <Button class="btn" >Add a new book</Button><br/><br/>

                    <form action="addBook.php" method="post" enctype="multipart/form-data">
                        <label>Title: </label><input type="text" name="title"/><br/><br/>
                        <label>Author: </label><input type="text" name="author"/><br/><br/>
                        <label>Publication: </label><input type="text" name="publication"/><br/><br/>
                        <div>
                            Category: 
                            <input type="radio" name="bookcat" value="Fiction"/>Fiction
                            <input type="radio" name="bookcat" value="Non-fiction"/>Non-fiction
                            
                            <div style="margin-left:80px">
                                <input type="radio" name="bookcat" value="Academic"/>Academic
                                <input type="radio" name="bookcat" value="Children"/>Children
                            </div>
                        </div><br/>
                        <label>Price: </label><input  type="number" name="price"/><br/><br/>
                        <label>Available: </label><input type="number" name="available"/><br/><br/>
   
                        <input type="submit" value="SUBMIT"/></br></br>

                    </form>
                </div>
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
                            $table .= "<td></td>";
                            $table .= "<td><a href='deleteBook.php?deletebookid=$row[0]'>Delete</a></td>";

                            $table .= "</tr>";
                        }

                        $table .= "</table>";
                        echo $table;
                    ?>
                </div>
            </div>

            <!-- To approve book request -->
            <div class="rightInnerDiv">
                <div id="approverequest" class="innerRight portion" style="display: none">
                    <button class="btn">Approve book request</button>


                </div>
            </div>

            <!-- To view issue reports -->
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