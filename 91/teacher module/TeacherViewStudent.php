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

// Fetch all student marks along with calculated percentages
$sql = "SELECT student_name, marks_1, marks_2, marks_3, marks_4, 
               co1_marks, co2_marks,
               (co1_marks / 10) * 100 AS co1_percentage, -- Assuming total CO1 marks = 20
               (co2_marks / 10) * 100 AS co2_percentage  -- Assuming total CO2 marks = 20
        FROM marks";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Marks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            text-align: center;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <h1>Student Marks and CO-wise Percentages</h1>
    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Marks for Q1</th>
                <th>Marks for Q2</th>
                <th>Marks for Q3</th>
                <th>Marks for Q4</th>
                <th>Total CO1 Marks</th>
                <th>Total CO2 Marks</th>
                <th>CO1 Percentage</th>
                <th>CO2 Percentage</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are results
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['marks_1']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['marks_2']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['marks_3']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['marks_4']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['co1_marks']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['co2_marks']) . "</td>";
                    echo "<td>" . number_format($row['co1_percentage'], 2) . "%</td>";
                    echo "<td>" . number_format($row['co2_percentage'], 2) . "%</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No data found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>

<?php
$conn->close();
?>