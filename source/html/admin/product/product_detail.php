<style>
    hr{
        margin: 10px 0;
    }
    .row-detail {
        display: flex;
        flex-wrap: wrap;
        margin-left: -4px;
        margin-right: -4px;
    }

    .row>*{
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

    .text-center{
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
    table td{
        border: 1px solid #ccc;
        padding: 5px;
        font-size: 17px;
    }
    
    table td:nth-child(2){
        color: #757575;
    }

</style>

<?php
    if(isset($_GET['action']) && $_GET['action'] === 'detail'){
        $productId = $_GET['productId'];
        $sql = "SELECT * FROM `sach` WHERE maSach = '$productId' ";
        $res = get_data_query($sql);
        $product = $res[0];
    }
?>

<div class="row-deltail" style="padding: 0 24px">
    <div class="col-12">
        <h3 class="text-center mt-3">Thông tin chi tiết</h3>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-4">
                <h6 class="text-center text-primary">Ảnh sách</h6>
                <hr />
                <img class="w-100 h-auto" src= <?php echo '../../../assets/images/products/'.$product['hinhAnh'] ?> />
            </div>
            <div class="col-8">
                <h6 class="text-center text-primary">Thông tin sách</h6>
                <hr />
                <table class="table table-bordered">
                    <tr>
                        <td class="text-dark">Mã sách</td>
                        <td> <?php echo $product['maSach'] ?> </td>
                    </tr>

                    <tr>
                        <td class="text-dark">Tên sách</td>
                        <td> <?php echo $product['tenSach'] ?> </td>
                    </tr>

                    <tr>
                        <td class="text-dark">Mã loại sách</td>
                        <td><?php echo $product['maLS'] ?></td>
                    </tr>

                    <tr>
                        <td class="text-dark">Tác giả</td>
                        <td><?php echo $product['tacGia'] ?></td>
                    </tr>

                    <tr>
                        <td class="text-dark">Giá tiền</td>
                        <td><?php echo number_format($product['giaTien'], 0, ',', '.') ?></td>
                    </tr>

                    <tr>
                        <td class="text-dark">Số lượng</td>
                        <td><?php echo $product['soLuong'] ?></td>
                    </tr>

                    <tr>
                        <td class="text-dark">Mô tả</td>
                        <td><?php echo $product['moTa'] ?></td>
                    </tr>
                </table>

                <div class="btn-group" style="margin-top: 10px">
                    <a onclick="window.location.href = '<?php echo save_or_to_index(false); ?>'"  class="btn btn-back">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span >Quay lại</span>
                    </a>
                    <a class='btn btn-success m-2 del-btn' href="<?php echo "?action=edit&productId=$productId" ?>" >Chỉnh sửa</a> 
                </div>
            </div>
        </div>
    </div>
</div>
