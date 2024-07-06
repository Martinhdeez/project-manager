<?php 
include '../auth/auth.php'; 
include '../includes/functions.php';
include '../parts/header.php';
?>
    <div class="container mt-5">
        <div class="dashboard text-center">
            <h2 class="mb-4">Projects</h2>
            <?php success(); ?>
            <a href="create_project.php" class="btn btn-primary mb-3">Create New Project</a>
            <ul class="list-group mb-3">
            <?php displayProjects($_SESSION['user_id']); ?>
            </ul>
            <a href="../index.php" class="btn btn-secondary me-2">Back Home</a>
            <a href="../controllers/LogoutController.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>