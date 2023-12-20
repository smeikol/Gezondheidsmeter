<?php
include('../../../Assets/PHP prefabs/connection.php');

if (!(isset($_SESSION['sessionid']) || $_SESSION['sessionid'] == session_id()) || $_SESSION['admin'] != "1") {
  header("location: ../../../Pages/Home");
}



if (isset($_POST['submit'])) {
  $vraag = htmlspecialchars($_POST['vraag']);
  $vraagcommon = htmlspecialchars($_POST['vraagcommon']);
  $vraagsoort = htmlspecialchars($_POST['vraagsoort']);



  $sql = "INSERT INTO `vragen` (`vraag`, `categorie`, `soortvraag`) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $vraag, $vraagsoort, $vraagcommon);
  $result = $stmt->execute();


  $questionid = mysqli_insert_id($conn);

  for ($i = 1; $i < 5; $i++) {

    $antwoord = htmlspecialchars($_POST['Antwoord' . $i]);
    $punten = htmlspecialchars($_POST['Punten' . $i]);
    $sql2 = "INSERT INTO `Antwoorden` (`antwoordoptie`, `vragen_vragenid`, `punten`) VALUES (?, ?, ?)";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("sss", $antwoord, $questionid, $punten);
    $result2 = $stmt2->execute();
  }
  // header( "Refresh:0.1; url=../Landingpage/", true, 303);
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
  <div class="container vh-600 d-flex justify-content-center align-items-center">
    <div class="row green-background">
      <div class="col-lg-9">
        <form method="post">
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
            <label for="Vraag" class="form-label">Antwoord 1</label>
            <div class="form-check mb-2">
              <input type="text" id="Antwoord1" name="Antwoord1" class="form-control">
              <div class="form-group">
                <label for="points1">Punten</label>
                <input type="text" id="Antwoord1" name="Punten1" class="form-control">
                </select>
              </div>
            </div> 
            <div class="form-check mb-2">
              <input type="text" id="Antwoord2" name="Antwoord2" class="form-control">
              <div class="form-group">
                <label for="points1">Punten</label>
                <input type="text" id="Antwoord2" name="Punten2" class="form-control">
                </select>
              </div>
            </div>

            <label for="Vraag" class="form-label">Antwoord 3</label>
            <div class="form-check mb-2">
              <input type="text" id="Antwoord3" name="Antwoord3" class="form-control">
              <div class="form-group">
                <label for="points1">Punten</label>
                <input type="text" id="Antwoord3" name="Punten3" class="form-control">
                </select>
              </div>
            </div>

            <label for="Vraag" class="form-label">Antwoord 4</label>
            <div class="form-check mb-2">
              <input type="text" id="Antwoord4" name="Antwoord4" class="form-control">
              <div class="form-group">
                <label for="points1">Punten</label>
                <input type="text" id="Antwoord4" name="Punten4" class="form-control">
                </select>
              </div>
            </div>
            <input type="submit" name="submit" class="btn btn-primary form-control">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>