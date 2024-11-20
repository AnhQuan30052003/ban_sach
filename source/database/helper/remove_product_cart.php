<?php
  include_once "db.php";
  $fileName = "a.txt";

  $id = $_POST["id"];
  // file_put_contents($fileName, $id, FILE_APPEND);

  if (strlen($id) == 4) {
    $sql = "delete from `gio_hang` where maSach = '$id' and ma = '$userId'";
    $result = quick_query($sql);
    // $text = "Delete $id" . "\n";
    // file_put_contents($fileName, $text, FILE_APPEND);
  }
  else {
    $id = explode(",", $id);
    unset($id[0]);

    foreach ($id as $i) {
      $sql = "delete from `gio_hang` where maSach = '$i' and ma = '$userId'";
      quick_query($sql);
    }
  }  
?> 