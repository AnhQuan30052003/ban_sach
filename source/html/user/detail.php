<?php
	$pathExit = "../../";
	$pathComponents = $pathExit . "components";

	include_once "../../database/helper/db.php";
	include_once $pathComponents . "/head.php";

	$productId = $_GET['id'];
	$sql = "
		select s.maSach, tenSach, moTa, s.maLS, tenLS, s.maTG, tenTG, s.maNXB, tenNXB, giaTien, soLuong, soTrang, hinhAnh
		from sach s join loai_sach ls on s.maLS = ls.maLS
			join tac_gia tg on tg.maTG = s.maTG
			join nha_xuat_ban nxb on nxb.maNXB = s.maNXB
		where s.maSach = '$productId'
	";

	$res = get_data_query($sql);
	$product = $res[0];
?>

<?php head("Detail book", "../../");?>

<style>
	.to-cart {
		width: 100%;
		height: 0;
		display: flex;
		overflow: hidden;
		transition: 0.4s;
		.space {
			width: 30%;
			background-color: white;
		}

		.number {
			padding: 5px 7px;
			width: 70%;
			display: flex;
			justify-content: space-between;
			align-items: center;
			gap: 10px;
			input {
				outline: none;
				width: 50px;
				text-align: center;
			}

			button.btn-in-de {
				width: 30px;
				text-align: center;
				background-color: white;
				border: solid 0.1px;
				outline: none;
			}

			button.btn-to-cart {
				padding: 7px 10px;
				background-color: red;
				color: white;
				border: none;
				outline: none;
				cursor: pointer;
				border-radius: 5px;

				&:hover {
					opacity: 0.7;
				}
			}
		}
	}
	body {
		background-color: #f7f7f7;
	}

	hr {
		margin: 10px 0;
	}

	.row-detail {
		display: flex;
		flex-wrap: wrap;
		margin-left: -4px;
		margin-right: -4px;
	}

	.row>* {
		padding: 0 12px;
	}

	.col-4 {
		flex: 0 0 33.33333%;
		max-width: 33.33333%;
	}

	.col-8 {
		flex: 0 0 66.66667%;
		max-width: 66.66667%;
	}

	.col-12 {
		flex: 0 0 100%;
		max-width: 100%;
	}

	.text-center {
		text-align: center;
	}

	.text-primary {
		font-size: 18px;
		color: var(--primary-color);
	}

	.w-100 {
		width: 100%;
	}

	.h-auto {
		height: auto;
	}


	table {
		border-collapse: collapse;
		width: 100%;
	}

	table tr td {
		border: 1px solid #ccc;
		padding: 5px;
		font-size: 17px;
	}

	tr td.text-dark {
		width: 120px;
	}

	table td:nth-child(2) {
		color: #757575;
	}

	.btn-group {
		display: flex;
		gap: 10px;
		justify-content: end;
	}

	.btn {
		display: inline-block;
		font-weight: 400;
		text-align: center;
		white-space: nowrap;
		vertical-align: middle;
		font-size: 16px;
		line-height: 1.5;
		padding: 6px 12px;
		border-radius: 4px;
		text-decoration: none;
		cursor: pointer;
	}

	.btn.btn-success {
		color: #fff;
		background-color: #28a745;
		border-color: #28a745;
	}
	.btn-success:hover {
		color: #fff;
		background-color: #218838;
		border-color: #1e7e34;
	}

	.btn.btn-danger{
		color: #fff;
		background-color: #dc3545;
		border-color: #dc3545;
	}

	.btn.btn-back{
		display: flex;
		width: 100px;
		align-items: center;
		justify-content: center;
		background-color: #eeeeee4b;
		transition: all 0.2s linear;
		background: #fff;
		border: 1px solid var(--black-color);
	}

	.btn.btn-back:active{
		background-color: #eeeeee4b;
	}

	.btn.btn-back > .fa-arrow-left {
		margin-right: 5px;
		margin-left: 5px;
		font-size: 15px;
		transition: all 0.4s ease-in;
	}

	.btn.btn-back:hover > .fa-arrow-left {
		transform: translateX(-5px);
	}
