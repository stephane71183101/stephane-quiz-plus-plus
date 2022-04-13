<?php
//session_start();
if  (isset($_POST["lastPageID"])) {
    $lastPageID=$_POST["lastPageID"];
    $_SESSION[$lastPageID]=$_POST;
}
//Devonly Gib die aktuelle $_SESSION in die Seite aus.
//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>'; 
?>