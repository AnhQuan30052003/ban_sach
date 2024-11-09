<?php
    $productsPerPage = 10;
    if (!isset($_GET["page"])) $_GET["page"] = 1;
    $offset = ($_GET["page"] - 1) * $productsPerPage;
	//cac bien luu tru tim kiem
    $search = isset($_GET["search"]) ? trim($_GET["search"]) : "";

    $sql = "SELECT * FROM `loai_sach`";
    
    if ($search !== "") {
        $sql .= " maLS LIKE '%$search%' OR tenLS LIKE '%$search%'";
    }

    $sql .= " LIMIT $offset, $productsPerPage";

    $res = get_data_query($sql);
    save_or_to_index(true);

    function build_body() {
        global $res;
        if (is_bool($res)) return;
        echo "<table align='center' cellpadding='2' cellspacing='2' '>";
        echo "
            <tr>
                <th>STT</th>
                <th>Mã loại sách</th>
                <th>Tên loại sách</th>
                <th style='text-align: center;'>Thao tác</th>
            </tr>
        ";

        $stt = 1;
        foreach ($res as $row) {
            echo "<tr>";
            echo "<td>$stt</td>";
            echo "<td>$row[0]</td>";
            echo "<td>$row[1]</td>";
            echo "
                <td style='display: flex; justify-content: center; gap: 5px;'>
                    <a class='btn btn-success m-2 del-btn' href='?action=edit&typeId=$row[0]'>Sửa</a> 
                    <a class='btn btn-danger m-2 del-btn' href='?action=delete&typeId=$row[0]' onclick=\"return confirm('Bạn có chắc chắn muốn xóa?');\" >Xóa</a>
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

    .wrapper-search-add, #form-search{
        display: flex;
        align-items: center;
        gap: 20px;
        margin: 20px 0;
    }
    .m-2 {
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

<section class='dislay-content' style='min-height: 600px;'>
    <h3 >QUẢN LÝ LOẠI SÁCH</h3><hr>
    <div class="wrapper-search-add">
        <a class="btn btn-add" href="?action=create">Tạo mới</a>
        <form action="" method="GET" id="form-search">
            <input class="search-text" id="search-text" name="search" value="<?php echo $search ?? "" ?>" placeholder="Nhập mã/tên loại sách để tìm kiếm">
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