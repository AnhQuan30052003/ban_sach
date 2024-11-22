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

	#choose {
		border: none;
		display: flex;
		padding: 0.75rem 1rem;
		background-color: #488aec;
		color: #ffffff;
		font-size: 0.75rem;
		line-height: 1rem;
		font-weight: 700;
		text-align: center;
		cursor: pointer;
		text-transform: uppercase;
		vertical-align: middle;
		align-items: center;
		border-radius: 0.5rem;
		user-select: none;
		gap: 0.5rem;
		box-shadow:
			0 4px 6px -1px #488aec31,
			0 2px 4px -1px #488aec17;
		transition: all 0.6s ease;
	}

	#choose:hover {
	box-shadow:
		0 10px 15px -3px #488aec4f,
		0 4px 6px -2px #488aec17;
	}

	#choose:focus,
	#choose:active {
	opacity: 0.85;
	box-shadow: none;
	}

	#choose svg {
	width: 1.25rem;
	height: 1.25rem;
	}
</style>

<?php
	// lấy id sách mới
	$idBook = get_id_laster("select maSach from sach group by maSach order by maSach desc limit 1");

	function save(string $id) {
		$productId = $id;
		$productName = $_POST["productName"] ?? "";
		$categoryId = $_POST["category"] ?? "";
		$nhaXuatBan = $_POST["nhaXuatBan"] ?? "";
		$author = $_POST["author"] ?? "";
		$quantity = $_POST["quantity"] ?? "";
		$pageNumber = $_POST["pageNumber"] ?? "";
		$productDes = $_POST["productDes"] ?? "";
		$price = $_POST["price"] ?? "";
		$img = $_FILES["get-file"];
		
		if ($img["name"] == "") {
			echo "
				<script>
					localStorage.setItem('failData', 'form-product-create');
					alert('Bạn chưa chọn ảnh !')
				</script>
			";
			return;
		}
		
		# Kiểm tra xem ảnh có thoả không ?
		$result = check_image($img);
		
		if (strlen($result) > 0) {
			echo "
				<script>
					localStorage.setItem('failData', 'form-product-create');
					alert('$result');
				</script>
			";
			return;
		}

		// truy van them sp
		$imgTemp = $img['name'];
		$sql = "
			INSERT INTO `sach` VALUES
			('$productId', '$productName', '$categoryId', '$productDes', $price, $quantity, $pageNumber, '$author', '$nhaXuatBan', '$imgTemp')
		";

		$result = quick_query($sql);

		if ($result) {
			save_file($img);

			$link = save_or_to_index(false);
			echo "
				<script>
					localStorage.removeItem('failData');
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

<section class='display-content'>
	<h3>THÊM SÁCH</h3>
	<hr>

	<form action="?action=create" method="post" class="form-container form-validate form-product-create" quantity='6' enctype="multipart/form-data">
		<div>
			<label for="productId" class="form-label">Mã sách</label>
			<input required type="text" id="productId" name="productId" class="form-input" value="<?php echo $idBook; ?>" readonly style='background-color: #ccc'>
		</div>

		<div class='validate'>
			<label for="productName" class="form-label">Tên sách</label>
			<input required type="text" name="productName" id="productName" class="form-input listener is-empty is-character" card='Tên sách' status='false' value="<?php echo $_POST['productName'] ?? ''; ?>">
			<span class="error"></span>
		</div>

		<div>
			<label for="category" class="form-label">Loại sách</label>
			<select name="category" id="category" class="form-select">
				<?php
					$sql_ls = "select * from loai_sach";
					$res_ls = get_data_query($sql_ls);

					foreach ($res_ls as $line) {
						$selected = ($line['0'] == $product['maLS']) ? 'selected' : '';
						echo "<option value='{$line['0']}' $selected> {$line['1']} </option>";
					}
				?>
			</select>
		</div>

		<div>
			<label for="category" class="form-label">Nhà xuất bản</label>
			<select name="nhaXuatBan" id="nhaXuatBan" class="form-select">
				<?php
					$sql_ls = "select * from nha_xuat_ban";
					$res_ls = get_data_query($sql_ls);

					foreach ($res_ls as $line) {
						$selected = ($line['0'] == $product['maNXB']) ? 'selected' : '';
						echo "<option value='{$line['0']}' $selected> {$line['1']} </option>";
					}
				?>
			</select>
		</div>

		<div>
			<label for="category" class="form-label">Tác giả</label>
			<select name="author" id="author" class="form-select">
				<?php
					$sql_ls = "select * from tac_gia";
					$res_ls = get_data_query($sql_ls);

					foreach ($res_ls as $line) {
						$selected = ($line['0'] == $product['maTG']) ? 'selected' : '';
						echo "<option value='{$line['0']}' $selected> {$line['1']} </option>";
					}
				?>
			</select>
		</div>

		<div class='validate'>
			<label for="quantity" class="form-label">Số lượng</label>
			<input required type="number" min="1" name="quantity" id="quantity" class="form-input listener is-empty positive-number" card='Số lượng' status='false' value="<?php echo $_POST['quantity'] ?? ''; ?>">
			<span class="error"></span>
		</div>

		<div class='validate'>
			<label for="pageNumber" class="form-label">Số trang</label>
			<input required type="number" id="pageNumber" min="1" name="pageNumber" class="form-input listener is-empty positive-number" card='Số trang' status='false' value="<?php echo $_POST['pageNumber'] ?? '' ?>">
			<span class="error"></span>
		</div>

		<div class='validate'>
			<label for="price" class="form-label">Giá</label>
			<input required type="number" min="0" name="price" id="price" class="form-input listener is-empty positive-number" card='Giá' status='false' value="<?php echo $_POST['price'] ?? ''; ?>">
			<span class="error"></span>
		</div>

		<div class='validate'>
			<label for="description" class="form-label">Mô tả</label>
			<div class="editor-container">
				<textarea class='listener is-empty is-character' card='Mô tả' status='false' rows="5" name="productDes" id="des" style='padding: 3px 5px;'><?php echo $_POST['productDes'] ?? ""; ?></textarea>
			</div>
			<span class="error"></span>
		</div>

		<div class='validate'>
			<label for="" class="form-label">Hình ảnh</label>
			<input card='Hình ảnh' status='false' type="text" name="productImg" id="productImg" class="form-input is-empty listener" readonly style='background-color: #ccc'>
			<span class="error"></span>
			<div style="margin-top: 12px" >
				<button id='choose' type="button">
					<svg
						aria-hidden="true"
						stroke="currentColor"
						stroke-width="2"
						viewBox="0 0 24 24"
						fill="none"
						xmlns="http://www.w3.org/2000/svg">
						<path
						stroke-width="2"
						stroke="#fffffff"
						d="M13.5 3H12H8C6.34315 3 5 4.34315 5 6V18C5 19.6569 6.34315 21 8 21H11M13.5 3L19 8.625M13.5 3V7.625C13.5 8.17728 13.9477 8.625 14.5 8.625H19M19 8.625V11.8125"
						stroke-linejoin="round"
						stroke-linecap="round"
						></path>
						<path
						stroke-linejoin="round"
						stroke-linecap="round"
						stroke-width="2"
						stroke="#fffffff"
						d="M17 15V18M17 21V18M17 18H14M17 18H20"
						></path>
					</svg>
					Chọn
				</button>
				<input type="file" id='get-file' name='get-file' style='display: none;'>
			</div>
		</div>

		<div class="btn-group" style="margin-top: 10px">
			<div>
				<a href="<?php echo save_or_to_index(false); ?>" class="btn btn-back">
					<i class="fa-solid fa-arrow-left"></i>
					<span>Quay lại</span>
				</a>
			</div>
			<div>
				<input required type="submit" name="submit" value="Thêm" class="btn btn-success btn-validate not-allowed"  disabled/>
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
			inputText.dispatchEvent(new Event("keyup"));
		}
	});
</script>