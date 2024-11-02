<?php
  include_once "../../database/helper/db.php";

  $userName = isset($_REQUEST[""]) ? $_REQUEST[""] : "";
  $password = isset($_REQUEST[""]) ? $_REQUEST[""] : "";

  # Nếu userName & password hợp lệ thì truy vấn
  $sql = "select * from khach_hang where (tenKH = '$userName' or email = '$userName') and matKhau = '$password'";
  $result = get_data_query($sql);

?>