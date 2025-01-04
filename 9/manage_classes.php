<?php
session_start();
include('db.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch all classes, subjects, students, and teachers for selection
$class_sql = "SELECT * FROM classes";
$class_result = $conn->query($class_sql);

$subject_sql = "SELECT * FROM subjects";
$subject_result = $conn->query($subject_sql);

$student_sql = "SELECT id, username FROM users WHERE role = 'student'";
$student_result = $conn->query($student_sql);

$teacher_sql = "SELECT id, username FROM users WHERE role = 'teacher'";
$teacher_result = $conn->query($teacher_sql);

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle Create Class
    if (isset($_POST['create_class'])) {
        $class_name = $_POST['class_name'];
        $class_sql = "INSERT INTO classes (class_name) VALUES ('$class_name')";
        if ($conn->query($class_sql) === TRUE) {
            $success_message = "Class created successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }

    // Handle Create Subject
    if (isset($_POST['create_subject'])) {
        $subject_name = $_POST['subject_name'];
        $subject_sql = "INSERT INTO subjects (subject_name) VALUES ('$subject_name')";
        if ($conn->query($subject_sql) === TRUE) {
            $success_message = "Subject created successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }

    // Handle Assign Subject to Class
    if (isset($_POST['assign_subject'])) {
        $class_id = $_POST['class_id'];
        $subject_id = $_POST['subject_id'];
        $sql = "INSERT INTO class_subject (class_id, subject_id) VALUES ('$class_id', '$subject_id')";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Subject assigned to class successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }

    // Handle Assign Student to Class
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

    // Handle Assign Teacher to Subject
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
    <title>Manage Classes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Manage Classes and Assign Students and Teachers</h1>

    <!-- Display success or error message -->
    <?php if (isset($success_message)) { echo "<p class='success'>$success_message</p>"; } ?>
    <?php if (isset($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>

    <!-- Create Class Form -->
    <h2>Create New Class</h2>
    <form method="POST">
        <label for="class_name">Class Name:</label>
        <input type="text" name="class_name" required><br>
        <button type="submit" name="create_class">Create Class</button>
    </form>

    <!-- Create Subject Form -->
    <h2>Create New Subject</h2>
    <form method="POST">
        <label for="subject_name">Subject Name:</label>
        <input type="text" name="subject_name" required><br>
        <button type="submit" name="create_subject">Create Subject</button>
    </form>

    <!-- Assign Subject to Class -->
    <h2>Assign Subject to Class</h2>
    <form method="POST">
        <label for="class_id">Select Class:</label>
        <select name="class_id" required>
            <?php while ($class = $class_result->fetch_assoc()) { ?>
                <option value="<?php echo $class['id']; ?>"><?php echo $class['class_name']; ?></option>
            <?php } ?>
        </select><br>

        <label for="subject_id">Select Subject:</label>
        <select name="subject_id" required>
            <?php 
            if ($subject_result->num_rows > 0) {
                while ($subject = $subject_result->fetch_assoc()) { 
            ?>
                    <option value="<?php echo $subject['id']; ?>"><?php echo $subject['subject_name']; ?></option>
            <?php 
                }
            } else {
                echo "<option>No subjects available</option>";
            }
            ?>
        </select><br>

        <button type="submit" name="assign_subject">Assign Subject</button>
    </form>

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
            <?php 
            if ($subject_result->num_rows > 0) {
                while ($subject = $subject_result->fetch_assoc()) { 
            ?>
                    <option value="<?php echo $subject['id']; ?>"><?php echo $subject['subject_name']; ?></option>
            <?php 
                }
            } else {
                echo "<option>No subjects available</option>";
            }
            ?>
        </select><br>

        <label for="teacher_id">Select Teacher:</label>
        <select name="teacher_id" required>
            <?php while ($teacher = $teacher_result->fetch_assoc()) { ?>
                <option value="<?php echo $teacher['id']; ?>"><?php echo $teacher['username']; ?></option>
            <?php } ?>
        </select><br>

        <button type="submit" name="assign_teacher">Assign Teacher</button>
    </form>

    <!-- Logout Link -->
    <a href="logout.php">Logout</a>
</div>

</body>
</html>
