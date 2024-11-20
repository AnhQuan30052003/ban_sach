<?php
  include_once "db.php";
  
  $data = $_REQUEST["data"];
  $data = explode("-", $data);
  $productId = $data[0];
  $quantity = $data[1];

  // Kiểm tra xem người dùng hiện tại đã có sản phẩm đó trong giỏ hàng chưa ?
  $sql = "select * from `gio_hang` where ma = '$userId' and maSach = '$productId'";
  $result = get_data_query($sql);

  if (count($result) > 0) {
    $sql = "update `gio_hang` set soLuong = $quantity where maSach = '$productId' and ma = '$userId'";
    quick_query($sql);
    return;
  }

  $sql = "insert into `gio_hang` values ('$productId', '$userId', $quantity);";
  quick_query($sql);

  $fileName = "a.txt";
  $text = $result . "\n";
  file_put_contents($fileName, $text, FILE_APPEND);
?>