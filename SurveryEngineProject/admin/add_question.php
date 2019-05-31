<?php

session_start();
$page_title = 'Add a question';
include ('View/Header.php');
include ('View/login_functions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require('../dbConnect.php');
    $question = $_POST['question'];
    $ans1 = $_POST['ans1'];
    $ans2 = $_POST['ans2'];
    $ans3 = $_POST['ans3'];
    $ans4 = $_POST['ans4'];
    $ans5 = $_POST['ans5'];
    $q = "INSERT INTO haller_survey_entity_questions (question, answer_1, answer_2, answer_3, answer_4, answer_5) VALUES ('$question','$ans1','$ans2','$ans3','$ans4','$ans5')";
    if ($conn->query($q) === TRUE){
        echo "You have succesfully added your question";
    } else {
        echo "error: ".$q . "<br>" . $conn->error;
    }
    
    $q =mysqli_query ($conn,"SELECT * FROM haller_survey_entity_questions");
    $numRows = mysqli_num_rows($q);
    $col = "ans_".($numRows);
    
    $q = "ALTER TABLE haller_survey_entity_answers ADD $col VARCHAR( 255 )";
    $rs = mysqli_query($conn,$q);
    if($rs){
        console_log("New column added to table");
    }
    
    mysqli_close($conn);
    include ('View/Footer.php');
    exit();
}



?><h1>Add question</h1>
<form action="add_question.php" method="post">
	<p>Question: <input type="text" name="question" size="20" maxlength="60" /> </p>
	<p>Answer 1: <input type="text" name="ans1" size="20" maxlength="20" /></p>
        <p>Answer 2: <input type="text" name="ans2" size="20" maxlength="20" /></p>
        <p>Answer 3: <input type="text" name="ans3" size="20" maxlength="20" /></p>
        <p>Answer 4: <input type="text" name="ans4" size="20" maxlength="20" /></p>
        <p>Answer 5: <input type="text" name="ans5" size="20" maxlength="20" /></p>
	<p><input type="submit" name="submit" value="Add" /></p>
</form>

<?php include ('View/Footer.php');