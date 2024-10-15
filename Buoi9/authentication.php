<?php
session_start();

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['username'])) {
    // Nếu đã đăng nhập, chuyển hướng đến trang chính
    if ($_SESSION['username'] === 'admin') {
        header('Location: admin.php');
    } else {
        header('Location: nv.php');
    }
    exit();
}

// Dữ liệu giả lập cho tên đăng nhập và mật khẩu đã được mã hóa
$users = [
    'admin' => password_hash('admin123', PASSWORD_DEFAULT),
    'employee' => password_hash('employee123', PASSWORD_DEFAULT)
];

// Kiểm tra nếu form được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra tên đăng nhập và mật khẩu
    if (array_key_exists($username, $users) && password_verify($password, $users[$username])) {
        $_SESSION['username'] = $username;

        // Phân quyền
        if ($username === 'admin') {
            header('Location: admin.php'); // Điều hướng đến trang admin
        } else {
            header('Location: nv.php'); // Điều hướng đến trang employee
        }
        exit();
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng thử lại.";
    }
}

// Nếu không có phương thức POST, yêu cầu xác thực
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Secure Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Bạn cần đăng nhập để truy cập trang này.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-form {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .login-form h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .login-form input[type="submit"] {
            background-color: #2196F3;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .login-form input[type="submit"]:hover {
            background-color: #1976D2;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .info {
            color: #333;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="login-form">
    <h2>Đăng Nhập</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="text" id="username" name="username" placeholder="Tên đăng nhập" required>
        <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
        <input type="submit" value="Đăng Nhập">
    </form>
    <p class="info">
        Thông tin đăng nhập:<br>
        username: admin - password: admin123<br>
        username: employee - password: employee123
    </p>
</div>

</body>
</html>