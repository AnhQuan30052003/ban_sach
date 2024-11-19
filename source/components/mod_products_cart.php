<?php
  function handle_sql() {
    global $tim, $userId;

    $sql = "
      select s.maSach, tenSach, s.maLS, tenLS, moTa, giaTien, soLuong, s.maTG, tenTG, s.maNXB, tenNXB, hinhAnh
      from sach s join loai_sach ls on s.maLS = ls.maLS
        join nha_xuat_ban nxb on nxb.maNXB = s.maNXB
        join tac_gia tg on tg.maTG = s.maTG
        join gio_hang gh on gh.maSach = s.maSach
        where gh.ma = '$userId' 
    ";

    if (strlen($tim) > 0) {
      $sql .= "s.tenSach = '%$tim%' and moTa = '%$tim%'";
    }

    return $sql;
  }

  $tim = isset($_GET["txtTimKiem"]) ? $_GET["txtTimKiem"] : "";
  
  $productsPerPage = 10;
  if (!isset($_GET["page"])) $_GET["page"] = 1;
  $offset = ($_GET["page"] - 1) * $productsPerPage;
  
  $sql = handle_sql(type_page("index") ? false : true);
  $sql .= " limit $offset, $productsPerPage";
  $result = get_data_query($sql);

  function build_data() {
    global $result, $sql, $userId;
    if (is_bool($result)) return;

    # Hiển thị số đếm sản phẩm tìm thấy
    $sqlTemp = cutString($sql, "limit");
    $resultTemp = get_data_query($sqlTemp);
    number_products_found(count($resultTemp));

    $soLuong = 1;
    foreach ($result as $line) {
      if ($soLuong == 1) echo "<tr>";
      $imgPath = "../../assets/images/products/$line[11]";

      echo "
        <td>
          <div class='image'>
            <img src='$imgPath' alt='' style='width: 100%; height: 100%; object-fit: cover;'>
          </div>

          <div class='info'>
            <div class='top'>
              <p class='short-text-product'><span class='bold'>Tên sách:</span> $line[1]</p>
              <p><span class='bold'>Thể loại:</span> $line[3]</p>
              <p><span class='bold'>Tác giả:</span> $line[8]</p>
              <p><span class='bold'>Nhà xuất bản:</span> $line[10]</p>
              <p class='short-text-product'><span class='bold'>Mô tả:</span> $line[4]</p>
              <p style='display: flex; justify-content: space-between;'>
                <span><span class='bold'>Giá:</span> " . "<span style='color: red;'>". number_format($line[5], 0, ',', '.') . " VNĐ</span></span>
                <span><span class='bold'>Còn:</span> $line[6]</span>
              </p>
            </div>

            <div class='bottom'>
              <p class='item-maSach'>                
                <a href='./detail.php?id=$line[0]'>
                  <i class='icon-info fa-solid fa-circle-info'style='color: gray;'></i>
                </a>
                <i class='icon-heart fa-solid fa-heart' id='$line[0]'></i>
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
  .mod-san-pham-gioi-hang {
    margin-top: <?php echo (type_page("index") ? "130px" : "110px"); ?>;
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
            transition: 0.4s;
          }

          .info {
            width: 70%;
            padding: 5px 5px 5px 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            font-size: 15px;

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
              
              i {
                transition: 0.4s;
              }

              i:hover {
                cursor: pointer;
                transform: translateY(-5px);
              }
            }

            .bold {
              font-weight: bold;
            }
          }
        }

        td:hover .image {
          scale: 1.05;
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

<section class='mod-san-pham-gioi-hang'>
  <div class="container">
    <table class='table-products'>
      <?php build_data(); ?>
    </table>
  </div>
</section>