function lock_access(lock = true) {
  const body = document.querySelector("body");
  let value = "100%";
  if (!lock) value = "0%";
  body.style.setProperty("--width", value);
}

function show_or_hidden(type) {
  const login = document.querySelector("#div-login"); // 1
  const register = document.querySelector("#div-register"); // 2

  let element = (type == 1 ? login : register);
  
  if (element.style.display == "none") {
    lock_access(true);
    element.style.display = "block";
  }
  else {
    lock_access(false);
    element.style.display = "none";
  }
}
