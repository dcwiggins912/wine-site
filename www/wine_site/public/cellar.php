<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
  check_login_redirect("Please log in to view your cellar");
?>


<!DOCTYPE html PUBLIC "-//W3C//DD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd>

<html lang="en">
  <head>
    <title>Cellar</title>
    <link href="css/public.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <?php require_once("../includes/layouts/header.php"); ?>
    <h2><?php echo $_SESSION["username"]; ?>'s Virtual Cellar</h2>
    <?php
      $user_id = $_SESSION['user_id'];
      
      $query = "SELECT * ";
      $query .= "FROM user_cellar ";
      $query .= "WHERE user_id = {$user_id}";
      $result = mysqli_query($connection, $query);
      
      if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
          $wine_id = $row['wine_id'];
          $query = "SELECT * ";
          $query .= "FROM wines ";
          $query .= "WHERE id = {$wine_id}";
          $wine_result = mysqli_query($connection, $query);
          if ($wine_result) {
            $wine_row = mysqli_fetch_assoc($wine_result);
            echo wine_as_div($wine_row);
          }
        }
      }
      else {
      
      
      }
    ?>
    <?php require_once("../includes/layouts/footer.php"); ?>