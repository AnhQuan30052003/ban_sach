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
	$id = $_GET['id'];
	$sql = "select * from khach_hang where ma = '$id'";
	$res = get_data_query($sql);
	$customer = $res[0];

	function update() {
		global $id;

		$customerId = $_POST["customerId"];
		$customerName = $_POST["customerName"];
		$email = $_POST["email"];
		$phoneNumber = $_POST["phoneNumber"];
		$password = $_POST["password"];
		$address = $_POST["address"];

		// Kiểm tra email có hay chưa ?
		$sql = "select ma from `khach_hang` where email = '$email'";
    $result = get_data_query($sql);
    if (count($result) > 0) {
			if ($result[0]["ma"] != $customerId) {
				echo "
				<script>
				localStorage.setItem('failData', 'form-customer-edit');
				alert('Email đã được đăng ký !');
				</script>
				";
				return;
			}
    }

		// truy van them sp
		$sql = "
			UPDATE `khach_hang` 	
			SET ten = '$customerName',
				matKhau = '$password',
				sdt = '$phoneNumber',
				email ='$email',
				diaChi ='$address'
			WHERE ma ='$customerId'
			";

		quick_query($sql);

		$link = save_or_to_index(false);

		echo "
			<script>
				localStorage.removeItem('failData');
				alert('Cập nhật khách hàng thành công');
				window.location.href = '$link';
			</script>
		";

	}

	if (isset($_POST['submit'])) update();
?>

<section>
	<h3>CẬP NHẬT KHÁCH HÀNG</h3>
	<hr>

	<form action="" method="post" class="form-container form-validate form-customer-edit" quantity='4'>
		<div>
			<label for="customerId" class="form-label">Mã khách hàng</label>
			<input type="text" readonly style="background-color: #ccc;" id="customerId" name="customerId" value="<?php echo $id; ?>" class="form-input">
		</div>

		<div class='validate'>
			<label for="customerName" class="form-label">Tên khách hàng</label>
			<input required type="text" id="customerName" name="customerName" value="<?php echo $customer['ten']; ?>" class="form-input listener is-empty is-character" card='Tên khách hàng' status='true'>
			<span class='error'></span>
		</div>

		<div class='validate'>
			<label for="email" class="form-label">Email</label>
			<input required type="email" name="email" id="email" value="<?php echo $customer['email']; ?>" class="form-input listener is-email is-empty" card='Email' status='true'>
			<span class='error'></span>
		</div>

		<div class='validate'>
			<label for="phoneNumber" class="form-label">Số điện thoại</label>
			<input required type="text" id="phoneNumber" name="phoneNumber" value="<?php echo $customer['sdt']; ?>" class="form-input listener is-empty is-phone-number" card='Số điện thoại' status='true'>
			<span class='error'></span>
		</div>

		<div>
			<label for="password" class="form-label">Mật khẩu</label>
			<input readonly style='background-color: #ccc;' type="text" id="password" name="password" value="<?php echo $customer['matKhau'];  ?>" class="form-input">
		</div>

		<div class='validate'>
			<label for="address" class="form-label">Địa chỉ</label>
			<input required type="text" id="address" name="address" value="<?php echo $customer['diaChi']; ?>" class="form-input is-empty listener" card='Địa chỉ' status='true'>
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