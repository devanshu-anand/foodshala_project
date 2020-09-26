<?php
    $servername = "localhost"; //change according to your server
    $database = "db_foodshala"; //my database folder name 
    $username = "foodshala_admin"; // my user admin but you can make any other user too !!
    $password = ""; // thats my generated password but if you make your new user for the database then enter your own password which you have made while creating the database 
    $conn_status = 0;

    // Create connection

    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
      // echo "die";
    } else {
    $con_status = 1;
    // echo "Connected successfully";
    }

?>