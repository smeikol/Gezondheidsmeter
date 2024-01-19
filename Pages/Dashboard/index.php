<?php
include "../../Assets/PHP prefabs/connection.php";

if (isset($_POST['beantwoordVragen'])) {
    $today = date("Y-m-d");
    echo $today;
}

$userid = $_SESSION['gebruikersid'];

$categorie1puntentotaal = 0;
$categorie2puntentotaal = 0;
$categorie3puntentotaal = 0;
$categorie4puntentotaal = 0;
$categorie5puntentotaal = 0;
$categorie6puntentotaal = 0;

$categorie1puntenuser = 0;
$categorie2puntenuser = 0;
$categorie3puntenuser = 0;
$categorie4puntenuser = 0;
$categorie5puntenuser = 0;
$categorie6puntenuser = 0;

$percentage1 = 0;
$percentage2 = 0;
$percentage3 = 0;
$percentage4 = 0;
$percentage5 = 0;
$percentage6 = 0;

$sql = "SELECT * FROM `gebruikers_lijst_punten` WHERE gebruikers_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userid);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    header("Location: ../vragenlijst");
}
while ($row = $result->fetch_array()) {

$lijstid = $row['dagelijkse_lijst_id'];

$sql2 = "SELECT * FROM `dagelijkse_lijst` WHERE id = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("s", $lijstid);
$stmt2->execute();
$result2 = $stmt2->get_result();

while ($row2 = $result2->fetch_array()) {
$vraagid = $row2['vragen_vragenid'];

$sql3 = "SELECT MAX(`punten`) FROM `antwoorden` WHERE vragen_vragenid = ?";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("s", $vraagid);
$stmt3->execute();
$result3 = $stmt3->get_result();

while ($row3 = $result3->fetch_array()) {

    $ctpunten = $row3[0];



$categorie = $row['punten_categorie'];

if ($categorie == 0) {
    $categorie1puntentotaal += $ctpunten;
    $categorie1puntenuser += $row['aantalpunten'];
}
else if ($categorie == 1) {
    $categorie2puntentotaal += $ctpunten;
    $categorie2puntenuser += $row['aantalpunten'];
}
else if ($categorie == 2) {
    $categorie3puntentotaal += $ctpunten;
    $categorie3puntenuser += $row['aantalpunten'];
}
else if ($categorie == 3) {
    $categorie4puntentotaal += $ctpunten;
    $categorie4puntenuser += $row['aantalpunten'];
}
else if ($categorie == 4) {
    $categorie5puntentotaal += $ctpunten;
    $categorie5puntenuser += $row['aantalpunten'];
}
else if ($categorie == 5) {
    $categorie6puntentotaal += $ctpunten;
    $categorie6puntenuser += $row['aantalpunten'];
}


}
}
}


$totaalpuntentotaal = $categorie1puntentotaal + $categorie2puntentotaal + $categorie3puntentotaal + $categorie4puntentotaal + $categorie5puntentotaal + $categorie6puntentotaal;
$totaalpuntenuser = $categorie1puntenuser + $categorie2puntenuser + $categorie3puntenuser + $categorie4puntenuser + $categorie5puntenuser + $categorie6puntenuser;

