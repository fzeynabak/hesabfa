<?php
session_start();
require_once('../includes/db_connect.php');

if (isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];
    
    try {
        // ابتدا اطلاعات تصویر دسته‌بندی را دریافت می‌کنیم
        $stmt = $pdo->prepare("SELECT image FROM categories WHERE id = ?");
        $stmt->execute([$category_id]);
        $category = $stmt->fetch();
        
        if ($category && $category['image']) {
            // حذف فایل تصویر از سرور
            $image_path = __DIR__ . '/uploads/categories/' . basename($category['image']);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        
        // حذف دسته‌بندی از دیتابیس
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
        $result = $stmt->execute([$category_id]);
        
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'دسته‌بندی با موفقیت حذف شد']);
        } else {
            throw new Exception("خطا در حذف دسته‌بندی");
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['status' => 'error', 'message' => 'خطا در ارتباط با سرور']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'شناسه دسته‌بندی یافت نشد']);
}