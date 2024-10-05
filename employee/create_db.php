<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="submit" name="cr_db" value="create_db">
</form>
<?php

$servername = "sql110.infinityfree.com";  
$username = "if0_37106760";
$password = "5zcyxOEBI8";  
$dbname = "if0_37106760_employee_db"; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new PDO("mysql:host=$servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE employee_db";
        $conn->exec($sql);
        echo "Cơ sở dữ liệu đã được tạo thành công<br>";

        $conn->exec($sql);

        echo "Các bảng đã được tạo thành công<br>";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}
?>
</body>
</html>
