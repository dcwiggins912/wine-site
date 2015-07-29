<div class="log-header">
  <form action="index.php" method="post">
    <label>Currently logged in as <b><?php echo $_SESSION["username"]; ?></b></label>
    <input type="submit" name="logout" value="Log Out" style="width: 70px; "/>
  </form>
</div>