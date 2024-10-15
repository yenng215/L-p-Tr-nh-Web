<?php
session_start();
session_destroy(); // Hủy phiên làm việc
header('Location: authentication.php'); // Chuyển hướng về trang đăng nhập
exit();
?>