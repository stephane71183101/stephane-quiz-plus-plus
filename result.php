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

<main>
<?php
// data collector
session_start();
$lastPageID = $_POST["lastPageID"];
$_SESSION[$lastPageID] = $_POST;

printResult();

// data evealuation
function printResult() {
    
    $totalPoints = evaluateQuestions();
    
   if ($totalPoints < 9) {
        echo "<h3>" . "Du musst noch viel nachholen..." . "</h3>";

    }
    elseif ($totalPoints < 13) {
        echo "<h3>" . "Gut, Du weisst schon viel!" . "</h3>";
 
    }
    elseif ($totalPoints > 13) {
        echo "<h3>Super! Bist du aus der Schweiz?</h3>";

    }
}

function evaluateQuestions() {
    $questionPageNames = [
        "question-01",
        "question-02",
        "question-03",
        "question-04",
        "question-05",
        "question-06",
        "question-07",
        "question-08",
        "question-09",
        "question-10",
        "question-11",
        "question-12",
        "question-13",
        "question-14",
        "question-15"
];
    
    $totalPoints = 0;
    $pageNum = count($questionPageNames);
    
    for ($i = 0; $i < $pageNum; $i++) {
        $lastPageID = $questionPageNames[$i];
    
        if (isset($_SESSION[$lastPageID])) {
            $pageData = $_SESSION[$lastPageID];
            $achievedPoints = $pageData["achievedPoints"];
    
            $totalPoints = $totalPoints + intval($achievedPoints);
        }
    }
    
    // DEVONLY
    echo "TotalPoints = $totalPoints<br>";

    return $totalPoints;
    
    }
    ?>

    <div>
        <div class="container-fluid bg-secondary text-light pt-3 pb-3 ">
            <div class="container">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <h4 id="questionTitle">Hier ist dein Quiz-Ergebnis...</h4>
                    </div>
                    <div class="col-1"></div>
                </div>
            </div>
        </div>
        <div class="container text-secondary h6 mt-3">
            <form action="questions.php" method="post" onsubmit="return validateQuestion();">       
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div>
                                    <input type="hidden" name="lastPageID" value="question-01">
                                    <input type="hidden" id="achievedPoints" name="achievedPoints">
                                    <p id="validation-warning" class="warning"></p>
                                    <button type="submit" class="btn btn-outline-danger buttons">Noch einmal spielen...</button>
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