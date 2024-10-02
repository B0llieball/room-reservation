<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Form</title>
<script>
function toggleStudentIdField() {
    var role = document.getElementById("role").value;
    var studentIdField = document.getElementById("student_id_field");
    if (role === "student") {
        studentIdField.style.display = "block";
    } else {
        studentIdField.style.display = "none";
    }
}
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="index.php?fn=regisAdd">
    <label>Username:</label>
    <input type="text" name="username" required>
    <br>
    <label>รหัสผ่าน:</label>
    <input type="password" name="password" required>
    <br>
    <label>Email:</label>
    <input type="email" name="email" required>
    <br>
    <label>เบอร์โทรศัพท์:</label>
    <input name="phone" type="text" id="phone" required>
    <br>
	<label>รหัสนักศึกษาหรือรหัสอาจารย์:</label>
        <input type="text" name="student_id" id="student_id" required>
    <label>สถานะ:</label>
    <select name="status" id="status" onchange="toggleStudentIdField()">
        <option value="0">Admin</option>
        <option value="1">Teacher</option>
        <option value="2">Student</option>
    </select>
    <br>
        

    <br>
    <button type="submit">Register</button>
</form>
</body>
</html>