</style>

<div class="row-deltail display-content" style="padding: 24px; margin: 10px auto; border: solid 1px; width: 900px; background-color: white;">
	<div class="col-12">
		<h3 class="text-center mt-3" style='margin-bottom: 10px;'>Thông tin chi tiết</h3>
	</div>

	<div class="col-12">
		<div class="row">
			<div class="col-4">
				<h6 class="text-center text-primary">Ảnh sách</h6>
				<hr />
				<img class="w-100 h-auto" src='<?php echo '../../assets/images/products/' . $product['hinhAnh'] ?>' />
			</div>

			<div class="col-8">
				<h6 class="text-center text-primary">Thông tin sách</h6>
				<hr />
				<table class="table table-bordered">
					<tr>
						<td class="text-dark">Tên sách</td>
						<td> <?php echo $product['tenSach'] ?> </td>
					</tr>

					<tr>
						<td class="text-dark">Loại sách</td>
						<td><?php echo $product['tenLS'] ?></td>
					</tr>

					<tr>
						<td class="text-dark">Tác giả</td>
						<td><?php echo $product['tenTG'] ?></td>
					</tr>

					<tr>
						<td class="text-dark">Nhà xuất bản</td>
						<td><?php echo $product['tenNXB'] ?></td>
					</tr>

					<tr>
						<td class="text-dark">Giá tiền</td>
						<td><?php echo number_format($product['giaTien'], 0, ',', '.') . " VNĐ"; ?></td>
					</tr>

					<tr>
						<td class="text-dark">Số lượng</td>
						<td><?php echo $product['soLuong'] ?></td>
					</tr>

					<tr>
						<td class="text-dark">Số trang</td>
						<td><?php echo $product['soTrang'] ?></td>
					</tr>

					<tr>
						<td class="text-dark">Mô tả</td>
						<td><?php echo $product['moTa'] ?></td>
					</tr>

					<tr>
						<td class="text-dark">Phi ship</td>
						<td><?php echo number_format(7000, 0, ".", ".") . " VNĐ"; ?></td>
					</tr>
				</table>

				<div class='to-cart'>
            <div class='space'></div>

            <div class='number'>
              <span>Số lượng: </span> 
              <span class='frame'>
                <button class='btn-in-de btn-de' type='button'>-</button>
                <input class='quantity-add' name='quantity-add' type='text' readonly value='1'>
                <button class='btn-in-de btn-in' type='button'>+</button>
              </span>
              <button class='btn-to-cart' type='button' data-id='$line[0]'>Mua ngay</button>
            </div>
          </div>

				<div class="btn-group" style="margin-top: 10px">
					<a href="javascript:history.back(-1);" class="btn btn-back" style='color: black;'>
						<i class="fa-solid fa-arrow-left"></i>
						<span>Quay lại</span>
					</a>
					<button class='btn btn-success m-2 del-btn' onclick='show_hidden_mua_ngay();' style='outline: none; border: none;'>Mua</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function show_hidden_mua_ngay() {
		const toCart = document.querySelector(".to-cart");
		toCart.classList.toggle("height-auto");
	}

	const btnDe = document.querySelectorAll(".btn-de");
  btnDe.forEach((item) => {
    item.addEventListener("click", function() {
      const quantity = this.closest(".frame").querySelector(".quantity-add");
      if (parseInt(quantity.value) > 1) {
        quantity.value = parseInt(quantity.value) - 1;
      }
    });
  });

  const btnIn = document.querySelectorAll(".btn-in");
  btnIn.forEach((item) => {
    item.addEventListener("click", function() {
      const quantity = this.closest(".frame").querySelector(".quantity-add");
      if (parseInt(quantity.value) < <?php echo $product['soLuong']; ?>) {
        quantity.value = parseInt(quantity.value) + 1;
      }
    });
  });
</script>