<?php
	if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
		$customerId = $_GET['id'];
		$sql = "DELETE FROM `khach_hang` WHERE ma = '$customerId'";
		$res = quick_query($sql);

		$linkBack = save_or_to_index(false);

		if ($res) {
			echo "<script>alert('Xóa thành công!'); window.location.href = '$linkBack';</script>";
		} else {
			echo "<script>alert('Không thể xóa sản phẩm!'); window.location.href = '$linkBack';</script>";
		}
}
