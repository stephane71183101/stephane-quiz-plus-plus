<?php
function getQuestions () {
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
        $questions[$q]['answers'] = $answers;
    }

    return $questions;

}
?>