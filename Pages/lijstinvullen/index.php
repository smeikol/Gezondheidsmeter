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


$sql500 = "SELECT * FROM vragen WHERE soortvraag = 3 & MONTH(laatstgebruikt) = MONTH(?)";
$stmt500 = $conn->prepare($sql500);
$stmt500->bind_param("s", $today);
$stmt500->execute();
$result500 = $stmt500->get_result();

if ($result->num_rows > 0) {
    echo date('D');
} else {

    if (date('D') === 'Fri') {
        $sql2 = "SELECT * FROM vragen  WHERE soortvraag = 2";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        while ($row = $result2->fetch_array()) {
            $id = $row['vragenid'];

            $updatelastuse = "UPDATE vragen SET laatstgebruikt = ? WHERE vragenid = ?";
            $stmt4 = $conn->prepare($updatelastuse);
            $stmt4->bind_param("ss", $today, $id);
            $stmt4->execute();

            $inserttodayslist = "INSERT INTO `dagelijkse_lijst` (`vragen_vragenid`, `datum`) VALUES (?, ?)";
            $stmt5 = $conn->prepare($inserttodayslist);
            $stmt5->bind_param("ss", $id, $today);
            $stmt5->execute();
        }
    } else if ($result500->num_rows == 0) {
        $sql2 = "SELECT * FROM vragen  WHERE soortvraag = 3";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        while ($row = $result2->fetch_array()) {
            $id = $row['vragenid'];

            $updatelastuse = "UPDATE vragen SET laatstgebruikt = ? WHERE vragenid = ?";
            $stmt4 = $conn->prepare($updatelastuse);
            $stmt4->bind_param("ss", $today, $id);
            $stmt4->execute();

            $inserttodayslist = "INSERT INTO `dagelijkse_lijst` (`vragen_vragenid`, `datum`) VALUES (?, ?)";
            $stmt5 = $conn->prepare($inserttodayslist);
            $stmt5->bind_param("ss", $id, $today);
            $stmt5->execute();
        }
    } else {
        var_dump($result500);

        $questionlist = [];
        for ($y = 5; $y > 0; $y--) {


            $sql2 = "SELECT DISTINCT laatstgebruikt FROM vragen WHERE soortvraag = 1";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            $alldates = [];
            $randomdatebias = [];

            while ($row = $result2->fetch_array()) {
                $alldates[] = $row["laatstgebruikt"];
            }
            $loopcount = count($alldates);
            rsort($alldates);
            for ($loopcount; $loopcount > 0; $loopcount--) {
                for ($i = $loopcount; $i > 0; $i--) {
                    $randomdatebias[] = $alldates[$loopcount - 1];
                }
            }
            $randomnumber1 = rand(1, count($randomdatebias));
            $chosendate = $randomdatebias[$randomnumber1 - 1];

            $sql3 = "SELECT * FROM vragen  WHERE laatstgebruikt = ? ORDER BY RAND ( ) LIMIT 1";
            $stmt3 = $conn->prepare($sql3);
            $stmt3->bind_param("s", $chosendate);
            $stmt3->execute();
            $result3 = $stmt3->get_result();

            while ($row2 = $result3->fetch_array()) {
                if (in_array($row2['vragenid'], $questionlist)) {
                    $y++;
                } else {
                    $questionlist[] = $row2['vragenid'];
                }
            }
        }

        foreach ($questionlist as $id) {
            $updatelastuse = "UPDATE vragen SET laatstgebruikt = ? WHERE vragenid = ?";
            $stmt4 = $conn->prepare($updatelastuse);
            $stmt4->bind_param("ss", $today, $id);
            $stmt4->execute();

            $inserttodayslist = "INSERT INTO `dagelijkse_lijst` (`vragen_vragenid`, `datum`) VALUES (?, ?)";
            $stmt5 = $conn->prepare($inserttodayslist);
            $stmt5->bind_param("ss", $id, $today);
            $stmt5->execute();
        }

        echo "list gemaakt";
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