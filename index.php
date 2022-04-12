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
<?php //echo "echo php"; ?>
    <div>
    <div class="container-fluid text-secondary pt-3 pb-3">
            <div class="container">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <h4 id="questionTitle">Im Quiz werden dir Redewendung-Fragen gestellt. Manche Fragen können mehrere richtige Antworten haben. Bist du bereit?</h4>
                    </div>
                    <div class="col-1"></div>
                </div>
            </div>
        </div>
        <div class="container text-secondary h6 mt-3">
            <form action="questions-01.php" method="post" onsubmit="return validateQuestion();">       
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div>
                                    <input type="hidden" name="lastPageID" value="question-01">
                                    <input type="hidden" id="achievedPoints" name="achievedPoints">
                                    <p id="validation-warning" class="warning"></p>
                                    <button type="submit" class="btn btn-outline-danger buttons">Ja!</button>
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