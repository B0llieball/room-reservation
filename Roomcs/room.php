<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Booking Form</title>
<script>
function confirmform() {
    return confirm("Are you sure you want to book this room?");
}
</script>
</head>

<body>
<?php
// ตรวจสอบว่าผู้ใช้ล็อกอินหรือยัง
if (!isset($_SESSION['userid'])) {
    header("Location: loginForm.php"); // ถ้ายังไม่ได้ล็อกอิน ให้กลับไปหน้า login
    exit;
}

// ถ้า POST มาจากแบบฟอร์มการจอง
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connectDB.php'; // เชื่อมต่อฐานข้อมูล

    $student_id = $_SESSION['student_id']; // ดึง ID ของผู้ใช้ที่ล็อกอิน
    $roomid = $_POST['roomsid']; // ห้องที่เลือกจากฟอร์ม
    $booking_date = $_POST['booking_date']; // วันที่จอง
	$start_time = $_POST['start_time'];
    $end_time = $_POST['end_time']; // เวลาที่จอง

    // SQL สำหรับเพิ่มข้อมูลการจองห้อง
    $sql = "INSERT INTO bookings (student_id, roomid, booking_date, start_time) VALUES ('$student_id', '$roomid', '$booking_date', '$start_time', '$end_time')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Room booked successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
</body>
</html>
