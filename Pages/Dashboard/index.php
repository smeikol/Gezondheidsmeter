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
                <input type="hidden" value='30' class="text-box" placeholder="0%" onload="gawker()" />
                <div class="gauge-copy"></div>
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