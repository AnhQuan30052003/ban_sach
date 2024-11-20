function show_noti(text) {
  const noti = document.querySelector("#notification");
  noti.querySelector("p").innerHTML = text;
  noti.classList.toggle("show");

  setTimeout(function() {
    noti.classList.toggle("show");
  }, 2000);
}