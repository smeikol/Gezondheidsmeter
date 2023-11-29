<?php
session_start();


if (!(isset($_SESSION['sessionid']) || $_SESSION['sessionid'] == session_id()) || $_SESSION['admin'] != "1") {
    header("location: ../../../Pages/Home");
} ?>

<?php include('../../../Assets/css/bootstrap.php'); ?> 
<?php include('../../../Assets/css/textstyling.php'); ?> 
<?php include('../../../Assets/PHP prefabs/Header.php'); ?>
<?php include('../../../Assets/PHP prefabs/connection.php'); ?>

<table class="table">
  <thead class="table-success">
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <?php
        $sql = "SELECT * from gebruikers";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the data from the result set
        while ($row = $result->fetch_assoc()) {
            // Do something with each row, for example, echo the user's name
            echo '<tr>';
            echo '  <th scope="row">' . $row['id'] . '</th>';
            echo '  <td>' . $row['gebruikersnaam'] . '</td>';
            echo '  <td>' . $row['email'] . '</td>';
            
            if ($row['admin'] == 0) {
                echo '<td><button type="button" class="btn btn-warning btn-sm text-sm">Maak admin</button></td>';
            } else {
                echo '<td><button type="button" class="btn btn-danger btn-sm text-sm">Maak gebruiker</button></td>';
            }
            
            echo '<td><button type="button" class="btn btn-danger btn-sm text-sm">Verwijder gebruiker</button></td>';
            echo '</tr>';
        }
        ?>
  </tbody>
</table>