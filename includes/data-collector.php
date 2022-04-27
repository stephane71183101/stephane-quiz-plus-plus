<?php
session_start();

if  (isset($_POST['lastQuestionIndex'])) {
    // Get the index (string) of the last question.
    $lastQuestionIndex = $_POST['lastQuestionIndex']; // ohne intvall()

    // And create the key for that question.
    $questionKey = 'q-' . $lastQuestionIndex;

    // Achieved points -----------------------------------

    /*
    Get th number of achived points, checking all keys in $_POST for
    the head 'a-', like 'a-0', 'a-1' etc.
    */
    $achievedPoints = 0;

    foreach ($_POST as $key => $value) {
        if (str_contains($key, 'a-')) {
            $achievedPoints += intval($value); // same as: $achievedPoints = $achievedPoints + intval(value);
        }
    }

    // Devonly: echo "achievedPoints = $achievedPoints<br>;

    // 
    if (!isset($_SESSION['achievedPointsList'])) {
        $_SESSION['achievedPointsList'] = array();
    }

    //
    $_SESSION['achievedPointsList'][$questionKey] = $achievedPOints;

    // Max points -----------------------------------------
    $maxPoints = intvall($_POST['maxPOints']);

    // Make sure the list of all max points exists in the $_SESSION.
    if (!isset($_SESSION['maxPointsList'])) {
        $_SESSION['maxPointsList'] = array();
    }


}


//Devonly Gib die aktuelle $_SESSION in die Seite aus.
//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>'; 
?>