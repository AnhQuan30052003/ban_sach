<?php
  $_ten = isset($_REQUEST["ten"]) ? $_REQUEST["ten"] : "";
  $_sdt = isset($_REQUEST["sdt"]) ? $_REQUEST["sdt"] : "";
  $_email = isset($_REQUEST["email"]) ? $_REQUEST["email"] : "";
  $_password = isset($_REQUEST["password"]) ? $_REQUEST["password"] : "";
  $_diaChi = isset($_REQUEST["diaChi"]) ? $_REQUEST["diaChi"] : "";

  trim($_ten);
  trim($_sdt);
  trim($_email);
  trim($_password);
  trim($_diaChi);
  $errorRegister = "";

  function check_register() {
    global $errorRegister, $userId, $role, $_ma, $_ten, $_email, $_sdt, $_password, $_diaChi;

    $_password = md5($_password);

    $_ma = get_id_laster("select ma from khach_hang group by ma order by ma desc limit 1");
    $sql = "insert into `khach_hang` values ('$_ma', '$_ten', '$_email', '$_sdt', '$_password', '$_diaChi');";
    $result = quick_query($sql);
    
    if (!$result) {
      $errorRegister = "Thông tin đăng ký không đúng định dạng !";
      return;
    }

    $userId = $_ma;
    get_data_user($userId, $role);
    echo "
      <script>
        alert('Đăng ký tài khoản thành công');
      </script>
    ";
  }

  if (isset($_REQUEST["btn-register"])) {
    # Kiểm tra dữ liệu lấy vào
    $data_correct = true;

    # _ten phải toàn là ký tự, không có số
    if ($data_correct) $data_correct = run_check("check_is_string", $_ten, "Họ và tên không chứa số !");

    # _sdt là chuỗi toàn số
    if ($data_correct) $data_correct = run_check("check_is_numeric", $_sdt, "Số điện thoại phải là chuỗi toàn số !");

    # _email phải đúng định dạng
    if ($data_correct) $data_correct = run_check("check_is_email", $_email, "Email không đúng định dạng !");

    if ($data_correct) {
      check_register();
      return;
    }
    $errorRegister = " ";
  }
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
    <form action="" method="POST">
      <div class="form-group">
        <input type="text" id="ten" name="ten" placeholder="Họ và tên" required value='<?php echo $_REQUEST["ten"] ?? "" ?>'>
        <span id='error-ten' class='error'></span>
      </div>

      <div class="form-group">
        <input type="text" id="sdt" name="sdt" placeholder="Số điện thoại" required value='<?php echo $_REQUEST["sdt"] ?? "" ?>'>
        <span id='error-sdt' class='error'></span>
      </div>

      <div class="form-group">
        <input type="email" id="email" name="email" placeholder="Email" required value='<?php echo $_REQUEST["email"] ?? "" ?>'>
        <span id='error-email' class='error'></span>
      </div>
      
      <div class="form-group" style='position: relative;'>
        <input type="password" id='password-register' name="password" placeholder="Mật khẩu" required value='<?php echo $_REQUEST["password"] ?? "" ?>'>
        <span class='frame-eyes'>
          <i class="fa-solid fa-eye-slash"></i>
        </span>
        <span id='error-password-register' class='error'></span>
      </div>

      <div class="form-group">
        <input type="text" id="diaChi" name="diaChi" placeholder="Địa chỉ" required value='<?php echo $_REQUEST["diaChi"] ?? "" ?>'>
        <span id='error-diaChi' class='error'></span>
      </div>

      <button type="submit" class="btn" name='btn-register'>Đăng ký</button>
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

<script>
  // Trường tên
  window.addEventListener("load", after_leave("ten", "error-ten", "Họ và tên"));
  window.addEventListener("load", change_input("ten", "error-ten", "Họ và tên", 0, true));

  // Trường sdt
  window.addEventListener("load", after_leave("sdt", "error-sdt", "Số điện thoại"));
  window.addEventListener("load", change_input("sdt", "error-sdt", "Số điện thoại", 10, false, true));

  // Trường email
  window.addEventListener("load", after_leave("email", "error-email", "Email"));
  window.addEventListener("load", change_input("email", "error-email", "Email"));

  // Trường mật khẩu
  window.addEventListener("load", after_leave("password-register", "error-password-register", "Mật khẩu"));
  window.addEventListener("load", change_input("password-register", "error-password-register", "Mật khẩu"));

  // Trường địa chỉ
  window.addEventListener("load", after_leave("diaChi", "error-diaChi", "Địa chỉ"));
  window.addEventListener("load", change_input("diaChi", "error-diaChi", "Địa chỉ"));

</script>