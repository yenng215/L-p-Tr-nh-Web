<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'employee') {
    header('Location: authentication.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Nhân Viên</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .welcome-message {
            text-align: center; /* Căn giữa dòng văn bản */
            margin-bottom: 20px;
            font-size: 1.2em; /* Tăng kích thước chữ để nổi bật hơn */
        }
        .nav {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        .nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        .nav a:hover {
            background-color: #007bff;
            color: white;
        }
        .content {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
            text-align: center;
        }
        a.logout {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #ff4d4d;
            font-weight: bold;
            text-decoration: none;
        }
        a.logout:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Xin chào Nhân Viên</h1>
    <p class="welcome-message">Đây là trang dành cho nhân viên.</p>
    
    <nav class="nav">
        <a href="#" class="ajax-link" data-target="employee_list.php">Danh sách nhân viên</a>
        <a class="logout" href="logout.php">Đăng xuất</a>
    </nav>
    
    <div class="content" id="content">
        <p>Vui lòng chọn một liên kết để xem thông tin.</p>
    </div>

    <script>
        $(document).ready(function() {
            $('.ajax-link').on('click', function(e) {
                e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                var targetPage = $(this).data('target');

                $.ajax({
                    url: targetPage,
                    method: 'GET',
                    success: function(data) {
                        $('#content').html(data); // Cập nhật nội dung
                    },
                    error: function() {
                        $('#content').html('<p>Không thể tải nội dung.</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>