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
	$id = $_GET['typeId'];
	$sql = "SELECT * FROM loai_sach WHERE maLS = $id";
	$res = get_data_query($sql);
	$type = $res[0];

	function update() {
		$typeId = $_POST["typeId"];
		$typeName = $_POST["typeName"];


		// truy van them sp
		$sql = "
			UPDATE `loai_sach` 	
			SET maLS='$typeId',
				tenLS='$typeName'
			WHERE maLS='$typeId'
			";

		quick_query($sql);

		$link = save_or_to_index(false);
		echo "
			<script>
				localStorage.removeItem('form-typeOfProduct-create');
				alert('Cập nhật loại sách thành công');
				window.location.href = '$link';
			</script>
		";
	}

	if (isset($_POST['submit'])) update();
?>

<section class="display-content" >
	<h3>CẬP NHẬT LOẠI SÁCH</h3>
	<hr>
	<form action="" method="post" class="form-container form-validate form-typeOfProduct-create" quantity='1'>
		<div>
			<label for="typeId" class="form-label">Mã loại sách</label>
			<input type="text" readonly style="background-color: #ccc;" id="typeId" name="typeId" value="<?php echo $id; ?>" class="form-input">
		</div>

		<div class='validate'>
			<label for="typeName" class="form-label">Tên loại sách</label>
			<input required id='typeName' type="text" id="typeName" name="typeName" class="form-input is-empty is-character listener" card='Tên loại sách' status='true' value="<?php echo $type['tenLS'] ?? "" ?>" class="form-input">
			<span class='error'></span>
		</div>

		<div class="btn-group" style="margin-top: 10px">
			<div>
				<button type="button" onclick="window.location.href= '<?php echo save_or_to_index(false); ?>'" class="btn btn-back">
					<i class="fa-solid fa-arrow-left"></i>
					<span>Quay lại</span>
				</button>
			</div>
			
			<div class="col-md-offset-2 col-md-10">
				<input required type="submit" name="submit" value="Cập nhật" class="btn btn-success btn-validate" />
			</div>
		</div>
	</form>
</section>