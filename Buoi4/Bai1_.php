<?php

$first_name = $last_name = $email = $invoice_id = $pay_for = [];

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = test_input($_POST['first_name']);
    $last_name = test_input($_POST['last_name']);
    $email = test_input($_POST['email']);
    $invoice_id = test_input($_POST['invoice_id']);
    $pay_for = isset($_POST['pay_for']) ? implode(', ', $_POST['pay_for']) : 'None selected';
    $comment = isset($_POST['comment']) ? test_input($_POST['comment']) : '';

echo "<h3>Form Data Submitted</h3>";
echo "First Name: " . $first_name . "<br>";
echo "Last Name: " . $last_name . "<br>";
echo "Email: " . $email . "<br>";
echo "Invoice ID: " . $invoice_id . "<br>";
echo "Pay For: " . $pay_for . "<br>";
echo "Comment: " . $comment . "<br>";

  

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["BrowseFiles"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$check = getimagesize($_FILES["BrowseFiles"]["tmp_name"]);
if ($check !== false) { 
    $uploadOk = 1;
} else {
    $uploadOk = 0;
}

if (file_exists($target_file)) {
    echo "Xin lỗi, tệp đã tồn tại.<br>";
    $uploadOk = 0;
}

if ($_FILES["BrowseFiles"]["size"] > 1000000) {
    echo "Xin lỗi, tệp của bạn quá lớn.<br>";
    $uploadOk = 0;
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Xin lỗi, chỉ chấp nhận tệp JPG, JPEG, PNG & GIF.<br>";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Xin lỗi, tệp của bạn không được tải lên.<br>";
} else {
    if (move_uploaded_file($_FILES["BrowseFiles"]["tmp_name"], $target_file)) {
        echo "Tệp đã được tải lên.<br>";
        echo "<img src='" . $target_file . "' alt='Uploaded Image' style='max-width: 300px;'><br>";
    } else {
        echo "Xin lỗi, đã xảy ra lỗi khi tải tệp của bạn lên.<br>";
    }
}
   
 }
 ?>