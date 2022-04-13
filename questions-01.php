<?php
include "includes/head.php";
include "includes/data-collector.php";
include "includes/header.php";

    $dbHost = getenv('DB_HOST');
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');

    //echo "dbHost=$dbHost, dbName=$dbName, dbUser=$dbUser; dbPassword=$dbPassword<br>";
    $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPassword);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query=$dbConnection->query("SELECT * from Questions");
    $questions=$query->fetchAll(PDO::FETCH_ASSOC);

    foreach($questions as $key => $question) {
        $subQuery=$dbConnection->prepare("SELECT * from Answers where Answers.QuestionID= ?");
        $subQuery->bindValue(1, $question['ID']);
        $subQuery->execute();
        $answers=$subQuery->fetchAll(PDO::FETCH_ASSOC);
        $question[$key]['answers']=$answers;
        //print "<pre>";
        //print_r($question);
        //print "</pre>";
}
?>
<div>
    <div class="container-fluid text-secondary pt-3 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">

                <h4 id="questionWording">Du bist neu in der Schweiz und hast Papierkram zu erledigen. Wonach erkundigt sich das Amt, wenn es fragt: "Werden Sie betrieben?"<h4>
               
            </div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>
    <div class="container text-secondary h6 mt-3">
        <form action="question-02.php" method="post" onsubmit="return validateQuestion();">       
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10" id="answerPanel">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="single-choice-1" name="single-choice" value="1">
                        <label class="form-check-label" for="single-choice-1"><p>Haben Sie Schulden?</p></label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="single-choice-2"name="single-choice" value="0">
                        <label class="form-check-label" for="single-choice-2"><p>Sind Sie selbstständig?</p></label>
                    </div>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="single-choice-3" name="single-choice" value="0">
                        <label class="form-check-label" for="single-choice-3"><p>Haben Sie eine Festanstellung?</p></label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="single-choice-4" name="single-choice" value="0">
                        <label class="form-check-label" for="single-choice-4"><p>Sind sie haftpflichtversichert?</p></label>
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
                                <button type="submit" class="btn btn-outline-danger buttons">Ergebnis berechnen...</button>
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