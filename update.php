<?php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentID = $_POST['studentID'];
    $status = $_POST['status'];
    $classID = $_POST['classID'];
    $date = date('Y-m-d');

    $stmt = $conn->prepare("
        INSERT INTO Attendance (ClassID, StudentID, Date, Status) 
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE Status = VALUES(Status)
    ");
    $stmt->bind_param("iiss", $classID, $studentID, $date, $status);
    $stmt->execute();
}
