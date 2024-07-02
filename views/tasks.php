<?php
include '../auth/auth.php';
include '../includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="dashboard">
        <h2>Tasks</h2>
        <?php
            success();
        ?>
        <a href="create_task.php" class="btn">Create New Task</a>
        <ul>
        <?php displayTasks($_SESSION['project_id']); ?>
        </ul>
        <a href="../index.php">back home</a>
        <a href="../controllers/LogoutController.php" class="btn">Logout</a>
    </div>
</body>
</html>