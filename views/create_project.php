<?php 
require_once '../auth/auth.php';
require '../parts/header.php';
?>
    
    <div class="container mt-5">
        <form action="../controllers/createProjectController.php" method="post" class="form" enctype="multipart/form-data">
            <h2 class="mb-4">Create New Project</h2>
            <div class="mb-3">
                <label for="title" class="form-label">Project Title:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" rows="4"></textarea>
            </div>
            <div class="mb-3">
                <label for="cover" class="form-label">Project Cover:</label>
                <input type="file" id="cover" name="cover" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Create Project</button>
            <a href="../index.php" class="btn btn-secondary ms-2">Back to Projects</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>