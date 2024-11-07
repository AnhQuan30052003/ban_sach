<?php
    $pathExit = "../../../";
    $pathComponents = $pathExit . "components";

    include_once "../../../database/helper/db.php";
    include_once $pathComponents . "/head.php";
    include_once $pathComponents . "/mod_paginate.php";
?>

<!DOCTYPE html>
<html lang="en">

<?php head("Page Admin"); ?>

<style>
    :root{
        --primary-color: #f95030;
        --primary-color-rgb: rgba(238, 75 , 43);
        --white-color: #fff;
        --black-color: #000;
        --text-color: #949494;
    }
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    li {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .ad-container .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        background-color: #f3f6f9;
        height: 100vh;
        width: 190px;
    }

    .sidebar .navbar-brand {
        display: block;
        padding: 5px 0;
        margin: 0 24px 16px;
        font-size: 24px;
    }

    .sidebar .navbar .nav-item .nav-link {
        padding: 7px 20px;
    }

    .sidebar .dropdown-menu .dropdown-item {
        display: block;
        padding: 7px 20px;
        text-decoration: none;
        font-size: 17px;
    }


    .content {
        margin-left: 190px;
        min-height: 100vh;
        background-color: #fff;
    }

    .content .navbar {
        background-color: #f3f6f9;
        position: sticky;
        display: flex;
        padding: 0 24px;
    }

    .sticky-top {
        position: sticky;
        top: 0;
        z-index: 999;
    }

    .navbar {
        padding: 8px 0;
    }


    .content .navbar-nav,
    .navbar-brand {
        display: flex;
        align-items: center;
    }

    .navbar-nav {
        margin-left: auto;
        gap: 20px;

    }

    .navbar .navbar-nav .nav-link i {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #FFFFFF;
        border-radius: 40px;
    }

    .navbar .navbar-nav .nav-link {
        padding: 12px 0;
        font-size: 18px;
        display: block;
        text-decoration: none;
        color: #333;
    }

    .navbar-expand {
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
    }

    .ad-footer {
        padding: 24px 24px 0 24px;
    }

    .footer-box {
        background-color: rgb(243, 246, 249);
        border-radius: 3px;
        padding: 24px;
    }

    .row {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        font-size: 17px;
    }

    .row .row-item {
        color: #757575;
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


    .btn-danger:hover {
        color: #fff;
        background-color: #c82333;
        border-color: #bd2130;
    }

    .btn.btn-add {
        color: #000;
        border: 2px solid var(--primary-color);
    }

    .btn.btn-add:hover{
        background-color: var(--primary-color);
        outline: none;
        color: var(--white-color);
    }
    section {
        padding: 24px;
    }
    h3 {
        padding: 10px 0;
        text-align: center;
    }
</style>

<body>
    <div class="ad-container">
        <div class="sidebar">
            <nav class="navbar">
                <a href="./index.php" class="navbar-brand">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>ADMIN</h3>
                </a>
                <div class="navbar-nav ">
                    <div class="nav-item ">
                        <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Quản lý</a>
                        <div class="dropdown-menu ">
                            <a href="../product/index.php" class="dropdown-item">Sách</a>
                            <a href="../customer/index.php" class="dropdown-item">Loại sách</a>
                            <a href="../customer/index.php" class="dropdown-item">Khách hàng</a>                            
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <div class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="#">
                            <i class="fa fa-user"></i>
                            <span style="margin-left: 5px;">Admin</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary" href='../../system/change_password.php'>
                            <i class='fa-solid fa-key'></i>
                            <span style="margin-left: 5px;">Đổi mật khẩu</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" onclick='logout(3);' href="#">
                            <i class="fa fa-sign-out-alt"></i>
                            <span>Đăng xuất</span>
                        </a>
                    </li>

                </div>
            </nav>
            <!-- Navbar End -->
            <?php include_once $body; ?>

            <!-- Footer Start -->
            <div class="ad-footer">
                <div class="footer-box">
                    <div class="row">
                        <div class="row-item">
                            &copy; <a href="#">Ecommerce website</a>, All Right Reserved.
                        </div>
                        <div class="row-item">
                            Designed By <a href="#">Tiến Quân</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script src='../../../assets/javascripts/mod_header.js'></script>
</body>
</html>