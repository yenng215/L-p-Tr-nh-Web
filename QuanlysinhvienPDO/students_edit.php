<?php
require './libs/students.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if ($id) {
    $data = get_student($id);
}

if (!$data) {
    header("Location: students_list.php");
}

if (!empty($_POST['edit_student'])) {
    $data['sv_name'] = isset($_POST['name']) ? $_POST['name'] : '';
    $data['sv_sex'] = isset($_POST['sex']) ? $_POST['sex'] : '';
    $data['sv_birthday'] = isset($_POST['birthday']) ? $_POST['birthday'] : '';
    $data['sv_id'] = isset($_POST['id']) ? $_POST['id'] : '';

    $errors = array();
    if (empty($data['sv_name'])) {
        $errors['sv_name'] = 'Chưa nhập tên sinh viên';
    }
    if (empty($data['sv_sex'])) {
        $errors['sv_sex'] = 'Chưa nhập giới tính sinh viên';
    }

    if (!$errors) {
        edit_student($data['sv_id'], $data['sv_name'], $data['sv_sex'], $data['sv_birthday']);
        header("Location: students_list.php");
    }
}

disconnect_db();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa sinh viên</title>
    <meta charset="UTF-8">
</head>
<body>
<h1>Sửa sinh viên</h1>
<form method="post" action="students_edit.php?id=<?php echo $data['id']; ?>">
<table width="30%" border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td>Name</td>
            <td><input type="text" name="name" value="<?php echo $data['hoten']; ?>"/></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>
                <select name="sex">
                    <option value="Nam">Nam</option>
                    <option value="Nữ" <?php if ($data['gioitinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Birthday</td>
            <td><input type="date" name="birthday" value="<?php echo $data['ngaysinh']; ?>"/></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>"/>
                <input type="submit" name="edit_student" value="Sửa"/>
            </td>
        </tr>
    </table>
</form>
<a href="students_list.php" style="background-color: #4CAF50; color: white; padding: 7px 20px; margin-top:10px; text-align: center; text-decoration: none; display: inline-block; border-radius: 5px;">Trở về</a>
</body>
</html>
