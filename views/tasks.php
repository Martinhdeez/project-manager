<?php
include '../auth/auth.php';
include '../includes/functions.php';
include '../parts/header.php';
?>
<body>
    <div class="dashboard">
        <h2>Tasks</h2>
        <?php
            success();
        ?>
        <a href="create_task.php" class="btn btn-success">Create New Task</a>
        <ul>
        <?php displayTasks($_SESSION['project_id']); ?>
        </ul>
        <a href="../index.php">back home</a>
        <a href="../controllers/LogoutController.php" class="btn">Logout</a>
    </div>
</body>
</html>