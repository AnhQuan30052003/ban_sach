<!-- customer.php -->
<?php
$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'edit':
        $body = 'customer_edit.php';
        break;
    case 'delete':
        $body = 'customer_delete.php';
        break;
    default:
        $body = 'customer_list.php';
        break;
}

include '../../../components/layout_admin.php';
