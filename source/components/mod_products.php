<?php
  function handle_sql_index() {
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

  function handle_sql_favorite() {
    global $tim, $userId;

    $sql = "
      select s.maSach, tenSach, ls.maLS, tenLS, moTa, giaTien, soLuong, tacGia, hinhAnh
      from sach s join loai_sach ls on s.maLS = ls.maLS
        join sach_yeu_thich syt on syt.maSach = s.maSach
      where syt.ma = '$userId'
    ";

    if (strlen($tim) > 0) {
      $sql .= " and tenSach like '%$tim%' or tenLS like '%$tim%' or moTa like '%$tim%' or tacGia like '%$tim%'";
      return $sql;
    }

    return $sql;
  }

  $tim = isset($_GET["txtTimKiem"]) ? $_GET["txtTimKiem"] : "";
  
  $productsPerPage = 10;
  if (!isset($_GET["page"])) $_GET["page"] = 1;
  $offset = ($_GET["page"] - 1) * $productsPerPage;
  
  if ($typePage == "index") $sql = handle_sql_index();
  else $sql = handle_sql_favorite();

  $sql .= " limit $offset, $productsPerPage";
  $result = get_data_query($sql);

  function build_data() {
    global $result, $sql, $userId;
    if (is_bool($result)) {
      number_products_found(0);
      return;
    }

    # Hiển thị số đếm sản phẩm tìm thấy
    $sqlTemp = cutString($sql, "limit");
    $resultTemp = get_data_query($sqlTemp);
    number_products_found(count($resultTemp));

    # Danh sách sản phẩm yêu thích của user
    $sqlTemp = "select maSach from sach_yeu_thich where ma = '$userId'";
    $resultTemp = get_data_query($sqlTemp);

    $array = [];
    foreach ($resultTemp as $line) {
      $array[] = $line[0];
    }
    $soLuong = 1;
    foreach ($result as $line) {
      if ($soLuong == 1) echo "<tr>";
      $tym = ""; 

      if (in_array($line[0], $array)) $tym = "style='color: red;'";
      $show = rand(0,1) ? "style= 'display: block;' " : "style= 'display: none;' ";

      $imgPath = "../../assets/images/products/$line[8]";

      echo "
        <td>
          <div class='image'>
            <img src='$imgPath' alt='' style='width: 100%; height: 100%; object-fit: cover;'>
            <div class= 'image-item__favor' $show >
              <i class= 'fa-solid fa-check'></i>
              <span>Yêu thích</span>
            </div>
          </div>

          <div class='info'>
            <div class='top'>
              <p><span class='bold'>Tên sách:</span> $line[1]</p>
              <p><span class='bold'>Thể loại:</span> $line[3]</p>
              <p><span class='bold'>Tác giả:</span> $line[7]</p>
              <p><span class='bold'>Mô tả:</span> $line[4]</p>
              <p style='display: flex; justify-content: space-between;'>
                <span><span class='bold'>Giá:</span> " . "<span style='color: red;'>". number_format($line[5], 0, ',', '.') . " VNĐ</span></span>
                <span><span class='bold'>Còn:</span> $line[6]</span>
              </p>
            </div>

            <div class='bottom'>
              <p class='item-maSach'>
                <i class='icon-info fa-solid fa-circle-info' style='color: gray;'></i>
                <i class='icon-heart fa-solid fa-heart' $tym id='$line[0]'></i>
                <i class='icon-cart fa-solid fa-cart-shopping'></i>
              </p>
            </div>
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
    margin-top: <?php echo ($typePage == "index" ? "130px" : "100px"); ?>;
    min-height: 525px;

    .table-products {
      width: 100%;

      tr {
        width: 100%;
        height: 250px;
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
            position: relative;
          }

          .info {
            width: 70%;
            padding: 5px 5px 5px 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;

            .top {
              display: flex;
              flex-direction: column;
              justify-content: start;
              gap: 10px;
              flex-grow: 1;
              padding-top: 10px;
            }

            .bottom {
              height: 35px;
            }

            .item-maSach  {
              display: flex;
              margin-top: 5px;
              gap: 20px;
              font-size: 24px;

              i:hover {
                cursor: pointer;
              }
            }

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
    .image-item__favor{
      font-size: 12px;
      font-weight: bold;
      position: absolute;
      top: 0;
      left: -5px;
      display: flex;
      gap: 5px;
      justify-content: center;
      align-items: center;
      background-color: var(--primary-color);
      color: var(--white-color);
      padding: 3px;
      border-radius: 0 2px 2px 0
    }
    .image-item__favor::before{
      content: "";
      position: absolute;
      border-top: 5px solid var(--primary-color);
      border-left: 6px solid transparent;
      top: 100%;
      left: 0;
      filter: brightness(60%);
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