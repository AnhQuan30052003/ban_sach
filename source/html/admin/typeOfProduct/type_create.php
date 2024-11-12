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
	$idBook = get_id_laster("select maLS from loai_sach group by maLS order by maLS desc limit 1");

	function save(string $id) {
		$typeId = $id;
		$typeName = $_POST["typeName"] ?? "";
		
		$sql = "
			INSERT INTO `loai_sach` (maLs, tenLS)
			VALUES ('$typeId', '$typeName')
		";

		$result = quick_query($sql);

		if ($result) {
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

<section class="display-content" >
	<h3>THÊM SÁCH</h3>
	<hr>

	<form action="?action=create" method="post" class="form-container" enctype="multipart/form-data">
		<div>
			<label for="typeId" class="form-label">Mã sách</label>
			<input required type="text" id="typeId" name="typeId" class="form-input" value="<?php echo $idBook; ?>" disabled>
		</div>

		<div>
			<label for="typeName" class="form-label">Tên sách</label>
			<input required type="text" name="typeName" class="form-input" value="<?php echo $_POST['typeName'] ?? ''; ?>">
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
