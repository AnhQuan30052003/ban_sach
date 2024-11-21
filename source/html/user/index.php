<?php
  $pathExit = "../../";
  $pathComponents = $pathExit . "components";

  include_once "../../database/helper/db.php";
  include_once $pathComponents . "/head.php";
?> 

<!DOCTYPE html>
<html lang="en">

<?php head("Book Store"); ?>

<body>
  <?php include_once $pathComponents . "/mod_login.php"; ?>
  <?php include_once $pathComponents . "/mod_register.php"; ?>

  <?php include_once $pathComponents . "/mod_header_user.php"; ?>
  <?php include_once $pathComponents . "/mod_products.php"; ?>

  <?php
    include_once $pathComponents . "/mod_paginate.php";
    
    $sql = cutString($sql, "limit");
    $result = quick_query($sql);
    show_number_page($result, $productsPerPage);
  ?>

  <?php include_once $pathComponents . "/mod_footer_user.php"; ?>

  <script src='../../assets/javascripts/mod_header.js'></script>
  <script src='../../assets/javascripts/mod_products.js'></script>
  <script src='../../assets/javascripts/mod_login_or_register.js'></script>
  <script src='../../assets/javascripts/mod_handle_eyes_password.js'></script>
  <script src='../../assets/javascripts/validate_class.js'></script>


  <?php
    if (strlen($errorLogin) > 0) echo "<script>show_or_hidden(1);</script>";
    if (strlen($errorRegister) > 0) echo "<script>show_or_hidden(2);</script>";
  ?>
</body>
</html>
