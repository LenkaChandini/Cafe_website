<?php include('partials/constants.php'); ?>


<html>
    <head>
        <title>LOGIN - CAFE FOOD ORDER WEBSITE</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">LOGIN</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- LOgin from start here -->

            <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"> <br><br>

            Password:<br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>


            <input type="submit" name="submit" value="Login" class="btn-primary"> 

            </form>

            

        </div>

    </body>
</html>

<?php

//check wheather the submit button is clicked or not
if(isset($_POST['submit']))
{
    //process for login
    //1. Get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //2. sql to check wheather the user with username and password exists or not
    $sql = "SELECT * FROM   tbl_admin WHERE username='$username' AND password='$password'";

    //3.execute the query
    $res = mysqli_query($conn, $sql);

    //4.count rows to check wheather the user exists or not
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        //User Available and login success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; // To check wheather the user is logged in or not and logout will unset it

        //Redirect to home page/dashboard
        header('location:'.SITEURL.'admin/');
    }
    else
    {
        //User not available and login fail
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        //Redirect to home page/dashboard
        header('location:'.SITEURL.'admin/login.php');
    }
}

?>