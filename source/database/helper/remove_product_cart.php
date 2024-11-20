<?php
  include_once "db.php";
  $fileName = "a.txt";

  $id = $_POST["id"];
  // file_put_contents($fileName, $id, FILE_APPEND);

  $sql = "delete from `gio_hang` where maSach = '$id' and ma = '$userId'";
  $result = quick_query($sql);
  
  // $text = "Run done" . "\n";
  // file_put_contents($fileName, $text, FILE_APPEND);
?> 