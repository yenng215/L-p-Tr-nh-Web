<?php
require 'employee.php';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_department'])) {
    $department_name = $_POST['department_name'];

    // Validate
    if (empty($department_name)) {
        $errors['department_name'] = 'Chưa nhập tên phòng ban';
    }

    if (empty($errors)) {
        add_department($department_name);
        header("location: department_list.php");
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
    <a href="department_list.php">Trở về</a> <br/> <br/>
    <form method="POST" action="">
    <table width="50%" border="1" cellspacing="0" cellpadding="10">  
        <tr>
            <td>Tên phòng ban:</td>
            <td>
            <input type="text" name="department_name" value="<?php echo htmlspecialchars($department_name ?? '', ENT_QUOTES); ?>"/>
        <?php if (!empty($errors['department_name'])) echo "<span style='color:red;'>{$errors['department_name']}</span>"; ?>
            </td>
            <td>
            <input type="submit" name="add_department" value="Lưu"/>
            </td>
            </tr>
    </form>
</body>
</html>
