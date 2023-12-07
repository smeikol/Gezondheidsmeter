<?php
include('../../../Assets/PHP prefabs/connection.php');

if (!(isset($_SESSION['sessionid']) || $_SESSION['sessionid'] == session_id()) || $_SESSION['admin'] != "1") {
    header("location: ../../../Pages/Home");
}
// Create connection
// Fetch questions from the vragen table
$sql = "SELECT vragenid, vraag FROM vragen";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (
    isset($_POST['question_id']) &&
    isset($_POST['title']) &&
    isset($_POST['punt1']) &&
    isset($_POST['punt2']) &&
    isset($_POST['punt3']) &&
    isset($_POST['punt4']) &&
    isset($_POST['answer_1']) &&
    isset($_POST['answer_2']) &&
    isset($_POST['answer_3']) &&
    isset($_POST['answer_4'])
  ) {
    $questionId = $_POST['question_id'];
    $title = $_POST['title'];
    $punt1 = $_POST['punt1'];
    $punt2 = $_POST['punt2'];
    $punt3 = $_POST['punt3'];
    $punt4 = $_POST['punt4'];
    $answer1 = $_POST['answer_1'];
    $answer2 = $_POST['answer_2'];
    $answer3 = $_POST['answer_3'];
    $answer4 = $_POST['answer_4'];

    // Update title for the selected question
    $updateTitle = "UPDATE vragen SET vraag = '$title' WHERE vragenid = $questionId";
    $conn->query($updateTitle);

    // Update points and answers for the selected question
    $updatePunt1 = "UPDATE antwoorden SET punten = $punt1, antwoordoptie = '$answer1' WHERE vragen_vragenid = $questionId AND id = 1";
    $conn->query($updatePunt1);

    $updatePunt2 = "UPDATE antwoorden SET punten = $punt2, antwoordoptie = '$answer2' WHERE vragen_vragenid = $questionId AND id = 2";
    $conn->query($updatePunt2);

    $updatePunt3 = "UPDATE antwoorden SET punten = $punt3, antwoordoptie = '$answer3' WHERE vragen_vragenid = $questionId AND id = 3";
    $conn->query($updatePunt3);

    $updatePunt4 = "UPDATE antwoorden SET punten = $punt4, antwoordoptie = '$answer4' WHERE vragen_vragenid = $questionId AND id = 4";
    $conn->query($updatePunt4);

    // Check if any update query failed
    if ($conn->error) {
      echo "Error updating data: " . $conn->error;
    } else {
      echo "Changes saved successfully";
    }
  } else {
    echo "Invalid data received";
  }
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

  <div class="container mt-4">
  <h1>Edit Questions</h1>
  <form action="process.php" method="post">
    <div class="form-group">
      <label for="questionSelect">Select a Question:</label>
      <select class="form-control" id="questionSelect" name="question_id">
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["vragenid"] . '">' . $row["vraag"] . '</option>';
          }
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="title">Titel:</label>
      <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group">
      <label for="punt1">Antwoord punten 1:</label>
      <input type="number" class="form-control" id="punt1" name="punt1">
    </div>
    <div class="form-group">
      <label for="punt2">Antwoorden punten 2:</label>
      <input type="number" class="form-control" id="punt2" name="punt2">
    </div>
    <div class="form-group">
      <label for="punt3">Antwoorden punten 3:</label>
      <input type="number" class="form-control" id="punt3" name="punt3">
    </div>
    <div class="form-group">
      <label for="punt4">Antwoorden punten 4:</label>
      <input type="number" class="form-control" id="punt4" name="punt4">
    </div>
    <div class="form-group">
      <label for="answer_1">Antwoord 1:</label>
      <input type="text" class="form-control" id="answer_1" name="answer_1">
    </div>
    <div class="form-group">
      <label for="answer_2">Antwoord 2:</label>
      <input type="text" class="form-control" id="answer_2" name="answer_2">
    </div>
    <div class="form-group">
      <label for="answer_3">Antwoord 3:</label>
      <input type="text" class="form-control" id="answer_3" name="answer_3">
    </div>
    <div class="form-group">
      <label for="answer_4">Antwoord 4:</label>
      <input type="text" class="form-control" id="answer_4" name="answer_4">
    </div>
    <input type="submit" name="Opslaan" class="btn btn-primary form-control">
  </form>
</div>
</body>
</html>

