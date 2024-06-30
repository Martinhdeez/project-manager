<?php 
include '../auth/auth.php'; 
include '../includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Projects</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Projects</h2>
    <?php
    session_start();
    if (isset($_SESSION['success'])) {
        echo "<p class='success'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo "<p class='error'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>
    <a href="create_project.php">Create New Project</a>
    <ul>
    <?php displayProjects($_SESSION['user_id']); ?>
    </ul>
    
    <a href="../controllers/LogoutController.php">Logout</a>
</body>
</html>
