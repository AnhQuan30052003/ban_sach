<?php
  $conn = new mysqli();

  $host = "localhost";
  // $user = "tienquan";
  // $password = "tienquan";
  $user = "root";
  $password = "";
  $database = "quanlybansach";

  # Kết nối
  function connect() {
    global $conn, $host, $user, $password, $database;
    $conn = mysqli_connect($host, $user, $password, $database) or die("Không thể kết nối tới database $database !");
    mysqli_set_charset($conn, "UTF8");
  }

  # Ngắt kết nối
  function disconnect() {
    global $conn;
    mysqli_close($conn);
  }
?>