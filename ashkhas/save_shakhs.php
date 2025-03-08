<?php

// اتصال به پایگاه داده
include '../database.php';

// دریافت اطلاعات از فرم (قسمت بالای صفحه)
$code_hesabdari = $_POST['code_hesabdari'];
$company = $_POST['company'];
$title = $_POST['title'];
$name = $_POST['name'];
$family = $_POST['family'];
$nickname = $_POST['nickname'];
$category = $_POST['category'];

//دریافت اطلاعات مربوط به نوع شخص
$type_customer = isset($_POST['type_customer']) ? 1 : 0;
$type_supplier = isset($_POST['type_supplier']) ? 1 : 0;
$type_shareholder = isset($_POST['type_shareholder']) ? 1 : 0;
$type_employee = isset($_POST['type_employee']) ? 1 : 0;

// اعتبارسنجی اطلاعات (حداقل نام و نام خانوادگی)
if (empty($name) || empty($family)) {
    $message = "نام و نام خانوادگی الزامی است.";
    header("Location: ../index.php?message=" . urlencode($message));
    exit;
}

// جلوگیری از XSS و SQL Injection
$code_hesabdari = htmlspecialchars(escapeString($code_hesabdari));
$company = htmlspecialchars(escapeString($company));
$title = htmlspecialchars(escapeString($title));
$name = htmlspecialchars(escapeString($name));
$family = htmlspecialchars(escapeString($family));
$nickname = htmlspecialchars(escapeString($nickname));
$category = htmlspecialchars(escapeString($category));

// Query برای درج اطلاعات در جدول
$sql = "INSERT INTO ashkhas (code_hesabdari, company, title, name, family, nickname, category, type_customer, type_supplier, type_shareholder, type_employee) 
VALUES ('$code_hesabdari', '$company', '$title', '$name', '$family', '$nickname', '$category', '$type_customer', '$type_supplier', '$type_shareholder', '$type_employee')";

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