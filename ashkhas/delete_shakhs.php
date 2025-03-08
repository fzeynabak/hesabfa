<?php

// اتصال به پایگاه داده
include '../database.php';

// دریافت ID شخص از URL
$id = $_GET['id'];

// Query برای حذف شخص
$sql = "DELETE FROM ashkhas WHERE id = " . escapeString($id);

// اجرای Query
if (executeQuery($sql)) {
    $message = "شخص با موفقیت حذف شد.";
} else {
    $message = "خطا در حذف شخص: " . $conn->error;
}

// بستن اتصال
closeConnection();

// انتقال به صفحه لیست اشخاص با پیام
header("Location: ashkhas.php?message=" . urlencode($message));
exit;

?>