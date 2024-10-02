<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลการจอง</title>
</head>

<body>
<?php
// ตรวจสอบว่ามีการเชื่อมต่อฐานข้อมูล
include "connectDB.php"; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบสถานะผู้ใช้
if (isset($_SESSION['status']) && $_SESSION['status'] == 0) { // ถ้าเป็นแอดมิน
    // ดึงข้อมูลการจองจากฐานข้อมูล
    $sql = "SELECT student_id, roomid, booking_date, phone_number FROM bookings"; // ดึงข้อมูลทั้งหมด
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<form id="form1" name="form1" method="post" action="index.php?fn=dataroomadmin">';
        echo '<table width="1197" border="1" align="center">';
        echo '<tr>
                <td>รหัสนักศึกษา</td>
                <td>เลขที่ห้อง</td>
                <td>วันที่จอง</td>
                <td>เวลาที่จอง</td>
                <td>เบอร์โทร</td>
                <td>จัดการ</td> <!-- เพิ่มคอลัมน์สำหรับจัดการ -->
              </tr>';
        
        while ($a = $result->fetch_assoc()) { // ดึงข้อมูลแต่ละแถว
            echo '<tr>
                    <td>' . $a['student_id'] . '</td>
                    <td>' . $a['roomid'] . '</td>
                    <td>' . $a['booking_date'] . '</td>
                    <td>' . $a['booking_date'] . '</td>
                    <td>' . $a['phone_number'] . '</td>
                    <td>
                        <button onclick="editBooking(' . $a['student_id'] . ')">แก้ไข</button>
                        <button onclick="deleteBooking(' . $a['student_id'] . ')">ลบ</button>
                    </td>
                  </tr>';
        }
        
        echo '</table>';
        echo '</form>';
        
        // ปุ่มสำหรับเพิ่มข้อมูล
    } else {
        echo "ไม่พบข้อมูลการจอง";
    }
} else {
    echo "คุณไม่มีสิทธิ์เข้าถึงหน้านี้";
}

$conn->close();
?>

<script>
function editBooking(studentId) {
    // เขียนโค้ดเพื่อแก้ไขข้อมูลการจอง
    window.location.href = 'roomEdit.php?student_id=' + studentId;
}

function deleteBooking(studentId) {
    // เขียนโค้ดเพื่อยืนยันการลบข้อมูลการจอง
    if (confirm('คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้?')) {
        window.location.href = 'roomDel.php?student_id=' + studentId; // ลิงก์ไปยังหน้าลบข้อมูล
    }
}

function addBooking() {
    // เขียนโค้ดสำหรับการเพิ่มข้อมูลการจอง
    window.location.href = 'roomAddadmin.php'; 
	window.location.href = 'useradmin.php';// ลิงก์ไปยังหน้าสำหรับเพิ่มข้อมูล
}
</script>
</body>
</html>
