<?php
  $conn = new mysqli();

  $host = "localhost";
  $user = "root";
  $password = "";
  $database = "quanlybansach";
  
  $userId = "";
  if (isset($_SESSION["userId"])) {
    $userId = $_SESSION["userId"];
  }
  else {
    $linkDefault = "http://localhost/ban_sach/source/html/user/index.php";
    $url = get_url_page();

    if ($url != $linkDefault) {
      echo "<script>window.location.href = '$linkDefault'</script>";
    }
  }


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