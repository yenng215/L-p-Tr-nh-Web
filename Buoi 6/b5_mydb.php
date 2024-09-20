<?php
$servername = "sql110.infinityfree.com";  
$username = "if0_37106760";
$password = "5zcyxOEBI8";  
$dbname = "if0_37106760_b5_mydb"; 

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$conn->select_db($dbname);
$sql = "CREATE TABLE IF NOT EXISTS MyGuests (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL COLLATE latin1_swedish_ci,
    lastname VARCHAR(50) NOT NULL COLLATE latin1_swedish_ci,
    email VARCHAR(100) NOT NULL COLLATE latin1_swedish_ci,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Tạo bảng MyGuests thành công";
} else {
    echo "Lỗi khi tạo bảng: " . $conn->error;
}

$conn->close();
?>