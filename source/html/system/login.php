<?php
  include_once "../../database/helper/db.php";

  $userName = isset($_REQUEST[""]) ? $_REQUEST[""] : "";
  $password = isset($_REQUEST[""]) ? $_REQUEST[""] : "";

  # Nếu userName & password hợp lệ thì truy vấn
  $sql = "select * from khach_hang where (tenKH = '$userName' or email = '$userName') and matKhau = '$password'";
  $result = get_data_query($sql);

?>
<div class="login-container" >
  <div class="login-header">
    <img class="header-logo" src="" alt="">
    <h2>Đăng nhập vào Sach</h2>
  </div>
  <div class="login-form">
    <form action="" method="POST">
      <div class="form-group">
        <label class="uname" for="username">Tên đăng nhập</label>
        <input type="text" id="username" name="username" placeholder="Username" required>
      </div>
      <div class="form-group">
        <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
      </div>
      <div class="save-pass">
        <input type="radio">
        <label for="">Ghi nhớ đăng nhập</label>
      </div>
      <button type="submit" class="btn">Đăng nhập</button>
    </form>
  </div>
  <div class="login-footer">
    <div>
      <p> <span>Bạn chưa có tài khoản?</span> <a href="">Đăng ký</a></p>
      <p><a href="">Quên mật khẩu</a></p>
    </div>
  </div>
</div>

<style>
  .login-container {
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
  .login-form label{
    display: block;
  }

  .login-form input[type='text'],input[type='password']{
    width: 100%;
    border-radius: 30px;
    padding: 12px 20px;
    border: none;
  }

  .login-form .form-group {
    margin-top: 10px;
  }
  .login-form .uname{
    margin: 10px;
    font-weight: 600;
    font-size: 16px;
    color: #292929;
  }

  .login-form .save-pass{
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

</style>