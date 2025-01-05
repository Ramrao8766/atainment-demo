<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
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
        <h1>Admin Dashboard</h1>
        <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>

        <!-- Navigation Buttons -->
        <div class="dashboard-links">
            <button onclick="window.location.href='admin module/manage_classes.php'">Manage Classes</button>
            <button onclick="window.location.href='admin module/manage_subjects.php'">Manage Subjects</button>
            <button onclick="window.location.href='admin module/assign_roles.php'">Assign Students & Teachers</button>
        </div>

        <!-- Logout Link -->
        <a href="logout.php">Logout</a>
    </div>

</body>

</html>