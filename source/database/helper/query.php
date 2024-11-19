<?php
  include_once "connect.php";
  
  # Truy vấn nhanh thông qua kết nối rồi ngắt
  function quick_query(string $sql) {
    global $conn;
    connect();
    $result = mysqli_query($conn, $sql);
    
    // if (!$result) {
      // $error = mysqli_error($conn); 
      // mysqli_close($conn);
      // return "Lỗi truy vấn: " . $error;
    // }
      
    disconnect();
    return $result;
}


  # Lấy dữ liệu sau khi kết nối
  function get_data_query(string $sql) {
    $result = quick_query($sql);
    if (is_bool($result)) return $result;

    $data = [];
    if (mysqli_num_rows($result) != 0) {
      while ($row = mysqli_fetch_array($result)) {
        $data[] = $row;
      }
    }
    
    return $data;
  }

  # Chạy function
  function run($data, $func) {
    if (!is_bool($data)) $func();
  }
?>