<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php	
	if (isset($_POST['submit'])) {
		// form was submitted
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);
		$firstname = trim($_POST["first-name"]);
		$lastname = trim($_POST["last-name"]);
		$email = trim($_POST["email"]);

		// Validations
		$fields_required = array("username", "password", "email");
		foreach($fields_required as $field) {
			$value = trim($_POST[$field]);
			if (!has_presence($value)) {
				$errors[$field] = "Please input a value";
			}
		}
		
		$fields_with_max_lengths = array("username" => 30);
		$fields_with_min_lengths = array("username" => 3, "password" => 8);
		validate_max_lengths($fields_with_max_lengths);
		validate_min_lengths($fields_with_min_lengths);
		
		validate_email($email);
		
		if (empty($errors)) {
    // Perform Create

      $username = mysql_prep($_POST["username"]);
      $hashed_password = password_encrypt($_POST["password"]);
      
      $query  = "INSERT INTO userss (";
      $query .= "  username, hashed_password";
      $query .= ") VALUES (";
      $query .= "  '{$username}', '{$hashed_password}'";
      $query .= ")";
      $result = mysqli_query($connection, $query);

      if ($result) {
        // Success
        $_SESSION["message"] = "User created.";
        redirect_to("register_success.php");
      } else {
        // Failure
        $_SESSION["message"] = "User creation failed.";
      }

	} else {
		$username = "";
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
    <title>My Wine Site</title>
    <link href="css/public.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <?php require_once("../includes/layouts/login_header.php"); ?>
    <?php require_once("../includes/layouts/header.php"); ?>
    <h1>Create a New Account</h1>
    <br />
		
		<form action="register.php" method="post" class="vertical">
		  <label>Username:</label>
      <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" />
      <?php echo error_message("username"); ?>
      <br />
		  <label>Password:</label>
      <input type="password" name="password" value="" />
       <?php echo error_message("password"); ?>
      <br />
			<br />
      <label>First Name:</label>
      <input type="text" name="first-name" value="" />
      <br />
      <label>Last Name:</label>
      <input type="text" name="last-name" value="" />
      <br />
      <br />
      <label>Email:</label>
      <input type="text" name="email" value="" />
      <?php echo error_message("email"); ?>
      <br />
      <br />
		  <input type="submit" name="submit" value="Submit" />
		</form>

	</body>
</html>
