<?php

// اتصال به پایگاه داده
include '../database.php';

// دریافت اطلاعات از فرم
$name = $_POST['name'];
$family = $_POST['family'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// اعتبارسنجی اطلاعات
if (empty($name) || empty($family)) {
    $message = "نام و نام خانوادگی الزامی است.";
    header("Location: ../index.php?message=" . urlencode($message));
    exit;
}

// جلوگیری از XSS و SQL Injection
$name = htmlspecialchars(escapeString($name));
$family = htmlspecialchars(escapeString($family));
$phone = htmlspecialchars(escapeString($phone));
$address = htmlspecialchars(escapeString($address));

// Query برای درج اطلاعات در جدول
$sql = "INSERT INTO ashkhas (name, family, phone, address) VALUES ('$name', '$family', '$phone', '$address')";

// اجرای Query
if (executeQuery($sql)) {
    $message = "اطلاعات شخص با موفقیت ذخیره شد.";
} else {
    $message = "خطا در ذخیره اطلاعات: " . $conn->error;
}

// بستن اتصال
closeConnection();

// انتقال به صفحه اصلی با پیام
header("Location: ../index.php?message=" . urlencode($message));
exit;

?>