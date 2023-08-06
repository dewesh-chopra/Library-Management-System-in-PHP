<?php
    include("data.php");

    $userid = $_POST['book'];
    $bookid = $_POST['book'];
    $days = $_POST['days'];
    $issueDate = date("Y-m-d");
    $returnDate = date('Y-m-d', strtotime('+' . $days . 'days'));

    $obj = new data();
    $obj->setConn();
    $obj->issueBook($userid, $bookid, $days, $issueDate, $returnDate);
?>