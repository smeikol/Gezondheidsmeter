<?php
include('../../../Assets/PHP prefabs/connection.php');

// Session check
if (!(isset($_SESSION['sessionid']) && $_SESSION['sessionid'] == session_id()) || $_SESSION['admin'] != "1") {
    header("location: ../../../Pages/Home");
    exit();
}

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
        isset($_POST['answer_4']) &&
        isset($_POST['vraagcommon']) &&
        isset($_POST['vraagsoort'])
    ) {
        // Retrieve POST data
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
        $vraagcommon = $_POST['vraagcommon'];
        $vraagsoort = $_POST['vraagsoort'];

        // Update queries
        $updateTitle = "UPDATE vragen SET vraag = ?, soortvraag = ?, categorie = ? WHERE vragenid = ?";
        $stmt = $conn->prepare($updateTitle);
        $stmt->bind_param("ssss", $title, $vraagcommon, $vraagsoort, $questionId);
        $stmt->execute();

        // Update other fields...
        $sql = "SELECT id FROM antwoorden WHERE vragen_vragenid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $questionId);
        $stmt->execute();
        $result = $stmt->get_result();

        $counter = 0;

        while ($row = $result->fetch_array()) {
            $counter++;
            $updateTitle2 = "UPDATE antwoorden SET antwoordoptie = ?, punten = ? WHERE id = ?";
            $stmt2 = $conn->prepare($updateTitle2);
            $stmt2->bind_param("sss", $_POST['answer_' . $counter], $_POST['punt' . $counter], $row['id']);
            $stmt2->execute();
        }

        // Check for errors
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

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form action="" method="post" class="green-background p-4 rounded">
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
                <label for="vraagdag">Hoevaak een vraag gesteld moet worden:</label>
                <div class="mb-3">
                    <select class="form-select form-control" name="vraagcommon" aria-label="Default select example">
                        <option selected></option>
                        <option value="1">Dagelijks</option>
                        <option value="2">Wekelijks</option>
                        <option value="3">Maandelijks</option>
                    </select>
                </div>
                <label for="Categorie">Categorie:</label>
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
                    <!-- Add the rest of your form fields here -->
                    <div class="form-group">
                        <label for="punt1">Antwoord punten 1:</label>
                        <input type="number" class="form-control" id="punt1" name="punt1">
                    </div>
                    <!-- Add the rest of your form fields here -->
                    <input type="submit" name="Opslaan" class="btn btn-primary form-control mt-3">
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>