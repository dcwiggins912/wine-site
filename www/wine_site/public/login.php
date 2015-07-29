<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
  $username = "";

  if (isset($_POST['login'])) {
    // validations
    $required_fields = array("username", "password");
    validate_presences($required_fields);
    
    if (empty($errors)) {
      // Attempt Login

      $username = $_POST["username"];
      $password = $_POST["password"];
      
      $found_user = attempt_login($username, $password);

      if ($found_user) {
        // Success
        // Mark user as logged in
        $_SESSION["user_id"] = $found_user["id"];
        $_SESSION["username"] = $found_user["username"];
        $_SESSION["login"] = true;
        redirect_to("profile.php");
      }
      else {
        // Failure
        $_SESSION["message"] = "Username/password not found.";
      }
    }
    else {
      $_SESSION["message"] = "Please enter a value username/password.";
    }
  }
  else {
  // This is probably a GET request
  
  } // end: if (isset($_POST['submit']))

?>


<!DOCTYPE html PUBLIC "-//W3C//DD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
  <head>
    <title>Login</title>
    <link href="css/public.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <?php require_once("../includes/layouts/header.php"); ?>
    <h2>Log In</h2>
    <br />
    <?php echo message(); ?>
    <br />
    <br />
    <form action="login.php" method="post" class="vertical">
		  <label>Username:</label>
      <input type="text" name="username" value="<?php echo htmlentities($username); ?>" />
      <br />
		  <label>Password:</label>
      <input type="password" name="password" value="" />
      <br />
      <br />
		  <input type="submit" name="login" value="Login"/>
    </form>
 
<?php include("../includes/layouts/footer.php"); ?>