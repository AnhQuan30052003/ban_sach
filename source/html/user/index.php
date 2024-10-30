<?php
  $pathExit = "../../";
  $pathComponents = $pathExit . "components";

  include_once "../../database/helper/db.php";
  include_once $pathComponents . "/head.php";
?> 

<!DOCTYPE html>
<html lang="en">

<?php head("Book Shop"); ?>

<body>
  <?php include_once $pathComponents . "/mod-header.php"; ?>
  <?php include_once $pathComponents . "/mod_san_pham.php"; ?>

  <?php
    include_once $pathComponents . "/mod-paginate.php";
    
    $sql = cutString($sql, "limit");
    $result = quick_query($sql);
    show_number_page($result, $productsPerPage);
  ?>

  <?php include_once $pathComponents . "/mod-footer.php"; ?>

  <script src='../../assets/javascripts/mod_tim_kiem.js'></script>
</body>
</html>