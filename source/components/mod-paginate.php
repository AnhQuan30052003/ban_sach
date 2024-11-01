<style>
  .mod-paginate {
    a {
      text-decoration: none;
    }

    .box .line {
      border: solid 1px;
      padding: 5px 7px;
      border-radius: 10px;
    }
  }
</style>

<?php
  function show_number_page($result, $itemNumbers) {
    if (is_bool($result) || mysqli_num_rows($result) == 0) return;
    $url = get_url_page();
    if (!strpos($url, "?")) $url .= "?";


    $numberRows = mysqli_num_rows($result);
    $maxPage = floor($numberRows / $itemNumbers) + 1;
    $pageP = $_GET["page"]-1;
    $pageN = $_GET["page"]+1;
    
    echo "<section class='mod-paginate'>";
    echo "<div class='container'>";

    echo "<div class='box' style='width: 100%; text-align: center;'>";

    echo "<span class='line'>";
    echo "<a href='" . $url . "&page=" . 1  . "'> Đầu </a>";
    if ($pageP >= 1) echo "<a href='" . $url . "&page=" . $pageP  . "'> < </a>";

    for ($i = 1; $i <= $maxPage; $i++) {
      if ($i == $_GET["page"]) echo "<b> $i </b>";
      else echo "<a href='" . $url . "&page=" . $i  . "'> $i </a>";
    }

    if ($pageN <= $maxPage) echo "<a href='" . $url . "&page=" . $pageN  . "'> > </a>";
    echo "<a href='" . $url . "&page=" . $maxPage  . "'> Cuối </a>";
    echo "</span>";

    echo "</div>";
    echo "</div>";
    echo "</section>";
  }
?>