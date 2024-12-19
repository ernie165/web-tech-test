<?php 
session_start();
include '../includes/config.php';

// Redirect if already logged in
if (isset($_SESSION['UserID'])) {
    if ($_SESSION['Role'] === 'teacher') {
        header("Location: ../teacher/teacher_dashboard.php");
    } elseif ($_SESSION['Role'] === 'student') {
        header("Location: ../student/student_dashboard.php");
    }
    exit();
}

// Handle login
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $passwordInput = trim($_POST['PasswordHash']); // User-entered password

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($passwordInput)) {
        // Prepare SELECT query
        $query = $conn->prepare("SELECT * FROM Users WHERE Email = ?");
        $query->bind_param('s', $email);
        $query->execute();
        $result = $query->get_result();
        $user = $result->fetch_assoc();

        // Verify user and password
        if ($user && password_verify($passwordInput, $user['PasswordHash'])) {
            // Set session variables
            $_SESSION['UserID'] = $user['UserID'];
            $_SESSION['Role'] = $user['Role'];

            // Redirect based on role
            if ($user['Role'] === 'teacher') {
                header("Location: ../teacher/teacher_dashboard.php");
                exit();
            } elseif ($user['Role'] === 'student') {
                header("Location: ../student/student_dashboard.php");
                exit();
            }
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Please provide a valid email and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form id="loginForm" method="POST" action="login.php">
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="PasswordHash">Password:</label>
                <input type="password" id="PasswordHash" name="PasswordHash" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p class="login-link">Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>
</html>


