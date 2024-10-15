<?php
require 'employee.php';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_department'])) {
    $department_name = $_POST['department_name'];
    $department_description = $_POST['department_description']; // Giả sử đây là tham số thứ 2 cần thiết

    // Validate
    if (empty($department_name)) {
        $errors['department_name'] = 'Chưa nhập tên phòng ban';
    }

    if (empty($department_description)) {
        $errors['department_description'] = 'Chưa nhập mô tả phòng ban';
    }

    if (empty($errors)) {
        // Gọi hàm add_department với đủ 2 tham số
        add_department($department_name, $department_description);
        header("location: department.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm Phòng Ban</title>
</head>
<body>
<h1>Thêm Phòng Ban</h1>
<a href="department.php">Trở về</a> <br/> <br/>
<form method="POST" action="">
    <table width="50%" border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td>Tên phòng ban:</td>
            <td>
                <input type="text" name="department_name" value="<?php echo htmlspecialchars($department_name ?? '', ENT_QUOTES); ?>"/>
                <?php if (!empty($errors['department_name'])) echo "<span style='color:red;'>{$errors['department_name']}</span>"; ?>
            </td>
        </tr>
        <tr>
            <td>Mô tả phòng ban:</td>
            <td>
                <input type="text" name="department_description" value="<?php echo htmlspecialchars($department_description ?? '', ENT_QUOTES); ?>"/>
                <?php if (!empty($errors['department_description'])) echo "<span style='color:red;'>{$errors['department_description']}</span>"; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" name="add_department" value="Lưu"/>
            </td>
        </tr>
    </table>
</form>
</body>
</html>