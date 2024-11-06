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

function logout(stringExits = 2) {
  if (confirm("Bạn chắc chắn đăng xuất ?")) {
    localStorage.setItem("userId", "");
    if (stringExits == 2) stringExits = "../../";
    else stringExits = "../../../";

    let link = stringExits +  "database/helper/active_logout.php";
    window.location.href = link;
  } 
}