<?php

	function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}

	function mysql_prep($string) {
		global $connection;
		
		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}
	
	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");
		}
	}
  
  function find_row_by_field($field, $column_name, $table_name) {
    global $connection;
    
    if (is_string($field)) {
      $safe_field = "'" . mysql_prep($field) . "'";
    }
    else {
      $safe_field = mysql_prep($field);
    }
    
    $query  = "SELECT * ";
		$query .= "FROM {$table_name} ";
		$query .= "WHERE {$column_name} = {$safe_field} ";
		$query .= "LIMIT 1";
    
    
    $result_set = mysqli_query($connection, $query);
    confirm_query($result_set);
    if ($result = mysqli_fetch_assoc($result_set)) {
      return $result;
    }
    else {
      return null;
    } 
  }
  
  function find_user_by_id($user_id) {
    return find_row_by_field($user_id, "id", "users");
	}

	function find_user_by_username($username) {
    return find_row_by_field($username, "username", "users");
	}
  
  function find_user_by_email($email) {
    return find_row_by_field($email, "email", "user_info");
  }
  
  function password_encrypt($password) {
  	$hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
	  $salt_length = 22; 					// Blowfish salts should be 22-characters or more
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($password, $format_and_salt);
		return $hash;
	}
	
	function generate_salt($length) {
	  // Not 100% unique, not 100% random, but good enough for a salt
	  // MD5 returns 32 characters
	  $unique_random_string = md5(uniqid(mt_rand(), true));
	  
		// Valid characters for a salt are [a-zA-Z0-9./]
	  $base64_string = base64_encode($unique_random_string);
	  
		// But not '+' which is valid in base64 encoding
	  $modified_base64_string = str_replace('+', '.', $base64_string);
	  
		// Truncate string to the correct length
	  $salt = substr($modified_base64_string, 0, $length);
	  
		return $salt;
	}
	
	function password_check($password, $existing_hash) {
		// existing hash contains format and salt at start
	  $hash = crypt($password, $existing_hash);
	  if ($hash === $existing_hash) {
	    return true;
	  } else {
	    return false;
	  }
	}

	function attempt_login($username, $password) {
		$user = find_user_by_username($username);
		if ($user) {
			// found user, now check password
			if (password_check($password, $user["hashed_password"])) {
				// password matches
				return $user;
			} else {
				// password does not match
				return false;
			}
		} else {
			// user not found
			return false;
		}
	}

	function logged_in() {
		return isset($_SESSION['user_id']);
	}
	
	function confirm_logged_in() {
		if (!logged_in()) {
			redirect_to("login.php");
		}
	}
?>