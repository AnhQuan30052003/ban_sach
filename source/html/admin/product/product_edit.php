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
	// truy van chi tiet san pham theo id
	$id = $_GET['productId'];
	$sql = "SELECT s.*, l.tenLS FROM sach AS s JOIN loai_sach AS l ON s.maLS = l.maLS WHERE s.maSach = $id";
	$res = get_data_query($sql);
	$product = $res[0];

	function update() {
		global $product;
		$productId = $_POST["productId"];
		$productName = $_POST["productName"];
		$categoryId = $_POST["category"];
		$author = $_POST["author"];
		$quantity = $_POST["quantity"];
		$productDes = $_POST["productDes"];
		$price = $_POST["price"];
		$img = $_FILES["get-file"];
		$imgSave = null;

		if ($img["name"] != "") {
			$result = check_image($img);

			if (strlen($result) > 0) {
				echo "<script>alert('$result')</script>";
				return;
			}

			$imgSave = $img;
			$img = $img["name"];
		}
		else {
			$img = $product["hinhAnh"];
		}

		// truy van them sp
		$sql = "
			UPDATE `sach` 	
			SET tenSach='$productName',
				maLS='$categoryId',
				moTa='$productDes',
				giaTien= $price,
				soLuong= $quantity,
				tacGia='$author',
				hinhAnh='$img' 
			WHERE maSach='$productId'
		";
		
			$result = quick_query($sql);

		if ($result) {
			if ($imgSave != null) {
				save_file($imgSave);
			}

			$link = save_or_to_index(false);
			
			echo "
				<script>
					alert('Cập nhật sách thành công');
					window.location.href = '$link';
				</script>
			";
		}
		else {
			echo "<script>alert('Cập nhật sách thất bại' . $result)</script>";
		}
	}

	if (isset($_POST['submit'])) update();
?>

<section class='display-content'>
	<h3>CẬP NHẬT SÁCH</h3>
	<hr>
	<form action="" method="post" class="form-container" enctype="multipart/form-data">
		<div>
			<label for="productId" class="form-label">Mã sản phẩm</label>
			<input type="text" readonly style="background-color: #ccc;" id="productId" name="productId" value="<?php echo $id; ?>" class="form-input">
		</div>

		<div>
			<label for="productName" class="form-label">Tên sản phẩm</label>
			<input required type="text" id="productName" name="productName" value="<?php echo $product['tenSach'] ?? "" ?>" class="form-input">
		</div>

		<div>
			<label for="category" class="form-label">Phân loại</label>
			<select name="category" id="category" class="form-select">
				<?php
					$sql_ls = "SELECT s.maLS, l.tenLS FROM sach AS s JOIN loai_sach AS l ON s.maLS = l.maLS group by s.maLS";
					$res_ls = get_data_query($sql_ls);

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
			<input required type="number" id="price" min="0" name="price" value="<?php echo $product['giaTien'] ?>" class="form-input">
		</div>

		<div>
			<label for="description" class="form-label">Mô tả</label>
			<div class="editor-container">
				<textarea rows="5" name="productDes" id=""><?php echo $product['moTa'] ?? ""; ?></textarea>
			</div>
		</div>

		<div>
			<label for="productImg" class="form-label">Hình ảnh</label>
			<input required type="text" name="productImg" value="<?php echo $product['hinhAnh'] ?>" id="productImg" class="form-input" disabled>
			<div style="margin-top: 12px" >
                <button id='choose' >
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
				<button type="button" onclick="window.location.href= '<?php echo save_or_to_index(false); ?>'" class="btn btn-back">
					<i class="fa-solid fa-arrow-left"></i>
					<span>Quay lại</span>
				</button>
			</div>
			
			<div class="col-md-offset-2 col-md-10">
				<input required type="submit" name="submit" value="Cập nhật" class="btn btn-success" />
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
			console.log(inputFile);
		}
	});
</script>
