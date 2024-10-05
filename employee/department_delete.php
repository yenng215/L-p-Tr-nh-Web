<?php
require 'employee.php';
$id = $_POST['id'] ?? null;

if ($id) {
    delete_department($id);
}
header("location: department_list.php");
?>

