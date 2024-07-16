<?php
    //Starts Session
    session_start();

    //Create Constants to store non Reapting Values
    define('SITEURL', 'http://localhost/cafe_web_prj/');
    define('LOCALHOST', 'localhost:3307');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'cafe-bke-prj');

    


$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // SQL to retrieve comments from database
?>