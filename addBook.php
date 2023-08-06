<?php
    include("data.php");

    $title = $_POST['title'];
    $author = $_POST['author'];
    $publication = $_POST['publication'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $available = $_POST['available'];

    $obj->addBook($title, $author, $publication, $category, $price, $available);
?>