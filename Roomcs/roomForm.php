<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Room Booking</title>
<style>
    .room-container {
        margin: 20px;
    }
    .room-img {
        width: 300px;
        height: 200px;
    }
    .book-btn {
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }
    .booking-form {
        margin: 20px 0;
        display: none;
    }
    .form-label {
        display: block;
        margin-top: 10px;
    }
    .submit-btn {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }
</style>
<script>
function showBookingForm() {
    document.getElementById("bookingForm").style.display = "block";
}

function confirmBooking() {
    alert("Your booking is confirmed!");
    window.location.href = "index.php"; // หลังจากการจองเสร็จสิ้น จะกลับไปยังหน้าแรก
}
</script>
</head>

<body>
ห
<!-- รูปห้องที่จะแสดง -->
<div class="room-container"><br />
  <table width="200" border="1">
      <tr>
        <td><img src="images/room.png" alt="Room Image" width="1748" height="1240" class="room-img" />
			<div style="text-align: center;">
				<button class="book-btn" onclick="showBookingForm()">จองห้องนี้</button>
		</div>		</td>
        <td align="center"><img src="images/room.png" alt="Room Image" width="1748" height="1240" class="room-img" />
			<div style="text-align: center;">
				<button class="book-btn" onclick="showBookingForm()">จองห้องนี้</button>
		</div>		</td>
		<td><img src="images/room.png" alt="Room Image" width="1748" height="1240" class="room-img" />
			<div style="text-align: center;">
				<button class="book-btn" onclick="showBookingForm()">จองห้องนี้</button>
		</div>		</td>
		<td><img src="images/room.png" alt="Room Image" width="1748" height="1240" class="room-img" />
			<div style="text-align: center;">
				<button class="book-btn" onclick="showBookingForm()">จองห้องนี้</button>
		</div>		</td>
	  </tr>
  </table>
  <!-- ฟอร์มกรอกข้อมูลการจองห้อง -->
</div>

<div id="roomForm" class="room-form">
    <h2>กรอกข้อมูลการจองห้อง</h2>
    <form method="POST" action="index.php?fn=roomAdd">
        <label for="room">ห้องเรียน:</label>
        <select id="roomid" name="roomid">
            <option value="">เลือก</option>
            <option value="48201">ห้อง 48201</option>
            <option value="48202">ห้อง 48202</option>
            <option value="48203">ห้อง 48203</option>
            <option value="48204">ห้อง 48204</option>
            <option value="48206">ห้อง 48206</option>
        </select>
        <br>

        <label for="date">วันที่จอง:</label>
        <input type="date" id="date" name="booking_date" required>
        <br>

        <label for="time">เวลาที่จอง:</label>
        <select id="booking_time" name="booking_time">
            <option value="">โปรดเลือก</option>
            <option value="08:00 - 12:00">08:00 - 12:00</option>
            <option value="13:00 - 17:00">13:00 - 17:00</option>
            <option value="18:00 - 22:00">18:00 - 22:00</option>
        </select>
        <br>

        <label for="name">ชื่อ-สกุล:</label>
        <input type="text" id="name" name="full_name" required>
        <br>

        <label for="phone">เบอร์โทรศัพท์:</label>
        <input type="text" id="phone" name="phone_number" required>
        <br>

        <label for="student_id">รหัสนักศึกษา:</label>
        <input type="text" id="student_id" name="student_id" required>
        <br>

        <button type="submit">ส่งการจอง</button>
    </form>
</div>

</div>
</body>
</html>
