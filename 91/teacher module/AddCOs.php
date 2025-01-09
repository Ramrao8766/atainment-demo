<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Database Connection Error: " . $e->getMessage());
}

// Add COs Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_id = htmlspecialchars($_POST['class_id']);
    $co_number = htmlspecialchars($_POST['co_number']);
    $co_description = htmlspecialchars($_POST['co_description']);

    if (!empty($class_id) && !empty($co_number) && !empty($co_description)) {
        // Check if class_id exists in classes table
        $class_check_sql = "SELECT id FROM classes WHERE id = ?";
        $stmt_check = $conn->prepare($class_check_sql);
        $stmt_check->bind_param("i", $class_id);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            // Class ID exists, insert the data into course_outcomes
            $sql = "INSERT INTO course_outcomes (class_id, co_number, co_description) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("iss", $class_id, $co_number, $co_description);

                if ($stmt->execute()) {
                    $success_message = "CO added successfully!";
                } else {
                    $error_message = "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $error_message = "SQL Preparation Error: " . $conn->error;
            }
        } else {
            $error_message = "Invalid Class ID. Please select a valid class.";
        }

        $stmt_check->close();
    } else {
        $error_message = "All fields are required!";
    }
}

// Fetch classes for the dropdown
$classes_sql = "SELECT id, class_name FROM classes";
$classes_result = $conn->query($classes_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add COs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Add COs</h1>
        <?php
        if (isset($error_message)) {
            echo "<div class='message error'>{$error_message}</div>";
        }
        if (isset($success_message)) {
            echo "<div class='message success'>{$success_message}</div>";
        }
        ?>
        <form action="" method="POST">
            <label for="class_id">Select Class</label>
            <select id="class_id" name="class_id" required>
                <option value="">-- Select Class --</option>
                <?php
                if ($classes_result && $classes_result->num_rows > 0) {
                    while ($class = $classes_result->fetch_assoc()) {
                        echo "<option value='{$class['id']}'>{$class['class_name']}</option>";
                    }
                } else {
                    echo "<option value=''>No classes available</option>";
                }
                ?>
            </select>

            <label for="co_number">CO Number</label>
            <input type="text" id="co_number" name="co_number" placeholder="Enter CO Number" required>

            <label for="co_description">CO Description</label>
            <textarea id="co_description" name="co_description" placeholder="Enter CO description" rows="4"
                required></textarea>

            <button type="submit">Add CO</button>
        </form>
    </div>
</body>

</html>

<?php
$conn->close();
?>