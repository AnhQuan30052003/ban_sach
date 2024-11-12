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
		$author = $_POST["author"] ?? "";
		$quantity = $_POST["quantity"] ?? 1;
		$productDes = $_POST["productDes"] ?? "";
		$price = $_POST["price"] ?? 0;
		$img = $_FILES["get-file"];
		
		if ($img["name"] == "") {
			echo "<script>alert('Bạn chưa chọn ảnh !')</script>";
			return;
		}
		
		# Kiểm tra xem ảnh có thoả không ?
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

<section class='display-content'>
	<h3>THÊM SÁCH</h3>
	<hr>

	<form action="?action=create" method="post" class="form-container" enctype="multipart/form-data">
		<div>
			<label for="productId" class="form-label">Mã sách</label>
			<input required type="text" id="productId" name="productId" class="form-input" value="<?php echo $idBook; ?>" readonly style='background-color: #ccc'>
		</div>

		<div>
			<label for="productName" class="form-label">Tên sách</label>
			<input required type="text" name="productName" class="form-input" value="<?php echo $_POST['productName'] ?? ''; ?>">
			<span class="error-message" id="productNameError"></span>
		</div>

		<div>
			<label for="category" class="form-label">Loại sách</label>
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
		console.log(123);
	});

	inputFile.addEventListener("change", function() {
		console.log(123);
		if (inputFile.value != "") {
			inputText.value = inputFile.files[0].name;
		}
	});

	// Validation
    // function showError(inputId, message) {
    //     document.getElementById(inputId + "Error").innerText = message;
    // }

    // // Hàm ẩn thông báo lỗi
    // function hideError(inputId) {
    //     document.getElementById(inputId + "Error").innerText = "";
    // }

    // // Kiểm tra Tên sách
    // document.querySelector("input[name='productName']").addEventListener("input", function () {
    //     const productName = this.value.trim();
    //     if (productName === "") {
    //         showError("productName", "Tên sách không được để trống.");
    //     }
	// 	else if(length(productName) <= 5){
	// 		showError("productName", "Số lượng kí tự phải lớn hơn 5");
	// 	}
	// 	else {
    //         hideError("productName");
    //     }
    // });

    // // Kiểm tra Tác giả
    // document.querySelector("input[name='author']").addEventListener("input", function () {
    //     const author = this.value.trim();
    //     if (author === "") {
    //         showError("author", "Tên tác giả không được để trống.");
    //     } else {
    //         hideError("author");
    //     }
    // });

    // // Kiểm tra Số lượng
    // document.querySelector("input[name='quantity']").addEventListener("input", function () {
    //     const quantity = this.value;
    //     if (isNaN(quantity) || quantity <= 0) {
    //         showError("quantity", "Số lượng phải là số dương.");
    //     } else {
    //         hideError("quantity");
    //     }
    // });

    // // Kiểm tra Giá
    // document.querySelector("input[name='price']").addEventListener("input", function () {
    //     const price = this.value;
    //     if (isNaN(price) || price < 0) {
    //         showError("price", "Giá phải là số không âm.");
    //     } else {
    //         hideError("price");
    //     }
    // });

    // // Kiểm tra Mô tả
    // document.querySelector("textarea[name='productDes']").addEventListener("input", function () {
    //     const description = this.value.trim();
    //     if (description === "") {
    //         showError("productDes", "Mô tả không được để trống.");
    //     } else {
    //         hideError("productDes");
    //     }
    // });
</script>