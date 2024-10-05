<?php
require 'employee.php';
$roles = get_all_roles();
$departments = get_all_departments();
$errors = [];

$id = $_GET['id'] ?? null;
$employee = get_employees($id);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_employee'])) {
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
        edit_employee($id, $firstname, $lastname, $department_id, $role_id);
        header("location: employee_list.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa Nhân Viên</title>
</head>
<body>
    <h1>Sửa Nhân Viên</h1>
    <a href="employee_list.php">Trở về</a> <br/> <br/>
    <form method="POST" action="">
        <table width="50%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>First name</td>
                <td>
                    <input type="text" name="firstname" value="<?php echo htmlspecialchars($employee['first_name'], ENT_QUOTES); ?>"/>
                    <?php if (!empty($errors['firstname'])) echo "<span style='color:red;'>{$errors['firstname']}</span>"; ?>
                </td>
            </tr>
            <tr>
                <td>Last name</td>
                <td>
                    <input type="text" name="lastname" value="<?php echo htmlspecialchars($employee['last_name'], ENT_QUOTES); ?>"/>
                    <?php if (!empty($errors['lastname'])) echo "<span style='color:red;'>{$errors['lastname']}</span>"; ?>
                </td>
            </tr>
            <tr>
                <td>Role</td>
                <td>
                    <select name="role">
                    <?php foreach ($roles as $role) { ?>
                    <option value="<?php echo $role['role_id']; ?>" <?php echo ($role['role_id'] == $employee['role_id']) ? 'selected' : ''; ?>>
                    <?php echo $role['role_name']; ?>
                    </option>
                    <?php } ?>
                    </select>
            </td>
            </tr>
            <tr>
                <td>Department</td>
                 <td>
                    <select name="department">
                    <?php foreach ($departments as $department) { ?>
                    <option value="<?php echo $department['department_id']; ?>" <?php echo ($department['department_id'] == $employee['department_id']) ? 'selected' : ''; ?>>
                    <?php echo $department['department_name']; ?>
                    </option>
                    <?php } ?>
                    </select>
                    </td>
            </tr>
                <td></td>
                <td>
                    <input type="submit" name="edit_employee" value="Lưu"/>
                </td>
                </tr>
            </table>
        </form>
    </body>
</html>