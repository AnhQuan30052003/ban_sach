<?php
  $_ten = $_REQUEST["ten"] ?? "";
  $_sdt = $_REQUEST["sdt"] ?? "";
  $_email = $_REQUEST["email"] ?? "";
  $_password = $_REQUEST["password-register"] ?? "";
  $_diaChi = $_REQUEST["diaChi"] ?? "";

  trim($_ten);
  trim($_sdt);
  trim($_email);
  trim($_password);
  trim($_diaChi);
  $errorRegister = "";

  function check_register($_ten, $_email, $_sdt, $_password, $_diaChi) {
    global $errorRegister, $userId, $role;
    
    $sql = "select * from `khach_hang` where email = '$_email'";
    $result = get_data_query($sql);
    if (count($result) > 0) {
      $errorRegister = "Email đã được đăng ký !";
      echo "<script>localStorage.setItem('failData', 'form-register');</script>";
      return;
    }
    
    $_password = md5($_password);
    $_ma = get_id_laster("select ma from khach_hang group by ma order by ma desc limit 1");
    $sql = "insert into `khach_hang` values ('$_ma', '$_ten', '$_email', '$_sdt', '$_password', '$_diaChi');";
    quick_query($sql);
    
    $userId = $_ma;
    get_data_user($userId, $role);
    echo "
      <script>
        localStorage.removeItem('failData');
        alert('Đăng ký tài khoản thành công');
      </script>
    ";
  }

  if (isset($_REQUEST["btn-register"])) check_register($_ten, $_email, $_sdt, $_password, $_diaChi);
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
    <h2>ĐĂNG KÝ</h1>
    <p style='color: red;'> <?php echo $errorRegister; ?></p>
  </div>

  <div class="register-form">
    <form action="" method="POST" class='form-validate form-register' quantity='5'>
      <div class="form-group validate">
        <input card='Họ và tên' status='false' class='listener is-empty is-character' type="text" id="ten" name="ten" placeholder="Họ và tên" required value='<?php echo $_REQUEST["ten"] ?? "" ?>'>
        <span class='error'></span>
      </div>

      <div class="form-group validate">
        <input class='listener is-empty is-phone-number' card='Số điện thoại' status='false' type="text" id="sdt" name="sdt" placeholder="Số điện thoại" required value='<?php echo $_REQUEST["sdt"] ?? "" ?>'>
        <span class='error'></span>
      </div>

      <div class="form-group validate">
        <input class='is-email is-empty listener' card='Email' status='false' type="email" id="email" name="email" placeholder="Email" required value='<?php echo $_REQUEST["email"] ?? "" ?>'>
        <span class='error'></span>
      </div>
      
      <div class="form-group validate" style='position: relative;'>
        <input class='is-empty correct-password listener' card='Mật khẩu' status='false' type="password" id='password-register' name="password-register" placeholder="Mật khẩu" required value='<?php echo $_REQUEST["password-register"] ?? "" ?>'>
        <span class='frame-eyes'>
          <i class="fa-solid fa-eye-slash"></i>
        </span>
        <span class='error'></span>
      </div>

      <div class="form-group validate">
        <input class='listener is-empty' card='Địa chỉ' status='false' type="text" id="diaChi" name="diaChi" placeholder="Địa chỉ" required value='<?php echo $_REQUEST["diaChi"] ?? "" ?>'>
        <span class='error'></span>
      </div>

      <button type="submit" class="btn btn-validate not-allowed" disabled name='btn-register'>Đăng ký</button>
    </form>
  </div>

  <div class="register-footer">
    <div>
      <p>
        <span>Bạn đã có tài khoản?</span>
        <a href="#" onclick="show_or_hidden(2); show_or_hidden(1);">Đăng nhập</a>
      </p>
    </div>
  </div>
</div>