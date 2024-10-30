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

function save_link_index(get) {
  if (get) {
    let link = window.location.href;
    localStorage.setItem("linkIndex", link);
  }
  else {
    let link = localStorage.getItem("linkIndex");
    if (link == null) link = "http://localhost/ban_sach/source/html/user/index.php";
    window.location.href = link;
  }
}
