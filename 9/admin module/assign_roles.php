<?php
session_start();
include('../db.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch necessary data
$class_result = $conn->query("SELECT * FROM classes");
$subject_result = $conn->query("SELECT * FROM subjects");
$student_result = $conn->query("SELECT id, username FROM users WHERE role = 'student'");
$teacher_result = $conn->query("SELECT id, username FROM users WHERE role = 'teacher'");

// Handle form submissions (assignments)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['assign_student'])) {
        $class_id = $_POST['class_id'];
        $student_id = $_POST['student_id'];
        $sql = "INSERT INTO class_student (class_id, student_id) VALUES ('$class_id', '$student_id')";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Student assigned to class successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }

    if (isset($_POST['assign_teacher'])) {
        $subject_id = $_POST['subject_id'];
        $teacher_id = $_POST['teacher_id'];
        $sql = "INSERT INTO subject_teacher (subject_id, teacher_id) VALUES ('$subject_id', '$teacher_id')";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Teacher assigned to subject successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Roles</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>

    <div class="container">
        <h1>Assign Students and Teachers</h1>

        <!-- Success or Error Message -->
        <?php if (isset($success_message))
            echo "<p class='success'>$success_message</p>"; ?>
        <?php if (isset($error_message))
            echo "<p class='error'>$error_message</p>"; ?>

        <!-- Assign Student to Class -->
        <h2>Assign Student to Class</h2>
        <form method="POST">
            <label for="class_id">Select Class:</label>
            <select name="class_id" required>
                <?php while ($class = $class_result->fetch_assoc()) { ?>
                    <option value="<?php echo $class['id']; ?>"><?php echo $class['class_name']; ?></option>
                <?php } ?>
            </select><br>
            <label for="student_id">Select Student:</label>
            <select name="student_id" required>
                <?php while ($student = $student_result->fetch_assoc()) { ?>
                    <option value="<?php echo $student['id']; ?>"><?php echo $student['username']; ?></option>
                <?php } ?>
            </select><br>
            <button type="submit" name="assign_student">Assign Student</button>
        </form>

        <!-- Assign Teacher to Subject -->
        <h2>Assign Teacher to Subject</h2>
        <form method="POST">
            <label for="subject_id">Select Subject:</label>
            <select name="subject_id" required>
                <?php while ($subject = $subject_result->fetch_assoc()) { ?>
                    <option value="<?php echo $subject['id']; ?>"><?php echo $subject['subject_name']; ?></option>
                <?php } ?>
            </select><br>
            <label for="teacher_id">Select Teacher:</label>
            <select name="teacher_id" required>
                <?php while ($teacher = $teacher_result->fetch_assoc()) { ?>
                    <option value="<?php echo $teacher['id']; ?>"><?php echo $teacher['username']; ?></option>
                <?php } ?>
                </ </select><br>
                <button type="submit" name="assign_teacher">Assign Teacher</button>
        </form>

        <!-- Back to Dashboard -->
        <a href="admin_dashboard.php">Back to Dashboard</a>
    </div>

</body>

</html>