<div id="container">
  <div id="header">
    <?php
      echo "<div id=\"header-top\">";
      if (!logged_in()) {
        require_once("../includes/layouts/login_header.php");  
      }
    ?>
    <h1>Insert Site Name Here</h1>
    <?php
      if (logged_in()) {
        echo "</div>\n<div style=\"margin-top: -26px;\">";
        require_once("../includes/layouts/search_bar.php");
        echo "</div>";
        require_once("../includes/layouts/navbar_logged_in.php");  
      }
      else {
        echo "</div>";
        require_once("../includes/layouts/navbar_logged_out.php");
      }
    ?>
  </div>
  <div id="content">