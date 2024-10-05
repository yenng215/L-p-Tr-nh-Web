<?php
require 'employee.php';
$roles = get_all_roles();
$departments = get_all_departments();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_employee'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $role_id = $_POST['role'];
    $department_id = $_POST['department'];

    // Validate inputs
    if (empty($firstname)) {
        $errors['firstname'] = 'Chưa nhập họ đệm nhân viên';
    }
    if (empty($lastname)) {
        $errors['lastname'] = 'Chưa nhập tên nhân viên';
    }

    if (empty($errors)) {
        add_employee($firstname, $lastname, $department_id, $role_id);
        header("location: employee_list.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm Nhân Viên</title>
   
</head>
<body>
    <h1 >Thêm Nhân Viên</h1>
    <a href="employee_list.php">Trở về</a> <br/> <br/>
    <form method="POST" action="">
    <table width="50%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td><label for="firstname">Họ đệm:</label></td>
                <td>
                    <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname ?? '', ENT_QUOTES); ?>"/>
                    <?php if (!empty($errors['firstname'])) echo "<span class='error'>{$errors['firstname']}</span>"; ?>
                </td>
            </tr>
            <tr>
                <td><label for="lastname">Tên:</label></td>
                <td>
                    <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname ?? '', ENT_QUOTES); ?>"/>
                    <?php if (!empty($errors['lastname'])) echo "<span class='error'>{$errors['lastname']}</span>"; ?>
                </td>
            </tr>
            <tr>
                <td><label for="role">Chức vụ:</label></td>
                <td>
                    <select id="role" name="role">
                        <?php foreach ($roles as $role) { ?>
                            <option value="<?php echo $role['role_id']; ?>"><?php echo $role['role_name']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="department">Phòng ban:</label></td>
                <td>
                    <select id="department" name="department">
                        <?php foreach ($departments as $department) { ?>
                            <option value="<?php echo $department['department_id']; ?>"><?php echo $department['department_name']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;">
                    <input type="submit" name="add_employee" value="Lưu"/>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
