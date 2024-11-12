<?php
  $userId = "";
  $role = "";
  $infoUser = ["userId" => $userId, "ten" => "", "email" => "", "sdt" => "", "matKhau" => "", "diaChi" => ""];

  if (isset($_SESSION["userId"]) && isset($_SESSION["role"])) {
    $userId = $_SESSION["userId"];
    $role = $_SESSION["role"];
    get_data_user($userId, $role);
  }

  login_to_link();

  # Huỷ sesstion
  // echo "userId = $userId; role: $role;<br>"
  // $_SESSION = [];
?>