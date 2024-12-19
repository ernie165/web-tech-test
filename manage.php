<?php
include '../includes/config.php';

// Redirect if not a teacher
if ($_SESSION['Role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}

$teacherID = $_SESSION['UserID'];
$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $className = trim($_POST['class_name']);
    $classID = $_POST['class_id'] ?? null;

    if (!empty($className)) {
        if ($classID) {
            // Update existing class
            $stmt = $conn->prepare("UPDATE Classes SET ClassName = ? WHERE ClassID = ? AND TeacherID = ?");
            $stmt->bind_param("sii", $className, $classID, $teacherID);
            $stmt->execute();
            $success = "Class updated successfully!";
        } else {
            // Insert new class
            $stmt = $conn->prepare("INSERT INTO Classes (ClassName, TeacherID) VALUES (?, ?)");
            $stmt->bind_param("si", $className, $teacherID);
            $stmt->execute();
            $success = "Class added successfully!";
        }
    } else {
        $error = "Class name cannot be empty.";
    }
}

// Fetch class details for editing
$class = null;
if (isset($_GET['edit'])) {
    $classID = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM Classes WHERE ClassID = ? AND TeacherID = ?");
    $stmt->bind_param("ii", $classID, $teacherID);
    $stmt->execute();
    $result = $stmt->get_result();
    $class = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Class</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="form-container">
        <h2><?= $class ? 'Edit Class' : 'Add New Class' ?></h2>
        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php elseif ($success): ?>
            <p class="success"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="hidden" name="class_id" value="<?= $class['ClassID'] ?? '' ?>">
            <div>
                <label for="class_name">Class Name:</label>
                <input type="text" id="class_name" name="class_name" value="<?= htmlspecialchars($class['ClassName'] ?? '') ?>" required>
            </div>
            <button type="submit"><?= $class ? 'Update' : 'Add' ?> Class</button>
        </form>
        <p><a href="../classes/index.php">Back to Classes</a></p>
    </div>
</body>
</html>
