<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
 //step 1
    include "connectDB.php";
	//get data
	$roomid = $_POST['roomid'];
	$booking_date = $_POST['booking_date'];
	$booking_time = $_POST['booking_time'];
	$full_name = $_POST['full_name'];
	$phone_number = $_POST['phone_number'];
	$student_id = $_POST['student_id'];
// บันทึกข้อมูลลงฐานข้อมูล
	$sql = "INSERT INTO bookings (roomid, booking_date, booking_time, full_name,phone_number,student_id)
        VALUES ('$roomid', '$booking_date', '$booking_time', '$full_name','$phone_number','$student_id')";

if ($conn->query($sql) === TRUE) {
    echo "การจองสำเร็จ";
} else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
}

	mysqli_query($conn,$sql);
	mysqli_close($conn);
?>
<meta http-equiv="refresh" content="3;index.php?fn=room" />
</body>
</html>
