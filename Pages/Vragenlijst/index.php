<?php
include "../../Assets/PHP prefabs/connection.php";
include('../../Assets/css/bootstrap.php');
include('../../Assets/css/textstyling.php');
include('../../Assets/PHP prefabs/Header.php');


if (isset($_POST['submit'])) {
    $antwoorden = $_POST['antwoord'];
    $userid = $_SESSION['gebruikersid'];
    $vraagids = $_POST['vraag']; 
    $vraagcategories = $_POST['vraagcategorie']; 
    $counter = 0;
    foreach ($antwoorden as $antwoordstuk) {
        $sql = "INSERT INTO `gebruikers_lijst_punten` (`gebruikers_id`, `dagelijkse_lijst_id`, `punten_categorie`, `aantalpunten`) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $userid, $vraagids[$counter], $vraagcategories[$counter], $antwoordstuk);
        $result = $stmt->execute();
        $counter++;
    }
    header("Location: ../dashboard");

}

$today = date("Y-m-d");

$sql = "SELECT * FROM dagelijkse_lijst WHERE datum = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();


if (!($result->num_rows > 0)) {
    header("Location: ../lijstinvullen");
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<form method="post" action="">
    <?php
    while ($row = $result->fetch_array()) {


        $sqltest = "SELECT * FROM `gebruikers_lijst_punten` WHERE dagelijkse_lijst_id = ?";
        $stmttest = $conn->prepare($sqltest);
        $stmttest->bind_param("s", $row['id']);
        $stmttest->execute();
        $resulttest = $stmttest->get_result();

        if ($resulttest->num_rows > 0) {
            echo "<script> 
            window.location.replace('../dashboard');
            </script>";
        }

        $vragenid = $row['vragen_vragenid'];
        $sql2 = "SELECT * FROM vragen WHERE vragenid = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("s", $vragenid);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        while ($row2 = $result2->fetch_array()) {
            echo ($row2['vraag'] . "<br>" . "<input type='hidden' value='". $row['id'] . "' name='vraag[]'> </input>" . "<input type='hidden' value='". $row2['categorie'] . "' name='vraagcategorie[]'> </input>"  ."<select name='antwoord[]' id='antwoord'>");
            $sql3 = "SELECT * FROM antwoorden WHERE vragen_vragenid = ?";
            $stmt3 = $conn->prepare($sql3);
            $stmt3->bind_param("s", $vragenid);
            $stmt3->execute();
            $result3 = $stmt3->get_result();
            while ($row3 = $result3->fetch_array()) {
                echo("<option value='" . $row3['punten'] . "'>". $row3['antwoordoptie'] . "</option>"  );
            }
            echo ("</select>" . "<br>");
        }
    }
    ?>
    <button type="submit" name="submit" class="btn btn-success">Verzenden</button>
    </form>
</body>

</html>