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
	// lấy id sách mới
	$idBook = get_id_laster("select maSach from sach group by maSach order by maSach desc limit 1");

	function save(string $id) {
		$productId = $id;
		$productName = $_POST["productName"] ?? "";
		$categoryId = $_POST["category"] ?? "";
		$author = $_POST["author"] ?? "";
		$quantity = $_POST["quantity"] ?? 1;
		$productDes = $_POST["productDes"] ?? "";
		$price = $_POST["price"] ?? 0;
		$img = $_POST["productImg"] ?? "";
		
		if (strlen($img) == 0) {
			echo "<script>alert('Bạn chưa chọn ảnh !')</script>";
			return;
		}
		
		# Kiểm tra xem ảnh có thoả không ?
		$img = $_FILES["get-file"];
		$result = check_image($img);
		
		if (strlen($result) > 0) {
			echo "<script>alert('$result')</script>";
			return;
		}

		// truy van them sp
		$imgTemp = $img['name'];
		$sql = "
			INSERT INTO `sach` (maSach, tenSach, maLS, moTa, giaTien, soLuong, tacGia, hinhAnh)
			VALUES ('$productId', '$productName', '$categoryId', '$productDes', $price, $quantity, '$author', '$imgTemp')
		";

		$result = quick_query($sql);

		if ($result) {
			save_file($img);
			$link = save_or_to_index(false);
			echo "
				<script>
					alert('Thêm sách thành công');
					window.location.href = '$link';
				</script>
			";
		} else {
			echo "<script>alert('Thêm sách thất bại' . $result)</script>";
		}
	}

	if (isset($_POST['submit'])) save($idBook);
?>

<section>
	<h3>THÊM SÁCH</h3>
	<hr>

	<form action="?action=create" method="post" class="form-container" enctype="multipart/form-data">
		<div>
			<label for="productId" class="form-label">Mã sách</label>
			<input required type="text" id="productId" name="productId" class="form-input" value="<?php echo $idBook; ?>" disabled>
		</div>

		<div>
			<label for="productName" class="form-label">Tên sản phẩm</label>
			<input required type="text" name="productName" class="form-input" value="<?php echo $_POST['productName'] ?? ''; ?>">
		</div>

		<div>
			<label for="category" class="form-label">Phân loại</label>
			<select name="category" class="form-select">
				<?php
					$sql_ls = "SELECT s.maLS, l.tenLS FROM sach AS s JOIN loai_sach AS l ON s.maLS = l.maLS group by s.maLS";
					$res = get_data_query($sql_ls);

					foreach ($res as $line) {
						echo "<option value='{$line['maLS']}'> {$line['tenLS']} </option>";
					}
				?>
			</select>
		</div>

		<div>
			<label for="author" class="form-label">Tác giả</label>
			<input required type="text" name="author" id="" class="form-input" value="<?php echo $_POST['author'] ?? ''; ?>">
		</div>

		<div>
			<label for="quantity" class="form-label">Số lượng</label>
			<input required type="number" min="1" value="1" name="quantity" class="form-input" value="<?php echo $_POST['quantity'] ?? ''; ?>">
		</div>

		<div>
			<label for="price" class="form-label">Giá</label>
			<input required type="number" min="0" name="price" class="form-input" value="<?php echo $_POST['price'] ?? ''; ?>">
		</div>

		<div>
			<label for="description" class="form-label">Mô tả</label>
			<div class="editor-container">
				<textarea rows="5" name="productDes" id=""><?php echo $_POST['productDes'] ?? ""; ?></textarea>
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
				<a href="<?php echo save_or_to_index(false); ?>" class="btn btn-back">
					<i class="fa-solid fa-arrow-left"></i>
					<span>Quay lại</span>
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
		inputFile.click();
	});

	inputFile.addEventListener("change", function() {
		if (inputFile.value != "") {
			inputText.value = inputFile.files[0].name;
		}
	});
</script>