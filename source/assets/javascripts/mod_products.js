const iconHeart = document.querySelectorAll(".icon-heart");

iconHeart.forEach(item => {
  item.addEventListener("click", function() {

    let userId = localStorage.getItem("userId")
    if (userId == null) {
      alert("Hãy đăng nhập để tiếp tục !");
      return;
    }

    let id = this.getAttribute("id");

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../database/helper/add_product_favorite.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('id=' + id);

    xhr.onload = function() {
      if (xhr.status === 200) {
        location.reload();
      }
    }
  })
});