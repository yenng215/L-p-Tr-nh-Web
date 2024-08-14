<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Phép Toán</title>
</head>
<body>

<?php
function tinh_phep_toan($so1, $so2, $operation) {
    switch ($operation) {
        case 'Cộng':
            return $so1 + $so2;
        case 'Trừ':
            return $so1 - $so2;
        case 'Nhân':
            return $so1 * $so2;
        case 'Chia':
            return $so2 != 0 ? $so1 / $so2 : "Không thể chia cho 0!";
    }
}

$so_a = 4;
$so_b = 5;
$ket_qua = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $operation = $_POST['operation'];
    $ket_qua = tinh_phep_toan($so_a, $so_b, $operation);
}

?>


<form method="post">
    Các phép toán giữa số 4 và 5 là:<br><br>
    Chọn phép toán:
    <input type="radio" name="operation" value="Cộng" required> Cộng
    <input type="radio" name="operation" value="Trừ"> Trừ
    <input type="radio" name="operation" value="Nhân"> Nhân
    <input type="radio" name="operation" value="Chia"> Chia
    <br><br>
    <input type="submit" value="Tính toán">
</form>

<?php
if ($ket_qua !== "") {
    echo "<h3>Kết quả: $ket_qua</h3>";
}
?>

</body>
</html>