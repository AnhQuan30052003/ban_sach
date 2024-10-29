<?php
  $tim = isset($_GET["txtTimKiem"]) ? $_GET["txtTimKiem"] : "";
  $toanTuKetNoi = $loaiSach == "" || $tacGia == "" ? "or" : "and";

  $sql = "
    select maSach, tenSach, maLS, tenLS, moTa, giaTien, soLuong, tacGia, hinhAnh
    from sach s join loai_sach ls on s.maLS = ls.maLS
  ";

  if (strlen($tim) > 0) $sql .= " where tenSach like '%$tim%' or tenLS like '%$tim%' or moTa like '%$tim%' or tacGia like '%$tim%'";
  else if ($toanTuKetNoi == "or") $sql .= " where " . ($loaiSach == "" ? "tacGia = '$tacGia'" : "maLS = '$loaiSach'");
  else $sql .= "where tacGia = '$tacGia' and maLS = '$loaiSach'";

  $result = get_data_query($sql);

  function build_data() {
    global $result;

    if (is_bool($result)) return;

    foreach ($result as $line) {
      echo "
        <tr>
          <td>
            <img src='$line[8]' alt=''>
          </td>
          <td>
            <p>Tên sách: $line[1]</p>
            <p>Thể loại: $line[3]</p>
            <p>Tác giả: $line[7]</p>
            <p>Mô tả: $line[4]</p>
            <p style='display: flex; justify-content: space-around;'>
              <span>Giá: $line[5]</span>
              <span>Còn: $line[6]</span>
            </p>
          </td>
        </tr>
      ";
    }
  }
?>

<style>

</style>

<section class='mod-san-pham'>
  <div class="container">
    <table>
      <?php build_data(); ?>
    </table>
  </div>
</section>