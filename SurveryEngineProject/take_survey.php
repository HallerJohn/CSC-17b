<?php

include ('Includes/login_functions.php');
require ('dbConnect.php');
$q = "SELECT COUNT FROM entity_questions";
$numRows = mysqli_query($conn, $q);

$q = "SELECT question FROM entity_questions";
$result = $conn->query($q);
$questions = array();

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = mysqli_fetch_array($result)) {
        $questions[] = $row["question"];
    }
}

console_log('QUESTION = ');
console_log($questions[0]);


//Use Prepared statements and manually insert each row/col into an array
$q = "SELECT answer_1, answer_2, answer_3, answer_4, answer_5 FROM entity_questions";
$result = $conn->query($q);
$answers = array();





//for($i = 0;$i < $numRows ; $i++){
//    for($j = 0; $j<4; $j++){
//        echo '<div>';
//        echo '<input type="radio" id="ans"' .$j . '" name="question"' . $i .'" value=(PUT IN THE ANSWER HERE)' ;
//    }
//}



?>

<h1>Take a Survey!</h1>
<div>
    <input type="radio" id="ans1" name=""
</div>