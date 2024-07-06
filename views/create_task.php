<?php 
require '../auth/auth.php'; 
require '../parts/header.php';
?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">Create New Task</h2>
                <form action="../controllers/createTaskController.php" method="post">
                    <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($_GET['project_id']); ?>">
                    <div class="form-group">
                        <label for="title">Task Title:</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Create Task</button>
                    <a href="project.php?id=<?php echo htmlspecialchars($_GET['project_id']); ?>" class="btn btn-secondary">Back to Project</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>