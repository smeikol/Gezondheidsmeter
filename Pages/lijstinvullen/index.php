<?php
include('../../Assets/css/bootstrap.php');
include('../../Assets/css/textstyling.php');
include('../../Assets/PHP prefabs/Header.php');

$today = date("Y-m-d");

$sql = "SELECT * FROM dagelijkse_lijst WHERE datum = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gezondheidsmeter</title>
</head>

<body>

</body>

</html>