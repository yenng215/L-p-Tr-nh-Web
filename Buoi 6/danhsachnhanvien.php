<?php
$servername = "sql110.infinityfree.com";  
$username = "if0_37106760";
$password = "5zcyxOEBI8";  
$dbname = "if0_37106760_b5_mydb"; 

// Kết nối tới cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu
$sql = "SELECT id, firstname, lastname,email, reg_date FROM MyGuests";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
    <!-- Liên kết tới file CSS -->
    <link rel="stylesheet" href="dsnv.css">
</head>
<body>
    <h2>Danh sách nhân viên</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Id</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Reg_Date</th>
            <th>Thao tác</th>
        </tr>
        
        <?php
        // Hiển thị dữ liệu trong bảng
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["firstname"] . "</td>
                        <td>" . $row["lastname"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["reg_date"] . "</td>
                        <td>
                            <a href='sua_nv.php?id=" . $row["id"] . "'>Sửa</a>   |
                            <a href='xoa_nv.php?id=" . $row["id"] . "' class='delete' onclick='return confirm(\"Bạn có chắc chắn muốn xóa nhân viên này?\")'>Xóa</a>
                        </td>
                      </tr>";
                      
            }
        } else {
            echo "<tr><td colspan='5'>Không có dữ liệu nào.</td></tr>";
        }
        ?>
        
    </table>
    <a href="them_nv.php" class="add-button">Thêm nhân viên</a>
</body>
</html>

<?php
$conn->close();
?>
