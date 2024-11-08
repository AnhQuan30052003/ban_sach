<?php
    $productsPerPage = 10;
    if (!isset($_GET["page"])) $_GET["page"] = 1;
    $offset = ($_GET["page"] - 1) * $productsPerPage;

    $sql = "SELECT s.maSach, s.tenSach, s.tacGia, s.soLuong, s.giaTien , l.tenLS FROM sach AS s JOIN loai_sach AS l ON s.maLS = l.maLS 
        LIMIT $offset, $productsPerPage";

    $res = get_data_query($sql);

    function build_body() {
        global $res;
        if (is_bool($res)) {
            number_products_found(0);
            return;
        }
        echo "<table align='center' cellpadding='2' cellspacing='2' '>";
        echo '<tr>
            <th width="10">STT</th>
            <th width="50">Mã sách</th>
            <th width="150">Tên sách</th>
            <th width="50">Loại sách</th>
            <th width="50">Tác giả</th>
            <th width="50">Số lượng</th>
            <th width="50">Giá tiền</th>
            <th width="50">Thao tác</th>
            </tr>';
        $stt = 1;
        foreach ($res as $row) {
            echo "<tr>";
            echo "<td>$stt</td>";
            echo "<td>$row[0]</td>";
            echo "<td><a class='link-detail' title='Xem chi tiết' href=''>$row[1]</a></td>";
            echo "<td>{$row['tenLS']}</td>";
            echo "<td>$row[2]</td>";
            echo "<td>$row[3]</td>";
            echo "<td>$row[4]</td>";
            // echo "<td>
            //     <a class='btn btn-success m-2 del-btn' href='?action=edit&productId=$row[0]'>Sửa</a> 
            //     <button class='btn btn-danger m-2 del-btn' data-productID='$row[0]'>Xóa</button>
            // </td>";
            echo "<td>
                <a class='btn btn-success m-2 del-btn' href='?action=edit&productId=$row[0]'>Sửa</a> 
                <a class='btn btn-danger m-2 del-btn' href='?action=delete&productId=$row[0]' onclick=\"return confirm('Bạn có chắc chắn muốn xóa?');\" >Xóa</a>
            </td>";
            echo "</tr>";
            $stt++;
        }
        echo "</table>";
    }


?>

<style>
    table {
        font-size: 15px;
        font-family: Arial, Helvetica, sans-serif;
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        color: var(--text-color);
    }

    table tr {
        border-bottom: 1px solid #ccc;
    }

    table tr:not(:first-child):hover{
        color: var(--primary-color);
        background-color: #ccc;

        .link-detail{
            color: var(--primary-color);
        }
    }

    table tr:nth-child(1){
        border-color: black;
        color: var(--primary-color);
    }

    table th{
        padding: 4px 0;
    }
    
    .link-detail {
        color: #757575;
        text-decoration: none;
    }

    .wrap-search-add{
        display: flex;
        align-items: center;
        gap: 20px;
        margin: 20px 0;
    }
    .m-2 {
        margin: 2px;
    }

    .input {
        border: 2px solid transparent;
        width: 17em;
        height: 2.7em;
        padding-left: 0.8em;
        outline: none;
        overflow: hidden;
        background-color: #F3F3F3;
        border-radius: 10px;
        transition: all 0.5s;
    }

    .input:hover,
    .input:focus {
    border: 2px solid #4A9DEC;
    box-shadow: 0px 0px 0px 7px rgb(74, 157, 236, 20%);
    background-color: white;
    }
</style>
<section style='min-height: 600px;'>
    <h3 >QUẢN LÝ SẢN PHẨM</h3><hr>
    <div class="wrap-search-add">
        <a class="btn btn-add" href="?action=create">Tạo mới</a>
        <input class="input" name="name_search" type="search" placeholder="Nhập tên sản phẩm để tìm kiếm" >
    </div>
    <form action="" method="post">
        <?php build_body(); ?>
    </form>

    <?php
        $sql = "select * from sach";
        $res = quick_query($sql);
    
        show_number_page($res, $productsPerPage);
    ?>
</section>