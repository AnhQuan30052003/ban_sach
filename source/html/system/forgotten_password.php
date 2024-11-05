<?php
  $pathExit = "../../";
  $pathComponents = $pathExit . "components";

  include_once "../../database/helper/db.php";
  include_once $pathComponents . "/head.php";
?> 

<!DOCTYPE html>
<html lang="en">

<?php head("Forgotten Password"); ?>

<body>
  <?php include_once $pathComponents . "/mod_forgotten_password.php"; ?>
</body>
</html>
