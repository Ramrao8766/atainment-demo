<?php
// Sample Teacher Data - Replace with real database or logic
$teacher = [
    'name' => 'John Doe',
    'designation' => 'Assistant Professor',
    'department' => 'Computer Science',
    'email' => 'johndoe@example.com',
    'phone' => '+1 234 567 890',
    'subjects' => ['Programming', 'Data Structures', 'Algorithms'],
    'profile_image' => 'teacher.jpg' // Replace with actual image path or URL
];

// Function to display the subjects
function displaySubjects($subjects) {
    echo '<ul>';
    foreach ($subjects as $subject) {
        echo "<li>$subject</li>";
    }
    echo '</ul>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Profile</title>
    <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-header img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            margin-right: 20px;
        }

        .profile-header .info {
            color: #333;
        }

        .profile-header .info h2 {
            margin-bottom: 10px;
        }

        .profile-header .info p {
            font-size: 1.1em;
        }

        .subject-list {
            margin-top: 20px;
        }

        .subject-list ul {
            list-style: none;
            padding-left: 20px;
        }

        .subject-list li {
            margin-bottom: 5px;
            font-size: 1.1em;
        }

        .contact-info {
            margin-top: 30px;
        }

        .contact-info p {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Teacher Profile</h1>
        
        <div class="profile-header">
            <img src="<?php echo $teacher['profile_image']; ?>" alt="Teacher Photo">
            <div class="info">
                <h2><?php echo $teacher['name']; ?></h2>
                <p><strong>Designation:</strong> <?php echo $teacher['designation']; ?></p>
                <p><strong>Department:</strong> <?php echo $teacher['department']; ?></p>
            </div>
        </div>

        <div class="subject-list">
            <h3>Subjects Taught:</h3>
            <?php displaySubjects($teacher['subjects']); ?>
        </div>

        <div class="contact-info">
            <h3>Contact Information:</h3>
            <p><strong>Email:</strong> <a href="mailto:<?php echo $teacher['email']; ?>"><?php echo $teacher['email']; ?></a></p>
            <p><strong>Phone:</strong> <a href="tel:<?php echo $teacher['phone']; ?>"><?php echo $teacher['phone']; ?></a></p>
        </div>
    </div>
</body>
</html>
