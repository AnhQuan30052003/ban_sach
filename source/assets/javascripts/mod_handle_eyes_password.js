const eyePass = document.querySelectorAll(".frame-eyes");

for (let i = 0; i < eyePass.length; i++) {
  eyePass[i].addEventListener("click", function() {
    let cardI = eyePass[i].querySelector('i');
    let cardParent = eyePass[i].parentElement;
    let inputPassword = cardParent.querySelector("input");
    let attr = inputPassword.getAttribute("type");

    if (attr == "password") {
      cardI.classList.remove("fa-eye-slash");
      cardI.classList.add("fa-eye");
    }
    else {
      cardI.classList.remove("fa-eye");
      cardI.classList.add("fa-eye-slash");
    }
    
    inputPassword.setAttribute("type", attr == "password" ? "text" : "password");
  });
}