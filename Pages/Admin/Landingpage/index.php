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
    <title>Gezondheidsmeter.</title>
</head>

<body>
    <?php include('../../../Assets/PHP prefabs/Header.php'); ?>   
    <div class="container text-center">
    <div class="row">
        <div class="col-md-6 w-100">
            <a href="../../Admin/Createvragen/" class="btn btn-secondary mb-5 d-block mt-36">
                <i class="bi bi-plus-square"></i> Maak vragen
            </a>
            <a href="../../Admin/Users/" class="btn btn-secondary mb-5 d-block mt-3">
                <i class="bi bi-person"></i> Bewerk Medewerkers
            </a>
            <a href="../../Admin/Bewerkvragen" class="btn btn-secondary mb-5 d-block mt-3">
                <i class="bi bi-card-checklist"></i> Bewerk vragen
            </a>
        </div>
    </div>
</div>


</body>

</html>