<?php
include('db.php');

// Fetch the class list
$classList = [];
$sql = "SELECT id, class_name FROM classes";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $classList[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $classId = isset($_POST['class']) ? $_POST['class'] : null;

    // Ensure only valid roles are inserted
    if (in_array($role, ['student', 'teacher', 'admin'])) {
        // Validate class only if the role is student
        if ($role === 'student' && empty($classId)) {
            $error = "Class selection is required for students!";
        } else {
            // Insert user into the database
            $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
            if ($conn->query($sql) === TRUE) {
                $userId = $conn->insert_id;

                // Assign class if the role is student
                if ($role === 'student' && !empty($classId)) {
                    $sql = "INSERT INTO class_student (class_id, student_id) VALUES ('$classId', '$userId')";
                    $conn->query($sql);
                }

                $success = "User registered successfully!";
            } else {
                $error = "Error: " . $conn->error;
            }
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

    <?php if (isset($success)) {
        echo "<p style='color: green;'>$success</p>";
    } ?>
    <?php if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    } ?>

    <form method="post" action="register.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="role">Role:</label>
        <select name="role" id="role" required onchange="toggleClassField()">
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
            <option value="admin">Admin</option>
        </select><br>

        <div id="class-field" style="display: none;">
            <label for="class">Class:</label>
            <select name="class" id="class">
                <option value="">Select Class</option>
                <?php foreach ($classList as $class) { ?>
                    <option value="<?php echo $class['id']; ?>"><?php echo $class['class_name']; ?></option>
                <?php } ?>
            </select><br>
        </div>

        <button type="submit">Register</button>
    </form>

    <a href="login.php">Already have an account? Login here.</a>

    <script>
        function toggleClassField() {
            const role = document.getElementById('role').value;
            const classField = document.getElementById('class-field');
            if (role === 'student') {
                classField.style.display = 'block';
                document.getElementById('class').setAttribute('required', 'required');
            } else {
                classField.style.display = 'none';
                document.getElementById('class').removeAttribute('required');
            }
        }

        // Call the function on page load to ensure proper display state
        window.onload = toggleClassField;
    </script>
</body>

</html>