// Kiểm tra không nhập dữ liệu ?
const isEmpty = document.querySelectorAll(".is-empty");
if (isEmpty) {
  isEmpty.forEach((item) => {
    let card = item.getAttribute("card");

    item.addEventListener("blur", function() {
      if (this.value == "") show_error(this, card + " không được bỏ trống");
    });
    item.addEventListener("keyup", function() {
      if (this.value == "") show_error(this, card + " không được bỏ trống");
      else show_error(this);
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

// Kiểm tra mật khẩu phải thoả 4-32 ký tự
const correctPassword = document.querySelectorAll(".correct-password");
correctPassword.forEach((item) => {
  item.addEventListener("keyup", function() {
    if (this.value.length >= 4 && this.value.length <= 32) show_error(this);
    else {
      let card = this.getAttribute("card");
      show_error(this, card + " phải có chiều dài từ 4-32 ký tự");
    }
  });
});

// Chuỗi chỉ có thể có ký tự thường, không số, không ký tự đặc biệt
const isCharacter = document.querySelectorAll(".is-character");
isCharacter.forEach((item) => {
  item.addEventListener("keyup", function() {
    let card = item.getAttribute("card");
    const regex = /^[\p{L} ]+$/u;

    if (this.value == " ") {
      show_error(this, "Ký đầu từ đầu không được là khoảng trống");
      return;
    }

    if (regex.test(this.value.trim())) show_error(this);
    else show_error(this, card + " chỉ được nhập ký tự");
  });
});

// Kiểm tra số điện thoại
const phoneNumber = document.querySelectorAll(".is-phone-number");
phoneNumber.forEach((item) => {
  let card = item.getAttribute("card");
  item.addEventListener("keyup", function() {
    let value = this.value;
    for (let i = 0; i < value.length; i++) {
      if (value[i] < '0' || value[i] > '9') {
        show_error(this, card + " chỉ được nhập số từ 0-9");
        return;
      }
    }
    if (value.length > 10) show_error(this, card + " chỉ được nhập 10 số");
    else show_error(this);
  });
});

// Chỉ nhập số dương
const positiveNumber = document.querySelectorAll(".positive-number");
positiveNumber.forEach((item) => {
  let card = item.getAttribute("card");
  item.addEventListener("keyup", function() {
    if (this.value.length == 0) return;
    if (this.value < 0) show_error(this, card + " phải là số dương");
    else show_error(this);
  });
});


// ---------- Nếu không có lỗi thì được phép -----------
const listener = document.querySelectorAll(".listener");
listener.forEach((item) => {
  item.addEventListener("keyup", function() {
    let card = this.getAttribute("card");
    if (this.value.length == 0) show_error(this, card + " không được bỏ trống");

    let formValidate = this.closest(".form-validate");
    let countStatus = 0;
  
    let quantity = formValidate.getAttribute("quantity");
    let listeners = formValidate.querySelectorAll(".listener");
    let btnValidate = formValidate.querySelector(".btn-validate");
  
    listeners.forEach((item) => {
      if (item.getAttribute("status") == "true") countStatus += 1;
    });
  
    if (countStatus == quantity) {
      btnValidate.classList.remove("not-allowed");
      btnValidate.removeAttribute("disabled");
    }
    else {
      btnValidate.classList.add("not-allowed");
      btnValidate.disabled = true;
    }
  });
});

// Sau khi load web
window.addEventListener("load", function() {
  const listener = document.querySelectorAll(".listener");
  const failData = localStorage.getItem("failData");
  if (failData == null) return;

  listener.forEach((item) => {
    if (item.closest(`.${failData}`)) {
      item.dispatchEvent(new Event("keyup"));
    }
  })
});

// localStorage.clear();