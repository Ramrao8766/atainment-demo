<?php
session_start();
include('db.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validate the role
    if (in_array($role, ['student', 'teacher'])) {
        // Insert new user into the database
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        if ($conn->query($sql) === TRUE) {
            $success_message = "User added successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    } else {
        $error_message = "Invalid role!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Welcome, <?php echo $_SESSION['username']; ?> (Admin)</h1>

    <!-- Display success or error message -->
    <?php if (isset($success_message)) { echo "<p class='success'>$success_message</p>"; } ?>
    <?php if (isset($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>

    <h2>Add New User</h2>
    <form method="POST" action="admin_dashboard.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="role">Role:</label>
        <select name="role" required>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select><br>

        <button type="submit" name="add_user">Add User</button>
    </form>

    <!-- Logout Link -->
    <a href="logout.php">Logout</a>
</div>

</body>
</html>
