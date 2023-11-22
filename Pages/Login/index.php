<?php

include "../../Assets/PHP prefabs/connection.php";

function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

if (isset($_POST['login'])) {
    $name = htmlspecialchars($_POST['username']);
    $wachtwoord = htmlspecialchars($_POST['password']);

    $sql = "SELECT `id`, `wachtwoord`, `email` , `admin` FROM `gebruikers` WHERE `gebruikersnaam` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $name);
    $stmt->execute();
    $result = $stmt->get_result();

    try {
        while ($row = $result->fetch_array()) {
            $passwordreturn = password_verify($wachtwoord, $row['wachtwoord']);

            if ($passwordreturn) {
                $_SESSION['gebruikersnaam'] = $name;
                $_SESSION['admin'] = $row['admin'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['gebruikersid'] = $row['id'];
                $_SESSION['sessionid'] = session_id();

                if($_SESSION['admin'] == "1"){
                    header("Refresh:0.1; url=../../Pages/Admin/Landingpage", true, 303);
                }
                else {
                    header("Refresh:0.1; url=../../Pages/Dashboard/", true, 303);
                }
                
            }
        }
    } catch (Exception $e) {
        $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gezondheidsmeter</title>
    <?php include('../../Assets/css/bootstrap.php'); ?> 
    <?php include('../../Assets/css/textstyling.php'); ?> 
</head>

<body>
<?php include ('../../Assets/PHP prefabs/Header.php');?>
<div class="centered-form">
  <form method="post" action="">
  <div class="green-background">
    <input type="text" required autofocus="" name="username" placeholder="Vul uw gebruikersnaam in" class="form-control">
    <input type="password" required name="password" placeholder="Vul uw wachtwoord in" class="form-control">
    <button type="submit" name="login" class="btn btn-success">Log in</button>
  </form>
</div>
</div>



</body>

</html>