<?php
    // ob_start();
    if(isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['productId'])){
        $productId = $_GET['productId'] ?? "";
        $sql = "DELETE FROM `sach` WHERE maSach = $productId";
        $res = quick_query($sql);

        if($res){
            echo "<script>alert('Xóa thành công!'); window.location.href = 'index.php';</script>";
        }
        else{
            echo "<script>alert('Không thể xóa sản phẩm!'); window.location.href = 'index.php'</script>";
        }
    }
?>
