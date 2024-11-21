<?php
  function handle_sql() {
    global $tim, $userId;

    $sql = "
      select s.maSach, tenSach, giaTien, gh.soLuong, hinhAnh
      from gio_hang gh join sach s on gh.maSach = s.maSach
        where gh.ma = '$userId' 
    ";

    if (strlen($tim) > 0) {
      $sql .= "and tenSach like '%$tim%' and moTa like '%$tim%'";
    }

    echo $sql;
    return $sql;
  }

  $showControl = "";

  $tim = isset($_GET["txtTimKiem"]) ? $_GET["txtTimKiem"] : "";
  
  $productsPerPage = 5;
  if (!isset($_GET["page"])) $_GET["page"] = 1;
  $offset = ($_GET["page"] - 1) * $productsPerPage;
  
  $sql = handle_sql();
  // $sql .= " limit $offset, $productsPerPage";
  $result = get_data_query($sql);

  function build_data() {
    global $result, $showControl;
    if (count($result) == 0) {
      $showControl = "style='display: none !important;'";
      return;
    }

    foreach ($result as $line) {
      $imgPath = "../../assets/images/products/{$line['hinhAnh']}";

      echo "
        <div class='item'>
          <div class='check-box'>
            <input type='checkbox' class='choose-products-cart'>
          </div>

          <div class='image'>
            <a href='./detail.php?id={$line['maSach']}'>
              <img src='$imgPath' alt='' style='width: 100%; height: 100%; object-fit: cover;'>
            </a>
          </div>

          <div class='content'>
            <span style='width: 40%;'>
              <a href='./detail.php?id={$line['maSach']}'>{$line['tenSach']}</a>
            </span>
            <span style='width: 15%'><span class='price'>" . number_format($line['giaTien'], 0, ',', '.') . "</span> VNĐ</span>
            
            <span class='frame'>
              <button class='btn-in-de btn-de' type='button'>-</button>
              <input class='quantity-add' name='quantity-add' type='text' readonly value='{$line['soLuong']}'>
              <button class='btn-in-de btn-in' type='button'>+</button>
            </span>
            
            <span style='width: 15%; color: red;'><span class='total'>" . number_format($line['soLuong'] * $line['giaTien'], 0, ',', '.') . "</span> VNĐ</span>

            <button class='btn-delete' data-id='{$line['maSach']}'>Xoá</button>
          </div>
        </div>
      ";
    }
  }
?>

<style>
  .mod-san-pham-gioi-hang {
    margin-top: 100px;
    min-height: 525px;

    input[type='checkbox']:hover {
      cursor: pointer;
    }

    .table-products-cart {
      width: 100%;

      .item {
        display: flex;
        margin: 10px 0;
        padding: 10px;
        border: solid 1px;
        border-radius: 3px;
        gap: 10px;

        .check-box {
          width: 20px;
          display: flex;
          align-items: center;
          justify-content: space-between;

          input {
            width: 100%;
            outline: none;
            border: none;
          }
        }
        .image {
          width: 70px;
          height: 70px;
        }
  
        .content {
          width: 95%;
          display: flex;
          padding: 0 10px;
          align-items: center;
          justify-content: space-between;
          font-size: 16px;

          a {
            color: black;
          }


          span:not(:first-child) {
            text-align: center;
          }

          input {
            outline: none;
            width: 50px;
            text-align: center;
          }
  
          button.btn-in-de {
            width: 30px;
            text-align: center;
            background-color: white;
            outline: none;
            border: solid 0.1px;
          }

          button.btn-delete {
            width: 100px;
            padding: 5px 10px;
            border-radius: 5px;
            outline: none;
            border: none;
            background-color: red;
            color: white;
          }
        }
      }
    }
    
    .control {
      display: flex;
      padding: 10px;
      gap: 10px;
      font-size: 16px;
      background-color: #f5f5f5;
      margin: 30px 0 10px 0;
      border-radius: 5px;

      .left {
        width: 40%;
        display: flex;
        gap: 10px;
        align-items: center;
      }

      .right {
        width: 60%;
        display: flex;
        justify-content: end;
        align-items: center;
        gap: 10px;
        font-size: 13px;

        .btn-mua-hang {
          padding: 7px 40px;
          color: white;
          background-color: red;
          border: none;
          outline: none;
        }
      }
    }
  }
</style>

<section class='mod-san-pham-gioi-hang'>
  <div class="container">
    <div class='table-products-cart'>
      <?php build_data(); ?>
    </div>

    <div class="control" <?php echo $showControl; ?>>
      <div class='left'>
        <input type='checkbox' id='click-all'>
        <span><span id='chon-hoac-bo-chon'>Chọn</span> tất cả <span id='count-all'>(<?php echo count($result); ?>)</span></span>
        <span style='color: red; cursor: pointer;' id='delete-all' onclick='delete_all();'>Xoá</span>
      </div>

      <div class="right">
        <span>Tổng thanh toán (<span id='tong-san-pham'>0</span> sản phẩm): <span id='show-total' style='color: red;'><span id='tong-tien-san-pham'>0</span> VND</span></span>
        <button class='btn-mua-hang'>Mua hàng</button>
      </div>
    </div>
  </div>
