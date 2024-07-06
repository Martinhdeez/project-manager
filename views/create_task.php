<?php 
require '../auth/auth.php'; 
require '../parts/header.php';
?>
    <form action="../controllers/createTaskController.php" value=" <?php echo $_GET['project_id'];?>  method="post">
        <h2>Create new task</h2>
        <label for="title">Task Title:</label> 
        <input type="text" id="title" name="title" required> 
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
        <br>
        <button type="task_submit" class="btn btn-success">Create Task</button>
        <a href="project.php?id=<?php echo htmlspecialchars($_GET['project_id']); ?>" class="btn">Back to Project</a>
    </form>
</body>
</html>