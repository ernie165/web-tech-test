<?php
session_start();

// Check if user is logged in and has 'student' role
if (!isset($_SESSION['UserID']) || $_SESSION['Role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fafc;
            color: #333;
        }
        header {
            background-color: #4a90e2;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .nav {
            display: flex;
            justify-content: center;
            background-color: #0056b3;
            padding: 10px;
        }
        .nav a {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
            font-size: 1.1rem;
        }
        .nav a:hover {
            text-decoration: underline;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #4a90e2;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Student Dashboard</h1>
        <p>Welcome to your attendance portal</p>
    </header>

    <div class="nav">
        <a href="view_attendance.php">View Attendance</a>
        <a href="class_info.php">Class Information</a>
        <a href="../auth/logout.php">Logout</a>
    </div>

    <div class="content">
        <h2>Dashboard Overview</h2>
        <p>Use the navigation menu to view your attendance records or get class information.</p>
    </div>

    <footer>
        <p>&copy; 2024 Remote Attendance System. All Rights Reserved.</p>
    </footer>
</body>
</html>
