<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['username'])) {
    header('Location: authentication.php'); // Chuyển hướng đến trang đăng nhập
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Admin</title>
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
        .content {
            background: white;
            padding: 40px; /* Tăng padding */
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 1200px; /* Tăng chiều rộng tối đa */
            margin: auto;
        }
        #content {
            margin-top: 20px;
            padding: 15px;
            border-top: 1px solid #ddd;
        }
        .user-link {
            display: flex;
            justify-content: center;
            margin: 20px 0; /* Thêm khoảng cách trên và dưới */
        }
        .user-link a {
            margin: 0; /* Xóa khoảng cách bên trái và bên phải */
            padding: 10px 15px; /* Giữ padding giống như nav */
            background-color: #007bff; /* Màu nền giống như nav */
            color: white; /* Màu chữ trắng */
            border-radius: 5px; /* Bo góc */
            text-decoration: none; /* Xóa gạch chân */
            font-weight: bold; /* Đậm chữ */
            transition: background-color 0.3s, color 0.3s; /* Hiệu ứng chuyển màu */
        }
        .user-link a:hover {
            background-color: #0056b3; /* Màu nền khi hover */
        }
    </style>
    <script>
    $(document).ready(function() {
        // Load default content
        loadPage('employee_list.php');

        $('.nav a').click(function(e) {
            e.preventDefault();
            const page = $(this).attr('href');
            loadPage(page);
        });

        // Function to load content via AJAX
        function loadPage(page) {
            $.ajax({
                url: page,
                type: 'GET',
                success: function(data) {
                    $('#content').html(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#content').html('<p>Đã xảy ra lỗi khi tải trang: ' + textStatus + ' - ' + errorThrown + '</p>');
                }
            });
        }

        // Xử lý form từ user.php
        $(document).on('submit', 'form', function(e) {
            e.preventDefault(); // Ngăn chặn hành vi mặc định của form
            const formData = $(this).serialize(); // Lấy dữ liệu từ form

            $.post($(this).attr('action'), formData, function(data) {
                $('#content').html(data); // Cập nhật nội dung
            }).fail(function(jqXHR, textStatus, errorThrown) {
                $('#content').html('<p>Đã xảy ra lỗi khi gửi dữ liệu: ' + textStatus + ' - ' + errorThrown + '</p>');
            });
        });
    });
    </script>
</head>
<body>
    <div class="content">
        <h1>Xin chào, Admin</h1>
        <p>Đây là trang dành cho quản trị.</p>
        <div class="nav">
            <a href="employee_list.php">Home</a>
            <a href="employee_manager.php">Quản trị nhân viên</a>
        </div>
        <div class="user-link">
            <a href="user.php">Quản trị người dùng</a>
        </div>
        <a class="logout" href="logout.php">Đăng xuất</a>
        <div id="content">
            <p>Vui lòng chọn một liên kết.</p>
        </div>
    </div>
</body>
</html>