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
<div class="container d-flex justify-content-center">
  <div class="row green-background  ">
    <div class="col-lg-6">
      <form method="post" class="">
        <div class="mb-3">
          <label for="Vraag" class="form-label">Vraag</label>
          <input type="Vraag" name="vraag" class="form-control">
        </div>
        <div class="mb-3">
          <select class="form-select form-control" name="vraagcommon" aria-label="Default select example">
            <option selected></option>
            <option value="1">Dagelijks</option>
            <option value="2">Weekelijks</option>
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
  </div>
</div>

</body>

</html>