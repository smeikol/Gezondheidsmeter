<?php
session_start();

if (!(isset($_SESSION['sessionid']) || $_SESSION['sessionid'] == session_id())) {
    header("location: ../../../Home");
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
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-primary mb-3">Bewerk lijst</button>
                <button type="button" class="btn btn-secondary mb-3">Maak vragen</button>
                <button type="button" class="btn btn-success mb-3">Bewerk gebruikers</button>
                <button type="button" class="btn btn-danger mb-3">Bewerk Admin perms</button>
            </div>
        </div>
    </div>
    
</body>

</html>