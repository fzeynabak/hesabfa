<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hesabfa";

// ایجاد اتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// بررسی اتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// تابع برای اجرای query
function executeQuery($sql) {
    global $conn;
    $result = $conn->query($sql);
    return $result;
}

// تابع برای بستن اتصال
function closeConnection() {
    global $conn;
    $conn->close();
}

// تابع برای جلوگیری از SQL Injection
function escapeString($string) {
    global $conn;
    return $conn->real_escape_string($string);
}

// تنظیم charset به utf8
$conn->set_charset("utf8");

?>