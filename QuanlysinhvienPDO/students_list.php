<?php
require './libs/students.php';
$students = get_all_students();
disconnect_db();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sinh viên</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Danh sách sinh viên</h1>
    <table width="50%" border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>Mã sinh viên</th>
            <th>Họ tên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Chọn thao tác</th>
        </tr>
        <?php foreach ($students as $item) { ?>
        <tr>
            <td><?php echo $item['id']; ?></td>
            <td><?php echo $item['hoten']; ?></td>
            <td><?php echo $item['gioitinh']; ?></td>
            <td><?php echo $item['ngaysinh']; ?></td>
            <td>
            <input onclick="window.location = 'students_edit.php?id=<?php echo $item['id']; ?>'" type="button" value="Sửa"/>
                <form method="post" action="students_delete.php" style="display:inline-block;">
                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>"/>
                    <input type="submit" value="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này không?');"/>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
    <a href="students_add.php" style="background-color: #4CAF50; color: white; padding: 7px 20px; margin-top:10px; text-align: center; text-decoration: none; display: inline-block; border-radius: 5px;">Thêm sinh viên</a>
</body>
</html>
