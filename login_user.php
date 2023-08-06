<?php
    include("data.php");
    
    $login_email = $_GET['login_email'];
    $login_password = $_GET['login_password'];

    if($login_email == null || $login_password == null) {
        $emailmsg="";
        $passmsg="";

        if($login_email == null) {
            $emailmsg = "email was left blank!";
        }
        if($login_password == null) {
            $passmsg = "password was left blank!";
        }
        
        header("Location:index.php?emailmsg=$emailmsg&passmsg=$passmsg");
    }
    elseif($login_email != null && $login_password != null) {
        $obj = new data();
        $obj->setConn();
        $obj->loginUser($login_email, $login_password);
    }
?>