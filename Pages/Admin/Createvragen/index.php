<?php
include('../../../Assets/PHP prefabs/connection.php');

if (!(isset($_SESSION['sessionid']) || $_SESSION['sessionid'] == session_id()) || $_SESSION['admin'] != "1") {
    header("location: ../../../Pages/Home");
}



if(isset($_POST['submit'])){
  $vraag = htmlspecialchars($_POST['vraag']);
  $vraagcommon = htmlspecialchars($_POST['vraagcommon']);
  $vraagsoort = htmlspecialchars($_POST['vraagsoort']);

  $sql = "INSERT INTO `vragen` (`vraag`, `categorie`, `soortvraag`) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $vraag, $vraagsoort, $vraagcommon);
  $result = $stmt->execute();
  header( "Refresh:0.1; url=../Landingpage/", true, 303);


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
<div class="container d-flex justify-content-center align-items-center vh-600">
  <div class="row">
    <div class="col-lg-9 ms-auto">
      <form method="post" class="green-background">
        <div class="mb-3">
          <label for="Vraag" class="form-label">Vraag</label>
          <input type="text" name="vraag" class="form-control">
        </div>
        <div class="mb-3">
          <select class="form-select form-control" name="vraagcommon" aria-label="Default select example">
            <option selected></option>
            <option value="1">Dagelijks</option>
            <option value="2">Wekelijks</option>
            <option value="3">Maandelijks</option>
          </select>
        </div>
        <div class="mb-3">
          <select class="form-select form-control" name="vraagsoort" aria-label="Default select example">
            <option selected></option>
            <option value="0">Arbeidsomstandigheden</option>
            <option value="1">Sport en bewegen</option>
            <option value="2">Voeding</option>
            <option value="3">Alcohol</option>
            <option value="4">Drugs</option>
            <option value="5">Slaap</option>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary form-control">Submit</button>
      </form>
    </div>
      
    <div class="container">
  <div class="row">
    <div class="col-lg-9 ms-auto">
      <form method="post" class="green-background">
      <label for="Vraag" class="form-label">Antwoorden</label>
      <div class="form-check mb-2">
            <input type="checkbox" id="chkAntwoord1" class="form-check-input">
            <input type="text" id="Antwoord1" name="Antwoord1" class="form-control">
          </div>

          <div class="form-check mb-2">
            <input type="checkbox" id="chkAntwoord2" class="form-check-input">
            <input type="text" id="Antwoord2" name="Antwoord2" class="form-control">
          </div>

          <div class="form-check mb-2">
            <input type="checkbox" id="chkAntwoord3" class="form-check-input">
            <input type="text" id="Antwoord3" name="Antwoord3" class="form-control">
          </div>

          <div class="form-check mb-2">
            <input type="checkbox" id="chkAntwoord4" class="form-check-input">
            <input type="text" id="Antwoord4" name="Antwoord4" class="form-control">
          </div>
        <button type="submit" name="submit" class="btn btn-primary form-control">Submit</button>
      </form>
    </div>  
</body>

</html>