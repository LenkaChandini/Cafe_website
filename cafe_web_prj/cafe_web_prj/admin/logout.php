<?php 
    //include constants.php for siteurl
    include('partials/constants.php'); 
    //1. Destory the session
    session_destroy(); //unsets $_session['user']

    //2.redirect to login page
    header('location:'.SITEURL.'admin/login.php');



?>