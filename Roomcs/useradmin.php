<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "connectDB.php"; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบการเข้าสู่ระบบของแอดมิน
if (!isset($_SESSION['status']) || $_SESSION['status'] != 0) {
    header("Location: index.php?fn=loginForm"); // เปลี่ยนเส้นทางไปยังหน้าล็อกอินถ้าไม่ใช่แอดมิน
    exit;
}

// ฟังก์ชันสำหรับอัปเดตข้อมูลผู้ใช้
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $user_id = $_POST['user_id'];
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        // Update only if password is provided
        if (!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // แฮชรหัสผ่านใหม่
            $sql = "UPDATE users SET username='$username', email='$email', password='$password' WHERE student_id='$user_id'";
        } else {
            $sql = "UPDATE users SET username='$username', email='$email' WHERE student_id='$user_id'";
        }
        $conn->query($sql);
    } elseif (isset($_POST['delete'])) {
        $user_id = $_POST['user_id'];
        $sql = "DELETE FROM users WHERE student_id='$user_id'";
        $conn->query($sql);
    }
}

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการผู้ใช้</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .edit-form {
            display: none;
            margin-top: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #f9f9f9;
        }
    </style>
    <script type="text/javascript">
        function toggleEditForm(id) {
            var form = document.getElementById('editForm' + id);
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }

        function confirmDeletion() {
            return confirm("คุณแน่ใจหรือไม่ว่าต้องการลบผู้ใช้นี้?");
        }
    </script>
</head>

<body>
    <h1>จัดการผู้ใช้</h1>
    <table>
        <tr>
            <th>ไอดี</th>
            <th>ชื่อผู้ใช้</th>
            <th>อีเมล</th>
            <th>การจัดการ</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['student_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td>
                        <button onclick="toggleEditForm('<?php echo $row['student_id']; ?>')">แก้ไข</button>
                        <form method="post" action="" style="display:inline;" onsubmit="return confirmDeletion();">
                            <input type="hidden" name="user_id" value="<?php echo $row['student_id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger">ลบ</button>
                        </form>

                        <div id="editForm<?php echo $row['student_id']; ?>" class="edit-form">
                            <form method="post" action="">
                                <input type="hidden" name="user_id" value="<?php echo $row['student_id']; ?>">
                                <label>ชื่อผู้ใช้:</label>
                                <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
                                <label>อีเมล:</label>
                                <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                                <label>รหัสผ่านใหม่:</label>
                                <input type="password" name="password">
                                <button type="submit" name="update">อัปเดต</button>
                                <button type="button" onclick="toggleEditForm('<?php echo $row['student_id']; ?>')">ยกเลิก</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">ไม่มีผู้ใช้ในระบบ</td>
            </tr>
        <?php endif; ?>
    </table>
    <a href="index.php">กลับหน้าหลัก</a>
</body>
</html>

<?php
$conn->close();
?>
