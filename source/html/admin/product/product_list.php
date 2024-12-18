<?php
    $productsPerPage = 10;
    if (!isset($_GET["page"])) $_GET["page"] = 1;
    $offset = ($_GET["page"] - 1) * $productsPerPage;

	//cac bien luu tru tim kiem
    $loaiSach = isset($_GET["loai-sach"]) ? $_GET["loai-sach"] : "";
    $tacGia = isset($_GET["tac-gia"]) ? $_GET["tac-gia"] : "";
    $nhaXuatBan = isset($_GET["nha-xuat-ban"]) ? $_GET["nha-xuat-ban"] : "";
    $search = isset($_GET["search"]) ? trim($_GET["search"]) : "";

    $sql = "
        select s.maSach, tenSach, s.maLS, tenLS, s.maTG, tenTG, s.maNXB, tenNXB, giaTien
        from sach s join loai_sach ls on s.maLS = ls.maLS
            join tac_gia tg on tg.maTG = s.maTG
            join nha_xuat_ban nxb on nxb.maNXB = s.maNXB
    ";

    if ($search != "") {
        $sql .= " where s.maSach like '%$search%' or tenSach like '%$search%'";
    }
    else {
        $conditions = [];
        if ($loaiSach != "") $conditions[] = "s.maLS = '$loaiSach'";
        if ($tacGia != "") $conditions[] = "s.maTG = '$tacGia'";
        if ($nhaXuatBan != "") $conditions[] = "s.maNXB = '$nhaXuatBan'";

        if (count($conditions) > 0) $sql .= " WHERE " . implode("AND ", $conditions);
    }
    
    $sql .= " GROUP BY s.maSach, tenSach, s.maLS, tenLS, s.maTG, tenTG, s.maNXB, tenNXB, giaTien LIMIT $offset, $productsPerPage";

    $res = get_data_query($sql);
    save_or_to_index(true);

    function build_group_box($name, $nameFake, $typeCur, $sql) {
        $result = get_data_query($sql);
    
        echo "<select class='group-box' name='$name' id='$name' onchange='send()'>";
    
        if ($typeCur == "") echo "<option value='' selected>$nameFake</option>";
        else echo "<option value=''>$nameFake</option>";
    
        foreach ($result as $line) {
          if ($line[0] == $typeCur) echo "<option value='$line[0]' selected>$line[1]</option>";
          else echo "<option value='$line[0]'>$line[1]</option>";
        }
        
        echo "</select>";
    }

    function build_body() {
        global $res;
        if (is_bool($res)) return;
        echo "<table align='center' cellpadding='2' cellspacing='2' '>";
        echo "
            <tr>
                <th>STT</th>
                <th>Mã sách</th>
                <th width='350'>Tên sách</th>
                <th>Loại sách</th>
                <th>Tác giả</th>
                <th>Nhà xuất bản</th>
                <th>Giá tiền</th>
                <th style='text-align: center; width: 300px;'>Thao tác</th>
            </tr>
        ";

        $stt = 1;
        foreach ($res as $row) {
            $money = number_format($row[8], 0, ',', '.');

            echo "<tr>";
            echo "<td>$stt</td>";
            echo "<td>$row[0]</td>";
            echo "<td><a class='link-detail short-text-product-admin' title='Xem chi tiết' href='?action=detail&productId=$row[0]'>$row[1]</a></td>";
            echo "<td>$row[3]</td>";
            echo "<td>$row[5]</td>";
            echo "<td>$row[7]</td>";
            echo "<td>$money</td>";
            echo "
                <td style='display: flex; justify-content: center; gap: 5px;'>
                    <a class='btn btn-success mg-2 del-btn' href='?action=detail&productId=$row[0]' style='background-color: gray;'>Chi tiết</a> 
                    <a class='btn btn-success mg-2 del-btn' href='?action=edit&productId=$row[0]'>Sửa</a> 
                    <a class='btn btn-danger mg-2 del-btn' href='?action=delete&productId=$row[0]' onclick=\"return confirm('Bạn có chắc chắn muốn xóa?');\" >Xóa</a>
                </td>
            ";
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
        width: 100%;
    }

    table tr:not(:first-child):hover{
        color: var(--primary-color);
        background-color: #cccccc42;

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

    .wrapper-search-add, #form-search{
        display: flex;
        align-items: center;
        gap: 20px;
        margin: 20px 0;
    }
    .mg-2 {
        margin: 2px;
    }

    .search-text {
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

    .search-text:hover,
    .search-text:focus {
        border: 2px solid #4A9DEC;
        box-shadow: 0px 0px 0px 7px rgb(74, 157, 236, 20%);
        background-color: white;
    }

    select {
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
        font-size: 14px;
        background-color: #fff;
        margin-right: 10px;
        cursor: pointer;
    }

    select:hover {
        border-color: #888;
    }

    select:focus {
        border-color: #007BFF;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
</style>

<section class='display-content'>
    <h3 >QUẢN LÝ SÁCH</h3>
    <hr>

    <div class="wrapper-search-add">
        <a class="btn btn-add" href="?action=create">Tạo mới</a>
        <form action="" method="GET" id="form-search">
            <input class="search-text" id="search-text" name="search" value="<?php echo $search ?? "" ?>" placeholder="Nhập mã/tên sách để tìm kiếm">
            <div>
                <?php build_group_box("loai-sach", "Loại sách", $loaiSach, "select * from loai_sach"); ?>
                <?php build_group_box("tac-gia", "Tác giả", $tacGia, "select * from tac_gia"); ?>
                <?php build_group_box("nha-xuat-ban", "Nhà xuất bản", $nhaXuatBan, "select * from nha_xuat_ban"); ?>
            </div>

            <?php
                if ($loaiSach != "" || $tacGia != "" || $nhaXuatBan != "" || $search != "") {
                    $sql_count = cutString($sql, "LIMIT");
                    $result_count = count(get_data_query($sql_count));
                    echo "<span id='description' style='color: red;'>Tìm thấy $result_count kết quả</span>";
                }
            ?>
        </form>
    </div>

    <form action="" method="post">
		<?php build_body(); ?>
    </form>

    <?php
        $sql = cutString($sql, "LIMIT");
        $res = quick_query($sql);
    
        show_number_page($res, $productsPerPage);
    ?>
</section>