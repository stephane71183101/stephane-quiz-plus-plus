<?php session_start(); session_destroy(); ?>
<?php include "includes/head.php"; ?>
<?php include "includes/header.php"; ?>
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
        <form action="question.php" method="post" onsubmit="return validateQuestion();">       
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
<?php include "includes/footer.php"; ?>