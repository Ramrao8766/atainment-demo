<?php
session_start();
include('../db.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Handle Create Subject
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_subject'])) {
    $subject_name = $_POST['subject_name'];
    $sql = "INSERT INTO subjects (subject_name) VALUES ('$subject_name')";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Subject created successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Subjects</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>

    <div class="container">
        <h1>Manage Subjects</h1>

        <!-- Success or Error Message -->
        <?php if (isset($success_message))
            echo "<p class='success'>$success_message</p>"; ?>
        <?php if (isset($error_message))
            echo "<p class='error'>$error_message</p>"; ?>

        <!-- Create Subject Form -->
        <form method="POST">
            <label for="subject_name">Subject Name:</label>
            <input type="text" name="subject_name" required><br>
            <button type="submit" name="create_subject">Create Subject</button>
        </form>

        <a href="admin_dashboard.php">Back to Dashboard</a>
    </div>

</body>

</html>