<?php
session_start();
include '../includes/config.php';

// Check if user is logged in and has 'student' role
if (!isset($_SESSION['UserID']) || $_SESSION['Role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit();
}

$userID = $_SESSION['UserID'];

// Fetch attendance records for the logged-in student
$query = $conn->prepare("SELECT Date, Status FROM Attendance WHERE StudentID = ?");
$query->bind_param("i", $userID);
$query->execute();
$result = $query->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
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
        <h1>Your Attendance Records</h1>
    </header>

    <div class="content">
        <h2>Attendance Details</h2>
        <table>
            <tr>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['Date']); ?></td>
                <td><?php echo htmlspecialchars($row['Status']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="student_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
