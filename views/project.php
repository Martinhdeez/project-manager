<?php
include '../auth/auth.php';
include '../config/db.php';

// Verificar si el ID del proyecto está presente en la URL
if (!isset($_GET['id'])) {
    die('Project ID is missing.');
}

$projectId = $_GET['id'];

// Conectar a la base de datos
$database = new Db();
$db = $database->connect();

// Obtener los detalles del proyecto
$stmt = $db->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->execute([$projectId]);
$project = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si el proyecto existe y pertenece al usuario
if (!$project || $project['user_id'] != $_SESSION['user_id']) {
    die('Project not found or access denied.');
}

// Obtener las tareas del proyecto
$stmt = $db->prepare("SELECT * FROM tasks WHERE project_id = ?");
$stmt->execute([$projectId]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($project['title']); ?> - Tasks</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="dashboard">
        <h2><?php echo htmlspecialchars($project['title']); ?></h2>
        <p><?php echo htmlspecialchars($project['description']); ?></p>

        <h3>Tasks</h3>
        <a href="create_task.php?project_id=<?php echo $projectId; ?>" class="btn">Create New Task</a>
        <ul>
        <?php foreach ($tasks as $task) {
            echo "<li>" . htmlspecialchars($task['title']) . "</li>";
        } ?>
        </ul>

        <a href="projects.php" class="btn">Back to Projects</a>
        <a href="../controllers/LogoutController.php" class="btn">Logout</a>
    </div>
</body>
</html>
