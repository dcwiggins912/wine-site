<?php
  $dbhost = "localhost";
  $dbuser = "wine_root";
  $dbpass = "winegiraffedecanter";
  $dbname = "wine_db";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  
  if (mysqli_connect_errno()) {
    die("Database connection failed: " .
      mysqli_connect_error() . " (" .
      mysqli_connect_errno() . ")"
    );
  }
?>