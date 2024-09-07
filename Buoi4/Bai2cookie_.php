<?php

$first_name = $last_name = $email = $invoice_id = $comment = $pay_for = $file_name = '';

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

    setcookie("first_name", $first_name, time() + 30, "/");
    setcookie("last_name", $last_name, time() + 30, "/");
    setcookie("email", $email, time() + 30, "/");
    setcookie("invoice_id", $invoice_id, time() + 30, "/");
    setcookie("pay_for", $pay_for, time() + 30, "/");
    setcookie("comment", $comment, time() + 30, "/");

    if (isset($_FILES["BrowseFiles"]) && $_FILES["BrowseFiles"]["error"] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $file_name = basename($_FILES["BrowseFiles"]["name"]);
        $target_file = $target_dir . $file_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["BrowseFiles"]["tmp_name"]);
        if ($check !== false) { 
            $uploadOk = 1;
        } else {
            echo "Tệp không phải là hình ảnh.<br>";
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
                echo "The file ". htmlspecialchars($file_name) . " has been uploaded.<br>";
                echo "<img src='" . $target_file . "' alt='Uploaded Image' style='max-width: 300px;'><br>";
                setcookie("file_name", $file_name, time() + 30, "/");
            } else {
                echo "Xin lỗi, đã xảy ra lỗi khi tải tệp của bạn lên.<br>";
            }
        }
    } else {
        if (isset($_FILES["BrowseFiles"])) {
            echo "Không có tệp nào được tải lên hoặc đã xảy ra lỗi với tệp.<br>";
        }
    }

    header("Refresh:0");

} else {
    echo "<h3>Form Data Submitted:</h3>";
    echo "First Name: " . (isset($_COOKIE["first_name"]) ? $_COOKIE["first_name"] : 'None') . "<br>";
    echo "Last Name: " . (isset($_COOKIE["last_name"]) ? $_COOKIE["last_name"] : 'None') . "<br>";
    echo "Email: " . (isset($_COOKIE["email"]) ? $_COOKIE["email"] : 'None') . "<br>";
    echo "Invoice ID: " . (isset($_COOKIE["invoice_id"]) ? $_COOKIE["invoice_id"] : 'None') . "<br>";
    echo "Pay For: " . (isset($_COOKIE["pay_for"]) ? $_COOKIE["pay_for"] : 'None') . "<br>";
    echo "Comment: " . (isset($_COOKIE["comment"]) ? $_COOKIE["comment"] : 'None') . "<br>";
    
    if (isset($_COOKIE["file_name"])) {
        $file_name = $_COOKIE["file_name"];
        $file_path = "uploads/" . $file_name;
        if (file_exists($file_path)) {
            echo "Tệp đã tải lên gần đây: " . "<br>";
            echo "<img src='" . $file_path . "' alt='Uploaded Image' style='max-width: 300px;'><br>";
        } else {
            echo "Không tìm thấy tệp.<br>";
        }
    } else {
        echo "Chưa có tệp nào được tải lên.<br>";
    }
}

if (count($_COOKIE) > 0) {
    echo "Cookie đã được kích hoạt.";
  } else {
    echo "Cookie chưa được kích hoạt.";
  }
  

?>
