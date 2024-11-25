<style>
	.form-container {
		max-width: 800px;
		margin: 0 auto;
		padding: 20px;
		font-family: Arial, sans-serif;

    .frame-eyes {
			position: absolute;
			top: 40px;
			right: -35px;

			:hover {
				cursor: pointer;
			}
		}
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
	$idCustomer = get_id_laster("select ma from `khach_hang` group by ma order by ma desc limit 1");

	function register(string $id) {
		$customerId = $id;
		$customerName = $_POST["customerName"] ?? "";
		$phoneNumber = $_POST["phoneNumber"] ?? "";
		$email = $_POST["email"] ?? "";
		$password = $_POST["password"] ?? "";
		$address = $_POST["address"] ?? "";

		$sql = "select * from `khach_hang` where email = '$email'";
    $result = get_data_query($sql);
    if (count($result) > 0) {
      echo "
				<script>
					localStorage.setItem('failData', 'form-customer-create');
					alert('Email đã được đăng ký !');
				</script>
			";
      return;
    }

		$password = md5($password);
    $sql = "insert into `khach_hang` values ('$customerId', '$customerName', '$email', '$phoneNumber', '$password', '$address');";
    quick_query($sql);

		$link = save_or_to_index(false);
    echo "
      <script>
        localStorage.removeItem('failData');
        alert('Tạo mới tài khoản khách hàng thành công');
				window.location.href = '$link';
      </script>
    ";
	}

	if (isset($_POST['submit'])) register($idCustomer);
?>

<section class='display-content'>
	<h3>THÊM KHÁCH HÀNG</h3>
	<hr>

	<form action="?action=create" method="post" class="form-container form-validate form-customer-create" quantity='5'>
		<div>
			<label for="customerId" class="form-label">Mã khách hàng</label>
			<input required type="text" id="customerId" name="customerId" class="form-input" value="<?php echo $idCustomer; ?>" readonly style='background-color: #ccc'>
		</div>

		<div class='validate'>
			<label for="customerName" class="form-label">Họ và tên</label>
			<input required type="text" name="customerName" id="customerName" class="form-input listener is-empty is-character" card='Họ và tên' status='false' value="<?php echo $_POST['customerName'] ?? ''; ?>">
			<span class="error"></span>
		</div>

		<div class='validate'>
			<label for="phoneNumber" class="form-label">Số điện thoại</label>
			<input required type="text" name="phoneNumber" id="phoneNumber" class="form-input listener is-empty is-phone-number" card='Số điện thoại' status='false' value="<?php echo $_POST['phoneNumber'] ?? ''; ?>">
			<span class="error"></span>
		</div>

		<div class='validate'>
			<label for="email" class="form-label">Email</label>
			<input required type="email" id="email" name="email" class="form-input listener is-empty is-email" card='Email' status='false' value="<?php echo $_POST['email'] ?? '' ?>">
			<span class="error"></span>
		</div>

		<div class='validate' style='position: relative;'>
			<label for="password" class="form-label">Mật khẩu</label>
			<input required type="password" name="password" id="password" class="form-input listener is-empty correct-password" card='Mật khẩu' status='false' value="<?php echo $_POST['password'] ?? ''; ?>">
			<span class="error"></span>
      <span class='frame-eyes'>
        <i class="fa-solid fa-eye-slash"></i>
      </span>
		</div>

    <div class='validate'>
			<label for="address" class="form-label">Đại chỉ</label>
			<input required type="address" name="address" id="address" class="form-input listener is-empty positive-number" card='Địa chỉ' status='false' value="<?php echo $_POST['address'] ?? ''; ?>">
			<span class="error"></span>
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