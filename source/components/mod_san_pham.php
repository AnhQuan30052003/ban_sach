<?php
  function handle_sql() {
    global $tim, $loaiSach, $tacGia;

    $sql = "
      select maSach, tenSach, ls.maLS, tenLS, moTa, giaTien, soLuong, tacGia, hinhAnh
      from sach s join loai_sach ls on s.maLS = ls.maLS
    ";

    if (strlen($tim) > 0) {
      $sql .= " where tenSach like '%$tim%' or tenLS like '%$tim%' or moTa like '%$tim%' or tacGia like '%$tim%'";
      return $sql;
    }

    if (($loaiSach == "" && $tacGia == "") || ($loaiSach != "" && $tacGia != "")) {
      $sql .= " where tacGia = '$tacGia' and ls.malS = '$loaiSach'";
      return $sql;
    }

    $sql .= " where " . ($loaiSach == "" ? "tacGia = '$tacGia'" : "ls.maLS = '$loaiSach'");
    return $sql;
  }

  $tim = isset($_GET["txtTimKiem"]) ? $_GET["txtTimKiem"] : "";
  
  if (!isset($_GET["page"])) $_GET["page"] = 1;
  $productsPerPage = 10;
  $offset = ($_GET["page"] - 1) * $productsPerPage;
  
  $sql = handle_sql();
  $sql .= " limit $offset, $productsPerPage";
  $result = get_data_query($sql);

  function build_data() {
    global $result, $sql;
    if (is_bool($result)) {
      number_products_found(0);
      return;
    }

    $sqlTemp = cutString($sql, "limit");
    $productsFound = count(get_data_query($sqlTemp));
    number_products_found($productsFound);

    $soLuong = 1;
    foreach ($result as $line) {
      if ($soLuong == 1) echo "<tr>";

      echo "
        <td>
          <div class='image'>
            <img src='$line[8]' alt='' style='width: 100%; height: 100%; object-fit: cover;'>
          </div>

          <div class='info'>
            <p><span class='bold'>Tên sách:</span> $line[1]</p>
            <p><span class='bold'>Thể loại:</span> $line[3]</p>
            <p><span class='bold'>Tác giả:</span> $line[7]</p>
            <p><span class='bold'>Mô tả:</span> $line[4]</p>
            <p style='display: flex; justify-content: space-between; margin-top: 5px;'>
              <span><span class='bold'>Giá:</span> " . number_format($line[5], 0, ',', '.') . " VNĐ</span>
              <span><span class='bold'>Còn:</span> $line[6]</span>
            </p>
          </div>
        </td>
      ";

      if ($soLuong == 2) {
        $soLuong = 0;
        echo "</tr>";
      }
      $soLuong += 1;
    }
  }
?>

<style>
  .mod-san-pham {
    margin-top: 130px;

    .table-products {
      width: 100%;

      tr {
        width: 100%;
        /* height: 250px; */
        height: 200px;
        margin: 5px 0;
        display: flex;
        align-items: stretch;
        justify-content: space-between;

        td {
          width: 49%;
          margin: 5px;
          padding-right: 5px;
          display: flex;
          gap: 10px;
          background-color: #f6f6f6;

          .image {
            width: 30%;
            display: flex;
            justify-content: center;
            align-items: center;
          }

          .info {
            width: 70%;
            padding-right: 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 5px;

            p {
              width: 392px;
              white-space: nowrap;
              overflow: hidden;
              text-overflow: ellipsis;
            }
            
            .bold {
              font-weight: bold;
            }
          }
        }
      }
    }
  }
</style>

<section class='mod-san-pham'>
  <div class="container">
    <table class='table-products'>
      <?php build_data(); ?>
    </table>
  </div>
</section>