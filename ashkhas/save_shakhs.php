<?php

// اتصال به پایگاه داده
include '../database.php';

// دریافت اطلاعات از فرم
$code = $_POST['code'];
$company_name = $_POST['company_name'];
$name = $_POST['name'];
$family = $_POST['family'];
$father_name = $_POST['father_name'];
$shenasname = $_POST['shenasname'];
$eghtesadi = $_POST['eghtesadi'];
$shomare_sabt = $_POST['shomare_sabt'];
$phone = $_POST['phone'];
$mobile = $_POST['mobile'];
$fax = $_POST['fax'];
$email = $_POST['email'];
$website = $_POST['website'];
$country = $_POST['country'];
$ostan = $_POST['ostan'];
$shahr = $_POST['shahr'];
$codeposti = $_POST['codeposti'];
$address = $_POST['address'];

// اعتبارسنجی اطلاعات (حداقل نام و نام خانوادگی)
if (empty($name) || empty($family)) {
    $message = "نام و نام خانوادگی الزامی است.";
    header("Location: ../index.php?message=" . urlencode($message));
    exit;
}

// جلوگیری از XSS و SQL Injection
$code = htmlspecialchars(escapeString($code));
$company_name = htmlspecialchars(escapeString($company_name));
$name = htmlspecialchars(escapeString($name));
$family = htmlspecialchars(escapeString($family));
$father_name = htmlspecialchars(escapeString($father_name));
$shenasname = htmlspecialchars(escapeString($shenasname));
$eghtesadi = htmlspecialchars(escapeString($eghtesadi));
$shomare_sabt = htmlspecialchars(escapeString($shomare_sabt));
$phone = htmlspecialchars(escapeString($phone));
$mobile = htmlspecialchars(escapeString($mobile));
$fax = htmlspecialchars(escapeString($fax));
$email = htmlspecialchars(escapeString($email));
$website = htmlspecialchars(escapeString($website));
$country = htmlspecialchars(escapeString($country));
$ostan = htmlspecialchars(escapeString($ostan));
$shahr = htmlspecialchars(escapeString($shahr));
$codeposti = htmlspecialchars(escapeString($codeposti));
$address = htmlspecialchars(escapeString($address));

// Query برای درج اطلاعات در جدول
$sql = "INSERT INTO ashkhas (code, company_name, name, family, father_name, shenasname, eghtesadi, shomare_sabt, phone, mobile, fax, email, website, country, ostan, shahr, codeposti, address) 
VALUES ('$code', '$company_name', '$name', '$family', '$father_name', '$shenasname', '$eghtesadi', '$shomare_sabt', '$phone', '$mobile', '$fax', '$email', '$website', '$country', '$ostan', '$shahr', '$codeposti', '$address')";

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