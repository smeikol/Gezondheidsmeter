<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['beantwoordVragen'])) {
    $today = date("Y-m-d");
    echo $today;
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
</head>

<body>
    <?php include ('../../Assets/PHP prefabs/Header.php');?>
    <div class="centered-text">
</div>
    <style>

        
    </style>
</head>
<body>

    <div class="text-center">
        <h1 class="">Gezonde Leefstijl Schaal</h1>
    </div>

    <div class="container-fluid d-flex justify-content-center align-items-center vh-80">
        <div class="col-lg-8"> <!-- Bootstrap column, adjust based on your layout -->
            <div class="schaal-container">
                <div class="schaal">
                    <div class="pijl"></div>
                </div>
                <div class="waarde">7</div>
            </div>
        </div>
    </div>  
    <div class="container-fluid vh-100">
    <div class="col-lg-12">
        <div class="row justify-content-center">
            <div class="col-sm-12 text-center mb-3">
                <label class="">Arbeidsomstandigheden</label>
                <meter class="meter w-50 text-center" id="Arbeidsomstandigheden" value="0.1">40%</meter>
            </div>
            <div class="col-sm-12 text-center mb-3">
                <label class="">Sport en bewegen</label>
                <meter class="meter w-50 text-center" id="Sport_en_bewegen" value="0.6">60%</meter>
            </div>
            <div class="col-sm-12 text-center mb-3">
                <label class="">Voeding</label>
                <meter class="meter w-50 text-center" id="Voeding" value="0.6">60%</meter>
            </div>
            <div class="col-sm-12 text-center mb-3">
                <label class="">Alcohol</label>
                <meter class="meter w-50 text-center" id="Alcohol" value="0.6">60%</meter>
            </div>
            <div class="col-sm-12 text-center mb-3">
                <label class="">Drugs</label>
                <meter class="meter w-50 text-center" id="Drugs" value="0.6">60%</meter>
            </div>
            <div class="col-sm-12 text-center mb-3">
                <label class="">Slaap</label>
                <meter class="meter w-50 text-center" id="Slaap" value="0.6">60%</meter>
            </div>
        </div>
    </div>
</div>

<div class="text-center top-0 start-0 mt-3 ms-3">
        <button onclick='toindex()' id="beantwoordVragen" class="btn btn-primary">Beantwoord vragen</button>
    </div>

</body>
<script>
    function toindex() {
        window.location.replace("../../Pages/lijstinvullen/")
    }
</script>




    <script>
        // JavaScript om de pijl te draaien op basis van de waarde
        const waardeElement = document.querySelector('.waarde');
        const pijlElement = document.querySelector('.pijl');

        function updatePijlRotatie() {
            const waarde = parseFloat(waardeElement.innerText);
            const rotatieHoek = (waarde / 10) * 180; // Aannemende schaal van 0 tot 10

            pijlElement.style.transform = `translate(-50%, -50%) rotate(${rotatieHoek}deg)`;
        }

        // Voorbeeld: Wijzig de waarde en update de pijlrotatie
        waardeElement.innerText = '-3';
        updatePijlRotatie();
    </script>
</body>

</html>