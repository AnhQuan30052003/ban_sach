  <?php
  function handle_sql(bool $pageFavorite = true) {
    global $tim, $loaiSach, $tacGia, $nhaXuatBan, $userId;

    $sql = "
      select s.maSach, tenSach, s.maLS, tenLS, moTa, giaTien, soLuong, s.maTG, tenTG, s.maNXB, tenNXB, hinhAnh
      from sach s join loai_sach ls on s.maLS = ls.maLS
        join nha_xuat_ban nxb on nxb.maNXB = s.maNXB
        join tac_gia tg on tg.maTG = s.maTG
    ";

    if ($pageFavorite) $sql .= " join sach_yeu_thich syt on syt.maSach = s.maSach where syt.ma = '$userId' ";

    // Ưu tiên tìm kiếm theo input nhập vào
    if (strlen($tim) > 0) {
      $sql .= $pageFavorite ? "and " :  " where ";
      $sql .= "(tenSach like '%$tim%' or tenLS like '%$tim%' or moTa like '%$tim%')";
      return $sql;
    }
    
    if ($pageFavorite) return $sql;

    $cons = [];
    if ($loaiSach != "") $cons[] = "s.maLS = '$loaiSach'";
    if ($tacGia != "") $cons[] = "s.maTG = '$tacGia'";
    if ($nhaXuatBan != "") $cons[] = "s.maNXB = '$nhaXuatBan'";

    if (count($cons) == 0) $sql .= " where false";
    else $sql .= " where " . implode("and ", $cons);

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

    # Danh sách sản phẩm yêu thích của user
    $sqlTemp = "select maSach from sach_yeu_thich where ma = '$userId'";
    $resultTemp = get_data_query($sqlTemp);

    $array = [];
    foreach ($resultTemp as $line) {
      $array[] = $line[0];
    }

    $soLuong = 1;
    foreach ($result as $line) {
      $tym = ""; 

      if (in_array($line[0], $array)) $tym = "style='color: red;'";
      $show = rand(0,1) ? "style= 'display: block;' " : "style= 'display: none;' ";

      $imgPath = "../../assets/images/products/$line[11]";

      echo "
        <div class='item'>
          <div class='wrapper'>
            <div class='image'>
              <img src='$imgPath' alt='' style='width: 100%; height: 100%; object-fit: cover;'>
              <div class= 'image-item__favor' $show >
                <i class= 'fa-solid fa-check'></i>
                <span>Yêu thích</span>
              </div>
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
                  <span><span class='bold'>Còn:</span> <span class='quantity-remain'>$line[6]</span></span>
                </p>
              </div>

              <div class='bottom'>
                <p class='item-maSach'>                
                  <a href='./detail.php?id=$line[0]'>
                    <i class='icon-info fa-solid fa-circle-info'style='color: gray;'></i>
                  </a>
                  <i class='icon-heart fa-solid fa-heart' $tym id='$line[0]'></i>
                  <i class='icon-cart fa-solid fa-cart-shopping'></i>
                </p>
              </div>
            </div>
          </div>

          <div class='to-cart'>
            <div class='space'></div>

            <div class='number'>
              <span>Số lượng: </span> 
              <span class='frame'>
                <button class='btn-in-de btn-de' type='button'>-</button>
                <input class='quantity-add' name='quantity-add' type='text' readonly value='1'>
                <button class='btn-in-de btn-in' type='button'>+</button>
              </span>
              <button class='btn-to-cart' type='button' data-id='$line[0]'>Thêm</button>
            </div>
          </div>
        </div>
      ";
    }
  }
?>

<style>
  .mod-san-pham {
    margin-top: <?php echo (type_page("index") ? "130px" : "120px"); ?>;
    min-height: 525px;

    .table-products {
      width: 100%;
      display: flex;
      flex-wrap: wrap;
      
      .item {
        width: 49%;
        height: 250px;
        margin: 5px;
        background-color: #f6f6f6;
        transition: 0.4s;
        
        .wrapper {
          width: 100%;
          height: 250px;  
          display: flex;
          gap: 10px;
          padding-right: 5px;
        }

        .wrapper .image {
          width: 30%;
          height: 100%;
          display: flex;
          justify-content: center;
          align-items: center;
          position: relative;
          transition: 0.4s;
        }

        .wrapper .info {
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

        .to-cart {
          width: 100%;
          height: 0;
          display: flex;
          overflow: hidden;
          transition: 0.4s;
          .space {
            width: 30%;
            background-color: white;
          }

          .number {
            padding: 5px 7px;
            width: 70%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            input {
              outline: none;
              width: 40px;
              text-align: center;
            }

            button.btn-in-de {
              width: 30px;
              text-align: center;
              background-color: white;
              border: none;
              outline: none;
            }

            button.btn-to-cart {
              padding: 7px 10px;
              background-color: green;
              color: white;
              border: none;
              outline: none;
              cursor: pointer;
              border-radius: 5px;

              &:hover {
                opacity: 0.7;
              }
            }
          }
        }
      }

      .item:hover .wrapper .image {
        scale: 1.05;
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
    <div class='table-products'>
      <?php build_data(); ?>
    </div>
  </div>
</section>

<script>
  // Xử lý việc nhấn icon cart
  const iconCart = document.querySelectorAll(".icon-cart");

  iconCart.forEach((item) => {
    item.addEventListener("click", function () {
      const item = this.closest(".item");
      const toCart = item.querySelector(".to-cart");
      item.classList.toggle("height-have-cart");
      toCart.classList.toggle("height-auto");
    });
  });
  
  const btnDe = document.querySelectorAll(".btn-de");
  btnDe.forEach((item) => {
    item.addEventListener("click", function() {
      const quantity = this.closest(".frame").querySelector(".quantity-add");
      if (parseInt(quantity.value) > 1) {
        quantity.value = parseInt(quantity.value) - 1;
      }
    });
  });

  const btnIn = document.querySelectorAll(".btn-in");
  btnIn.forEach((item) => {
    item.addEventListener("click", function() {
      const quantity = this.closest(".frame").querySelector(".quantity-add");
      const remain = this.closest(".item").querySelector(".quantity-remain").innerText;
      if (parseInt(quantity.value) < parseInt(remain)) {
        quantity.value = parseInt(quantity.value) + 1;
      }
    });
  });

  const btnThem = document.querySelectorAll(".btn-to-cart");
  btnThem.forEach((item) => {
    item.addEventListener("click", function() {
      let userId = localStorage.getItem("userId")
      if (userId == null) {
        alert("Hãy đăng nhập để tiếp tục !");
        return;
      }
      
      let id = this.getAttribute("data-id");
      let inputValue = this.closest(".number").querySelector("input").value;
      let data = `${id}-${inputValue}`;

      this.closest(".number").querySelector("input").value = 1;
      this.closest(".item").querySelector(".to-cart").classList.toggle("height-auto");
      this.closest(".item").classList.toggle("height-have-cart");

      let xhr = new XMLHttpRequest();
      xhr.open('POST', '../../database/helper/add_product_cart.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.send('data=' + data);

      show_noti("Đã thêm vào giỏ hàng");
    });
  });
</script>