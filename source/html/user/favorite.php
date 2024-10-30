<?php
  $pathExit = "../../";
  $pathComponents = $pathExit . "components";

  include_once "../../database/helper/db.php";
  include_once $pathComponents . "/head.php";
?> 

<!DOCTYPE html>
<html lang="en">

<?php head("My Favorite"); ?>

<body>
  <?php include_once $pathComponents . "/mod-header.php"; ?>
  <?php include_once $pathComponents . "/mod_products.php"; ?>

  <?php
    include_once $pathComponents . "/mod-paginate.php";
    
    $sql = cutString($sql, "limit");
    $result = quick_query($sql);
    show_number_page($result, $productsPerPage);
  ?>

  <?php include_once $pathComponents . "/mod-footer.php"; ?>

  <script src='../../assets/javascripts/mod_header.js'></script>
  <script src='../../assets/javascripts/mod_products.js'></script>
</body>
</html>