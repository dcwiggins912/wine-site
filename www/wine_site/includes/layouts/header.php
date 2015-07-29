<?php
  if (!logged_in()) {
    require_once("../includes/layouts/login_header.php");  
  }
  else {
    require_once("../includes/layouts/logout_header.php");
  }
?>
<div id="header">
  <h1>Insert Site Name Here</h1>
</div>
<?php
  if (logged_in()) {
    require_once("../includes/layouts/header_logged_in.php");  
  }
  else {
    require_once("../includes/layouts/header_logged_out.php");
  }
?>