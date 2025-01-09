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

// Fetch Course Outcomes (COs) with associated course names
$sql = "
    SELECT 
        co.id AS co_id, 
        co.co_number, 
        co.co_description, 
        co.created_at, 
        c.class_name 
    FROM 
        course_outcomes co
    JOIN 
        classes c ON co.class_id = c.id
    ORDER BY 
        co.created_at DESC
";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Module - View Course Outcomes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 800px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }

        .message {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>View Course Outcomes</h1>
        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>CO ID</th>
                        <th>CO Number</th>
                        <th>CO Description</th>
                        <th>Course Name</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['co_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['co_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['co_description']); ?></td>
                            <td><?php echo htmlspecialchars($row['class_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="message">No Course Outcomes found.</div>
        <?php endif; ?>
    </div>
</body>

</html>

<?php
$conn->close();
?>