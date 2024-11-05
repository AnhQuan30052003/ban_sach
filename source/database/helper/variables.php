<?php
  $userId = "";
  $infoUser = ["userId" => $userId, "tenKH" => "", "email" => "", "sdt" => "", "matKhau" => "", "diaChi" => ""];

  if (isset($_SESSION["userId"])) {
    $userId = $_SESSION["userId"];
    get_data_user($userId);
  }

  login_to_link();

  # Huỷ sesstion
  // $_SESSION = [];
?>