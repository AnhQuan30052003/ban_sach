// Nếu không có lỗi thì được phép 


// Kiểm tra không nhập dữ liệu ?
const isEmpty = document.querySelectorAll(".is-empty");
if (isEmpty) {
  isEmpty.forEach((item) => {
    item.addEventListener("blur", function() {
      if (this.value == "") {
        let card = this.getAttribute("card");
        show_error(this, card + " không được bỏ trống");
      }
    });
  });
}

// Kiểm tra email
const isEmail = document.querySelectorAll(".is-email");
if (isEmail) {
  isEmail.forEach((item) => {
    item.addEventListener("keyup", function() {
      if (!check_format_email(this.value)) show_error(this, "Email không hợp lệ");
      else show_error(this);
    });   
  });
}