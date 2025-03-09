<?php
include '../database.php';

// دریافت اطلاعات از فرم
$title = $_POST['title'];
$parent_id = (int)$_POST['parent_id'];

// اعتبارسنجی
if (empty($title)) {
    header("Location: categories.php?message=" . urlencode("عنوان دسته‌بندی الزامی است."));
    exit;
}

// جلوگیری از XSS
$title = htmlspecialchars(escapeString($title));

// درج دسته‌بندی جدید
$sql = "INSERT INTO categories (title, parent_id) VALUES ('$title', $parent_id)";

if (executeQuery($sql)) {
    $message = "دسته‌بندی با موفقیت ایجاد شد.";
} else {
    $message = "خطا در ایجاد دسته‌بندی: " . $conn->error;
}

closeConnection();
header("Location: categories.php?message=" . urlencode($message));
exit;
?>