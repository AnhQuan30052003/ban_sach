<?php
  $_email = isset($_REQUEST["email"]) ? $_REQUEST["email"] : "";
  $_pin = isset($_REQUEST["pin"]) ? $_REQUEST["pin"] : "";

  trim($_email);
  trim($_pin);

  $errorForgottenPassword = "";
  $showInputPin = "none";
  $linkBack = ($role == "admin" ? "../admin/index.php" : "../user/index.php");

  function find_account() {
    global $errorForgottenPassword, $_pin;


  }

  if (isset($_REQUEST["btn-find"])) find_account();
?>

<style>
  .login-container {
    overflow: hidden;
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
  input[type='email'] {
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

  .frame-eyes {
    position: absolute;
    top: 15px;
    right: -35px;

    :hover {
      cursor: pointer;
    }
  }
</style>

<div class="login-container" id='div-forgotten-password'>
  <div class='cancel' onclick="show_or_hidden(1);">X</div>
  <div class="login-header">
    <!-- <img class="header-logo" src="" alt=""> -->
    <h2>QUÊN MẬT KHẨU</h2>
    <p style='color: red;'> <?php echo $errorForgottenPassword; ?></p>
  </div>

  <div class="login-form">
    <form action="" method="POST">
      <div class="form-group">
        <input type="email" id="email" name="email" autofocus placeholder="Nhập email đăng ký tài khoản">
      </div>

      <div class="form-group" style='position: relative; display: <?php echo $showInputPin; ?>;'>
        <input type="text" name="pin" placeholder="Nhập mã pin (6 số)" >
      </div>

      <button type="submit" class="btn" name='btn-find'>Tìm</button>
    </form>
  </div>

  <div class="login-footer">
    <div>
      <a href="<?php echo $linkBack; ?>">Quay về</a>
    </div>
  </div>
</div>