<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Ensure only valid roles are inserted
    if (in_array($role, ['student', 'teacher', 'admin'])) {
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        if ($conn->query($sql) === TRUE) {
            $success = "User registered successfully!";
        } else {
            $error = "Error: " . $conn->error;
        }
    } else {
        $error = "Invalid role!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <h2>Register</h2>

    <?php if (isset($success)) { echo "<p style='color: green;'>$success</p>"; } ?>
    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>

    <form method="post" action="register.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="role">Role:</label>
        <select name="role" required>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
            <option value="admin">Admin</option>
        </select><br>

        <button type="submit">Register</button>
    </form>

    <a href="login.php">Already have an account? Login here.</a>
</body>
</html>
