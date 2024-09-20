<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa nhân viên</title>
    <style>
        body {
            font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
        }
        .form-container {
            max-width: 300px;
            margin: auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .submit{
            padding: 10px 20px;
            color: #fff;
            background-color: #08AB45;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php
$servername = "sql110.infinityfree.com";  
$username = "if0_37106760";
$password = "5zcyxOEBI8";  
$dbname = "if0_37106760_b5_mydb"; 
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT firstname, lastname FROM MyGuests WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
    } else {
        echo "<p class='error-message'>Không tìm thấy nhân viên.</p>";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_firstname = $_POST['firstname'];
        $new_lastname = $_POST['lastname'];
        $sql = "UPDATE MyGuests SET firstname = ?, lastname = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $new_firstname, $new_lastname, $id);

        if ($stmt->execute()) {
            header("Location: danhsachnhanvien.php");
        } else {
            echo "<p class='error-message'>Lỗi: " . $conn->error . "</p>";
        }
    }
} else {
    echo "<p class='error-message'>ID không hợp lệ.</p>";
    exit;
}

$conn->close();
?>
    <div class="form-container">
        <h2>Chỉnh sửa nhân viên</h2>
        <form method="post">
        <div class="form-group">
            <label for="firstname">Firstname:</label>
            <input type="text" name="firstname" id="firstname" value="<?= htmlspecialchars($firstname) ?>" required>
        </div>
        <div class="form-group">
            <label for="lastname">Lastname:</label>
            <input type="text" name="lastname" id="lastname" value="<?= htmlspecialchars($lastname) ?>" required>
        </div>
        <button type="submit" class="submit">Cập nhật</button>
           
        </form>
    </div>
</body>
</html>
