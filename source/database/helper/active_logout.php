<?php
  session_start();

  $_SESSION = [];
  $linkIndex = "../../html/user/index.php";
  echo "<script>window.location.href = '$linkIndex';</script>";
?>