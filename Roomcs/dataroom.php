<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ปฏิทินการจองห้อง</title>

    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.css' rel='stylesheet' />

    <!-- jQuery Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>

</head>

<body>
<?php
include "connectDB.php"; // เชื่อมต่อฐานข้อมูล

$bookings = array(); // สร้าง array สำหรับเก็บข้อมูลการจอง

if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id'];

    // ดึงข้อมูลจากฐานข้อมูล
    $sql = "SELECT student_id, roomid, booking_date, booking_time, phone_number FROM bookings WHERE student_id='$student_id'"; // เพิ่ม booking_time
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // นำข้อมูลแต่ละรายการไปใส่ใน array $bookings
            $bookings[] = array(
                'title' => 'ห้อง ' . $row['roomid'] . ' รหัสนักศึกษา: ' . $row['student_id']. ' เวลา: ' . $row['booking_time'], // แก้ไข
                'start' => $row['booking_date'], // วันที่และเวลาที่จอง
                'description' => 'Phone: ' . $row['phone_number']
            );
        }
    }
}

$conn->close();

// ส่งข้อมูล JSON
echo '<script type="text/javascript">';
echo 'var eventsData = ' . json_encode($bookings) . ';';
echo '</script>';
?>

<div id='calendar'></div>

<script>
$(document).ready(function() {
    // สร้างปฏิทิน
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: eventsData, // ใช้ข้อมูลการจองที่ได้จาก PHP
        eventClick: function(info) {
            alert('Room: ' + info.event.title + '\n' + info.event.extendedProps.description);
        }
    });

    calendar.render(); // แสดงปฏิทิน
});
</script>

</body>
</html>
