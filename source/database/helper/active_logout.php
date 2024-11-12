<?php
  session_start();

  $_SESSION = [];
  $linkIndex = "../../html/user/index.php";
  echo "
    <script>
      localStorage.clear();
      window.location.href = '$linkIndex';
    </script>
  ";
?>