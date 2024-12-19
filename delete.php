<?php
include '../includes/config.php';

// Redirect if not a teacher
if ($_SESSION['Role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}

if (isset($_GET['id'])) {
    $classID = $_GET['id'];
    $teacherID = $_SESSION['UserID'];

    $stmt = $conn->prepare("DELETE FROM Classes WHERE ClassID = ? AND TeacherID = ?");
    $stmt->bind_param("ii", $classID, $teacherID);
    $stmt->execute();

    header("Location: ../classes/index.php?deleted=success");
    exit();
}
