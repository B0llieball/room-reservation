<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการการสมัครสมาชิก</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #FFF4B5; /* สีพื้นหลัง */
            font-family: Arial, sans-serif;
        }
        #mainContent {
            margin: 20px auto;
            background-color: #C4D7FF; /* สีพื้นของ div */
            padding: 20px;
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: #3F3F3F; /* สีตัวอักษร */
        }
        .btn-custom {
            background-color: #87A2FF; /* สีพื้นของปุ่ม */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 5px;
        }
        .btn-custom:hover {
            background-color: #6A94E4; /* สีเมื่อชี้เมาส์ */
        }
        .header {
            background-color: #87A2FF; /* สีพื้นของ header */
            padding: 10px 0;
            text-align: center;
        }
        .logo {
            width: 150px; /* ขนาดโลโก้ */
        }
    </style>
    <script type="text/javascript">
        function goToPage(page) {
            window.location.href = "index.php?fn=" + page;
        }
    </script>
</head>
<body>
<!-- Header Section -->
<div class="header">
    <img src="images/header.jpg" alt="Logo" width="1000%" height="200" class="logo">
</div>

<div id="mainContent" class="container">
    <h1>จัดการการสมัครสมาชิก</h1>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info text-center" role="alert">
                <?php
                if (!empty($_SESSION['student_id'])) {
                    echo "ยินดีต้อนรับ: " . htmlspecialchars($_SESSION['student_id']);
                    echo ' <a href="index.php?fn=logout" style="color:red;">logout</a>';
                } else {
                    $_SESSION['status'] = 3; // Set status to 3 if not logged in
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
        <button class="btn btn-custom" onClick="window.location.href='index.php'">หน้าหลัก</button>
        </div>
        <div class="col">
            <button class="btn btn-custom" onClick="goToPage('regisForm')">สมัครสมาชิก</button>
        </div>
        <div class="col">
            <button class="btn btn-custom" onClick="goToPage('loginForm')">เข้าสู่ระบบ</button>
        </div>
        <?php if ($_SESSION['status'] == 1 || $_SESSION['status'] == 2): ?>
            <div class="col">
                <button class="btn btn-custom" onClick="goToPage('roomForm')">ข้อมูลห้อง</button>
            </div>
            <div class="col">
                <button class="btn btn-custom" onClick="goToPage('dataroom')">ข้อมูลการจอง</button>
            </div>
        <?php elseif ($_SESSION['status'] == 0): ?>
            <div class="col">
                <button class="btn btn-custom" onClick="goToPage('dataroomadmin')">ข้อมูลการจอง</button>
            </div>
            <div class="col">
                <button class="btn btn-custom" onClick="goToPage('roomadmin')">ข้อมูลห้อง</button>
            </div>
            <div class="col">
                <button class="btn btn-custom" onClick="goToPage('useradmin')">ข้อมูลผู้ใช้</button>
            </div>
        <?php endif; ?>
    </div>
    <div class="row mt-4">
        <div class="col">
            <?php
            if (!empty($_GET['fn'])) {
                $fn = $_GET['fn'];
                include $fn . ".php";
            } else {
                echo "ตารางการจองห้องเรียน";
            }
            ?>
        </div>
    </div>
</div>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
