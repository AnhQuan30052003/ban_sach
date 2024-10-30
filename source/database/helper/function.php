<?php
  # Lấy url
  function get_url_page() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];

    $uri = cutString($uri, "&page");
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

  # Hiẻn thị thông tin về số lượng kết quả tìm thấy
  function number_products_found(int $number) {
    $text = $number == 0 ? "* Không tìm thấy sản phẩm nào !" : "* Tìm thấy $number sản phẩm";
    echo "<script>document.querySelector('#description').innerHTML = '$text';</script>";
  }
?>