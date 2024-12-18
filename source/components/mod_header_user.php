<?php
  // filter
  $loaiSach = isset($_GET["loai-sach"]) ? $_GET["loai-sach"] : "0000";
  $tacGia = isset($_GET["tac-gia"]) ? $_GET["tac-gia"] : "";
  $nhaXuatBan = isset($_GET["nha-xuat-ban"]) ? $_GET["nha-xuat-ban"] : "";

  function build_home_or_favorite() {

    if (type_page("index")) {
      save_or_to_index(true);

      return "
        <a class='favorite' title='Yêu thích' href='favorite.php'>
          <i class='fa-regular fa-heart'></i>
        </a>
      ";
    }
    else {
      $index = save_or_to_index(false);

      return "
        <a class='favorite' title='Page home' href='$index'>
          <i class='fa-solid fa-house'></i>
        </a>
        <a class='favorite' title='Yêu thích' href='favorite.php'>
          <i class='fa-regular fa-heart'></i>
        </a>
      ";
    }    
  }

  function build_user_login() {
    global $userId, $infoUser;
    // Hiển thị khi user đăng nhập
    if ($userId != "") {
      $name = $infoUser["ten"];
      $namePage = type_page("index") ? "Trang chủ" : (type_page("favorite") ? "Yêu thích" : "Giỏ hàng");

      echo "
        <span class='user-login-true' style='font-weight: bold;'>
          <i class='fa-solid fa-user'></i>
          <span style='margin: 0 10px;'>
            Xin chào
            <span style='text-decoration: underline; font-style: italic;'>$name</span>
            | $namePage
          </span>
        </span>
        
        <!-- Tuỳ chọn  -->
        <span class='user-login-true option'>
          " . build_home_or_favorite() . "
          <a class='pass' title='Giỏ hàng' href='./cart.php'>
            <i class='fa-solid fa-cart-shopping'></i>
          </a>
          <a class='pass' title='Đổi mật khẩu' href='../system/change_password.php'>
            <i class='fa-solid fa-key'></i>
          </a>
          <a class='logout' title='Đăng xuất' href='#' onclick='logout()'>
            <i class='fa-solid fa-right-from-bracket'></i>
          </a>
        </span>
    ";
    }

    // Hiển thị khi user chưa đăng nhập
    else {
      echo "
        <span class='user-login-false'></span>
        <span class='user-login-false' style='font-weight: bold; margin-bottom: 10px;'>
          <span onclick='show_or_hidden(2);'>Đăng ký</span> | 
          <span onclick='show_or_hidden(1);'>Đăng nhập</span>
        </span>
      ";
    }
  }

  function build_group_box($name, $nameFake, $typeCur, $sql) {
    $result = get_data_query($sql);

    echo "<select class='group-box' name='$name' id='$name' onchange='send()'>";

    if ($typeCur == "") echo "<option value='' selected>$nameFake</option>";
    else echo "<option value=''>$nameFake</option>";

    foreach ($result as $line) {
      if ($line[0] == $typeCur) echo "<option value='$line[0]' selected>$line[1]</option>";
      else echo "<option value='$line[0]'>$line[1]</option>";
    }
    
    echo "</select>";
  }
?>

<style>
  .mod-header {
    padding: 5px 0;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1;

    .container {
      display: flex;
      gap: 10px;
    }
  }

  .group-box,
  .frame-search,
  #search {
    border-radius: 4px;
  }

  .mod-header {
    background-color: var(--primary-color)
  }
  #search {
    background-color: #f95030;
  }

  .logo {
    width: 150px;
    display: flex;
    align-items: center;
  }

  .info {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-around;

    .name-user {
      color: white;
      display: flex;
      justify-content: space-between;

      .option {
        a {
          display: inline-block;
          text-decoration: none;
          padding: 5px 0 5px 10px;
          color: white;
          outline: none;
          border: none;
          height: 40px;
          margin-left: 15px;
          background-color: transparent;

          :hover {
            scale: 1.2;
          }
        }
      }

      .user-login-false {
        justify-self: end;
        span {
          border: none;
          outline: none;
          /* padding: 5px 0; */
          font-size: 18px;
          width: 100px;
          background-color: transparent;
          color: white;
        }

        span:hover {
          text-decoration: underline;
          cursor: pointer;
        }
      }
    }

    form {
      .frame-search {
        padding: 3px 5px;
        margin-bottom: 10px;
        background-color: white;
        display: flex;
        gap: 3px;        

        input {
          border: none;
          outline: none;
        }
        
        #search-text {
          padding: 5px;
          flex-grow: 4;
        }
  
        #search {
          border: none;
          outline: none;
          padding: 7px 10px;
          color: white;
          width: 100px;
        }
        #search:hover {
          opacity: 0.7;
        }
      }

      .group-box {
        outline: none;
        padding: 3px 5px;
      }

      .description {
        color: white;
        margin-left: 10px;
      }
    }
  }
</style>

<section class='mod-header'>
  <div class="container">
    <div class="logo">
      <a href="index.php">
         <img style="height: 100px;" src="../../assets/images/logo.png" alt="">
      </a>
    </div>

    <div class="info">
      <!-- Khung user login or not -->
      <p class='name-user'><?php build_user_login(); ?></p>

      <!-- Khung tìm kiếm -->
      <form action="" method='get' id='form-search'>
        <div class='frame-search'>
          <input type="text" id='search-text' name='txtTimKiem'
            placeholder="<?php echo (type_page("index") ? "Tìm gì đó..." : (type_page("favorite") ? "Tìm sản phẩm yêu thích..." : "Tìm sản phẩm trong giỏ hàng")); ?>"
            value='<?php if (isset($_GET["txtTimKiem"])) echo $_GET["txtTimKiem"]; ?>'
          >
          <button id="search"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>

        <div style='margin-top: 5px; <?php echo (type_page("index") ? "display: block;" : "display: none;"); ?>'>
          <?php build_group_box("loai-sach", "Loại sách", $loaiSach, "select * from loai_sach"); ?>
          <?php build_group_box("tac-gia", "Tác giả", $tacGia, "select * from tac_gia"); ?>
          <?php build_group_box("nha-xuat-ban", "Nhà xuất bản", $nhaXuatBan, "select * from nha_xuat_ban"); ?>
          <span id='description' class='description'></span>
        </div>
      </form>
    </div>
  </div>

  <div id="notification">
    <p><i class="fa-solid fa-check"></i></p>
  </div>
</section>