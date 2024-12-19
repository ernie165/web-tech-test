<?php
session_start();
include '../includes/config.php';

// Redirect if already logged in
if (isset($_SESSION['UserID'])) {
    header("Location: ../attendance/index.php");
    exit();
}

// Handle registration
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);
    $role = trim($_POST['role']); // New field for role

    // Validate input fields
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($name) && !empty($role) && 
        ($role === 'student' || $role === 'teacher') && strlen($password) >= 6 && $password === $confirmPassword) {
        
        // Check if email already exists
        $query = $conn->prepare("SELECT * FROM Users WHERE Email = ?");
        $query->bind_param('s', $email);
        $query->execute();
        $result = $query->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            $error = "Email is already registered.";
        } else {
            // Insert new user into database
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $insertQuery = $conn->prepare("INSERT INTO Users (Name, Email, PasswordHash, Role) VALUES (?, ?, ?, ?)");
            $insertQuery->bind_param('ssss', $name, $email, $hashedPassword, $role);
            if ($insertQuery->execute()) {
                // Redirect to login page
                header("Location: ../auth/login.php?registered=success");
                exit();
            } else {
                $error = "Error in registration. Please try again.";
            }
        }
    } else {
        $error = "Please provide valid details, ensure passwords match, and select a valid role.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* Base Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background: #f4f4f4;
    min-height: 100vh;
}

/* Hero Section */
.hero {
    background: linear-gradient(135deg, #0056b3, #4a90e2);
    color: white;
    text-align: center;
    padding: 60px 20px;
}

.hero h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

.hero p {
    font-size: 1.2rem;
    max-width: 600px;
    margin: 0 auto;
    opacity: 0.9;
}

/* Form Container */
.form-container {
    max-width: 500px;
    margin: -50px auto 40px;
    padding: 30px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    position: relative;
}

.form-container h2 {
    color: #0056b3;
    font-size: 1.8rem;
    margin-bottom: 30px;
    text-align: center;
}

/* Form Elements */
form {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

form div {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

label {
    font-weight: 500;
    color: #333;
    font-size: 0.95rem;
}

input, select {
    padding: 14px;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fff;
}

input:focus, select:focus {
    outline: none;
    border-color: #0056b3;
    box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.1);
}

select {
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 1em;
    padding-right: 2.5rem;
}

button {
    background-color: #0056b3;
    color: white;
    padding: 16px;
    border: none;
    border-radius: 6px;
    font-size: 1.1rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 10px;
}

button:hover {
    background-color: #003d82;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 86, 179, 0.2);
}

button:active {
    transform: translateY(0);
}

/* Error Message */
.error {
    background-color: #fff3f3;
    color: #dc2626;
    padding: 12px 16px;
    border-radius: 6px;
    margin-bottom: 20px;
    font-size: 0.95rem;
    text-align: center;
    border: 1px solid #fecaca;
}

/* Login Link */
.login-link {
    text-align: center;
    margin-top: 25px;
    font-size: 0.95rem;
    color: #666;
}

.login-link a {
    color: #0056b3;
    text-decoration: none;
    font-weight: 500;
    padding-bottom: 2px;
    border-bottom: 1px solid transparent;
    transition: border-color 0.3s ease;
}

.login-link a:hover {
    border-bottom-color: #0056b3;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero h1 {
        font-size: 2rem;
    }
    
    .hero p {
        font-size: 1.1rem;
    }
    
    .form-container {
        margin: -30px 20px 40px;
        padding: 25px;
    }
}

@media (max-width: 480px) {
    .hero {
        padding: 40px 20px;
    }
    
    .hero h1 {
        font-size: 1.8rem;
    }
    
    .form-container {
        padding: 20px;
    }
    
    input, select, button {
        padding: 12px;
        font-size: 1rem;
    }
    
    .form-container h2 {
        font-size: 1.5rem;
    }
}
        </style>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <!-- Hero Section -->
    <div class="hero">
        <h1>Register for Remote Learning Tracker</h1>
        <p>Join us today and start tracking your attendance and participation in virtual classrooms.</p>
    </div>

    <!-- Registration Form -->
    <div class="form-container">
        <h2>Create an Account</h2>
        
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form id="registerForm" method="POST" action="register.php">
            <div>
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="" disabled selected>Select your role</option>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
            </div>
            <button type="submit">Register</button>
        </form>

        <p class="login-link">Already have an account? <a href="../auth/login.php">Login here</a>.</p>
    </div>

    <!-- Include jQuery and Validations Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/validations.js"></script>
</body>
</html>

