<div id="logout-footer">
<br />
<br />
  <form action="index.php" method="post" id="logout">
    <label>Currently logged in as:</label>
    <br />
    <label><b><?php echo $_SESSION["username"]; ?></b></label>
    <br />
    <input type="submit" name="logout" value="Log Out"/>
  </form>
</div>