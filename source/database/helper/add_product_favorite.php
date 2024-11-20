<?php
  include_once "db.php";

  $id = $_POST["id"];

  # Kiểm tra có chưa ?
  $sql = "select * from sach_yeu_thich where maSach = '$id' and ma = '$userId'";
  $result = get_data_query($sql);

  // $fileName = "a.txt";
  // $text = $id . "\n";
  // file_put_contents($fileName, $text, FILE_APPEND);

  if (count($result) == 0) $sql = "insert into `sach_yeu_thich` values ('$id', '$userId');";
  else $sql = "delete from `sach_yeu_thich` where ma = '$userId' and maSach = '$id'";
  quick_query($sql);
?> 