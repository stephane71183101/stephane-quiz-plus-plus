<?php
printResult();
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
    //Devonly
    echo "TotalPoints = $totalPoints<br>";
    return $totalPoints;
}
?>