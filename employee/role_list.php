<?php
require 'employee.php';
$roles = get_all_roles();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách chức vụ</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <h1>Danh Sách Chức Vụ</h1>
    <a href="role_add.php">Thêm Chức Vụ</a>
    <table width="40%" border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td>Tên Chức Vụ</td>
            <td>Thao Tác</td>
        </tr>
        <?php foreach ($roles as $role) { ?>
            <tr>
                <td><?php echo $role['role_name']; ?></td>
                <td>
                    <form method="post" action="role_delete.php">
                        <input type="button" onclick="window.location='role_edit.php?id=<?php echo $role['role_id']; ?>'" value="Sửa"/>
                        <input type="hidden" name="id" value="<?php echo $role['role_id']; ?>"/>
                        <input type="submit" onclick="return confirm('Bạn có chắc muốn xóa không?');" value="Xóa"/>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
