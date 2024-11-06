<?php
    $productsPerPage = 10;
    if (!isset($_GET["page"])) $_GET["page"] = 1;
    $offset = ($_GET["page"] - 1) * $productsPerPage;

    $sql = "select * from sach limit $offset, $productsPerPage";
    $res = get_data_query($sql);

    function build_body() {
        global $res;
        if (is_bool($res)) {
            number_products_found(0);
            return;
        }
        echo "<table align='center' width='1000' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";
        echo '<tr>
            <th width="20">STT</th>
            <th width="50">Mã sách</th>
            <th width="250">Tên sách</th>
            <th width="50">Mã loại sách</th>
            </tr>';
        foreach ($res as $row) {
            $stt = 1;
            echo "<tr>";
            echo "<td>$stt</td>";
            echo "<td>$row[0]</td>";
            echo "<td>$row[1]</td>";
            echo "<td>$row[2]</td>";
            echo "<td>$row[3]</td>";
            // echo "<td>$row[4]</td>";
            // echo "<td>$row[5]</td>";
            // echo "<td>$row[6]</td>";
            // echo "<td>$row[7]</td>";
            echo "</tr>";
            $stt += 1;
        }
        echo "</table>";
    }


?>

<style>
    section {
        padding: 24px;
    }
</style>

<section style='min-height: 600px;'>
    <h1>SÁCH</h1>
    <form action="product_list.php" method="post">
        <?php build_body(); ?>
    </form>

    <?php
        $sql = "select * from sach";
        $res = quick_query($sql);
    
        show_number_page($res, $productsPerPage);
    ?>
</section>