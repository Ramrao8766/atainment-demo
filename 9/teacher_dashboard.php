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
    <style>
        /* General styles for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f9;
            color: #333;
        }

        /* Container for the content */
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
        }

        /* Header styles */
        h1 {
            margin: 20px 0 20px 0;
            font-size: 28px;
            text-align: center;
            color: #2c3e50;
        }

        /* Style for the button container */
        .button-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin: 20px 0;
        }

        /* Style for buttons */
        .btn {
            text-decoration: none;
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .btn:active {
            transform: translateY(0);
        }

        /* Logout link styles */
        .logout {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #e74c3c;
            font-weight: bold;
            transition: color 0.3s;
            text-align: center;
            font-size: 16px;
        }

        .logout:hover {
            color: #c0392b;
        }

        /* Style for the logo */
        .logo {
            max-width: 120px;
            margin: 0 auto 20px auto;
            /* Center the logo with auto margins */
            display: block;
        }

        /* Responsive design for smaller screens */
        @media (max-width: 768px) {
            .container {
                max-width: 90%;
                padding: 15px;
            }

            h1 {
                font-size: 24px;
            }

            .btn {
                font-size: 14px;
                padding: 10px;
            }

            .logout {
                font-size: 14px;
            }

            .logo {
                max-width: 100px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Centered Logo -->
        <img src="logo.png" alt="Logo" class="logo">

        <h1>Teacher Dashboard</h1>

        <div class="button-container">
            <a href="teacher module/TeacherProfile.php" class="btn">Profile</a>
            <a href="teacher module/AddCOs.php" class="btn">Add COs</a>
            <a href="teacher module/AddCOWiseMarks1.php" class="btn">Add CO-Wise Marks 1</a>
            <a href="teacher module/AddCOWiseMarks2.php" class="btn">Add CO-Wise Marks 2</a>
            <a href="teacher module/View Attainment 1.php" class="btn">View Attainment 1</a>
            <a href="teacher module/View Attainment 2.php" class="btn">View Attainment 2</a>
            <a href="teacher module/View Attainment 3.php" class="btn">View Attainment 2</a>
            <a href="teacher module/Co Po Matrix.php" class="btn">CO-PO Matrix</a>
        </div>

        <a href="logout.php" class="logout">Logout</a>
    </div>
</body>

</html>