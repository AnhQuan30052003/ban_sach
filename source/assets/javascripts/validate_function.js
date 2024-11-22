// Hiên thị thông báo lỗi
function show_error(card, infoError = "") {
  card.closest(".validate").querySelector(".error").innerHTML = infoError;
  if (infoError == "") card.setAttribute("status", "true");
  else card.setAttribute("status", "false");
}

// Kiểm tra email có đúng định dạng ?
function check_format_email(text) {
  if (text.includes("@") && (text.includes(".com") || text.includes(".vn"))) return true;
  return false;
}