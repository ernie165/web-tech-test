<?php
session_start();
include '../includes/config.php';

// Check if user is logged in and has 'teacher' role
if (!isset($_SESSION['UserID']) || $_SESSION['Role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}

// Variables
$error = '';
$success = '';

// Handle Add New Student
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_student'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $insert = $conn->prepare("INSERT INTO Users (Name, Email, PasswordHash, Role) VALUES (?, ?, ?, 'student')");
        $insert->bind_param("sss", $name, $email, $password);
        if ($insert->execute()) {
            $success = "Student added successfully!";
        } else {
            $error = "Failed to add student.";
        }
    } else {
        $error = "Please provide a valid name, email, and password.";
    }
}

// Handle Delete Student
if (isset($_GET['delete'])) {
    $studentID = intval($_GET['delete']);
    $delete = $conn->prepare("DELETE FROM Users WHERE UserID = ? AND Role = 'student'");
    $delete->bind_param("i", $studentID);
    if ($delete->execute()) {
        $success = "Student deleted successfully!";
    } else {
        $error = "Failed to delete student.";
    }
}

// Fetch all students
$students = $conn->query("SELECT UserID, Name, Email FROM Users WHERE Role = 'student'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            color: #333;
        }
        header {
            background-color: #4a90e2;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        table th {
            background-color: #4a90e2;
            color: white;
        }
        .actions a {
            text-decoration: none;
            color: red;
            margin: 0 5px;
        }
        .success, .error {
            color: green;
            margin-bottom: 20px;
            text-align: center;
        }
        .error {
            color: red;
        }
        form input, form button {
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            box-sizing: border-box;
        }
        button {
            background-color: #4a90e2;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #357ab8;
        }
    </style>
</head>
<body>
    <header>
        <h1>Manage Students</h1>
    </header>

    <div class="container">
        <!-- Success and Error Messages -->
        <?php if ($success): ?>
            <p class="success"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <!-- Add Student Form -->
        <h2>Add New Student</h2>
        <form method="POST" action="manage_students.php">
            <input type="text" name="name" placeholder="Student Name" required>
            <input type="email" name="email" placeholder="Student Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="add_student">Add Student</button>
        </form>

        <!-- Student List -->
        <h2>Students List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php while ($student = $students->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($student['UserID']); ?></td>
                <td><?php echo htmlspecialchars($student['Name']); ?></td>
                <td><?php echo htmlspecialchars($student['Email']); ?></td>
                <td class="actions">
                    <a href="?delete=<?php echo $student['UserID']; ?>" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <p><a href="teacher_dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
