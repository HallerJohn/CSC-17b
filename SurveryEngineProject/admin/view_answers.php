<?php

require('../dbConnect.php');
include ('View/Header.php');
include ('View/login_functions.php');

$q =mysqli_query ($conn,"SELECT * FROM haller_survey_entity_questions");
$numRows = mysqli_num_rows($q);
$q =mysqli_query ($conn,"SELECT * FROM haller_survey_entity_answers");
$numSurveys = mysqli_num_rows($q);

echo "<table border='1' width=600><tr>";
for($i = 1;$i <= $numRows; $i++){
    echo "<th>Answer ".$i."</th>";
}
echo '</tr>';

for($j = 1;$j <= $numSurveys;$j++){
    echo '<tr>';
    for($i = 1;$i <= $numRows; $i++){
        $q = "SELECT `haller_survey_entity_accounts`.`account_id`, `haller_survey_entity_answers`.`ans_".$i."` FROM `44085`.`haller_survey_xref_accounts_answers` AS `haller_survey_xref_accounts_answers`, `44085`.`haller_survey_entity_accounts` AS `haller_survey_entity_accounts`, `44085`.`haller_survey_entity_answers` AS `haller_survey_entity_answers` WHERE `haller_survey_xref_accounts_answers`.`account_id` = `haller_survey_entity_accounts`.`account_id` AND `haller_survey_entity_answers`.`survey_id` = $j";
        $results = mysqli_query($conn, $q);
        $re = mysqli_fetch_array($results);
        echo '<td align="center">'.$re['ans_'.$i].'</td>';
    }
    echo '</tr>';
}

//for($j = 1;$j <= $numSurveys;$j++){
//    $query = "SELECT `entity_accounts`.`account_id`, `entity_answers`.`ans_".$j."` FROM `survey_data`.`xref_accounts_answers` AS `xref_accounts_answers`, `survey_data`.`entity_accounts` AS `entity_accounts`, `survey_data`.`entity_answers` AS `entity_answers` WHERE `xref_accounts_answers`.`account_id` = `entity_accounts`.`account_id` AND `entity_answers`.`survey_id` = $j";
//    $rs = mysqli_query($conn,$query);
//}
//
//while($re = mysqli_fetch_array($rs)){
//    echo "<tr><td>".$re['account_id']."</td>";
//    for($i = 1;$i <= $numRows; $i++){
//        echo "<td>".$re['ans_'.$i]."</td>";
//    } echo '</tr>';
//}
//echo "</table>";