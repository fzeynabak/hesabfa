<?php

// اتصال به پایگاه داده
include '../database.php';

// دریافت اطلاعات از فرم
$id = $_POST['id'];
$name = $_POST['name'];
$family = $_POST['family'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// اعتبارسنجی اطلاعات
if (empty($name) || empty($family)) {
    $message = "نام و نام خانوادگی الزامی است.";
    header("Location: edit_shakhs.php?id=" . $id . "&message=" . urlencode($message));
    exit;
}

// جلوگیری از XSS و SQL Injection
$id = htmlspecialchars(escapeString($id));
$name = htmlspecialchars(escapeString($name));
$family = htmlspecialchars(escapeString($family));
$phone = htmlspecialchars(escapeString($phone));
$address = htmlspecialchars(escapeString($address));

// Query برای به‌روزرسانی اطلاعات در جدول
$sql = "UPDATE ashkhas SET name = '$name', family = '$family', phone = '$phone', address = '$address' WHERE id = " . $id;

// اجرای Query
if (executeQuery($sql)) {
    $message = "اطلاعات شخص با موفقیت به‌روزرسانی شد.";
} else {
    $message = "خطا در به‌روزرسانی اطلاعات: " . $conn->error;
}

// بستن اتصال
closeConnection();

// انتقال به صفحه لیست اشخاص با پیام
header("Location: ashkhas.php?message=" . urlencode($message));
exit;

?>