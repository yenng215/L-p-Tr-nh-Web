<?php
session_start();
$first_name = $last_name = $email = $invoice_id = $comment = $pay_for = $file_name = '';

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['first_name'] = test_input($_POST['first_name']);
    $_SESSION['last_name'] = test_input($_POST['last_name']);
    $_SESSION['email'] = test_input($_POST['email']);
    $_SESSION['invoice_id'] = test_input($_POST['invoice_id']);
    $_SESSION['pay_for'] = isset($_POST['pay_for']) ? implode(', ', $_POST['pay_for']) : 'Chưa chọn';
    $_SESSION['comment'] = isset($_POST['comment']) ? test_input($_POST['comment']) : '';


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
                $_SESSION['file_name'] = $file_name;
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
    
    // Kiểm tra và hiển thị từng trường session đã được lưu
    echo "First Name: " . (!empty($_SESSION['first_name']) ? $_SESSION['first_name'] : 'None') . "<br>";
    echo "Last Name: " . (!empty($_SESSION['last_name']) ? $_SESSION['last_name'] : 'None') . "<br>";
    echo "Email: " . (!empty($_SESSION['email']) ? $_SESSION['email'] : 'None') . "<br>";
    echo "Invoice ID: " . (!empty($_SESSION['invoice_id']) ? $_SESSION['invoice_id'] : 'None') . "<br>";
    echo "Pay For: " . (!empty($_SESSION['pay_for']) ? $_SESSION['pay_for'] : 'None') . "<br>";
    echo "Comment: " . (!empty($_SESSION['comment']) ? $_SESSION['comment'] : 'None') . "<br>";

    // Xử lý và hiển thị ảnh
    if (isset($_SESSION['file_name'])) {
        $file_name = $_SESSION['file_name'];
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
if (count($_SESSION) > 0) {
    echo "Session đã được kích hoạt.";
  } else {
    echo "Session chưa được kích hoạt.";
  }
  
?>
<a href = "Bai2session.php"> Trở về</a>