<style>
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-left: -4px;
        margin-right: -4px;
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
</style>
<?php
    if(isset($_GET['action']) && $_GET['action'] === 'detail')
?>
<div class="row" style="padding: 0 24px">
    <div class="col-12">
        <h3 class="text-center mt-3">Thông tin chi tiết</h3>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-4">
                <h6 class="text-center text-primary">Ảnh sản phẩm</h6>
                <hr />
                <img class="w-100 h-auto" src="" />
            </div>
            <div class="col-8">
                <h6 class="text-center text-primary">Thông tin sản phẩm</h6>
                <hr />
                <table class="table table-bordered">
                    <tr>
                        <td class="text-dark">Tên sách</td>
                        <td>@Html.DisplayFor(model => model.product_name)</td>
                    </tr>

                    <tr>
                        <td class="text-dark">Phân loại</td>
                        <td>@Html.DisplayFor(model => model.Category.name)</td>
                    </tr>

                    <tr>
                        <td class="text-dark">Giá tiền</td>
                        <td>@Model.price.ToString("#,##0")</td>
                    </tr>

                    <tr>
                        <td class="text-dark">Số lượng</td>
                        <td>@Html.DisplayFor(model => model.qty_in_stock)</td>
                    </tr>

                    <tr>
                        <td class="text-dark">Mô tả</td>
                        <td>@Html.Raw(Model.description)</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div style="text-align: right; padding: 0 24px">
    <a href=""></a>
    <a href=""></a>
</div>