<?php

require 'employee.php'; // Đảm bảo file này tồn tại và có chức năng cần thiết
$employee = get_all_employees(); // Lấy danh sách nhân viên
disconnect_db(); // Ngắt kết nối DB nếu cần
?>

<!DOCTYPE html>
<html>
<head>
    <title>Danh sách nhân viên</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Danh sách nhân viên</h1>
    <a href="employee_add.php">Thêm nhân viên</a> <br/> <br/>
    <a href="department.php">Danh sách phòng ban</a> <br/> <br/>
    <a href="roles_list.php">Danh sách chức vụ</a> <br/> <br/>
    <table width="100%" border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td><b>First name</b></td>
            <td>Last name</td>
            <td>Role</td>
            <td>Departments</td>
            
        </tr>
        <?php foreach ($employee as $item) { ?>
        <tr>
            <td><?php echo htmlspecialchars($item['first_name']); ?></td>
            <td><?php echo htmlspecialchars($item['last_name']); ?></td>
            <td><?php echo htmlspecialchars($item['role_name']); ?></td>
            <td><?php echo htmlspecialchars($item['department_name']); ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>