function tym() {
  const iconHeart = document.querySelectorAll(".icon-heart");
  
  iconHeart.forEach((item) => {
    item.addEventListener("click", function() {

      let userId = localStorage.getItem("userId")
      if (userId == null) {
        alert("Hãy đăng nhập để tiếp tục !");
        return;
      }
      
      let id = this.getAttribute("id");
      let toFile = "../../database/helper/add_product_favorite.php";
      send_data(id, toFile);

      let pageIndex = localStorage.getItem("index");
      if (pageIndex == 'index') {
        let checkColor = this.style.color;
        let color = "red";
        let info = "Đã thêm vào yêu thích";
        if (checkColor == "red") {
          color = "black";
          info = "Đã xoá khỏi yêu thích";
        }

        this.style.color = color;
        show_noti(info);
      }
      else {
        this.closest(".item").style.display = "none";
        show_noti("Đã xoá khỏi yêu thích");
      }
    })
  });
}
tym();