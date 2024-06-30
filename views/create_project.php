<?php include '../auth/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Project</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    
    <form action="../controllers/CreateProjectController.php" method="post">
        <h2>Create New Project</h2>
        <label for="title">Project Title:</label> 
        <input type="text" id="title" name="title" required> 
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
        <br>
        <button type="submit">Create Project</button>
        <a href="projects.php">Back to Projects</a>
    </form>
    
</body>
</html>
