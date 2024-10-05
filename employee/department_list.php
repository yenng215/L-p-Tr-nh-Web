<?php
require 'employee.php';
$departments = get_all_departments();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Danh Sách Phòng Ban</title>
</head>
<body>
    <h1>Danh Sách Phòng Ban</h1>
    <a href="department_add.php">Thêm Phòng Ban</a>
    <table width="40%" border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td>ID</td>
            <td>Tên Phòng Ban</td>
            <td>Thao Tác</td>
        </tr>
        <?php foreach ($departments as $department) { ?>
            <tr>
                <td><?php echo $department['department_id']; ?></td>
                <td><?php echo $department['department_name']; ?></td>
                <td>
                    <form method="post" action="department_delete.php">
                        <input type="button" onclick="window.location='department_edit.php?id=<?php echo $department['department_id']; ?>'" value="Sửa"/>
                        <input type="hidden" name="id" value="<?php echo $department['department_id']; ?>"/>
                        <input type="submit" onclick="return confirm('Bạn có chắc muốn xóa không?');" value="Xóa"/>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
