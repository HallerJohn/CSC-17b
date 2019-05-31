<?php

include ('View/Header.php');
include ('View/login_functions.php');
require ('dbConnect.php');

$q =mysqli_query ($conn,"SELECT * FROM haller_survey_entity_questions");
$numRows = mysqli_num_rows($q);
$userAns = array();

for($i = 1;$i <= $numRows;$i++){
    $userAns[$i] = $_POST['Answer'.$i];
    console_log("Answer ".$i." = ".$userAns[$i]);
}

$account_id = $_SESSION['account_id'];

$q = "INSERT INTO haller_survey_xref_accounts_answers (account_id) VALUES ('$account_id')";
$results = mysqli_query($conn, $q);
if(mysqli_affected_rows($conn)>0){
    console_log('Inserted into x-ref succesfully');
} else {
    console_log('Failed to insert into x-ref');
}

for($i = 1;$i<=$numRows; $i++){
    $insert_id;
    console_log('I = '.$i);
    if($i == 1){
        $q = "INSERT INTO haller_survey_entity_answers (ans_".$i.") VALUES (?)";
        $stmt = mysqli_prepare($conn, $q);
        $stmt->bind_param("s", $userAns[$i]);
        $stmt->execute();
        $insert_id = mysqli_insert_id($conn);
    } else {
        $q = "UPDATE haller_survey_entity_answers SET ans_".$i." = '$userAns[$i]' WHERE survey_id = $insert_id";
        mysqli_query($conn, $q);
    }
    
}

echo 'Thank you for taking our survey!<br>';
echo 'You may view the current results by clicking the link above';

