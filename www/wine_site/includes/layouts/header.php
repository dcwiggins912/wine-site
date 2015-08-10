<div id="container">
  <div id="header">
    <?php
      if (!logged_in()) {
        require_once("../includes/layouts/login_header.php");  
      }
    ?>
    <h1>Insert Site Name Here</h1>
    <?php
      if (logged_in()) {
        require_once("../includes/layouts/search_bar.php"); 
        require_once("../includes/layouts/navbar_logged_in.php");  
      }
      else {
        require_once("../includes/layouts/navbar_logged_out.php");
      }
    ?>
  </div>
  <div id="content">