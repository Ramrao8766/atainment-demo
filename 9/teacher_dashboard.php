<?php
session_start();
include('db.php');

// Check if the user is logged in and is a teacher
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'teacher') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="container">
        <h1>Teacher Dashboard</h1>

        <div class="button-container">
            <a href="AddCOs.php" class="btn">Add COs</a>
            <a href="AddTarget.php" class="btn">Add Target</a>
            <a href="AddCOWiseMarks.php" class="btn">Add CO-Wise Marks</a>
            <a href="GenerateCOAttainment.php" class="btn">Generate CO Attainment</a>
            <a href="GeneratePOAttainment.php" class="btn">Generate PO Attainment</a>
            <a href="TeacherProfile.php" class="btn">Profile</a>
            <a href="TeacherSubjectDetails.php" class="btn">Subject Details</a>
            <a href="TeacherSubjects.php" class="btn">Subjects</a>
            <a href="TeacherViewStudent.php" class="btn">View Students</a>
            <a href="ViewCOs.php" class="btn">View COs</a>
        </div>


        <a href="logout.php">Logout</a>
    </div>

    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .button-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }

        .btn {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</body>

</html>