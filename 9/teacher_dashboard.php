<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'teacher') {
    header("Location: login.php");
    exit;
}

echo "<h1>Welcome, " . $_SESSION['username'] . " (Teacher)!</h1>";
echo "<a href='logout.php'>Logout</a>";
?>
