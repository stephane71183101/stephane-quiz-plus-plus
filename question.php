<?php //include "includes/data-collector.php"; ?>
<?php include "includes/head.php"; ?>
<?php include "includes/header.php"; ?>
<?php 
$currentQuestionIndex = 0;

if  (isset($_POST['lastQuestionIndex'])) {
    $lastQuestionIndex = $_POST['lastQuestionIndex'];

    if  (isset($_POST['nextQuestionIndex'])) {
        $currentQuestionIndex = $_POST['nextQuestionIndex'];
    }
}

    $dbHost = getenv('DB_HOST');
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');

    //echo "dbHost=$dbHost, dbName=$dbName, dbUser=$dbUser; dbPassword=$dbPassword<br>";
    $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPassword);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query=$dbConnection->query("SELECT * from Questions");
    $questions=$query->fetchAll(PDO::FETCH_ASSOC);

    for ($q = 0; $q < count($questions); $q++) {
        $question = $questions[$q];
        $subQuery = $dbConnection->prepare("SELECT * from Answers where Answers.questionID=?");
        $subQuery->bindValue(1, $question['ID']);
        $subQuery->execute();
        $answers = $subQuery->fetchAll(PDO::FETCH_ASSOC);
        $questions[$q]['Text'] = $answers;
    }
    $_SESSION['quizData'] = $questions;
    
    //echo "<pre>";
    //print_r($_SESSION['quizData']);
    //echo "</pre>";
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
        <!--<form method="post" onsubmit="return validateQuestion();">-->
            
            <!-- Beginn changeover for implamentation of question's carousel -->
            <?php
                $answers = $questions[$currentQuestionIndex]['Text'];

                for ($a = 0; $a < count($answers); $a++) {
                    echo '<div class="form-check">';

                    $isCorrect = $answers[$a]['IsCorrectAnswer'];
                    echo '<input class="form-check-input" type="checkbox" value="' . $isCorrect . '" id="flexCheckDefault">';
                    echo '<label class="form-check-label" for="flexCheckDefault">';

                    $answers = $questions[$currentQuestionIndex]['Text'];
                    echo $answers[$a]['Text'];

                    echo '</label>';
                    echo '</div>';
                }
            ?>
            <!-- End changeover for implamentation of question's carousel -->
            
            <!-- Code befor implamentaton of question's carousel
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10" id="answerPanel">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="single-choice-1" name="single-choice" value="1">
                        <label class="form-check-label" for="single-choice-1">
                        <?php
                            $answers=$questions[$currentQuestionIndex]['Text'];
                            //$answer=$answers[0];
                            //echo $answer['answer'];
                            echo $answers[0]['Text']; //This line corresponds to the both previous lines.
                          ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="single-choice-2"name="single-choice" value="0">
                        <label class="form-check-label" for="single-choice-2">
                        <?php
                            $answers=$questions[$currentQuestionIndex]['Text'];
                            echo $answers[1]['Text'];
                          ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="single-choice-3" name="single-choice" value="0">
                        <label class="form-check-label" for="single-choice-3"> 
                        <?php
                            $answers=$questions[$currentQuestionIndex]['Text'];
                            echo $answers[2]['Text'];
                        ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="single-choice-4" name="single-choice" value="0">
                        <label class="form-check-label" for="single-choice-4"><p> 
                        <?php
                            $answers=$questions[$currentQuestionIndex]['Text'];
                            echo $answers[3]['Text'];
                        ?>
                        </label>
                    </div>
                    </div> 
                    <div class="col-1"></div>
                </div>
                -->
                <div class="container pt-3">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10">
                            <div>
                                <input type="hidden" name="lasQuestionIndex" value="<?php echo $currentQuestionIndex; ?>">
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