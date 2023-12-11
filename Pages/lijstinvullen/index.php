<?php
include "../../Assets/PHP prefabs/connection.php";
include('../../Assets/css/bootstrap.php');
include('../../Assets/css/textstyling.php');
include('../../Assets/PHP prefabs/Header.php');


$today = date("Y-m-d");

$sql = "SELECT * FROM dagelijkse_lijst WHERE datum = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) { 

}

else {
    $sql2 = "SELECT DISTINCT laatstgebruikt FROM vragen";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    $alldates = [];

    while ($row = $result2->fetch_array()) {
        $alldates[] = $row["laatstgebruikt"];
    }
    $loopcount = count($alldates);
    sort($alldates);
    var_dump($alldates);
    for ($loopcount; $loopcount > 0; $loopcount--) {
        $randomdatebias = "vul later in lol ben nog niet klaar";
    }



}


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