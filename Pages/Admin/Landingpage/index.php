<?php
session_start();

if (!(isset($_SESSION['sessionid']) || $_SESSION['sessionid'] == session_id()) || $_SESSION['admin'] != "1") {
    header("location: ../../../Pages/Home");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../../../Assets/css/bootstrap.php'); ?>
    <?php include('../../../Assets/css/textstyling.php'); ?>
    <title>Gezondheidsmeter</title>
</head>

<body>
    <?php include('../../../Assets/PHP prefabs/Header.php'); ?>   
    <div class="container d-flex justify-content-center">
    <div class="row">
        <div class="col-md-6">
            <a href="../../Admin/Createvragen/" class="btn btn-secondary mb-3">Bewerk lijst</a>
            <a href="../../Admin/Createvragen/" class="btn btn-secondary mb-3">Maak vragen</a>
            <a href="../../Admin/Createvragen/" class="btn btn-secondary mb-3">Bewerk Medewerkers</a>
        </div>
    </div>
</div>
    
</body>

</html>