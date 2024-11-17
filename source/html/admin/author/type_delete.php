<?php
	// ob_start();
	if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['typeId'])) {
		$typeId = $_GET['typeId'];
		$sql = "DELETE FROM `tac_gia` WHERE maTG = $typeId";
		$res = quick_query($sql);

		$linkBack = save_or_to_index(false);

		if ($res) {
			echo "<script>alert('Xóa thành công!'); window.location.href = '$linkBack';</script>";
		} else {
			echo "<script>alert('Không thể xóa sản phẩm!'); window.location.href = '$linkBack';</script>";
		}
}
