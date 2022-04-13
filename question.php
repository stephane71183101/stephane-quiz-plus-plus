<?php //include "includes/data-collector.php"; ?>
<?php include "includes/head.php"; ?>
<?php include "includes/header.php"; ?>
<?php 
$currentQuestionsIndex=0;

if  (isset($_POST["lastQuestionIndex"])) {
    $lastQuestionIndex=$_POST["lastQuestionIndex"];

    if  (isset($_POST["nextQuestionIndex"])) {
        $currentQuestionsIndex=$_POST["nextQuestionIndex"];
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

    for ($q=0; $q < count($questions); $q++) {
        $question=$questions[$q];
        $subQuery=$dbConnection->prepare("SELECT * from Answers where Answers.questionID=?");
        $subQuery->bindValue(1, $question['ID']);
        $subQuery->execute();
        $answers=$subQuery->fetchAll(PDO::FETCH_ASSOC);
        $questions[$q]['answers']=$answers;
    }
    $_SESSION['quizData']=$questions;
    
    //echo "<pre>";
    //print_r($_SESSION['quizData']);
    //echo "</pre>";

    /* Note: original code befor changeover with Chris
    foreach($questions as $key => $question) {
        $subQuery=$dbConnection->prepare("SELECT * from Answers where Answers.QuestionID= ?");
        $subQuery->bindValue(1, $question['ID']);
        $subQuery->execute();
        $answers=$subQuery->fetchAll(PDO::FETCH_ASSOC);
        $question[$key]['answers']=$answers;
        echo "<pre>";
        print_r($question);
        echo "</pre>";
    }
    */
?>
<div>
    <div class="container-fluid text-secondary pt-3 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">

                <h5 class="text-primary">Frage <?php echo $currentQuestionsIndex+1; ?><h5>
                <h4 id="questionWording"><?php echo $questions[$currentQuestionsIndex]['Text']; ?><h4>
            </div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>
    <div class="container text-secondary h6 mt-3">
        <form action="result.php" method="post" onsubmit="return validateQuestion();">       
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10" id="answerPanel">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="single-choice-1" name="single-choice" value="1">
                        <label class="form-check-label" for="single-choice-1">
                        <?php
                            $answers=$questions[$currentQuestionsIndex]['answers'];
                            //$answer=$answers[0];
                            //echo $answer['answer'];
                            echo $answers[0]['Text']; //This line correspond to the both previous lines
                          ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="single-choice-2"name="single-choice" value="0">
                        <label class="form-check-label" for="single-choice-2">
                        <?php
                            $answers=$questions[$currentQuestionsIndex]['answers'];
                            echo $answers[1]['Text'];
                          ?>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="single-choice-3" name="single-choice" value="0">
                        <label class="form-check-label" for="single-choice-3"> 
                        <?php
                            $answers=$questions[$currentQuestionsIndex]['answers'];
                            echo $answers[2]['Text'];
                        ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="single-choice-4" name="single-choice" value="0">
                        <label class="form-check-label" for="single-choice-4"><p> 
                        <?php
                            $answers=$questions[$currentQuestionsIndex]['answers'];
                            echo $answers[3]['Text'];
                        ?>
                        </label>
                    </div>
                    </div> 
                    <div class="col-1"></div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10">
                            <div>
                                <input type="hidden" name="lastPageID" value="question-01">
                                <input type="hidden" id="achievedPoints" name="achievedPoints">
                                <p id="validation-warning" class="warning"></p>
                                <button type="submit" class="btn btn-outline-primary buttons">Ergebnis berechnen...</button>
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