<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ตรวจสอบสถานะผู้ใช้
if (!isset($_SESSION['status']) || $_SESSION['status'] != 0) {
    echo "คุณไม่มีสิทธิ์เข้าถึงหน้านี้";
    exit;
}

// เชื่อมต่อฐานข้อมูล
include "connectDB.php";

// ตรวจสอบว่ามีข้อมูลที่ส่งมาหรือไม่
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // คำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM bookings WHERE student_id='$student_id'";

    if ($conn->query($sql) === TRUE) {
        echo "ลบข้อมูลสำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }
} else {
    echo "ข้อมูลไม่ถูกต้อง";
}

$conn->close();
?>

</body>
</html>
