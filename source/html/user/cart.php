<?php
  $pathExit = "../../";
  $pathComponents = $pathExit . "components";

  include_once "../../database/helper/db.php";
  include_once $pathComponents . "/head.php";
?> 

<!DOCTYPE html>
<html lang="en">

<?php head("My Cart"); ?>

<body>
  <?php include_once $pathComponents . "/mod_header_user.php"; ?>
  <?php include_once $pathComponents . "/mod_products_cart.php"; ?>
  <?php include_once $pathComponents . "/mod_footer_user.php"; ?>

  <script src='../../assets/javascripts/mod_header.js'></script>
</body>
</html>