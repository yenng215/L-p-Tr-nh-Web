<?php
global $conn;

function connect_db() {
    global $conn;
    try {
        $conn = new PDO("mysql:host=sql110.infinityfree.com;dbname=if0_37106760_employee_db;charset=utf8mb4", "if0_37106760", "5zcyxOEBI8");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Lỗi kết nối: " . $e->getMessage();
    }
}

function disconnect_db() {
    global $conn;
    $conn = null;
}

function get_all_employees() {
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("SELECT employees.employee_id, employees.first_name, employees.last_name, departments.department_name, employeeroles.role_name 
                                  FROM employees 
                                  JOIN departments ON employees.department_id = departments.department_id 
                                  JOIN employeeroles ON employees.role_id = employeeroles.role_id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

// Hàm lấy nhân viên theo ID
function get_employees($employee_id) {
    global $conn;
    connect_db();
    $stmt = $conn->prepare("SELECT * FROM employees WHERE employee_id = ?");
    $stmt->execute([$employee_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hàm thêm nhân viên
function add_employee($firstname, $lastname, $department_id, $role_id) {
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("INSERT INTO employees (first_name, last_name, department_id, role_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$firstname, $lastname, $department_id, $role_id]);
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

// Hàm sửa nhân viên
function edit_employee($employee_id, $firstname, $lastname, $department_id, $role_id) {
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("UPDATE employees SET first_name = ?, last_name = ?, department_id = ?, role_id = ? WHERE employee_id = ?");
        $stmt->execute([$firstname, $lastname, $department_id, $role_id, $employee_id]);
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

// Hàm xóa nhân viên
function delete_employee($employee_id) {
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("DELETE FROM employees WHERE employee_id = ?");
        $stmt->execute([$employee_id]);
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

// Hàm lấy tất cả phòng ban
function get_all_departments() {
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("SELECT * FROM departments");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

// Hàm lấy tất cả chức vụ
function get_all_roles() {
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("SELECT * FROM employeeroles");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

// Hàm thêm phòng ban
function add_department($department_name) {
  global $conn;
  connect_db();
  try {
      $stmt = $conn->prepare("INSERT INTO departments (department_name) VALUES (:department_name)");
      $stmt->bindParam(':department_name', $department_name);
      $stmt->execute();
  } catch (PDOException $e) {
      echo "Lỗi: " . $e->getMessage();
  }
}

function edit_department($department_id, $department_name) {
  global $conn;
  connect_db();
  try {
      $stmt = $conn->prepare("UPDATE departments SET department_name = :department_name WHERE department_id = :department_id");
      $stmt->bindParam(':department_name', $department_name);
      $stmt->bindParam(':department_id', $department_id);
      $stmt->execute();
  } catch (PDOException $e) {
      echo "Lỗi: " . $e->getMessage();
  }
}

function delete_department($department_id) {
  global $conn;
  connect_db();
  try {
      $stmt = $conn->prepare("DELETE FROM departments WHERE department_id = :department_id");
      $stmt->bindParam(':department_id', $department_id);
      $stmt->execute();
  } catch (PDOException $e) {
      echo "Lỗi: " . $e->getMessage();
  }
}



function get_department($department_id) {
  global $conn;
  connect_db();
  try {
    
      $stmt = $conn->prepare("SELECT * FROM departments WHERE department_id = :department_id");
      $stmt->bindParam(':department_id', $department_id);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      echo "Lỗi: " . $e->getMessage();
  }
}

// Hàm thêm chức vụ
function add_role($role_name) {
  global $conn;
  connect_db();
  try {
      $stmt = $conn->prepare("INSERT INTO employeeroles (role_name) VALUES (:role_name)");
      $stmt->bindParam(':role_name', $role_name);
      $stmt->execute();
  } catch (PDOException $e) {
      echo "Lỗi: " . $e->getMessage();
  }
}

function edit_role($role_id, $role_name) {
  global $conn;
  connect_db();
  try {
      $stmt = $conn->prepare("UPDATE employeeroles SET role_name = :role_name WHERE role_id = :role_id");
      $stmt->bindParam(':role_name', $role_name);
      $stmt->bindParam(':role_id', $role_id);
      $stmt->execute();
  } catch (PDOException $e) {
      echo "Lỗi: " . $e->getMessage();
  }
}

function delete_role($role_id) {
  global $conn;
  connect_db();
  try {
      $stmt = $conn->prepare("DELETE FROM employeeroles WHERE role_id = :role_id");
      $stmt->bindParam(':role_id', $role_id);
      $stmt->execute();
  } catch (PDOException $e) {
      echo "Lỗi: " . $e->getMessage();
  }
}



function get_role($role_id) {
  global $conn;
  connect_db();
  try {
      $stmt = $conn->prepare("SELECT * FROM employeeroles WHERE role_id = :role_id");
      $stmt->bindParam(':role_id', $role_id);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      echo "Lỗi: " . $e->getMessage();
  }
}
?>
