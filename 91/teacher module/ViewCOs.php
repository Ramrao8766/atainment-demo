<?php
// Sample Data - Replace with real database or logic
$course = [
    'course_code' => 'CS101',
    'course_name' => 'Programming',
    'teacher' => 'John Doe',
    'co_list' => [
        [
            'co_code' => 'CO1',
            'co_description' => 'Understand the basic principles of programming and coding structures.',
        ],
        [
            'co_code' => 'CO2',
            'co_description' => 'Apply data types, control structures, and functions in problem solving.',
        ],
        [
            'co_code' => 'CO3',
            'co_description' => 'Write and debug programs using a variety of techniques and tools.',
        ],
        [
            'co_code' => 'CO4',
            'co_description' => 'Design and implement algorithms to solve computational problems.',
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Outcomes - <?php echo $course['course_name']; ?></title>
    <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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

        .course-info {
            margin-bottom: 30px;
        }

        .course-info p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .course-info h2 {
            color: #007bff;
        }

        .co-list {
            margin-top: 30px;
        }

        .co-list h3 {
            margin-bottom: 20px;
            color: #333;
        }

        .co-item {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .co-item h4 {
            margin-bottom: 10px;
            color: #007bff;
        }

        .co-item p {
            margin-bottom: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Course Outcomes for <?php echo $course['course_name']; ?> (<?php echo $course['course_code']; ?>)</h1>

        <!-- Course Info Section -->
        <div class="course-info">
            <h2>Course Information</h2>
            <p><strong>Teacher:</strong> <?php echo $course['teacher']; ?></p>
        </div>

        <!-- Course Outcomes List Section -->
        <div class="co-list">
            <h3>List of Course Outcomes (COs):</h3>
            <?php foreach ($course['co_list'] as $co): ?>
                <div class="co-item">
                    <h4><?php echo $co['co_code']; ?> - <?php echo $co['co_description']; ?></h4>
                    <p><strong>Description:</strong> <?php echo $co['co_description']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
