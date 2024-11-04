<?php
  $_username = isset($_REQUEST["username"]) ? $_REQUEST["username"] : "";
  $_password = isset($_REQUEST["password"]) ? $_REQUEST["password"] : "";

  trim($_username);
  trim($password);
  $errorRegister = "";

  # Nếu userName & password hợp lệ thì truy vấn
  $sql = "select * from khach_hang where (tenKH = '$_username' or email = '$_username') and matKhau = '$_password'";
  $result = get_data_query($sql);

  function check_login() {
    global $result, $errorRegister, $userId, $infoUser;
    if (count($result) == 0) {
      $errorRegister = "Tài khoản hoặc mật khẩu không chính xác !";
      return;
    }

    $_SESSION["userId"] = $userId = $result[0]["maKH"];
    get_data_user($userId);

    if ($userId == "0000") {
      $link = "../admin/index.php";
      echo "<script>window.location.href = '$link'</script>";
    }
  }

  if (isset($_REQUEST["btn-login"])) check_login();
?>

<style>
  .register-container {
    overflow: hdiden;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 3;
    width: 468px;
    margin: 0 auto;
    padding: 30px;
    text-align: center;
    border-radius: 20px;
    background: linear-gradient(177deg, rgb(121, 227, 187) 0%, rgb(232, 203, 227) 100%);
    background: -webkit-linear-gradient(177deg, rgb(121, 227, 187) 0%, rgb(232, 203, 227) 100%);
  }

  .register-form {
    max-width: 360px;
    margin: 0 54px;
    text-align: left;
  }
  .register-form label{
    display: block;
    margin: 10px;
    font-weight: 600;
    font-size: 16px;
    color: #292929;
  }

  .register-form input[type='text'], input[type='password'], input[type='email']{
    width: 100%;
    border-radius: 30px;
    padding: 12px 20px;
    border: none;
  }

  .register-form .form-group {
    margin-top: 10px;
  }

  .register-form .save-pass{
    display: flex;
    flex-direction: row;
    align-items: start;
    margin-top: 20px;
  }

  .register-form .btn {
    display: block;
    width: 100%;
    font-size: 16px;
    background-color: turquoise;
    border: none;
    outline: none;
    padding: 12px 20px;
    border-radius: 999px;
    color: white;
    font-weight: bold;
    margin-top: 30px;
    margin-bottom: 10px;
  }
  .cancel {
    position: absolute;
    top: 5px;
    right: 5px;
    font-size: 20px;
    color: red;
    cursor: pointer;
    padding: 5px;
  }
</style>

<div class="register-container" id='div-register' style='display: none;'>
  <div class='cancel' onclick="show_or_hidden(2);">X</div>
  <div class="register-header">
    <!-- <img class="header-logo" src="" alt=""> -->
    <h2>ĐĂNG KÝ</h1>
    <p style='color: red;'> <?php echo $errorRegister; ?></p>
  </div>

  <div class="register-form">
    <form action="" method="POST">
      <div class="form-group">
        <input type="text" id="tenKH" name="tenKH" placeholder="Họ và tên" required value='<?php if (isset($_REQUEST["tenKH"])) echo $_REQUEST["tenKH"]; ?>'>
      </div>

      <div class="form-group">
        <input type="text" id="sdt" name="sdt" placeholder="Số điện thoại" required value='<?php if (isset($_REQUEST["sdt"])) echo $_REQUEST["sdt"]; ?>'>
      </div>

      <div class="form-group">
        <input type="email" id="email" name="email" placeholder="Email" required value='<?php if (isset($_REQUEST["email"])) echo $_REQUEST["email"]; ?>'>
      </div>
      
      <div class="form-group">
        <input type="password" id="password" name="password" placeholder="Mật khẩu" required value='<?php if (isset($_REQUEST["password"])) echo $_REQUEST["password"]; ?>'>
      </div>

      <div class="form-group">
        <input type="text" id="diaChi" name="diaChi" placeholder="Địa chỉ" required value='<?php if (isset($_REQUEST["diaChi"])) echo $_REQUEST["diaChi"]; ?>'>
      </div>

      <button type="submit" class="btn">Đăng ký</button>
    </form>
  </div>

  <div class="register-footer">
    <div>
      <p>
        <span>Bạn chưa có tài khoản?</span>
        <a href="#" onclick="show_or_hidden(2); show_or_hidden(1);">Đăng nhập</a>
      </p>
      <p><a href="#">Quên mật khẩu</a></p>
    </div>
  </div>
</div>