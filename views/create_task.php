<?php 
require_once'../auth/auth.php'; 
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
                    <br>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" name="end_date" id="end_date">
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority:</label>
                        <select id="priority" name="priority" class="form-control">
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tags" class="form-label">Tags (comma separated): </label>
                        <input type="text" class="form-control" id="tags" name="tags" placeholder="ex: work,urgent,home">
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