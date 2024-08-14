<!DOCTYPE html>
<html >
<head>
    <title>Thông tin sách</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 4px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <th>STT</th>
        <th>Tên sách</th>
        <th>Nội dung sách</th>
    </tr>
    <?php
    for ($i = 1; $i <= 100; $i++) {
        echo "<tr>";
        echo "<td>" . $i . "</td>";
        echo "<td>Tensach" . $i . "</td>";
        echo "<td>Noidung" . $i . "</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
