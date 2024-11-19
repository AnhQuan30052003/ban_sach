<?php
  # Lấy url
  function get_url_page(bool $justLink = true) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];

    if ($justLink) $uri = cutString($uri, "&page");
    $fullUrl = $protocol . $domainName . $uri;
    
    return $fullUrl;
  }

  # Cắt chuỗi
  function cutString(string $text, string $findSub) {
    if ($findSub == "") return $text;

    $findPos = strpos($text, $findSub);
    if ($findPos) $text = substr($text, 0, $findPos);
    return $text;
  }

  # Hiển thị thông tin về số lượng kết quả tìm thấy
  function number_products_found(int $number) {
    $text = $number == 0 ? "* Không tìm thấy sản phẩm nào !" : "* Tìm thấy $number sản phẩm";
    echo "<script>document.querySelector('#description').innerHTML = '$text';</script>";
  }

  # Loại trang cho user
  function type_page(string $page) {
    $url = get_url_page();

    if (strpos($url, $page)) return true;
    return false;
  }

  # Lưu trang index
  function save_or_to_index(bool $save) {
    if ($save) $_SESSION["index"] = get_url_page(false);
    else return $_SESSION["index"];
  }

  # Lấy dữ liệu của user
  function get_data_user($userId, $role) {
    global $infoUser;

    $nameTable = $role == "admin" ? "admin" : "khach_hang";

    $sql = "select * from `$nameTable` where ma = '$userId'";
    $result = get_data_query($sql);

    $_SESSION["userId"] = $userId;
    $_SESSION["role"] = $role;

    $infoUser["userId"] = $userId;
    $infoUser["ten"] = $result[0]["ten"];
    $infoUser["email"] = $result[0]["email"];
    $infoUser["sdt"] = $result[0]["sdt"];
    $infoUser["matKhau"] = $result[0]["matKhau"];
    if ($role == "khach_hang") $infoUser["diaChi"] = $result[0]["diaChi"];
  }

  # Xử lý đăng nhập ràng buộc trang
  function login_to_link() {
    global $userId, $role;

    if (strlen($userId) == 0) return;

    $url = get_url_page(false);
    if (strpos($url, "system")) return;

    # Là admin
    if ($role == "admin") {
      if (!strpos($url, "admin")) {
        $link = "../admin/index.php";
        echo "<script>window.location.href = '$link'</script>";
      }
    }
    # Là người dùng khác
    else {
      if (!strpos($url, "user")) {
        $link = "../user/index.php";
        echo "<script>window.location.href = '$link'</script>";
      }
    }
  }

  # Lấy id của... cuối cùng
  function get_id_laster(string $sql) {
    $result = get_data_query($sql);

    if (count($result) == 0) return "0000";

    $id = (int) $result[0][0] + 1;
    $id = (string) $id;
    $strId = "";

    $len0 = 4 - strlen($id);
    for ($i = 1; $i <= $len0; $i++) {
      $strId .= "0";
    }
    $strId .= $id;

    return $strId;
  }

  # Kiểm tra xem file có thoả không ?
  function check_image(array $img) {
    $error = "";

    $file_size = $img['size'];
    $file_ext = @strtolower(end(explode('.', $img['name'])));
    $expensions = array("jpeg", "jpg", "png");
    
    if (!in_array($file_ext, $expensions)) {
      $error = "Phải chọn ảnh JPG hoặc PNG !";
      return $error;
    }

    if ($file_size > 2097152) {
      $error = 'Ảnh lón hơn 2MB !';
      return $error;
    }
    
    return $error;
  }
  
  # Đẩy và lưu file ảnh
  function save_file(array $img) {
    $path = getcwd() . "\..\..\..\assets\images\products\\{$img['name']}";
    move_uploaded_file($img["tmp_name"], $path);
  }

  # Kiểm tra chuỗi là ký tự
  function check_is_string(string $text) {
    for ($i = 0; $i < strlen($text); $i++) {
      if (is_numeric($text[$i])) return false;
    }

    return true;
  }

  # Kiểm tra chuỗi là số
  function check_is_numeric(string $text) {
    $count = 0;
    for ($i = 0; $i < strlen($text); $i++) {
      if (is_numeric($text[$i])) $count += 1;
    }

    return $count == strlen($text);
  }

  # Kiểm tra email
  function check_is_email(string $text) {
    $have_a = false;
    $have_com = false;
    if (strpos($text, "@")) $have_a = true;
    if (strpos($text, ".com")) $have_com = true;

    if ($have_a && $have_com) return true;
    
    return false;
  }

  # Chạy hàm khác & chuỗi thông báo
  function run_check($func, $text, $info) {
    if ($func($text) == false) {
      echo "<script>alert('$info');</script>";
      return false;
    }
    
    return true;
  }
?>