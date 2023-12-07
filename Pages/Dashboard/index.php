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
    <form method="post" action="">
        <button type="submit" id="beantwoordVragen" name="beantwoordVragen" class="btn btn-primary">Beantwoord vragen</button>
    </form>
</div>

</body>

</html>