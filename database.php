<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hesabfa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function executeQuery($sql) {
    global $conn;
    $result = $conn->query($sql);
    if (!$result) {
        error_log("SQL Error: " . $conn->error . " - Query: " . $sql);
        return false;
    }
    return $result;
}

function escapeString($string) {
    global $conn;
    return $conn->real_escape_string($string);
}

function closeConnection() {
    global $conn;
    $conn->close();
}

?>