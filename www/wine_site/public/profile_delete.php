<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
  check_login_redirect("Please log in to edit your profile");
?>

<?php

  if (isset($_POST['delete'])) {
    $user_id = $_SESSION['user_id'];
    $query  = "DELETE FROM users ";
    $query .= "WHERE id = {$user_id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);
    if ($result and mysqli_affected_rows($connection) == 1) {
      $_SESSION = array();
    }
    
    $query  = "DELETE FROM user_info ";
    $query .= "WHERE id = {$user_id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);
  }
  else {
    redirect_to("profile.php");
  }

?>
<!DOCTYPE html PUBLIC "-//W3C//DD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd>

<html lang="en">
	<head>
    <title>My Wine Site</title>
    <link href="css/public.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body>
    
    <?php require_once("../includes/layouts/header.php"); ?>
    <h2>Profile deleted</h2>
    <br />
    <p>We're sorry to see you leave :-(</p>
    <br />
    <p>Return to <a href="index.php">Home</a>
    <?php require_once("../includes/layouts/footer.php"); ?>