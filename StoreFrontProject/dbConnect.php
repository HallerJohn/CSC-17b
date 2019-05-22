<?php 
//This file connects to the database and queries information to it
    //Establish connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user_data";
    // Make the connection:
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
    }

//    //Query Database
//    $query = "INSERT INTO entity_account_information (email_address, first_name, last_name, address) VALUES ('4jfhaller@gmail.com', 'john', 'haller', '4786 Beatty dr')";
//    
//    //Check query
//    if ($conn->query($query) === TRUE) {
//        echo "New record created successfully";
//    } else {
//        echo "Error: " . $query . "<br>" . $conn->error;
//    }
//    $conn->close();
?>