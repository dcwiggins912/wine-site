    
    </div>
    <div id="footer"> 
      <?php
        if (logged_in()) {
          require_once("../includes/layouts/logout_footer.php");
        }
      ?>  
    </div>
  </div>
 </body>
</html>
 
<?php
  mysqli_close($connection);
?>