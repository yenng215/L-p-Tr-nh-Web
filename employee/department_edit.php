<?php
require 'employee.php';
$errors = [];

$id = $_GET['id'] ?? null;
$current_department = get_department($id);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_department'])) {
    $department_name = $_POST['department_name'];

    // Validate
    if (empty($department_name)) {
        $errors['department_name'] = 'Chưa nhập tên phòng ban';
    }

    if (empty($errors)) {
        edit_department($id, $department_name);
        header("location: department_list.php");
        exit; // Dừng thực hiện script sau khi redirect
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa Phòng Ban</title>
</head>
<body>
    <h1>Sửa Phòng Ban</h1>
    <a href="department_list.php">Trở về</a> <br/> <br/>
    <form method="POST" action="">
    <table width="50%" border="1" cellspacing="0" cellpadding="10">  
        <tr>
            <td>Tên phòng ban:</td>
            <td>
            <input type="text" name="department_name" value="<?php echo htmlspecialchars($current_department['department_name'], ENT_QUOTES); ?>"/>
            <?php if (!empty($errors['department_name'])) echo "<span style='color:red;'>{$errors['department_name']}</span>"; ?>
            </td>
            <td>
            <input type="submit" name="edit_department" value="Lưu"/>
            </td>
            </tr>
    </form>
</body>
</html>
