<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" />
    </head>
    <body>
        <div id="header">
            <h1>website name</h1>
            <h1>slogan</h1>
        </div>
        <div id="navigation">
            <ul>
                <li><a href="index.php">Home Page</a></li>
                <li><a href="survey.php">Take a survey!</a></li>
                <li><a href="change.php">Change your answers</a></li>
                <li>
                    <?php
                        if(isset($_SESSION['user_id'])){
                            echo '<a href="logout.php">Logout</a></li>';
                        } else {
                            echo '<a href="login.php">Login</a></li>';
                            echo '<li> <a href="register.">Register</a></li>';
                        }
                    ?>
                
            </ul>
        </div>
    </body>
</html>
