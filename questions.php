<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>

<?php
    $dbHost = getenv('DB_HOST');
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');

    //echo "dbHost=$dbHost, dbName=$dbName, dbUser=$dbUser; dbPassword=$dbPassword<br>";
    $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPassword);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query=$dbConnection->query("SELECT * from Questions");
    $questions=$query->fetchAll(PDO::FETCH_ASSOC);
?>

<header>
    <div class="container-fluid text-secondary">
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                    <div class="col-10">
                        <h1>Quiz++</h1>
                    </div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>
</header>

<?php
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
<main>
    <div>
        <div class="container-fluid bg-secondary text-light pt-3 pb-3 ">
            <div class="container">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <h3 id="questionTitle">Erste Frage</h3>
                        <h6 id="questionWording">Du bist neu in der Schweiz und hast Papierkram zu erledigen. Wonach erkundigt sich das Amt, wenn es fragt: "Werden Sie betrieben?"<h6>
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
                                    <button type="submit" class="btn btn-outline-danger buttons">Weiter</button>
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<footer>
</footer>

</body>
</html>