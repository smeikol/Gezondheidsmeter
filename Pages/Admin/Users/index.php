<?php include('../../../Assets/css/bootstrap.php'); ?> 
<?php include('../../../Assets/css/textstyling.php'); ?> 
<?php include('../../../Assets/PHP prefabs/connection.php');
if (!(isset($_SESSION['sessionid']) || $_SESSION['sessionid'] == session_id()) || $_SESSION['admin'] != "1") {
  header("location: ../../../Pages/Home");
}
if (isset($_POST['edit-perms'])) {
  $value_button = $_POST['edit-perms'];
  $explodedArray = explode("-", $value_button);
  $value_role = $explodedArray[0];
  $user_id = $explodedArray[1];
  $stmt = $conn->prepare("UPDATE gebruikers SET admin = ? WHERE id = ?");
  $stmt->bind_param("ii", $value_role, $user_id);
  $stmt->execute();
}



 ?>

<?php include('../../../Assets/css/bootstrap.php'); ?> 
<?php include('../../../Assets/css/textstyling.php'); ?> 
<?php include('../../../Assets/PHP prefabs/Header.php'); ?>

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
                echo '<form method="post" action="">';
                echo '<td><button name="edit-perms" value="1-' . $row['id'] . '" id="edit-perms" type="submit" class="btn btn-warning btn-sm text-sm">Maak admin</button></td>';
                echo '</form>';
            } else {
                echo '<form method="post" action="">';
                echo '<td><button name="edit-perms" value="0-' . $row['id'] . '" id="edit-perms" type="submit" class="btn btn-danger btn-sm text-sm">Maak gebruiker</button></td>';
                echo '</form>';
            }
            
            echo '<td><button type="button" onclick="redirect(' . $row['id'] . ')" class="btn btn-danger btn-sm text-sm">Verwijder gebruiker</button></td>';
            echo '</tr>';
        }

        echo '<script> 
        function redirect(uid) {
        window.location = "../../../assets/PHP prefabs/deleteuser.php?gebruikersid=" + uid; 
        }</script>'
        ?>
  </tbody>
</table>