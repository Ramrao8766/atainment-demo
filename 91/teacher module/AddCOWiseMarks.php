<?php
// Enable error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "student_marks";

try {
    // Create database connection
    $conn = new mysqli($servername, $username, $password, $database);
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $marks_1 = isset($_POST['marks_1']) && $_POST['marks_1'] !== "" ? $_POST['marks_1'] : null;
    $marks_2 = isset($_POST['marks_2']) && $_POST['marks_2'] !== "" ? $_POST['marks_2'] : null;
    $marks_3 = isset($_POST['marks_3']) && $_POST['marks_3'] !== "" ? $_POST['marks_3'] : null;
    $marks_4 = isset($_POST['marks_4']) && $_POST['marks_4'] !== "" ? $_POST['marks_4'] : null;

    // Calculate total marks for CO1 and CO2
    $co1_marks = ($marks_1 ?? 0) + ($marks_2 ?? 0); // CO1 includes Q1 and Q2
    $co2_marks = ($marks_3 ?? 0) + ($marks_4 ?? 0); // CO2 includes Q3 and Q4

    // Insert marks into the database
    $sql = "INSERT INTO marks (student_name, marks_1, marks_2, marks_3, marks_4, co1_marks, co2_marks) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if prepare() was successful
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters and execute the query
    $stmt->bind_param("siiiiii", $student_name, $marks_1, $marks_2, $marks_3, $marks_4, $co1_marks, $co2_marks);

    try {
        $stmt->execute();
        echo "Marks stored successfully!";
    } catch (Exception $e) {
        echo "Error while inserting marks: " . $e->getMessage();
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Store Student Marks</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>

<body>
    <h1>Store Question-wise Marks</h1>
    <form method="POST" action="">
        <label for="student_name">Student Name:</label>
        <input type="text" name="student_name" id="student_name" required><br><br>

        <h3>CO1: Attempt any one of Q1 and Q2</h3>
        <label for="marks_1">Marks for Q1 (1a and 1b):</label>
        <input type="number" name="marks_1" id="marks_1"> <span>(Max Marks: 10)</span><br>
        <label for="marks_2">Marks for Q2 (2a and 2b):</label>
        <input type="number" name="marks_2" id="marks_2"> <span>(Max Marks: 10)</span><br><br>

        <h3>CO2: Attempt any one of Q3 and Q4</h3>
        <label for="marks_3">Marks for Q3 (3a and 3b):</label>
        <input type="number" name="marks_3" id="marks_3"> <span>(Max Marks: 10)</span><br>
        <label for="marks_4">Marks for Q4 (4a and 4b):</label>
        <input type="number" name="marks_4" id="marks_4"> <span>(Max Marks: 10)</span><br><br>

        <button type="submit">Submit</button>
    </form>
</body>

</html>