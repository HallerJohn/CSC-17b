<?php

include ('Includes/Header.php');
include ('Includes/login_functions.php');
require ('dbConnect.php');

$q =mysqli_query ($conn,"SELECT * FROM entity_questions");
$numRows = mysqli_num_rows($q);
$userAns = array();

for($i = 1;$i <= $numRows;$i++){
    $userAns[$i] = $_POST['Answer'.$i];
    console_log("Answer ".$i." = ".$userAns[$i]);
}

