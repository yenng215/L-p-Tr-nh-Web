<?php
$servername = "sql110.infinityfree.com";  
$username = "if0_37106760";
$password = "5zcyxOEBI8";  
$dbname = "if0_37106760_b5_mydb"; 
global $conn;

function connect_db()
{
    global $conn;
    if (!$conn) {
        try {
            $conn = new PDO("mysql:host=sql110.infinityfree.com;dbname=if0_37106760_qlysinhvien;charset=utf8mb4", "if0_37106760", "5zcyxOEBI8");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Can't connect to database: " . $e->getMessage());
        }
    }
}

function disconnect_db()
{
    global $conn;
    if ($conn) {
        $conn = null;
    }
}

function get_all_students()
{
    global $conn;
    connect_db();

    $sql = "SELECT * FROM sinhvien";
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function get_student($student_id)
{
    global $conn;
    connect_db();
    $sql = "SELECT * FROM sinhvien WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $student_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function add_student($student_name, $student_sex, $student_birthday)
{
    global $conn;
    connect_db();

    $sql = "INSERT INTO sinhvien (hoten, gioitinh, ngaysinh) VALUES (:hoten, :gioitinh, :ngaysinh)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        'hoten' => $student_name,
        'gioitinh' => $student_sex,
        'ngaysinh' => $student_birthday
    ]);
}

function edit_student($student_id, $student_name, $student_sex, $student_birthday)
{
    global $conn;
    connect_db();

    $sql = "UPDATE sinhvien SET hoten = :hoten, gioitinh = :gioitinh, ngaysinh = :ngaysinh WHERE id = :id";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        'hoten' => $student_name,
        'gioitinh' => $student_sex,
        'ngaysinh' => $student_birthday,
        'id' => $student_id
    ]);
}

function delete_student($student_id)
{
    global $conn;
    connect_db();

    $sql = "DELETE FROM sinhvien WHERE id = :id";
    $stmt = $conn->prepare($sql);
    return $stmt->execute(['id' => $student_id]);
}
