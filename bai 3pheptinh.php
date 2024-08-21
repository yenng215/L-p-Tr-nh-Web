<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phép Tính Trên Hai Số</title>
    <link rel="stylesheet" href="bai3.css"> 
</head>
<body>
    <form action="Bài 3 kết quả.php" method="post">
        <h2 >PHÉP TÍNH TRÊN HAI SỐ</h2>
        <label style="color: red ">Chọn phép tính:</label>
        <input type="radio" name="pheptinh" value="cong" checked>
        <label>Cộng</label>
        <input type="radio" name="pheptinh" value="tru">
        <label>Trừ</label>
        <input type="radio" name="pheptinh" value="nhan">
        <label>Nhân</label>
        <input type="radio" name="pheptinh" value="chia">
        <label >Chia</label>
        <br><br>
        <label>Số thứ nhất:</label>
        <input type="text" name="so1"><br><br>
        <label>Số thứ hai:</label>
        <input type="text" name="so2"><br><br>
        <button>Tính</button>
       
    </form>
     
    <form method="post">
  <h2>KIỂM TRA SỐ</h2>
  <label style= "margin-right: 250px;">Chọn phép kiểm tra:</label><br>
  <input type="radio" name="kiemtra" value="nguyento">
  <label>Kiểm tra số nguyên tố</label><br>
  <input type="radio" name="kiemtra" value="chanle">
  <label>Kiểm tra số chẵn/lẻ     </label><br><br>
  <label>Nhập số kiểm tra:</label>
  <input type="text" name="so"><br><br>
  <button>Kiểm tra</button>

  <?php
    function kiem_tra_nguyen_to($n) {
        if ($n < 2) return false;
        for ($i = 2; $i <= sqrt($n); $i++) {
            if ($n % $i == 0) return false;
        }
        return true;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['so']) && isset($_POST['kiemtra'])) {
        $so = $_POST['so'];
        $kiemtra = $_POST['kiemtra'];

        if (is_numeric($so)) {
            $so = intval($so);
            if ($kiemtra == "nguyento") {
                if (kiem_tra_nguyen_to($so)) {
                    echo "<h3>$so là số nguyên tố.</h3>";
                } else {
                    echo "<h3>$so không phải là số nguyên tố.</h3>";
                }
            } elseif ($kiemtra == "chanle") {
                if ($so % 2 == 0) {
                    echo "<h3>$so là số chẵn.</h3>";
                } else {
                    echo "<h3>$so là số lẻ.</h3>";
                }
            }
        } else {
            echo "<p>Vui lòng nhập số hợp lệ.</p>";
        }
    }
    ?>
  
</form>


</body>
</html>