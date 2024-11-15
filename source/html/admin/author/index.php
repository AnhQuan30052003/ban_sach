<?php
$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'create':
        $body = 'type_create.php';
        break;
    case 'edit':
        $body = 'type_edit.php';
        break;
    case 'delete':
        $body = 'type_delete.php';
        break;
    default:
        $body = 'type_list.php';
        break;
}

include '../../../components/layout_admin.php';
