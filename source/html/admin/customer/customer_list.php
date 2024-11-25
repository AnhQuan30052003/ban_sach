<?php
  $customerPerPage = 10;
  if (!isset($_GET["page"])) $_GET["page"] = 1;
  $offset = ($_GET["page"] - 1) * $customerPerPage;

  //cac bien luu tru tim kiem
  $search = isset($_GET["search"]) ? trim($_GET["search"]) : "";

  $sql = "
    select ma, ten, email, sdt, diaChi from `khach_hang`
  ";

  if ($search != "") {
    $sql .= " where ma like '%$search%' or ten like '%$search%' or email like '%$search%' or sdt like '%$search%' or diaChi like '%$search%'";
  }

  $sql .= " LIMIT $offset, $customerPerPage";

  $res = get_data_query($sql);
  save_or_to_index(true);

  function build_body() {
    global $res;
    if (is_bool($res)) return;

    echo "<table align='center' cellpadding='2' cellspacing='2'>";
    echo "
      <tr>
        <th>STT</th>
        <th>Mã khách hàng</th>
        <th>Tên khách hàng</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th style='text-align: center;'>Thao tác</th>
      </tr>
    ";

    $stt = 1;
    foreach ($res as $row) {
      echo "<tr>";
      echo "<td>$stt</td>";
      echo "<td>$row[0]</td>";
      echo "<td>$row[1]</td>";
      echo "<td>$row[2]</td>";
      echo "<td>$row[3]</td>";
      echo "<td>$row[4]</td>";
      echo "
        <td style='display: flex; justify-content: center; gap: 5px;'>
            <a class='btn btn-success mg-2 del-btn' href='?action=edit&id=$row[0]'>Sửa</a> 
            <a class='btn btn-danger mg-2 del-btn' href='?action=delete&id=$row[0]' onclick=\"return confirm('Bạn có chắc chắn muốn xóa?');\" >Xóa</a>
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

  table tr:not(:first-child):hover {
    color: var(--primary-color);
    background-color: #cccccc42;

    .link-detail {
      color: var(--primary-color);
    }
  }

  table tr:nth-child(1) {
    border-color: black;
    color: var(--primary-color);
  }

  table th {
    padding: 4px 0;
  }

  .link-detail {
    color: #757575;
    text-decoration: none;
  }

  .wrapper-search-add,
  #form-search {
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
    width: 20em;
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
  <h3>QUẢN LÝ KHÁCH HÀNG</h3>
  <hr>
  <div class="wrapper-search-add">
    <a class="btn btn-add" href="?action=create">Tạo mới</a>
    <form action="" method="GET" id="form-search">
      <input class="search-text" id="search-text" name="search" value="<?php echo $search ?? "" ?>" placeholder="Nhập mã/tên khách hàng để tìm kiếm">
      <?php
        if ($search != "") {
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

  show_number_page($res, $customerPerPage);
  ?>
</section>