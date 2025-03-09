<?php
header('Content-Type: application/json; charset=utf-8');

// تنظیمات اتصال به دیتابیس
require_once '../../config/database.php';

try {
    // دریافت پارامتر جستجو
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    
    // ایجاد اتصال به دیتابیس
    $pdo = new PDO("mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset=utf8mb4", 
                   $db_config['username'], 
                   $db_config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ساخت کوئری
    $query = "SELECT id, name, code FROM categories WHERE 1=1";
    $params = [];

    if (!empty($search)) {
        $query .= " AND (name LIKE :search OR code LIKE :search)";
        $params[':search'] = '%' . $search . '%';
    }

    $query .= " ORDER BY name ASC";

    // اجرای کوئری
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // برگرداندن نتیجه
    echo json_encode([
        'status' => 'success',
        'data' => $categories
    ], JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    // در صورت بروز خطا
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'خطا در ارتباط با پایگاه داده',
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}