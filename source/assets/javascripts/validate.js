// Thay đổi nôi dung phần tử chỉ định (id)
function change_error(element, content) {
  document.getElementById(element).innerHTML = content;
}

// Lấy value
function get_value(element) {
  return document.getElementById(element).value;
}

// Kiểm tra chuỗi toàn số và đúng chiều dài n ký tự
function all_number_and_length_is(element, size) {
  element = element.value;

  if (element.length != size) return false;

  let count = 0;
  for (let i = 0; i < element.length; i++) {
    if (element[i] >= '0' && element[i] <= '9') count += 1;
  }

  return count == size;
}

// Kiểm tra chuỗi toàn ký tự
function all_charactor(element) {
  element = element.value.toLowerCase();

  for (let i = 0; i < element.length; i++) {
    if (element[i] >= '0' && element[i] <= '9') return false;
  }
  
  return true;
}

// Kiểm tra xem đối tượng đó không bị nhập dữ liệu hay không ?
function check_empty(element, elementError, object) {
  if (element.value == "") {
    change_error(elementError, `${object} không được rỗng !`)
  }
  else {
    change_error(elementError, "");
  }
}

// Ràng buộc dữ liệu sau khi rời khỏi ô
function after_leave(idCheck, objError, name) {
  document.getElementById(idCheck).addEventListener("blur", function() {
    check_empty(this, objError, name);
  });
}

// Ràng buộc dữ liệu sau khi thay đổi nội dung
function change_input(idCheck, objError, name, size = 0, allCharactor = false, allNumber = false) {
  document.getElementById(idCheck).addEventListener("keyup", function() {
    console.log("Run địa chỉ");
    check_empty(this, objError, name);

    if (allCharactor && !all_charactor(this)) {
      change_error(objError, `${name} không được chứa số !`)
      return;
    }
    
    if (allNumber && !all_number_and_length_is(this, size)) {
      change_error(objError, `${name} chỉ được nhập số và độ dài ${size} ký tự !`)
      return;
    }

    change_error(objError, "");
  });
}