<?php
$host = 'localhost';
$db = 'webtech_fall2024_ernest_smart';
$user = 'ernest.smart';
$pass = 'greatiscisco';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
