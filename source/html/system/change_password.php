<?php
  $pathExit = "../../";
  $pathComponents = $pathExit . "components";

  include_once "../../database/helper/db.php";
  include_once $pathComponents . "/head.php";
?> 

<!DOCTYPE html>
<html lang="en">

<?php head("Change Password"); ?>

<body>
  <?php include_once $pathComponents . "/mod_change_password.php"; ?>

  <script src='../../assets/javascripts/mod_handle_eyes_password.js'></script>
</body>
</html>
