<?php
session_start();

if (!(isset($_SESSION['sessionid']) || $_SESSION['sessionid'] == session_id()) || $_SESSION['admin'] != "1") {
    header("location: ../../../Pages/Home");
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
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <form class="green-background">
        <div class="mb-3">
          <label for="Vraag" class="form-label">Vraag</label>
          <input type="Vraag" class="form-control">
        </div>
        <div class="mb-3">
          <label for="Soortvraag" class="form-label">Soort vraag</label>
          <input type="Soortvraag" class="form-control">
        </div>
        <div class="mb-3">
          <select class="form-select form-control" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
</body>

</html>