function send() {
  document.querySelector("#search-text").value = "";
  document.querySelector("#form-search").submit();
}

function no_search() {
  document.getElementById("search-text").addEventListener("input", function() {
    if (this.value === "") document.getElementById("form-search").submit();
  });
}
no_search();

function logout() {
  if (confirm("Bạn chắc chắn đăng xuất ?")) {
    let link = "../../database/helper/active_logout.php";
    window.location.href = link;
  } 
}

localStorage.setItem("userId", "true");