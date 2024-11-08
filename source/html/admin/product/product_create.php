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

	.btn-choose-file {
		padding: 2px 4px;
	}
</style>

<?php
	// truy van loai san pham cho comboBox
	$sql_ls = "SELECT s.maLS, l.tenLS FROM sach AS s JOIN loai_sach AS l ON s.maLS = l.maLS group by s.maLS";
	$res = get_data_query($sql_ls);

	// truy van maSP lon nhat
	$sql_max_id = "SELECT maSach FROM `sach` ORDER BY maSach DESC LIMIT 1";
	$res_max_id = get_data_query($sql_max_id);

	if (isset($_POST['submit'])) {
		$productId = $_POST["productId"] ?? "";
		$productName = $_POST["productName"] ?? "";
		$categoryId = $_POST["category"] ?? "";
		$author = $_POST["author"] ?? "";
		$quantity = $_POST["quantity"] ?? 0;
		$productDes = $_POST["productDes"] ?? "";
		$price = $_POST["price"] ?? 0;
		$img = $_POST["productImg"] ?? "";

		// truy van them sp
		$sql = "INSERT INTO `sach` (maSach, tenSach, maLS, moTa, giaTien, soLuong, tacGia, hinhAnh)
					VALUES ('$productId', '$productName', '$categoryId', '$productDes', $price, $quantity, '$author', '$img')";

		$result = quick_query($sql);

		if ($result) {
			echo "<script>alert('Thêm sách thành công')</script>";
		} else {
			echo "<script>alert('Thêm sách thất bại' . $result)</script>";
		}
	}
?>

<section>
	<h3>THÊM SÁCH</h3>
	<hr>

	<form action="?action=create" method="post" class="form-container" enctype="multipart/form-data">
		<div>
			<label for="productId" class="form-label">Mã sách</label>
			<input required type="text" id="productId" name="productId" class="form-input">
		</div>

		<div>
			<label for="productName" class="form-label">Tên sách</label>
			<input required type="text" name="productName" class="form-input">
		</div>

		<div>
			<label for="category" class="form-label">Phân loại</label>
			<select name="category" class="form-select">
				<?php
				foreach ($res as $line) {
					echo "<option value='{$line['maLS']}'> {$line['tenLS']} </option>";
				}
				?>
			</select>
		</div>

		<div>
			<label for="author" class="form-label">Tác giả</label>
			<input required type="text" name="author" id="" class="form-input">
		</div>

		<div>
			<label for="quantity" class="form-label">Số lượng</label>
			<input required type="number" min="1" value="1" name="quantity" class="form-input">
		</div>

		<div>
			<label for="price" class="form-label">Giá</label>
			<input required type="number" min="0" name="price" class="form-input">
		</div>

        <div>
            <label for="description" class="form-label">Mô tả</label>
            <div class="editor-container">
                <textarea rows="5" name="productDes" id=""></textarea>
            </div>
        </div>

		<div>
			<label for="" class="form-label">Hình ảnh</label>
			<input required type="text" name="productImg" id="productImg" class="form-input" disabled>
			<span>
				<button type='button' id='choose'>Chọn</button>
				<input type="file" id='get-file' name='get-file' style='display: none;'>
			</span>
		</div>

        <div class="btn-group" style="margin-top: 10px">
            <div>
                <a href="index.php" class="btn btn-back">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span >Quay lại</span>
                </a>
            </div>
            <div>
                <input required type="submit" name="submit" value="Thêm" class="btn btn-success" />
            </div>
        </div>
    </form>
</section>

<script>
	const inputText = document.getElementById("productImg");
	const buttonChoose = document.getElementById("choose");
	const inputFile = document.getElementById("get-file");

	buttonChoose.addEventListener("click", function() {
		getFile.click();
	});

	inputFile.addEventListener("change", function() {
		if (inputFile.value != "") {
			inputText.value = inputFile.files[0].name;
		}
	});
</script>