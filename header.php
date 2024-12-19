<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Base URL for navigation (modify if necessary)
$baseUrl = "/REMOTE_ATTENDANCE"; // Update with your project path
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remote Learning Attendance Tracker</title>
    <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/styles.css">
    <style>
        nav {
            background-color: #0056b3;
            padding: 10px 20px;
        }

        nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav h2 {
            color: #ffffff;
            margin: 0;
            font-size: 1.5rem;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 15px;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            text-decoration: none;
            color: #ffffff;
            font-size: 1rem;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #ffd700;
        }
    </style>
</head>
<body>
    <nav>
        <div class="container">
            <h2>Attendance Tracker</h2>
            <ul>
                <li><a href="<?= $baseUrl ?>/index.php">Home</a></li>
                <li><a href="<?= $baseUrl ?>#about">About</a></li>
                <li><a href="<?= $baseUrl ?>#contact">Contact</a></li>
                <?php if (isset($_SESSION['UserID'])): ?>
                    <li><a href="<?= $baseUrl ?>../auth/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?= $baseUrl ?>../auth/login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
