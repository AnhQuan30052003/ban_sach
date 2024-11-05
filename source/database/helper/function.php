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
  function type_page() {
    $url = get_url_page();

    if (strpos($url, "index.php")) return "index";
    return "favorite";
  }

  function check_password(string $passNormal, string $md5Pass) {
    if (md5($passNormal) == $md5Pass) return true;
    return false;
  }

  # Lưu trang index
  function save_or_to_index(bool $save) {
    if ($save) $_SESSION["index"] = get_url_page(false);
    else return $_SESSION["index"];
  }

  # Lấy dữ liệu của user
  function get_data_user($userId) {
    global $infoUser;

    $sql = "select * from khach_hang where maKH = '$userId'";
    $result = get_data_query($sql);

    $_SESSION["userId"] = $userId;

    $infoUser["userId"] = $userId;
    $infoUser["tenKH"] = $result[0]["tenKH"];
    $infoUser["email"] = $result[0]["email"];
    $infoUser["sdt"] = $result[0]["sdt"];
    $infoUser["matKhau"] = $result[0]["matKhau"];
    $infoUser["diaChi"] = $result[0]["diaChi"];
  }

  # Xử lý đăng nhập ràng buộc trang
  function login_to_link() {
    global $userId;

    if (strlen($userId) == 0) return;

    $url = get_url_page(false);
    if (strpos($url, "system")) return;

    # Là admin
    if ($userId == "0000") {
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

  # Lấy mã khách hàng mới nhất
  function get_id_user() {
    $sql = "select maKH from khach_hang";
    $result = get_data_query($sql);
    $result = $result[count($result) - 1];

    $id = $result["maKH"];
    $id = (int) $id + 1;
    $id = (string) $id;
    $strId = "";

    $len0 = 4 - strlen($id);
    for ($i = 1; $i <= $len0; $i++) {
      $strId .= "0";
    }
    $strId .= $id;

    return $strId;
  }
?>