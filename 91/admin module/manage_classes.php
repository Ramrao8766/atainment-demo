<?php
session_start();
include('../db.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Handle Create Class
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_class'])) {
    $class_name = $_POST['class_name'];
    $sql = "INSERT INTO classes (class_name) VALUES ('$class_name')";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Class created successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

// Handle Edit Class
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_class'])) {
    $class_id = $_POST['class_id'];
    $class_name = $_POST['class_name'];
    $sql = "UPDATE classes SET class_name='$class_name' WHERE id='$class_id'";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Class updated successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

// Handle Delete Class
if (isset($_GET['delete_class'])) {
    $class_id = $_GET['delete_class'];
    $sql = "DELETE FROM classes WHERE id='$class_id'";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Class deleted successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

// Fetch all classes
$classes_sql = "SELECT * FROM classes";
$classes_result = $conn->query($classes_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Classes</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>

    <div class="container">
        <h1>Manage Classes</h1>

        <!-- Success or Error Message -->
        <?php if (isset($success_message))
            echo "<p class='success'>$success_message</p>"; ?>
        <?php if (isset($error_message))
            echo "<p class='error'>$error_message</p>"; ?>

        <!-- Create Class Form -->
        <h2>Create New Class</h2>
        <form method="POST">
            <label for="class_name">Class Name:</label>
            <input type="text" name="class_name" required><br>
            <button type="submit" name="create_class">Create Class</button>
        </form>

        <!-- List of Classes -->
        <h2>Registered Classes</h2>
        <table border="1px">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Class Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($classes_result->num_rows > 0) {
                    while ($class = $classes_result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $class['id']; ?></td>
                            <td><?php echo $class['class_name']; ?></td>
                            <td>
                                <!-- Edit Class Form -->
                                <form method="POST" style="display:inline-block;">
                                    <input type="hidden" name="class_id" value="<?php echo $class['id']; ?>">
                                    <input type="text" name="class_name" value="<?php echo $class['class_name']; ?>" required>
                                    <button type="submit" name="edit_class">Update</button>
                                </form>
                                <!-- Delete Class -->
                                <a href="?delete_class=<?php echo $class['id']; ?>"
                                    onclick="return confirm('Are you sure you want to delete this class?');">Delete</a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="3">No classes found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="admin_dashboard.php">Back to Dashboard</a>
    </div>

</body>

</html>