<style>
  .mod-tim-kiem {
    padding: 5px 0 10px 0;
  }
  .mod-tim-kiem,
  #search {
    background-color: #f95030;
  }

  .container {
    display: flex;
    gap: 10px;
  }
  
  .logo {
    width: 150px;
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
    }

    form {
      .frame-search {
        padding: 3px 5px;
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
    }
  }
</style>

<section class='mod-tim-kiem'>
  <div class="container">
    <div class="logo">
      <a href="http://localhost/ban_sach/source/html/type/user/index.php">
        <i class="fa-solid fa-book-open" style='color: white; font-size: 80px;'></i>
      </a>
    </div>

    <div class="info">
      <p class='name-user'>
        <span>Nguyễn Anh Quân</span>
        <span class='option'>
          <a class="favorite" title="Yêu thích" href="">
            <i class="fa-regular fa-heart"></i>
          </a>
          <a class='pass' title="Đổi mật khẩu" href="">
            <i class="fa-solid fa-key"></i>
          </a>
          <a class='logout' title="Đăng xuất" href="">
            <i class="fa-solid fa-right-from-bracket"></i>
          </a>
        </span>
      </p>

      <form action="" method='get'>
        <div class='frame-search'>
          <input type="text" id='search-text' name='txtTimKiem' placeholder="Tìm gì đó...">
          <button id="search"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
      </form>
    </div>
  </div>
</section>