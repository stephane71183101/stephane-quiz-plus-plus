<?php
session_start();

$currentQuestionsIndex=0;

if  (isset($_POST["lastQuestionIndex"])) {
    $lastQuestionIndex=$_POST["lastQuestionIndex"];

    if  (isset($_POST["nextQuestionIndex"])) {
        $currentQuestionsIndex=$_POST["nextQuestionIndex"];
    }
}

/*
if  (isset($_POST["lastPageID"])) {
    $lastPageID=$_POST["lastPageID"];
    $_SESSION[$lastPageID]=$_POST;
}
*/

//Devonly Gib die aktuelle $_SESSION in die Seite aus.
//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>'; 
?>