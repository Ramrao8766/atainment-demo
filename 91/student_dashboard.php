<?php
session_start();
include('db.php');

// Check if the user is logged in and is a student
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit;
}

// Get the logged-in user's ID from the session
$username = $_SESSION['username'];

// Fetch the user's ID from the database
$sql = "SELECT id FROM users WHERE username = '$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
$userId = $user['id'];

// Fetch the classes the student is registered in
$classList = [];
$sql = "
    SELECT c.class_name 
    FROM class_student cs 
    INNER JOIN classes c ON cs.class_id = c.id 
    WHERE cs.student_id = '$userId'
";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $classList[] = $row['class_name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <h2>Student Dashboard</h2>

        <!-- Display registered classes -->
        <h3>Your Registered Classes:</h3>
        <?php if (!empty($classList)) { ?>
            <ul>
                <?php foreach ($classList as $className) { ?>
                    <li><?php echo htmlspecialchars($className); ?></li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <p>You are not registered in any classes.</p>
        <?php } ?>

        <!-- Logout -->
        <a href="logout.php">Logout</a>
    </div>
</body>

</html>