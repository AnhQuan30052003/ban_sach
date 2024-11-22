<?php
  $_username =  $_REQUEST["username"] ?? "";
  $_password = $_REQUEST["password-login"] ?? "";

  trim($_username);
  trim($_password);
  $_password = md5($_password);
  $errorLogin = "";

  function request($_username, $_password, $nameTable) {
    $sql = "select * from `$nameTable` where email = '$_username' and matKhau = '$_password'";
    $result = get_data_query($sql);
    return $result;
  }

  # Nếu userName & password hợp lệ thì truy vấn
  function check_login($_username, $_password) {
    global $errorLogin, $userId, $role;
    
    # Kiểm tra bên khách hàng
    $result = request($_username, $_password, "khach_hang");
    $role = count($result) > 0 ? "khach_hang" : "";

    # Kiểm tra bên admin
    if ($role == "") {
      $result = request($_username, $_password, "admin");
      $role = count($result) > 0 ? "admin" : "";
    }

    if ($role == "") {
      $errorLogin = "Tài khoản hoặc mật khẩu không chính xác !";
      echo "<script>localStorage.setItem('failData', 'form-login');</script>";
      return;
    }

    $userId = $result[0][0];
    get_data_user($userId, $role);

    echo "
      <script>
        localStorage.setItem('userId', '$userId');
        localStorage.removeItem('failData');
        alert('Đăng nhập thành công');
      </script>
    ";

    if ($role == "admin") {
      $link = "../admin/index.php";
      echo "<script>window.location.href = '$link';</script>";
    }
  }

  if (isset($_REQUEST["btn-login"]) && $userId == "") check_login($_username, $_password);
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
    opacity: 0.5;
  }

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

  .form-login {
    max-width: 360px;
    margin: 0 40px;
    text-align: left;
  }

  .login-header{
    margin-bottom: 20px;
  }
  .form-login label {
    display: block;
  }

  .form-login input[type='text'],
  input[type='password'] {
    width: 100%;
    border-radius: 30px;
    padding: 12px 20px;
    border: none;
  }

  .form-login .form-group {
    margin-top: 10px;
  }

  .form-login .uname {
    margin: 10px;
    font-weight: 600;
    font-size: 16px;
    color: #292929;
  }

  .form-login .save-pass {
    display: flex;
    flex-direction: row;
    align-items: start;
    margin-top: 20px;
  }

  .form-login .btn {
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

<div class="login-container" id='div-login' style='display: none;'>
  <div class='cancel' onclick="show_or_hidden(1);">X</div>
  <div class="login-header">
    <h2>ĐĂNG NHẬP</h2>
    <p style='color: red;'> <?php echo $errorLogin; ?></p>
  </div>

  <div class="form-login">
    <form action="" method="POST" class='form-validate' quantity='2'>
      <div class="form-group validate">
        <input class='is-email is-empty listener' card='Email' status='false' type="text" id="username" name="username" placeholder="Email" required value='<?php echo $_REQUEST["username"] ?? ""; ?>'>
        <span class='error'></span>
      </div>
      
      <div class="form-group validate" style='position: relative;'>
        <input class='is-empty correct-password listener' type="password" id='password-login' card='Mật khẩu' status='false' name="password-login" placeholder="Mật khẩu" required maxlength="32" value='<?php echo $_REQUEST["password-login"] ?? ""; ?>' >
        <span class='frame-eyes'>
          <i class="fa-solid fa-eye-slash"></i>
        </span>
        <span class='error'></span>
      </div>

      <div class="save-pass" style='display: flex; gap: 10px; align-items: center;'>
        <input type="radio">
        <span>Ghi nhớ đăng nhập</span>
      </div>

      <button type="submit" class="btn btn-validate not-allowed" disabled name='btn-login'>Đăng nhập</button>
    </form>
  </div>

  <div class="login-footer">
    <div>
      <p>
        <span>Bạn chưa có tài khoản?</span>
        <a href="#" onclick="show_or_hidden(1); show_or_hidden(2);">Đăng ký</a>
      </p>
      <p><a href="../system/forgotten_password.php">Quên mật khẩu</a></p>
    </div>
  </div>
</div>