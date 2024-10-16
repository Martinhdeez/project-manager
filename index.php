<?php 
require_once 'auth/auth.php'; 
require_once 'includes/functions.php';
require 'parts/header.php';
?>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="dashboard text-center">
            
        <br>
            <h1 class="mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>, to Your Project Management Dashboard</h1>
            
            <p class="lead">Manage your projects efficiently with our project management dashboard. Track progress, assign tasks, and collaborate with your team.</p>
            
            <h2 class="mt-5 mb-3">Your Projects</h2>
            <?php success(); ?>
            <a href="views/project.php?isNew=true" class="btn btn-primary mb-3">Create New Project</a>
            <br>
            <br>
            <ul  class="row list-unstyled" id="projects-container">
                <?php displayProjects($_SESSION['user_id']); //llamo a la función que muestra los proyectos del usuario ?>
            </ul>

            <p class="mt-4"><a href="controllers/logoutController.php" class="btn btn-danger">Logout</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>