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
?>