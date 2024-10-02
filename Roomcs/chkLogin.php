<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login</title>
</head>

<body>
<!-- ฟอร์มสำหรับเข้าสู่ระบบ -->
<form action="" method="post">
    <table>
        <tr>
            <td>Student ID:</td>
            <td><input type="text" name="student_id" required></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Login"></td>
        </tr>
    </table>
</form>

<?php
include "connectDB.php"; // ไฟล์สำหรับเชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับข้อมูล student_id และ password จากฟอร์ม
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    // ค้นหาผู้ใช้โดยใช้ student_id
    $sql = "SELECT * FROM users WHERE student_id='$student_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // ตรวจสอบรหัสผ่านที่เข้ารหัส
        if (password_verify($password, $row['password'])) {
            // กำหนด session
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['student_id'] = $row['student_id']; // เก็บรหัสนักศึกษาใน session
            $_SESSION['status'] = $row['status']; // กำหนดสิทธิ์ (0 = Admin, 1 = Teacher, 2 = Student)

            // Redirect to index.php to show the appropriate content
            header("Location: index.php");
            exit;
        } else {
            echo "Invalid password.";
            echo "<meta http-equiv='refresh' content='1;index.php?fn=loginForm' />";
        }
    } else {
        echo "No user found with this student ID.";
        echo "<meta http-equiv='refresh' content='1;index.php?fn=loginForm' />";
    }

    $conn->close();
}
?>
</body>
</html>
