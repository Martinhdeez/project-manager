<?php 
include 'auth/auth.php'; 
include 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Management Dashboard - Manage Your Projects</title>
    <meta name="description" content="Manage your projects efficiently with our project management dashboard. Track progress, assign tasks, and collaborate with your team.">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="dashboard">
    
    <h1>Welcome <?php echo htmlspecialchars($_SESSION['username']);?> , to Your Project Management Dashboard</h1>
    
    <p>Manage your projects efficiently with our project management dashboard. Track progress, assign tasks, and collaborate with your team.</p>
    
    <h2>Your Projects</h2>
    <a href="views/create_project.php">Create New Project</a>
    <ul>
        <?php displayProjects($_SESSION['user_id']); //llamo a la función que muestra los proyectos del usuario ?>
    </ul>


    <p><a href="controllers/logoutController.php">Logout</a></p>
    </div>
</body>
</html>
