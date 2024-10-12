<?php
require_once '../auth/auth.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

$projectId = $_GET['project_id'] ?? null;
$isNew = isset($_GET['isNew']);

// Conexión a la base de datos
$database = new Db();
$db = $database->connect();

if ($isNew) {
    // Inicializar variables para nueva tarea
    $task = [
        'id' => '',
        'title' => '',
        'description' => '',
        'project_id' => $projectId,
        'end_date' => '0000-00-00',
        'priority' => 'Medium',
        'notes' => '',
        'tags' => '',
        'status' => 'Pending'
    ];
    try{
        // Insertar variables inicializadas en la base de datos y obtener el ID de la nueva tarea
    $stmt = $db->prepare("INSERT INTO tasks (title, description, project_id, end_date, priority, notes, tags, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$task['title'], $task['description'], $task['project_id'], $task['end_date'], $task['priority'], $task['notes'], $task['tags'], $task['status']]);
    }catch(PDOException $e){
        echo "Error creating a new task: ". $e->getMessage();
    }
    

    // Obtener el ID de la nueva tarea creada
    $taskId = $db->lastInsertId();
    $task['id'] = $taskId;
} else {
    $taskId = $_GET['id'] ?? null;
    if (!$taskId) {
        die('Task not found');
    }

    $stmt = $db->prepare("SELECT * FROM tasks WHERE id= ?");
    $stmt->execute([$taskId]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$task) {
        die('Task not found.');
    }
}

require_once '../parts/header.php';
?>


    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center"><?= $isNew ? 'Create New Task' : 'Edit Task'; ?></h2>
                <?php success(); ?>
                <form action="../controllers/taskController.php?action=save" method="post">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($task['id']); ?>">
                    <input type="hidden" name="project_id" value="<?= htmlspecialchars($task['project_id']); ?>">
                    <div class="form-group">
                        <label for="title">Task Title:</label>
                        <input type="text" id="title" name="title" class="form-control" required value="<?= htmlspecialchars($task['title']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control"><?= htmlspecialchars($task['description']); ?></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="<?= htmlspecialchars($task['end_date']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority:</label>
                        <select id="priority" name="priority" class="form-control">
                            <option value="Low" <?= $task['priority'] === 'Low' ? 'selected' : ''; ?>>Low</option>
                            <option value="Medium" <?= $task['priority'] === 'Medium' ? 'selected' : ''; ?>>Medium</option>
                            <option value="High" <?= $task['priority'] === 'High' ? 'selected' : ''; ?>>High</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tags" class="form-label">Tags (comma separated): </label>
                        <input type="text" class="form-control" id="tags" name="tags" placeholder="ex: work,urgent,home" value="<?= htmlspecialchars($task['tags']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select id="status" name="status" class="form-control">
                            <option value="Pending" <?= $task['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="Completed" <?= $task['status'] === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="notes">Notes:</label>
                        <textarea id="notes" name="notes" class="form-control"><?= htmlspecialchars($task['notes']); ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-success"><?= $isNew ? 'Create Task' : 'Update Task'; ?></button>
                    <a href="project.php?id=<?= htmlspecialchars($task['project_id']); ?>" class="btn btn-secondary">Back to Project</a>
                </form>
                <?php if (!$isNew): ?>
                    <form action="../controllers/taskController.php?action=delete" method="post" class="mt-2">
                        <input type="hidden" name="project_id" value="<?= htmlspecialchars($task['project_id']); ?>">
                        <input type="hidden" name="id" value="<?= $taskId; ?>">
                        <button type="submit" class="btn btn-danger">Delete Task</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0sG1M5b4hcpxyD9F7jL+ozpOn60pT9mYxIvC/N2JhvByj3Kd" crossorigin="anonymous"></script>
</body>
</html>
