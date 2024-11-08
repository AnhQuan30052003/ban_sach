<style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-weight: bold;
        margin: 15px 0 5px;
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }

    textarea {
        width: 100%;
    }
</style>

<?php

    // truy van loai san pham cho comboBox
    $sql_ls = "SELECT s.maLS, l.tenLS FROM sach AS s JOIN loai_sach AS l ON s.maLS = l.maLS group by s.maLS";
    $res_ls = get_data_query($sql_ls);
    
    // truy van chi tiet san pham theo id
    if(isset($_GET['productId'])){
        $id = $_GET['productId'];
        $sql = "SELECT s.*, l.tenLS FROM sach AS s JOIN loai_sach AS l ON s.maLS = l.maLS WHERE s.maSach = $id";
        $res = get_data_query($sql);
        if($res){
            $product = $res[0];
        }
    }

    if (isset($_POST['submit'])) {
        $productId = $_POST["productId"];
        $productName = $_POST["productName"];
        $categoryId = $_POST["category"];
        $author = $_POST["author"];
        $quantity = $_POST["quantity"];
        $productDes = $_POST["productDes"];
        $price = $_POST["price"];
        $img = $_POST["productImg"];


        // truy van them sp
        $sql = "UPDATE `sach` 
                SET tenSach='$productName',
                    maLS='$categoryId',
                    moTa='$productDes',
                    giaTien= $price,
                    soLuong= $quantity,
                    tacGia='$author',
                    hinhAnh='$img' 
                WHERE maSach='$productId'"; 
        // echo "<pre>$sql</pre>"; 
        $result = quick_query($sql);

        if ($result) {
            echo "<script>alert('Cập nhật sản phẩm thành công')</script>";
            // Truy vấn lại dữ liệu vừa cập nhật
            $sql = "SELECT * FROM sach WHERE maSach = '$productId'";
            $res = get_data_query($sql);
            if ($res) {
                $product = $res[0]; 
            }
            } else {
                echo "<script>alert('Cập nhật phẩm thất bại' . $result)</script>";
            }
    }
?>

<section>
    <h3>CẬP NHẬT SẢN PHẨM</h3>
    <hr>
    <form action="" method="post" class="form-container">
        <div>
            <label for="productId" class="form-label">Mã sản phẩm</label>
            <input type="text" readonly style="background-color: #ccc;" id="productId" name="productId" value="<?php echo $product['maSach'] ?? $productId; ?>" class="form-input" >
        </div>

        <div>
            <label for="productName" class="form-label">Tên sản phẩm</label>
            <input required type="text" id="productName" name="productName" value="<?php echo $product['tenSach'] ?? "" ?>" class="form-input">
        </div>

        <div>
            <label for="category" class="form-label">Phân loại</label>
            <select name="category" id="category" class="form-select">
                <?php
                foreach ($res_ls as $line) {
                    $selected = ($line['maLS'] == $product['maLS']) ? 'selected' : '';
                    echo "<option value='{$line['maLS']}' $selected> {$line['tenLS']} </option>";
                }
                ?>
            </select>
        </div>

        <div>
            <label for="author" class="form-label">Tác giả</label>
            <input required type="text" name="author" id="author" value="<?php echo $product['tacGia'] ?? "" ?>" class="form-input">
        </div>

        <div>
            <label for="quantity" class="form-label">Số lượng</label>
            <input required type="number" id="quantity" name="quantity" value="<?php echo $product['soLuong'] ?? $quantity ?>" class="form-input">
        </div>

        <div>
            <label for="price" class="form-label">Giá</label>
            <input required type="number" id="price" min="0" name="price" value="<?php echo $product['giaTien'] ?>"  class="form-input">
        </div>

        <div>
            <label for="description" class="form-label">Mô tả</label>
            <div class="editor-container">
                <textarea rows="5" name="productDes" id=""><?php echo $product['moTa'] ?></textarea>
            </div>
        </div>

        <!-- <div>
            <label for="" class="form-label" >Hình ảnh</label>
            <input required type="file" name="" id="" accept="image/*" required >
        </div> -->
        <div >
            <label for="productImg"  class="form-label">Hình ảnh</label>
            <input required type="text" name="productImg" value="<?php echo $product['hinhAnh'] ?>" id="productImg" class="form-input" required>
        </div>

        <div class="btn-group" style="margin-top: 10px">
            <div class="col-md-offset-2 col-md-10">
                <input required type="submit" name="submit" value="Cập nhật" class="btn btn-success" />
            </div>
            <div>
                <button onclick="window.history.back()" class="btn btn-back">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span >Quay lại</span>
                </button>
            </div>
        </div>
    </form>
</section>