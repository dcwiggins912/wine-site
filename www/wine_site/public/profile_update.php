<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
  check_login_redirect("Please log in to edit your profile");
?>

<?php	
	if (isset($_POST['update'])) {
    $user_id = $_SESSION['user_id'];
  
		// form was submitted
		$username = trim($_POST['username']);
		$firstname = trim($_POST['first-name']);
		$lastname = trim($_POST['last-name']);
		$email = trim($_POST['email']);
    $birth_month = date_parse($_POST['month'])['month'];
    $birth_day = $_POST['day'];
    $birth_year = $_POST['year'];
    
		// Validations
		$fields_required = array("username", "email");
		foreach($fields_required as $field) {
			$value = trim($_POST[$field]);
			if (!has_presence($value)) {
				$errors[$field] = "Please input a value";
			}
		}
		
		$fields_with_max_lengths = array("username" => 30);
		$fields_with_min_lengths = array("username" => 3);
		validate_max_lengths($fields_with_max_lengths);
		validate_min_lengths($fields_with_min_lengths);
		
		validate_email($email);
    validate_date($birth_month, $birth_day, $birth_year);
    
    // Check for duplicate username
    $duplicate = find_user_by_username($username);
    if ($duplicate and ($duplicate['id'] != $user_id)) {
      $errors["username"] = "Username not available";
    }
  
		if (empty($errors)) {
      // Perform user update

      $username = mysql_prep($_POST["username"]);
      
      $query  = "UPDATE users SET ";
      $query .= "username = '{$username}' ";
      $query .= "WHERE id = {$user_id} ";
      $query .= "LIMIT 1";
      $result = mysqli_query($connection, $query);
      
      if ($result) {
        // Success; update user info in table
      
        $safe_email = mysql_prep($email);
        $safe_firstname = mysql_prep($firstname);
        $safe_lastname = mysql_prep($lastname);
        
        $query  = "UPDATE user_info SET ";
        $query .= "username = '{$username}', ";
        $query .= "email = '{$safe_email}', ";
        $query .= "first_name = '{$safe_firstname}', ";
        $query .= "last_name = '{$safe_lastname}', ";
        $query .= "birthdate = '{$birth_year}-{$birth_month}-{$birth_day}' ";
        $query .= "WHERE id = {$user_id} ";
        $query .= "LIMIT 1";
        $result = mysqli_query($connection, $query);
               
        $_SESSION["message"] = "User profile updated.<br />";
      }
      else {
      // Failure
        //$_SESSION["message"] = "User creation failed.";
      }
      
    }

	}
  else {
    //POST request
    $user_id = $_SESSION['user_id'];
    $user = find_user_info_by_id($user_id);
    $username = $user['username'];
    $firstname = $user['first_name'];
    $lastname = $user['last_name'];
    $email = $user['email'];   
    
    list($birth_year, $birth_month, $birth_day) = explode("-", $user['birthdate']);
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
    <h2>Update Profile</h2>
    <form action="profile_update.php" method="post" class="vertical" id="profile-edit">
      <label>Username:</label>
      <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" />
      <?php echo error_message("username"); ?>
      <br />
      <label>Email:</label>
      <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" />
      <?php echo error_message("email"); ?>
      <br />
      <br />
      <label>First Name:</label>
      <input type="text" name="first-name" value="<?php echo htmlspecialchars($firstname); ?>" />
      <br />
      <label>Last Name:</label>
      <input type="text" name="last-name" value="<?php echo htmlspecialchars($lastname); ?>" />
      <br />
      <label>Birthdate:</label>
      <select name="month">
        <option value="default"></option>
        <?php 
          month_menu($birth_month);
        ?>
      </select>
      <select name="day">
        <option value="default"></option>
        <?php 
          number_menu(1, 31, $birth_day);
        ?>
      </select>
      <select name="year">
        <option value="default"></option>
        <?php 
          number_menu(1900, 2015, $birth_year);
        ?>
      </select>
      <?php echo error_message("birthdate"); ?>
      <br />
      <br />
      <input type="submit" name="update" value="Update" style="width: 80px;"/>
    </form>
    <br />
    <br />
    <h2>Delete</h2>
    <form action="profile_delete.php" method="post">
      <input type="submit" name="delete" value="Delete My Profile" onclick="return confirm('Are you sure you want to delete your profile? This CANNOT be undone');" style="width: 125px;"/>
    </form>
    <?php require_once("../includes/layouts/footer.php"); ?>