<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
  $username = mysqli_real_escape_string($connection, $_POST["username"]);
  $query = "SELECT * FROM users ";
  $query .= "WHERE username = '{$username}' ";
  $query .= "LIMIT 1";
  $result = mysqli_query($connection, $query);
  confirm_query($result);
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd>

<html lang="en">
  <head>
    <title>Login</title>
  </head>
  <body>
    <pre>
      <?php
        print_r($_POST);
      ?>
      <?php
      echo "<hr />";
      if ($user = mysqli_fetch_assoc($result)) {
        echo "Welcome, " . $user["username"] . "!";
      }
      ?>
    </pre>
 
<?php include("../includes/layouts/footer.php"); ?>