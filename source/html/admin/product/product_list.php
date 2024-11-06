<style>
    section {
        padding: 24px;
    }
</style>
<?php
    include_once "query.php";

    if (!isset($_GET["page"]))
         $_GET["page"] = 1;
    $productsPerPage = 10;
    $offset = ($_GET["page"] - 1) * $productsPerPage;
    $sql = "SELECT * FROM sach";
    $sql .= " limit $offset, $productsPerPage";
    $res = get_data_query($sql);
    
    function build_body(){
        global $res;
        if (is_bool($res)) {
            number_products_found(0);
            return;
        }
        echo "<table align='center' width='1000' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";
        echo '<tr>
          <th width="20">STT</th>
          <th width="50">Mã sữa</th>
          <th width="250">Tên sữa</th>
          <th width="50">Trọng lượng</th>
        </tr>';
        foreach($res as $row){
            $stt = 1;
              echo "<tr>";
              echo "<td>$stt</td>";
              echo "<td>$row[0]</td>";
              echo "<td>$row[1]</td>";
              echo "<td>$row[2]</td>";
              echo "<td>$row[3]</td>";
              echo "<td>$row[4]</td>";
              echo "<td>$row[5]</td>";
              echo "<td>$row[6]</td>";
              echo "<td>$row[7]</td>";
              echo "</tr>";
              $stt += 1;
        }
        echo "</table>";
    }
    
    $res = mysqli_query($conn, 'select * from sach');
    //tổng số mẩu tin cần hiển thị
    $numRows = mysqli_num_rows($res);
    //tổng số trang
    // $maxPage = floor($numRows/$rowsPerPage) + 1;
    // echo "<p align='center' >Tong so trang la:" . $maxPage . "</p>";
    
    
    $maxPage = floor($numRows/$rowsPerPage) + 1;
    echo "<p align='center'>";
    //gắn thêm nút Back
    echo "<a href=" .$_SERVER['PHP_SELF']."?page=" . (1)."> << </a> "; 
    if ($_GET['page'] > 1)
        echo "<a href=" .$_SERVER['PHP_SELF']."?page=" . ($_GET['page']-1)."> < </a> "; 
    //gắn thêm nút đầu tiên
    
    //tạo link tương ứng tới các trang
    for ($i=1 ; $i<=$maxPage ; $i++) {
        if ($i == $_GET['page']) {
        echo '<b>'.$i.'</b> '; //trang hiện tại sẽ được bôi đậm
        }
        else echo "<a href=" .$_SERVER['PHP_SELF']. "?page=" .$i.">".$i."</a> ";
    }
    //gắn thêm nút Next
    if ($_GET['page'] < $maxPage)
        echo "<a href=". $_SERVER['PHP_SELF']."?page=".($_GET['page']+1)."> > </a>"; 
    echo "<a href=". $_SERVER['PHP_SELF']."?page=".($maxPage)."> >> </a>"; 
    echo "</p>";
?>

<section>
    <h1>This is page list product</h1>
    <form action="product_list.php" method="post" >
        <?php ?>
    </form>
</section>