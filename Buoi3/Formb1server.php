<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>

    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>  

<?php
$tenErr = $emailErr = $gioitinhErr = $websiteErr = "";
$ten = $email = $gioitinh = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $tenErr = "Nhập tên của bạn";
  } else {
    $ten = test_input($_POST["name"]);
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Nhập email của bạn";
  } else {
    $email = test_input($_POST["email"]);
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $gioitinhErr = "Chọn giới tính";
  } else {
    $gioitinh = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>FORM</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Tên: <input type="text" name="name">
  <span class="error"><?php echo $tenErr;?></span>
  <br><br>
  Email: <input type="text" name="email">
  <span class="error"><?php echo $emailErr;?></span>
  <br><br>
  Trang web: <input type="text" name="website">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  Nhận xét: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Giới tính:
  <input type="radio" name="gender" value="female">Nữ
  <input type="radio" name="gender" value="male">Nam
  <input type="radio" name="gender" value="other">Khác
  <span class="error"><?php echo $gioitinhErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Gửi">  
</form>

<?php
echo "<h2>Thông Tin Bạn Nhập:</h2>";
echo "Tên: " . $ten;
echo "<br>";
echo "Email: " . $email;
echo "<br>";
echo "Trang web: " . $website;
echo "<br>";
echo "Nhận xét: " . $comment;
echo "<br>";
echo "Giới tính: " . $gioitinh;
?>

</body>
</html>
