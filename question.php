<?php 
//include "includes/data-collector.php";
include "includes/db.php";

// Initialize session.
session_start();

include "includes/head.php";
include "includes/header.php";


$currentQuestionIndex = 0;

// Evaluate data in $_POST variable.
if  (isset($_POST['lastQuestionIndex'])) {
    $lastQuestionIndex = $_POST['lastQuestionIndex'];

    if  (isset($_POST['nextQuestionIndex'])) {
        $currentQuestionIndex = $_POST['nextQuestionIndex'];
    }
}

// Check if $_SESSION['questions'] exists.
if (isset($_SESSION['questions'])) {
    echo 'questions exist in session <br>';
    $questions = $_SESSION['questions'];
}
else {
    echo 'questions do not exist in session <br>';
    
    // Get quiz data from database using includes/db.php ...
    $questions = getQuestions();

    // ... and save that data in $_SESSION.
    $_SESSION['questions'] = $questions;
}

// Get quiz data using includes/db.php
$questions = getQuestions();

// And put questions and answers data int PHP session.
// $_SESSION['questions'] = $questions;

// echo "<pre>";
// print_r($_SESSION['questions']);
// echo "</pre>";
?>

<div>
    <div class="container-fluid text-secondary pt-3 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">

                <h5 class="text-primary">Frage <?php echo $currentQuestionIndex + 1; ?><h5>
                <h4 id="questionWording"><?php echo $questions[$currentQuestionIndex]['Text']; ?><h4>
            </div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>
    <div class="container text-secondary h6 mt-3">
        <form method="post">
            <?php
                $answers = $questions[$currentQuestionIndex]['answers'];

                for ($a = 0; $a < count($answers); $a++) {
                    echo '<div class="form-check">';
                    $isCorrect = $answers[$a]['IsCorrectAnswer'];
                    echo '<input class="form-check-input" type="checkbox" value="' . $isCorrect . '" id="flexCheckDefault">';
                    echo '<label class="form-check-label" for="flexCheckDefault">';

                    echo $answers[$a]['Text'];
                    echo '</label>';
                    echo '</div>';
                }
            ?>
      
            
                <div class="container pt-3">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10">
                            <div>
                                <input type="hidden" name="lastQuestionIndex" value="<?php echo $currentQuestionIndex; ?>">
                                <input type="hidden" name="nextQuestionIndex" value="<?php $currentQuestionIndex++;
                                echo $currentQuestionIndex; ?>">
                                <!--<p id="validation-warning" class="warning"></p>-->
                                <button type="submit" class="btn btn-outline-primary buttons">Weiter...</button>
                            </div>
                        </div>
                        <div class="col-1"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include "includes/footer.php"; ?>