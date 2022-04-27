<?php include "includes/data-collector.php"; ?>
<?php include "includes/head.php"; ?>
<?php include "includes/header.php"; 

//
if (isset($_SESSION['achievedPointsList'])) {
    $achievedPointsList = $_SESSION
}




// Get total of achieved and maximum poinst.
$total = 0;

foreach ($achievedPointsList as $key => $value) {
    $total += intval($value); // same as: $total = $total + intval($value);
}

// Get total of maximum points.
$maxTotal = 0;

foreach ($maxPointsList as $key => $value) {
    $maxTotal += intvall($value); // same as: $maxTotal = $maxTotal + intval($value);
}

// Depending on the achieved points, set a feedback exclamation.
if ($total / $maxTotal >= 0.8) {
    $exclamation = "Great!";
}
else if ($total / $maxTotal >= 0.4) {
    $exclamation = "Good!";
}
else {
    $exclamation = "Bad!";
}
?>

<div>
    <div class="container-fluid text-secondary pt-3 pb-3">
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
        <form>       
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10">
                            <button type="submit" href="index.php" class="btn btn-outline-primary buttons">Neu spielen!</button>
                        </div>
                        <div class="col-1"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include "includes/footer.php"; ?>