</section>

<script>
  // Lấy giá trị số từ thẻ
  function get_number(text) {
    let price = parseInt(text.replaceAll('.', '').trim());
    return price;
  }

  // Chuyển thành chuỗi có phân dấu. VD: 10000 -> 10.0000
  function number_to_string(number) {
    let strNumber = number.toLocaleString('vi-VN');
    return strNumber;
  }

  // Tính tổng tiền sản phẩm
  function total_products() {
    let sum = 0;
    let countItem = 0;
    const item = document.querySelectorAll(".item");
    item.forEach((i) => {
      if (i.querySelector(".choose-products-cart").checked && i.style.display != "none") {
        sum += get_number(i.querySelector(".total").innerHTML);
        countItem += 1;
      }
    })

    document.querySelector("#tong-san-pham").innerHTML = countItem;
    document.querySelector("#tong-tien-san-pham").innerHTML = number_to_string(sum);
  }

  // Tính lại số lượng sản phẩm có thể click
  function total_can_click() {
    let countItem = 0;
    const item = document.querySelectorAll(".item");
    item.forEach((i) => {
      if (i.style.display != "none") {
        countItem += 1;
      }
    })
    document.querySelector("#count-all").innerHTML = countItem;
  }

  // Sự kiện khi click giảm số lượng
  const btnDe = document.querySelectorAll(".btn-de");
  btnDe.forEach((item) => {
    item.addEventListener("click", function() {
      const quantity = this.closest(".frame").querySelector(".quantity-add");
      
      if (parseInt(quantity.value) > 1) {
        quantity.value = parseInt(quantity.value) - 1;

        const price = this.closest(".content").querySelector(".price").innerText;
        const total = this.closest(".content").querySelector(".total");
        
        let result = get_number(price) * quantity.value;
        result = number_to_string(result);
        total.innerText = result;

        total_products();
      }
    });
  });
  
  // Sự kiện khi click tăng số lượng
  const btnIn = document.querySelectorAll(".btn-in");
  btnIn.forEach((item) => {
    item.addEventListener("click", function() {
      
      const quantity = this.closest(".frame").querySelector(".quantity-add");
      
      if (parseInt(quantity.value) < 30) {
        quantity.value = parseInt(quantity.value) + 1;
        
        const price = this.closest(".content").querySelector(".price").innerText;
        const total = this.closest(".content").querySelector(".total");
        
        let result = get_number(price) * quantity.value;
        result = number_to_string(result);
        total.innerText = result;
        
        total_products();
      }
    });
  });

  // Sự kiện khi nhấn nút xoá ở từng sản phẩm
  const btnDelete = document.querySelectorAll(".btn-delete");
  btnDelete.forEach((item) => {
    item.addEventListener("click", function() {
      let id = this.getAttribute("data-id");
      let toFile = "../../database/helper/remove_product_cart.php";
      send_data(id, toFile);

      this.closest(".item").style.display = "none";
      show_noti("Đã xoá khỏi giỏ hàng");
      total_can_click();
      total_products();
    });
  });

  // Sự kiện khi từng checkbox của item được click/bỏ
  const checkboxItem = document.querySelectorAll(".choose-products-cart");
  checkboxItem.forEach((item) => {
    item.addEventListener("change", function() {
      total_products();
    });
  });

  // Sự kiện khi click/bỏ click tất cả sản phẩm
  const clickAll = document.querySelector("#click-all");
  clickAll.addEventListener("click", function() {
    document.querySelector("#chon-hoac-bo-chon").innerHTML = this.checked ? "Bỏ chọn" : "Chọn";
    
    let allCheck = document.querySelectorAll(".choose-products-cart");
    for (let i = 0; i < allCheck.length; i++) {
      allCheck[i].checked = this.checked;
    }
    total_products();
  });

  // Xoá những sản phẩm được chọn
  function delete_all() {
    let toFile = "../../database/helper/remove_product_cart.php";
    let data = "";
    let countItemDelete = 0;

    document.querySelectorAll(".choose-products-cart").forEach((item) => {
      if (item.checked) {
        countItemDelete += 1;
        let itemCart = item.closest(".item");
        let idSach = itemCart.querySelector(".btn-delete").getAttribute("data-id");
        data = data +  "," + idSach;
        itemCart.style.display = "none";
      }
    });
    
    send_data(data, toFile);
    show_noti("Đã xoá " + countItemDelete + " sản phẩm");
    total_can_click();
    total_products();
  }
</script>