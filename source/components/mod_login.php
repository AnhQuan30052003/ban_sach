<?php
  $username = isset($_REQUEST["username"]) ? $_REQUEST["username"] : "";
  $password = isset($_REQUEST["password"]) ? $_REQUEST["password"] : "";

  trim($username);
  trim($password);
  $error = "";

  # Nếu userName & password hợp lệ thì truy vấn
  $sql = "select * from khach_hang where (tenKH = '$username' or email = '$username') and matKhau = '$password'";
  $result = get_data_query($sql);

  function check_login() {
    global $result;
    if (count($result) == 0) {
  
    }
  }

  check_login();
?>

<style>
  body::after {
    content: '';
    position: fixed;
    top: -130px;
    left: 0;
    z-index: 2;
    width: var(--width);
    height: 200vh;
    background-color: black;
    opacity: 0.7;
  }

  .login-container {
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

  .login-form {
    max-width: 360px;
    margin: 0 54px;
    text-align: left;
  }

  .login-form label {
    display: block;
  }

  .login-form input[type='text'],
  input[type='password'] {
    width: 100%;
    border-radius: 30px;
    padding: 12px 20px;
    border: none;
  }

  .login-form .form-group {
    margin-top: 10px;
  }

  .login-form .uname {
    margin: 10px;
    font-weight: 600;
    font-size: 16px;
    color: #292929;
  }

  .login-form .save-pass {
    display: flex;
    flex-direction: row;
    align-items: start;
    margin-top: 20px;
  }

  .login-form .btn {
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

<div class="login-container" id='div-login' style='display: block;'>
  <div class='cancel' onclick="show_or_hidden(1);">X</div>
  <div class="login-header">
    <!-- <img class="header-logo" src="" alt=""> -->
    <h2>Đăng nhập vào Sách</h2>
    <p style='color: red;'> <?php echo $error; ?></p>
  </div>

  <div class="login-form">
    <form action="" method="POST">
      <div class="form-group">
        <input type="text" id="username" name="username" placeholder="Email" required>
      </div>

      <div class="form-group">
        <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
      </div>

      <div class="save-pass" style='display: flex; gap: 10px; align-items: center;'>
        <input type="radio">
        <span>Ghi nhớ đăng nhập</span>
      </div>

      <button type="submit" class="btn">Đăng nhập</button>
    </form>
  </div>

  <div class="login-footer">
    <div>
      <p>
        <span>Bạn chưa có tài khoản?</span>
        <a href="#" onclick="show_or_hidden(1); show_or_hidden(2);">Đăng ký</a>
      </p>
      <p><a href="#">Quên mật khẩu</a></p>
    </div>
  </div>
</div>