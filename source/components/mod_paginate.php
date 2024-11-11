<style>
  .mod-paginate {
    min-height: 0;
    margin: 10px 0;
    a {
      text-decoration: none;
    }

    .box .line {
      /* padding: 5px 7px; */
      border-radius: 10px;
    }

    .line {
      display: flex;
      gap: 5px;
      justify-content: center;
    }

    .item {
      border: solid 1px;
      padding: 3px 5px;
      border-radius: 5px;
      color: black;
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

    $show = $maxPage > 1 ? "block" : "none";
    
    echo "<section class='mod-paginate' style='display: $show;'>";
    echo "<div class='container'>";

    echo "<div class='box' style='width: 100%; text-align: center;'>";
    echo "<span class='line'>";

    if ($maxPage > 3) echo "<a class='item' href='" . $url . "&page=" . 1 . "'> << </a>";
    if ($pageP >= 1) echo "<a class='item' href='" . $url . "&page=" . $pageP  . "'> < </a>";

    for ($i = 1; $i <= $maxPage; $i++) {
      if ($i == $_GET["page"]) echo "<b class='item' style='background-color: #8080807a; color: white;'> $i </b>";
      else echo "<a class='item' href='" . $url . "&page=" . $i  . "'> $i </a>";
    }

    if ($pageN <= $maxPage) echo "<a class='item' href='" . $url . "&page=" . $pageN  . "'> > </a>";
    if ($maxPage > 3) echo "<a class='item' href='" . $url . "&page=" . $maxPage . "'> >> </a>";

    echo "</span>";
    echo "</div>";

    echo "</div>";
    echo "</section>";
  }
?>