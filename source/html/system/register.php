
<div class="register-container" >
  <div class="register-header">
    <img class="header-logo" src="" alt="">
    <h1>Đăng ký tài khoản Sach</h1>
  </div>
  <div class="register-form">
    <form action="" method="POST">
      <div class="form-group">
        <label class="uname" for="username">Tên đăng nhập</label>
        <input type="text" id="username" name="username" placeholder="Username" required>
      </div>
      <div class="form-group">
        <label for="">Mật khẩu</label>
        <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
      </div>
      <div class="form-group">
        <label for="">Nhập lại mật khẩu</label>
        <input type="password" id="password" name="password" placeholder="Nhập lại mật khẩu" required>
      </div>
      <button type="submit" class="btn">Đăng ký</button>
    </form>
  </div>
  <div class="register-footer">
    <div>
      <p> <span>Bạn chưa có tài khoản?</span> <a href="">Đăng nhập</a></p>
      <p><a href="">Quên mật khẩu</a></p>
    </div>
  </div>
</div>

<style>
  .register-container {
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

  .register-form input[type='text'],input[type='password']{
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

</style>