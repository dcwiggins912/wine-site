<?php
  if (!isset($_SESSION["login"]) or !$_SESSION["login"]) {
    require_once("../includes/layouts/login_header.php");  
  }
?>
<div id="header">
  <h1>Insert Site Name Here</h1>
</div>
<div id="nav-bar">
  <ul class="menu-hor">
    <li><a href="index.php" class="nav-link">Home</a></li>
    <li>Item 2</li>
    <li>Item 3</li>
  </ul>
 </div>