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
    <link rel="stylesheet" href="styles.css">


</head>

<body>
    <h2>Login</h2>

    <?php if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    } ?>

    <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit" name="login">Login</button>
    </form>

    <form method="post" action="login.php">
        <button type="submit" name="register">Register</button>
    </form>
</body>

</html>