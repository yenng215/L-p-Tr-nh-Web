<?php
require 'employee.php';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_role'])) {
    $role_name = $_POST['role_name'];

    // Validate
    if (empty($role_name)) {
        $errors['role_name'] = 'Chưa nhập tên chức vụ';
    }

    if (empty($errors)) {
        add_role($role_name);
        header("location: role_list.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm Chức Vụ</title>
</head>
<body>
<h1>Thêm Chức Vụ</h1>
    <a href="department_list.php">Trở về</a> <br/> <br/>
    <form method="POST" action="">
    <table width="50%" border="1" cellspacing="0" cellpadding="10">  
        <tr>
            <td>Tên Chức Vụ:</td>
            <td>
            <input type="text" name="role_name" value="<?php echo htmlspecialchars($role_name ?? '', ENT_QUOTES); ?>"/>
            <?php if (!empty($errors['role_name'])) echo "<span style='color:red;'>{$errors['role_name']}</span>"; ?>
            </td>
            <td>
            <input type="submit" name="add_role" value="Lưu"/>
            </td>
            </tr>
    </form>
</body>
</html>
