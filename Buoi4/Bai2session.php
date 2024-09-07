<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt Upload Form</title>
    <script src="https://kit.fontawesome.com/cb3a16e09a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Bai2.css"> 
</head>
<body>
<?php
session_start();
$first_nameErr = $last_nameErr = $emailErr = $invoice_idErr = $pay_forErr = "";
$first_name = $last_name = $email = $invoice_id = $pay_for = [];
$comment = '';

// Kiểm tra nếu có dữ liệu phiên để điền vào biểu mẫu
if (isset($_SESSION['first_name'])) {
    $first_name = $_SESSION['first_name'];
}
if (isset($_SESSION['last_name'])) {
    $last_name = $_SESSION['last_name'];
}
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}
if (isset($_SESSION['invoice_id'])) {
    $invoice_id = $_SESSION['invoice_id'];
}
if (isset($_SESSION['pay_for'])) {
    $pay_for = explode(', ', $_SESSION['pay_for']);
}
if (isset($_SESSION['comment'])) {
    $comment = $_SESSION['comment'];
}

// Xử lý khi gửi biểu mẫu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Xác thực và xử lý dữ liệu
    if (empty($_POST["first_name"])) {
        $first_nameErr = "Vui lòng nhập tên.";
    } else {
        $first_name = test_input($_POST["first_name"]);
    }

    if (empty($_POST["last_name"])) {
        $last_nameErr = "Vui lòng nhập họ.";
    } else {
        $last_name = test_input($_POST["last_name"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Vui lòng nhập email.";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["invoice_id"])) {
        $invoice_idErr = "Vui lòng nhập ID hóa đơn.";
    } else {
        $invoice_id = test_input($_POST["invoice_id"]);
    }

    if (empty($_POST["pay_for"])) {
        $pay_forErr = "Vui lòng chọn ít nhất một mục thanh toán.";
    } else {
        $pay_for = $_POST["pay_for"];
    }

    // Lưu dữ liệu hợp lệ vào session
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['email'] = $email;
    $_SESSION['invoice_id'] = $invoice_id;
    $_SESSION['pay_for'] = isset($_POST['pay_for']) ? implode(', ', $_POST['pay_for']) : 'Chưa chọn';
    $_SESSION['comment'] = isset($_POST['comment']) ? test_input($_POST['comment']) : '';
}
?>

<div class="container">
    <h2>Payment Receipt Upload Form</h2>
    <form action="Bai2session_.php" method="POST" enctype="multipart/form-data">
        <div class="row two-columns">
        <span>First name:</span><input type="text" name="first_name">
            <span class="error"><?php echo $first_nameErr; ?></span>
        <span>Last Name:</span><input type="text" name="last_name">
            <span class="error"><?php echo $last_nameErr; ?></span>
        </div>
        <div class="row two-columns">     
        <span>Email:</span> <input type="email" name="email">
            <span class="error"><?php echo $emailErr; ?></span>     
        <span>Invoice ID:</span><input type="text" name="invoice_id">
            <span class="error"><?php echo $invoice_idErr; ?></span>
        </div>
        <div class="row">
            <span>Pay For:</span>
            <div class="checkbox-group">
                <p><input type="checkbox" name="pay_for[]" value="15K Category"> 15K Category</p>
                <p><input type="checkbox" name="pay_for[]" value="35K Category"> 35K Category</p>
                <p><input type="checkbox" name="pay_for[]" value="55K Category"> 55K Category</p>
                <p><input type="checkbox" name="pay_for[]" value="75K Category"> 75K Category</p>
                <p><input type="checkbox" name="pay_for[]" value="116K Category"> 116K Category</p>
                <p><input type="checkbox" name="pay_for[]" value="Shuttle One Way"> Shuttle One Way</p>
                <p><input type="checkbox" name="pay_for[]" value="Shuttle Two Ways"> Shuttle Two Ways</p>
                <p><input type="checkbox" name="pay_for[]" value="Training Cap Merchandise"> Training Cap Merchandise</p>
                <p><input type="checkbox" name="pay_for[]" value="Compressport T-Shirt Merchandise"> Compressport T-Shirt Merchandise</p>
                <p><input type="checkbox" name="pay_for[]" value="Buf Merchandise"> Buf Merchandise</p>
                <p><input type="checkbox" name="pay_for[]" value="Other"> Other</p>
            </div>
            <span class="error"><?php echo $pay_forErr; ?></span>
        </div>
        
        
        <span>Please upload your payment receipt:</span> 
        <div class="upload">
        <div class="icon">
        <i class="fa-solid fa-cloud-arrow-up"></i>
        </div>
        <input type="file" name="BrowseFiles" id="BrowseFiles">

        </div>
        jpg,jpeg,png,gif(1mb max.)
    <br>
        <span>Additional Information</span> <br>
        <textarea name="comment" rows="8"></textarea>
        <div class="submit-btn">
        <input type="submit" name="submit" value="submit">
        </div>
        </form>
</div>


</body>
</html>