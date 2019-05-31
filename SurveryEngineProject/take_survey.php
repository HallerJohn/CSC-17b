<?php

include ('View/Header.php');
include ('View/login_functions.php');
require ('dbConnect.php');

if(isset($_SESSION['account_id'])){

    $q = "SELECT question FROM haller_survey_entity_questions";
    $result = $conn->query($q);
    $numQues = $result->num_rows;
    $questions = array();

    if ($numQues > 0) {
        // output data of each row
        while ($row = mysqli_fetch_array($result)) {
            $questions[] = $row["question"];
        }
    }


    //Use Prepared statements and manually insert each row/col into an array
    $answers = array();
    $stmt = mysqli_prepare($conn,"SELECT answer_1, answer_2, answer_3, answer_4, answer_5 FROM haller_survey_entity_questions WHERE question_id = ?");
    for($i = 0; $i<$numQues; $i++){
        $z = $i+1;
        $stmt->bind_param("i",$z);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $answers[$i][0] = $row['answer_1'];
            $answers[$i][1] = $row['answer_2'];
            $answers[$i][2] = $row['answer_3'];
            $answers[$i][3] = $row['answer_4'];
            $answers[$i][4] = $row['answer_5'];
        }


    }

    for($i = 0;$i < $numQues; $i++){
        $z = $i+1;
        echo '<form action="took_survey.php" method="post">';
        echo '<p>'.$questions[$i].'</p>';
        for($j = 0;$j<5;$j++){
            echo '<input type="radio" name="Answer'.$z.'" value="'.$answers[$i][$j].'">'.$answers[$i][$j].'<br>'; 
        }

    }

    echo '<input type="submit" value="Submit">';
    echo '</form>';
} else {
    echo'Please log in before taking survey';
}



?>