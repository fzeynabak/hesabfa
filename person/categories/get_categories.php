<?php
header('Content-Type: application/json; charset=utf-8');

// اتصال به دیتابیس
require_once '../../config/database.php';

try {
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    
    // اتصال به دیتابیس
    $conn = new mysqli($db_config['host'], $db_config['username'], $db_config['password'], $db_config['dbname']);
    
    // تنظیم کاراکترست به UTF8
    $conn->set_charset("utf8");

    if ($conn->connect_error) {
        throw new Exception("خطا در اتصال به پایگاه داده: " . $conn->connect_error);
    }

    // ساخت کوئری
    $query = "SELECT id, name, code FROM person_categories WHERE 1=1";
    if (!empty($search)) {
        $search = $conn->real_escape_string($search);
        $query .= " AND (name LIKE '%$search%' OR code LIKE '%$search%')";
    }
    $query .= " ORDER BY name ASC";

    $result = $conn->query($query);
    
    $categories = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = [
                'id' => (int)$row['id'],
                'name' => $row['name'],
                'code' => $row['code']
            ];
        }
    }

    echo json_encode([
        'status' => 'success',
        'data' => $categories
    ], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}