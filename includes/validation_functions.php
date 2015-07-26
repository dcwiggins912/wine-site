<?php

$errors = array();

function fieldname_as_text($fieldname) {
  $fieldname = str_replace("_", " ", $fieldname);
  $fieldname = ucfirst($fieldname);
  return $fieldname;
}

// * presence
// use trim() so empty spaces don't count
// use === to avoid false positives
// empty() would consider "0" to be empty
function has_presence($value) {
	return isset($value) && $value !== "";
}

// * string length
// max length
function has_max_length($value, $max) {
	return strlen($value) <= $max;
}

function has_min_length($value, $min) {
	return strlen($value) >= $min;
}

// * inclusion in a set
function has_inclusion_in($value, $set) {
	return in_array($value, $set);
}

function validate_max_lengths($fields_with_max_lengths) {
	global $errors;
	// Expects an assoc. array
	foreach($fields_with_max_lengths as $field => $max) {
		$value = trim($_POST[$field]);
	  if (!has_max_length($value, $max)) {
	    $errors[$field] = isset($errors[$field]) ? $errors[$field] : ucfirst($field) . " is too long";
	  }
	}
}

function validate_min_lengths($fields_with_min_lengths) {
	global $errors;
	// Expects an assoc. array
	foreach($fields_with_min_lengths as $field => $min) {
		$value = trim($_POST[$field]);
	  if (!has_min_length($value, $min)) {
	    $errors[$field] = isset($errors[$field]) ? $errors[$field] : ucfirst($field) . " is too short";
	  }
	}
}

function error_message($field) {
  global $errors;
  if (isset($errors[$field])) {
    return $errors[$field];
  }
  return "";
}

function validate_email($email) {
  global $errors;
  if (substr_count($email, "@") != 1) {
    $errors["email"] = isset($errors["email"]) ? $errors["email"] : "Not a valid email address.";
    return;
  }
  $host = strpbrk($email, "@");
  if (substr_count($host, ".") == 0) {
    $errors["email"] = isset($errors["email"]) ? $errors["email"] : "Not a valid email address.";
    return;
  }
}

function validate_presences($required_fields) {
  global $errors;
  foreach($required_fields as $field) {
    $value = trim($_POST[$field]);
  	if (!has_presence($value)) {
  		$errors[$field] = fieldname_as_text($field) . " can't be blank";
  	}
  }
}

?>