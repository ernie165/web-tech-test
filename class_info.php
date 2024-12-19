<?php
session_start();
include '../includes/config.php';

// Check if user is logged in and has 'student' role
if (!isset($_SESSION['UserID']) || $_SESSION['Role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch class information (for demonstration purposes, hardcoded here)
// In real scenarios, fetch this from a database table like "ClassSchedules"
$classInfo = [
    ['Course' => 'Mathematics', 'Time' => '8:00 AM - 9:30 AM', 'Room' => '101'],
    ['Course' => 'Science', 'Time' => '10:00 AM - 11:30 AM', 'Room' => '102'],
    ['Course' => 'English', 'Time' => '1:00 PM - 2:30 PM', 'Room' => '103'],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Information</title>
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
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #4a90e2;
            color: #fff;
        }
        .content {
            text-align: center;
            padding: 20px;
        }
        a {
            color: #4a90e2;
            text-decoration: none;
            font-size: 1rem;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Class Information</h1>
    </header>

    <div class="content">
        <h2>Class Schedule</h2>
        <table>
            <tr>
                <th>Course</th>
                <th>Time</th>
                <th>Room</th>
            </tr>
            <?php foreach ($classInfo as $class): ?>
            <tr>
                <td><?php echo htmlspecialchars($class['Course']); ?></td>
                <td><?php echo htmlspecialchars($class['Time']); ?></td>
                <td><?php echo htmlspecialchars($class['Room']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <a href="student_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
