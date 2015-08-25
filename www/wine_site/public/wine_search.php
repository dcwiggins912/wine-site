<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>


<?php
  if (isset($_GET) and !empty($_GET)) {
    $query  = "SELECT b.filename, a.name, a.varietal, a.vintage, a.region, a.country, a.description ";
    $query .= "FROM wines a, wine_images b WHERE ";
    $query .= "a.id = b.id ";
    foreach ($_GET as $key => $value) {
      $safe_value = mysql_prep($value);
      $query .= "AND a.{$key} LIKE _utf8 '%{$safe_value}%' COLLATE utf8_unicode_ci ";
    }
    $query .= "LIMIT 10";
    $result = mysqli_query($connection, $query);
      
    if ($result) {
      $content = "";

      while ($row = mysqli_fetch_assoc($result)) {
        $content .= wine_as_div($row);
      }
    }
  }
  else {
    
  }

?>

<!DOCTYPE html PUBLIC "-//W3C//DD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
    <title>My Wine Site</title>
    <link href="css/public.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <?php require_once("../includes/layouts/header.php"); ?>
    <h2>Search Wines</h2>
    <?php
        if (isset($content) && $content) {
          echo $content;
        }
    ?>
    <?php require_once("../includes/layouts/footer.php"); ?>