<?php
$servername = "sql110.infinityfree.com";  
$username = "if0_37106760";
$password = "5zcyxOEBI8";  
$dbname = "if0_37106760_employee1_db"; 

try {
    // Tạo kết nối
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Thiết lập chế độ báo lỗi
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Lấy dữ liệu người dùng
    $sql = "SELECT user_id, username, password, role_name FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Xử lý thêm người dùng
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
        $new_username = $_POST['username'];
        $new_password = $_POST['password'];
        $new_role_name = $_POST['role_name'];

        // Mã hóa mật khẩu
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Chuẩn bị và thực hiện truy vấn
        $insert_sql = "INSERT INTO users (username, password, role_name) VALUES (:username, :password, :role_name)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->execute(['username' => $new_username, 'password' => $hashed_password, 'role_name' => $new_role_name]);
    }

    // Xử lý cập nhật người dùng
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
        $user_id = $_POST['user_id'];
        $updated_username = $_POST['username'];
        $updated_password = $_POST['password'];
        $updated_role_name = $_POST['role_name'];

        // Mã hóa mật khẩu
        $hashed_password = password_hash($updated_password, PASSWORD_DEFAULT);

        // Cập nhật dữ liệu
        $update_sql = "UPDATE users SET username = :username, password = :password, role_name = :role_name WHERE user_id = :user_id";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->execute(['username' => $updated_username, 'password' => $hashed_password, 'role_name' => $updated_role_name, 'user_id' => $user_id]);
    }

    // Xử lý xóa người dùng
    if (isset($_GET['delete'])) {
        $user_id = $_GET['delete'];
        $delete_sql = "DELETE FROM users WHERE user_id = :user_id";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->execute(['user_id' => $user_id]);
    }

    // Cập nhật lại dữ liệu sau khi thêm, sửa, xóa
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách người dùng</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        h1 { color: #006666; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #006666; color: white; }
        tr:hover { background-color: #f5f5f5; }
        form { display: inline; }
        .back-button {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1>Danh sách người dùng (admin - bổ sung, sửa, xóa)</h1>

<!-- Nút quay lại trang Admin -->
<a class="back-button" href="admin.php">Quay lại trang Admin</a>

<!-- Form để thêm người dùng mới -->
<form method="post" action="">
    <input type="text" name="username" placeholder="Tên đăng nhập" required>
    <input type="password" name="password" placeholder="Mật khẩu" required>
    <input type="text" name="role_name" placeholder="Vai trò" required>
    <input type="hidden" name="add_user" value="1">
    <button type="submit">Thêm người dùng</button>
</form>

<table>
    <tr>
        <th>User ID</th>
        <th>Tên đăng nhập</th>
        <th>Mật khẩu</th>
        <th>Vai trò</th>
        <th>Thao tác</th>
    </tr>
    <?php
    if (count($result) > 0) {
        foreach ($result as $row) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["user_id"]) . "</td>
                    <td>" . htmlspecialchars($row["username"]) . "</td>
                    <td>" . htmlspecialchars($row["password"]) . "</td>
                    <td>" . htmlspecialchars($row["role_name"]) . "</td>
                    <td>
                        <form method='post' action='' style='display:inline;'>
                            <input type='hidden' name='user_id' value='" . htmlspecialchars($row["user_id"]) . "'>
                            <input type='text' name='username' placeholder='Tên đăng nhập' required value='" . htmlspecialchars($row["username"]) . "'>
                            <input type='password' name='password' placeholder='Mật khẩu' required>
                            <input type='text' name='role_name' placeholder='Vai trò' required value='" . htmlspecialchars($row["role_name"]) . "'>
                            <input type='hidden' name='update_user' value='1'>
                            <button type='submit'>Sửa</button>
                        </form>
                        <a href='?delete=" . htmlspecialchars($row["user_id"]) . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\");'>Xóa</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
    }
    $conn = null; // Đóng kết nối
    ?>
</table>

</body>
</html>