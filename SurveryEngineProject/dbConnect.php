<?php 
//This file connects to the database and queries information to it
    //Establish connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "survey_data";
    // Make the connection:
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
    }
    
    ?>