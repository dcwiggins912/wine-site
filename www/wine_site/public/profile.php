<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php 
  check_login_redirect("Please log in to view your profile");
?>
<!DOCTYPE html PUBLIC "-//W3C//DD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
  <head>
    <title>Homepage</title>
    <link href="css/public.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <?php require_once("../includes/layouts/header.php"); ?>
    <h1>Welcome, <?php echo $_SESSION["username"]; ?></h1>
    <a href="profile_update.php">Edit my profile</a>  
    <?php require_once("../includes/layouts/footer.php"); ?>