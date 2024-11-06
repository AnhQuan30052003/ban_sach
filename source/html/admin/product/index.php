<!-- product.php -->
<?php
    $action = $_GET['action'] ?? 'list';

    switch ($action) {
        case 'list':
            $body = 'product_list.php';
            break;
        case 'edit':
            $body = 'product_edit.php';
            break;
        case 'delete':
            $body = 'product_delete.php';
            break;
        case 'create':
            $body = 'product_create.php';
            break;
        default:
            $body = 'product_list.php';
            break;
    }

    // Include layout và truyền file CRUD được chọn vào layout
    include_once '../../../components/layout_admin.php';
?>