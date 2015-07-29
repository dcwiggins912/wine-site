<?php

	session_start();
	
	function message() {
		if (isset($_SESSION["message"])) {
			$output = "<div class=\"message\">";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			
			// clear message after use
			$_SESSION["message"] = null;
			
			return $output;
		}
	}

	function errors() {
		if (isset($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];
			
			// clear message after use
			$_SESSION["errors"] = null;
			
			return $errors;
		}
	}
 
	function logged_in() {
		return isset($_SESSION['user_id']);
	}
  
  function check_login_redirect($message) {
    if (!logged_in()) {
      $_SESSION["message"] = $message;
      redirect_to("login.php");
    }
  }
?>