$percentageALL = ( $totaalpuntenuser * 100 ) / $totaalpuntentotaal;
if (!($categorie1puntentotaal == 0)){
$percentage1 = ( $categorie1puntenuser * 100 ) / $categorie1puntentotaal;
}
if (!($categorie2puntentotaal == 0)){
$percentage2 = ( $categorie2puntenuser * 100 ) / $categorie2puntentotaal;
}
if (!($categorie3puntentotaal == 0)){
$percentage3 = ( $categorie3puntenuser * 100 ) / $categorie3puntentotaal;
}
if (!($categorie4puntentotaal == 0)){
$percentage4 = ( $categorie4puntenuser * 100 ) / $categorie4puntentotaal;
}
if (!($categorie5puntentotaal == 0)){
$percentage5 = ( $categorie5puntenuser * 100 ) / $categorie5puntentotaal;
}
if (!($categorie6puntentotaal == 0)){
$percentage6 = ( $categorie6puntenuser * 100 ) / $categorie6puntentotaal;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gezondheidsmeter</title>
    <?php include('../../Assets/css/bootstrap.php'); ?>
    <?php include('../../Assets/css/textstyling.php'); ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="../../Assets/CSS/meter.css">
</head>

<body>
    <?php include('../../Assets/PHP prefabs/Header.php'); ?>
    <div class="centered-text">
    </div>
    <style>


    </style>
    </head>

    <body>

        <div class="text-center">
            <h1 class="">Gezonde Leefstijl Schaal</h1>
        </div>

        <div class="container">
            <div class="guage-holder">
                <div class="circle-mask">
                    <div class="circle">
                        <div class="circle-inner"></div>
                    </div>
                </div>
                <div class="percentage">0 %</div>
                <br>
                <input type="hidden" value='<?php echo $percentageALL ?>' class="text-box" placeholder="0%" onload="gawker()" />
                <div class="gauge-copy"></div>
            </div>
        </div>

        <div class="container-fluid vh-100">
            <div class="col-lg-12">
                <div class="row justify-content-center">
                    <div class="col-sm-12 text-center mb-3">
                        <label class="">Arbeidsomstandigheden</label>
                        <meter class="meter w-50 text-center" low="50" max="100" id="Arbeidsomstandigheden" value="<?php echo $percentage1 ?>">40%</meter>
                    </div>
                    <div class="col-sm-12 text-center mb-3">
                        <label class="">Sport en bewegen</label>
                        <meter class="meter w-50 text-center" low="50" max="100" id="Sport_en_bewegen" value="<?php echo $percentage2 ?>">60%</meter>
                    </div>
                    <div class="col-sm-12 text-center mb-3">
                        <label class="">Voeding</label>
                        <meter class="meter w-50 text-center" low="50" max="100" id="Voeding" value="<?php echo $percentage3 ?>">60%</meter>
                    </div>
                    <div class="col-sm-12 text-center mb-3">
                        <label class="">Alcohol</label>
                        <meter class="meter w-50 text-center" low="50" max="100" id="Alcohol" value="<?php echo $percentage4 ?>">60%</meter>
                    </div>
                    <div class="col-sm-12 text-center mb-3">
                        <label class="">Drugs</label>
                        <meter class="meter w-50 text-center" low="50" max="100" id="Drugs" value="<?php echo $percentage5 ?>">60%</meter>
                    </div>
                    <div class="col-sm-12 text-center mb-3">
                        <label class="">Slaap</label>
                        <meter class="meter w-50 text-center" low="50" max="100" id="Slaap" value="<?php echo $percentage6 ?>">60%</meter>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center top-0 start-0 mt-3 ms-3">
            <button onclick='toindex()' id="beantwoordVragen" class="btn btn-primary">Beantwoord vragen</button>
            <a href="../../Assets/PHP prefabs/deletedatauser.php" class="btn btn-danger">Reset progressie</a>
        </div>

    </body>
    <script>
        function toindex() {
            window.location.replace("../../Pages/lijstinvullen/")
        }
    </script>




    <script>
        $(function() {
            function updateGauge() {
                var dVal = $('.text-box').val();
                if (dVal === '') {
                    dVal = 0;
                }

                if (dVal >= 0 && dVal <= 100) {
                    var newVal = dVal * 1.8 - 45;
                    $('.circle-inner, .gauge-copy').css({
                        'transform': 'rotate(' + newVal + 'deg)'
                    });
                    $('.gauge-copy').css({
                        'transform': 'translate(-50%, -50%) rotate(' + dVal * 1.8 + 'deg)'
                    });
                    $('.percentage').text(dVal + ' %');
                } else {
                    $('.percentage').text('Invalid input value');
                }
            }

            // Call the function on page load
            updateGauge();
        });
    </script>
</body>

</html>