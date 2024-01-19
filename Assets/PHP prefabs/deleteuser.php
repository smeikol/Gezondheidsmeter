<?php 
include "../../Assets/PHP prefabs/connection.php";
if (!(isset($_SESSION['sessionid']) || $_SESSION['sessionid'] == session_id())) {
    header("location: ../../Pages/Home");
}
$userid = $_GET['gebruikersid'];

$sql = "DELETE FROM `gebruikers_lijst_punten` WHERE gebruikers_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userid);
$stmt->execute();

$sql = "DELETE FROM `gebruikers` WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userid);
$stmt->execute();
header("location: ../../Pages/Admin/Users");
?>