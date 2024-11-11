<?php
  $_password_old = isset($_REQUEST["password-old"]) ? $_REQUEST["password-old"] : "";
  $_password_new = isset($_REQUEST["password-new"]) ? $_REQUEST["password-new"] : "";

  trim($_password_old);
  trim($_password_new);

  $errorChangePassword = "";
  $linkBack = save_or_to_index(false);
  $username = ($userId == "0000" ? "admin" : $infoUser["email"]);

  function check_change_password() {
    global $errorChangePassword, $userId, $_password_old, $_password_new, $linkBack, $infoUser;

    if (md5($_password_old) != $infoUser["matKhau"]) {
      $errorChangePassword = "Mật khẩu cũ không chính xác !";
      return;
    }

    if ($_password_old == $_password_new) {
      $errorChangePassword = "Mật khẩu mới không được trùng với mật khẩu cũ !";
      return;
    }

    $_password_new = md5($_password_new);
    $sql = "update khach_hang set matKhau = '$_password_new' where maKH = '$userId'";
    $result = quick_query($sql);

    if (!$result) {
      $errorChangePassword = "Đổi mật khẩu mật khẩu thất bại!";
      return;
    }

    get_data_user($userId);

    echo "
      <script>
        alert('Đổi mật khẩu thành công');
        window.location.href = '$linkBack';
      </script>
    ";
  }

  if (isset($_REQUEST["btn-change-password"])) check_change_password();
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

  .frame-eyes {
    position: absolute;
    top: 15px;
    right: -35px;

    :hover {
      cursor: pointer;
    }
  }
</style>

<div class="login-container" id='div-change-password'>
  <div class='cancel' onclick="show_or_hidden(1);">X</div>
  <div class="login-header">
    <h2>ĐỔI MẬT KHẨU</h2>
    <p style='color: red;'> <?php echo $errorChangePassword; ?></p>
  </div>

  <div class="login-form">
    <form action="" method="POST">
      <div class="form-group">
        <input type="text" id="username" name="username" disabled value='<?php echo $username; ?>'>
      </div>

      <div class="form-group" style='position: relative;'>
        <input type="password" id="password-old" name="password-old" placeholder="Nhập mật khẩu cũ" required value='<?php if (isset($_REQUEST["password-old"])) echo $_REQUEST["password-old"]; ?>' >
        <span class='frame-eyes'>
          <i class="fa-solid fa-eye-slash"></i>
        </span>
      </div>

      <div class="form-group"  style='position: relative;'>
        <input type="password" id="password-new" name="password-new" placeholder="Nhập mật khẩu mới" required value='<?php if (isset($_REQUEST["password-new"])) echo $_REQUEST["password-new"]; ?>' >
        <span class='frame-eyes'>
          <i class="fa-solid fa-eye-slash"></i>
        </span>
      </div>

      <button type="submit" class="btn" name='btn-change-password'>Đổi</button>
    </form>
  </div>

  <div class="login-footer">
    <div>
      <a href="<?php echo $linkBack; ?>">Quay về</a>
    </div>
  </div>
</div>