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

    <!-- CSS for the form -->
    <link rel="stylesheet" href="style.css">

    <title>Library Management System</title>
</head>
<body>
    <!-- For displaying the message -->
    <?php
        $emailmsg="";
        $passmsg="";
        $ademailmsg="";
        $adpassmsg="";
        $msg="";

        if(!empty($_REQUEST['emailmsg'])) {
            $emailmsg = $_REQUEST['emailmsg'];
        }
        if(!empty($_REQUEST['passmsg'])) {
            $passmsg = $_REQUEST['passmsg'];
        }
        if(!empty($_REQUEST['ademailmsg'])) {
            $ademailmsg = $_REQUEST['ademailmsg'];
        }
        if(!empty($_REQUEST['adpassmsg'])) {
            $adpassmsg = $_REQUEST['adpassmsg'];
        }
        if(!empty($_REQUEST['msg'])) {
            $msg = $_REQUEST['msg'];
        }
    ?>

    <!-- Container for both login areas -->
    <div class="container login-container">
        <div class="row">
            <h4><?php echo $msg ?></h4>
        </div>
        
        <div class="row">
            <div class="col-md-6 login-form-1">
                <h3>Login</h3>

                <!-- Container for login form -->
                <form action="login_user.php" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" name="login_email" placeholder="Enter your email id" value="" />
                    </div>
                    <Label style="color:red">*<?php echo $emailmsg ?></label>

                    <div class="form-group">
                        <input type="password" class="form-control" name="login_password"  placeholder="Enter your password" value="" />
                    </div>
                    <Label style="color:red">*<?php echo $passmsg ?></label>

                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Login" />
                    </div>
                </form>
            </div>
                
            <!-- Container for login form for admin -->
            <div class="col-md-6 login-form-2">
                <h3>Login (Admin only)</h3>

                <form action="login_admin.php" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" name="login_email" placeholder="Enter your email id" value="" />
                    </div>
                    <label style="color:red">*<?php echo $ademailmsg ?></label>

                    <div class="form-group">
                        <input type="password" class="form-control" name="login_password"  placeholder="Enter your password" value="" />
                    </div>
                    <label style="color:red">*<?php echo $adpassmsg ?></label>

                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Login" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>