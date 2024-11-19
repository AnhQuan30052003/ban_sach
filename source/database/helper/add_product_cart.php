<?php
  include_once "db.php";
  
  $data = $_REQUEST["data"];
  $data = explode("-", $data);

  $id = get_id_laster("select * from `gio_hang`");
  $sql = "insert into `gio_hang` values ('$id', '$data[0]', '$userId',$data[1]);";
  $result = quick_query($sql);

  // $fileName = "a.txt";
  // $text = $result . "\n";
  // file_put_contents($fileName, $text, FILE_APPEND);
?>