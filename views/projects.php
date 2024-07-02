<?php 
include '../auth/auth.php'; 
include '../includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="dashboard">
        <h2>Projects</h2>
        <?php
            success();
        ?>
        <a href="create_project.php" class="btn">Create New Project</a>
        <ul>
        <?php displayProjects($_SESSION['user_id']); ?>
        </ul>
        <a href="../index.php">back home</a>
        <a href="../controllers/LogoutController.php" class="btn">Logout</a>
    </div>
</body>
</html>
