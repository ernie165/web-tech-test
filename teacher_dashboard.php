<?php
session_start();

// Check if user is logged in and has 'teacher' role
if (!isset($_SESSION['UserID']) || $_SESSION['Role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            color: #333;
        }
        header {
            background-color: #0056b3;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .nav {
            display: flex;
            justify-content: center;
            background-color: #003d80;
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
            background-color: #0056b3;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Teacher Dashboard</h1>
        <p>Welcome to your management portal</p>
    </header>

    <div class="nav">
        <a href="../attendance/manage.php">Manage Attendance</a>
        <a href="../attendance/report.php">View Reports</a>
        <a href="../teacher/manage_students.php">Manage Students</a>
        <a href="../auth/logout.php">Logout</a>
    </div>

    <div class="content">
        <h2>Dashboard Overview</h2>
        <p>Use the navigation menu to manage attendance, view student reports, or update student information.</p>
    </div>

    <footer>
        <p>&copy; 2024 Remote Attendance System. All Rights Reserved.</p>
    </footer>
</body>
</html>
