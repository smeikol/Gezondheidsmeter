<?php 
include "../../Assets/PHP prefabs/connection.php";

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}


if(isset($_POST['submit'])){
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);
    $sql2 = "SELECT gebruikersnaam FROM gebruikers WHERE gebruikersnaam = ?  || email = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("ss", $name, $email);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    if ($row = $result2->fetch_array() == true) {
        echo "<script>alert('Email of gebruikersnaam is al in gebruik');</script>";
    } else {
        $sql = "INSERT INTO `gebruikers` (`gebruikersnaam`, `email`, `wachtwoord`) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $wachtwoord);
        $result = $stmt->execute();
        alert('Account is aangemaakt');
        header( "Refresh:0.1; url=../../Pages/Login/", true, 303);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreer</title>
</head>
<body>
<form method="post" action="">
    <br>
    <input  type="text" name="name" required placeholder="Kies uw gebruikersnaam">
    <br> <br>
    <input  type="email" name="email" required placeholder="Vul uw E-mail in">
    <br> <br>
    <input  type="password" name="wachtwoord" required placeholder="Kies uw wachtwoord">
    <br> <br>
    <input  type="submit" name="submit" value="Creëer uw account">
    <br> <br>
</form>
</body>
</html>