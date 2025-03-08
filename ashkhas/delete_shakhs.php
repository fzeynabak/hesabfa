<?php

// دریافت ID شخص از URL
$id = $_GET['id'];

// اتصال به پایگاه داده
include '../database.php';

// Query برای حذف شخص با ID مشخص
$sql = "DELETE FROM ashkhas WHERE id = " . $id;

// اجرای Query
if (executeQuery($sql)) {
    $message = "شخص با موفقیت حذف شد.";
} else {
    $message = "خطا در حذف شخص: " . $conn->error;
}

// بستن اتصال
closeConnection();

// انتقال به صفحه اصلی با پیام
header("Location: ashkhas.php?message=" . urlencode($message));
exit;

?>