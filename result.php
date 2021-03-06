<?php include "includes/data-collector.php"; 
include "includes/head.php"; 
include "includes/header.php"; 



// Get the lists with the achieved and maximum points (listed per question).
if (isset($_SESSION['achievedPointsList'])) {
    $achievedPointsList = $_SESSION['achievedPointsList'];
}
else {
    // Lands here if result.php is opened in the browser before visiting any question before.
    $achievedPointsList = array();
}
if (isset($_SESSION['maxPointsList'])) {
    $maxPointsList = $_SESSION['maxPointsList'];
}
else {
    $maxPointsList = array();
}
// Get total of achieved and maximum poinst.
$total = 0;

foreach ($achievedPointsList as $key => $value) {
    $total += $value; // same as: $total = $total + $value;
}

$maxTotal = 0;

foreach ($maxPointsList as $key => $value) {
    $maxTotal += $value; // same as: $maxTotal = $maxTotal + $value;
}

// Depending on the achieved points, set a feedback exclamation.
if ($total / $maxTotal >= 0.8) {
    $exclamation = "Ausgezeichnet";
}
else if ($total / $maxTotal >= 0.4) {
    $exclamation = "Gut";
}
else {
    $exclamation = "Kopf hoch";
}
?>

<div>
    <div class="container-fluid text-secondary pt-3 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <h4 id="questionTitle"><?php echo $exclamation; ?>, dein Ergebnis ist <?php echo $total; ?> von <?php echo $maxTotal; ?> Punkte!</h4>
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>
    <div class="container text-secondary h6 mt-3">
        <form action="index.php">       
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10">
                            <button type="submit" class="btn btn-outline-primary buttons">Neu spielen!</button>
                        </div>
                        <div class="col-1"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include "includes/footer.php"; ?>