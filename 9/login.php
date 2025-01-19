<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to get the user details along with their role
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];  // Save role in session

        // Redirect user based on their role
        if ($user['role'] == 'student') {
            header("Location: student_dashboard.php");
        } elseif ($user['role'] == 'teacher') {
            header("Location: teacher_dashboard.php");
        } elseif ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        }
    } else {
        $error = "Invalid credentials!";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    header("Location: register.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <style>
        :root {
            /* Color Variables */
            --primary-color: #007bff;
            --primary-hover: #0056b3;
            --success-color: #28a745;
            --success-hover: #218838;
            --error-color: #ff4d4f;
            --background-color: #e9ecef;
            --text-color: #333;
            --white: #fff;
        }

        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form Container */
        form {
            background-color: var(--white);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
            margin-bottom: 10px;
            /* Add spacing between the two forms */
        }

        h2 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
            color: var(--text-color);
        }

        /* Input Fields */
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        /* Buttons */
        button {
            outline: 10px;
            width: 100%;
            padding: 12px;
            font-size: 1.1rem;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background-color: var(--primary-hover);
            transform: scale(1.05);
        }

        button:focus {
            outline: none;
        }

        /* Register Button Styling */
        button[type="submit"][name="register"] {
            background-color: var(--success-color);
        }

        button[type="submit"][name="register"]:hover {
            background-color: var(--success-hover);
        }

        /* Error Message */
        p {
            text-align: center;
            color: var(--error-color);
            font-size: 1rem;
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h2 {
                font-size: 1.8rem;
            }

            input[type="text"],
            input[type="password"],
            button {
                font-size: 1rem;
                padding: 10px;
            }
        }
    </style>

</head>

<body>

    <form method="post" action="login.php">
        <h2>Login</h2>

        <?php if (isset($error)) {
            echo "<p style='color: red;'>$error</p>";
        } ?>
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit" name="login">Login</button>

        <button type="submit" name="register">Register</button>
    </form>

</body>

</html>