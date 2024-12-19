<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remote Learning Attendance Tracker</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        /* Additional styling for the home page */
        .hero {
            text-align: center;
            padding: 50px;
            background: linear-gradient(135deg, #0056b3, #4a90e2);
            color: #ffffff;
            min-height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .hero .get-started {
            display: inline-block;
            padding: 15px 30px;
            font-size: 1.1rem;
            color: #fff;
            background-color: #f05656;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .hero .get-started:hover {
            background-color: #d04545;
        }

        .hero .login-link {
            margin-top: 15px;
            font-size: 1rem;
            color: #ffffff;
        }

        .hero .login-link a {
            color: #ffd700;
            text-decoration: underline;
        }

        .hero .login-link a:hover {
            text-decoration: none;
        }
        /* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: #333;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Navigation Bar */
nav {
    background-color: #ffffff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
}

nav .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
}

nav h2 {
    color: #0056b3;
    font-size: 1.5rem;
}

nav ul {
    display: flex;
    list-style: none;
    gap: 30px;
}

nav ul li a {
    color: #333;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

nav ul li a:hover {
    color: #0056b3;
}

/* Hero Section */
.hero {
    margin-top: 60px; /* Account for fixed navbar */
    background: linear-gradient(135deg, #0056b3, #4a90e2);
    padding: 100px 20px;
    text-align: center;
    color: white;
}

.hero h1 {
    font-size: 3.5rem;
    margin-bottom: 30px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

.hero p {
    font-size: 1.4rem;
    max-width: 800px;
    margin: 0 auto 40px;
    opacity: 0.9;
}

.get-started {
    background-color: #f05656;
    color: white;
    padding: 15px 40px;
    border-radius: 30px;
    font-size: 1.2rem;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.get-started:hover {
    background-color: #d04545;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

.login-link {
    margin-top: 20px;
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.9);
}

.login-link a {
    color: #ffd700;
    text-decoration: none;
    font-weight: 500;
    border-bottom: 1px solid transparent;
    transition: border-color 0.3s ease;
}

.login-link a:hover {
    border-bottom-color: #ffd700;
}

/* About and Contact Sections */
section {
    padding: 80px 20px;
}

section h2 {
    font-size: 2.5rem;
    color: #0056b3;
    margin-bottom: 30px;
    text-align: center;
}

section p {
    font-size: 1.2rem;
    color: #666;
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
    line-height: 1.8;
}

section a {
    color: #0056b3;
    text-decoration: none;
    border-bottom: 1px solid transparent;
    transition: border-color 0.3s ease;
}

section a:hover {
    border-bottom-color: #0056b3;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero h1 {
        font-size: 2.5rem;
    }

    .hero p {
        font-size: 1.2rem;
    }

    nav .container {
        flex-direction: column;
        gap: 15px;
    }

    nav ul {
        gap: 15px;
    }

    section {
        padding: 60px 20px;
    }

    section h2 {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .hero h1 {
        font-size: 2rem;
    }

    .hero p {
        font-size: 1.1rem;
    }

    .get-started {
        padding: 12px 30px;
        font-size: 1.1rem;
    }

    nav ul {
        flex-direction: column;
        text-align: center;
    }
}
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="container">
            <h2>Attendance Tracker</h2>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Welcome to the Remote Learning Attendance Tracker</h1>
        <p>Effortlessly track attendance for virtual classrooms, manage sessions, and generate insightful reports.</p>
        <a href="auth/register.php" class="get-started">Get Started</a>
<p class="login-link">
    Already registered? <a href="auth/login.php">Login here</a>.
</p>

        </p>
    </div>

    <!-- About Section -->
    <section id="about" class="container">
        <h2>About Our Platform</h2>
        <p>Our attendance tracker simplifies the process of managing virtual classroom attendance. Teachers can manage classes, record attendance, and generate detailed reports with ease.</p>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="container">
        <h2>Contact Us</h2>
        <p>Have questions or need help? Reach out to us at <a href="mailto:support@attendance-tracker.com">support@attendance-tracker.com</a>.</p>
    </section>
</body>
</html>
