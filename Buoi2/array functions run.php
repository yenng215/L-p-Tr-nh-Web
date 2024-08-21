<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Functions</title>
    <link rel="stylesheet" href="Array functions.css"> 
</head>
<body>
    <?php
    require 'Array functions.php'; 
    $array = [5, 2, 9, 1, 7, 3];
    $maxValue = GTLN($array);
    $minValue = GTNN($array);
    $sum = tinhtong($array);
    $contains7 = kiemtra($array, 7) ? '7 có trong mảng' : '7 không có trong mảng';
    sapxep($array);

    echo "<h1>Array Functions</h1>";
    echo "<div>Mảng ban đầu: 5, 2, 9, 1, 7, 3</div>";
    echo "<div>Giá trị lớn nhất trong mảng: $maxValue</div>";
    echo "<div>Giá trị nhỏ nhất trong mảng: $minValue</div>";
    echo "<div>Tổng các phần tử trong mảng: $sum</div>";
    echo "<div>Mảng sau khi sắp xếp: " . implode(", ", $array) . "</div>";
    echo "<div>$contains7</div>";
    ?>
</body>
</html>
