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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="xdashboard container">
        <img src="../project_covers/<?php echo htmlspecialchars($project['cover_name'])?>">
        <h2 class="text-primary"><?php echo htmlspecialchars($project['title']); ?></h2>
        <p class="lead"><?php echo htmlspecialchars($project['description']); ?></p>

        <h3>Tasks</h3>
        <a href="create_task.php?project_id=<?php echo $projectId; ?>" class="btn btn-success mb-3">Create New Task</a>
        <ul class="list-group mb-3">
        <?php foreach ($tasks as $task) {
            echo "<li class='list-group-item'>" . htmlspecialchars($task['title']) . "</li>";
        } ?>
        </ul>

        <a href="projects.php" class="btn btn-secondary">Back to Projects</a>
        <a href="../controllers/LogoutController.php" class="btn btn-danger">Logout</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+O2eF0LgPpLTn8K0q5r5a5Y7rbHp" crossorigin="anonymous"></script>
</body>
</html>
