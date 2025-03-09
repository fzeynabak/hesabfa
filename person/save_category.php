<?php
include '../database.php';

// تنظیم هدر برای پاسخ JSON
header('Content-Type: application/json; charset=utf-8');

try {
    // دریافت داده‌ها از فرم
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('درخواست نامعتبر است');
    }

    // بررسی و پاکسازی داده‌های ورودی
    $id = isset($_POST['id']) && !empty($_POST['id']) ? (int)$_POST['id'] : null;
    $code = isset($_POST['code']) ? trim($_POST['code']) : '';
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $parent_id = !empty($_POST['parent_id']) ? (int)$_POST['parent_id'] : null;
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $status = isset($_POST['status']) ? (int)$_POST['status'] : 1;

    // اعتبارسنجی داده‌ها
    if (empty($name)) {
        throw new Exception('نام دسته‌بندی الزامی است');
    }

    // بررسی تکراری نبودن نام
    $check_sql = "SELECT id FROM categories WHERE name = ? AND id != COALESCE(?, 0)";
    $stmt = $connection->prepare($check_sql);
    $stmt->bind_param("si", $name, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        throw new Exception('دسته‌بندی با این نام قبلاً ثبت شده است');
    }

    if ($id) {
        // به‌روزرسانی دسته‌بندی موجود
        $sql = "UPDATE categories SET 
                code = ?, 
                name = ?, 
                parent_id = ?, 
                description = ?, 
                status = ? 
                WHERE id = ?";
        
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssissi", $code, $name, $parent_id, $description, $status, $id);
        $message = 'دسته‌بندی با موفقیت به‌روزرسانی شد';
    } else {
        // افزودن دسته‌بندی جدید
        $sql = "INSERT INTO categories (code, name, parent_id, description, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssisi", $code, $name, $parent_id, $description, $status);
        $message = 'دسته‌بندی جدید با موفقیت ایجاد شد';
    }

    // اجرای کوئری
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => $message,
            'id' => $id ?? $connection->insert_id
        ], JSON_UNESCAPED_UNICODE);
    } else {
        throw new Exception('خطا در ذخیره‌سازی اطلاعات');
    }

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}