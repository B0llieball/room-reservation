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

// ตรวจสอบว่าได้ส่ง student_id มา
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // ดึงข้อมูลจากฐานข้อมูล
    $sql = "SELECT student_id, roomid, booking_date, phone_number FROM bookings WHERE student_id='$student_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
    } else {
        echo "ไม่พบข้อมูลการจอง";
        exit;
    }
} else {
    echo "ข้อมูลไม่ถูกต้อง";
    exit;
}

$conn->close();
?>
<body>
<form method="post" action="roomUpdate.php">
    <input type="hidden" name="student_id" value="<?php echo $booking['student_id']; ?>">
    <label>เลขที่ห้อง:</label> 
    <input type="text" name="roomid" value="<?php echo $booking['roomid']; ?>" required>
    <br>
    <label>วันที่จอง:</label>
    <input type="date" name="booking_date" value="<?php echo $booking['booking_date']; ?>" required>
    <br>
    <label>เบอร์โทร:</label>
    <input type="text" name="phone_number" value="<?php echo $booking['phone_number']; ?>" required>
    <br>
    <input type="submit" value="อัปเดตข้อมูล">
</form>
</body>
</html>

