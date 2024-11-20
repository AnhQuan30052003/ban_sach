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

  $tim = isset($_GET["txtTimKiem"]) ? $_GET["txtTimKiem"] : "";
  
  $productsPerPage = 10;
  if (!isset($_GET["page"])) $_GET["page"] = 1;
  $offset = ($_GET["page"] - 1) * $productsPerPage;
  
  $sql = handle_sql();
  $sql .= " limit $offset, $productsPerPage";
  $result = get_data_query($sql);

  function build_data() {
    global $result;
    if (is_bool($result)) return;

    foreach ($result as $line) {
      $imgPath = "../../assets/images/products/{$line['hinhAnh']}";

      echo "
        <div class='item'>
          <div class='image'>
            <a href='./detail.php?id={$line['maSach']}'>
              <img src='$imgPath' alt='' style='width: 100%; height: 100%; object-fit: cover;'>
            </a>
          </div>

          <div class='content'>
            <span style='width: 40%;'>
              <a href='./detail.php?id={$line['maSach']}'>{$line['tenSach']}</a>
            </span>
            <span class='price' style='width: 15%'>" . number_format($line['giaTien'], 0, ',', '.') . " VNĐ</span>
            
            <span class='frame'>
              <button class='btn-in-de btn-de' type='button'>-</button>
              <input class='quantity-add' name='quantity-add' type='text' readonly value='{$line['soLuong']}'>
              <button class='btn-in-de btn-in' type='button'>+</button>
            </span>
            
            <span class='total' style='width: 15%; color: red;'>" . number_format($line['soLuong'] * $line['giaTien'], 0, ',', '.') . " VNĐ</span>

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

    .table-products-cart {
      width: 100%;

      .item {
        display: flex;
        margin: 10px 0;
        padding: 10px;
        border: solid 1px;
        border-radius: 3px;
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
  }
</style>

<section class='mod-san-pham-gioi-hang'>
  <div class="container">
    <div class='table-products-cart'>
      <?php build_data(); ?>
    </div>
  </div>
</section>

<script>
  function get_number(text) {
    let price = parseInt(text.replaceAll('.', '').replace('VNĐ', '').trim());
    return price;
  }

  function to_string(number) {
    let strNumber = number.toLocaleString('vi-VN') + " VNĐ";
    return strNumber;
  }

  const btnDe = document.querySelectorAll(".btn-de");
  btnDe.forEach((item) => {
    item.addEventListener("click", function() {
      const quantity = this.closest(".frame").querySelector(".quantity-add");
      if (parseInt(quantity.value) > 1) {
        quantity.value = parseInt(quantity.value) - 1;

        const price = this.closest(".content").querySelector(".price").innerText;
        const total = this.closest(".content").querySelector(".total");

        let result = get_number(price) * quantity.value;
        result = to_string(result);
        total.innerText = result;
      }
    });
  });
  
  const btnIn = document.querySelectorAll(".btn-in");
  btnIn.forEach((item) => {
    item.addEventListener("click", function() {
      const quantity = this.closest(".frame").querySelector(".quantity-add");
      if (parseInt(quantity.value) < 30) {
        quantity.value = parseInt(quantity.value) + 1;

        const price = this.closest(".content").querySelector(".price").innerText;
        const total = this.closest(".content").querySelector(".total");

        let result = get_number(price) * quantity.value;
        result = to_string(result);
        total.innerText = result;
      }
    });
  });

  const btnDelete = document.querySelectorAll(".btn-delete");
  btnDelete.forEach((item) => {
    item.addEventListener("click", function() {
      let id = this.getAttribute("data-id");

      let xhr = new XMLHttpRequest();
      xhr.open('POST', '../../database/helper/remove_product_cart.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.send('id=' + id);
      location.reload();
    });
  });
</script>