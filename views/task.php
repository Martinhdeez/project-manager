<?php
    require_once '../auth/auth.php';
    require_once '../config/db.php';

    if(!isset($_GET['id'])){
        die('Task ID is missing.');
    }
    $taskId = $_GET['id'];
    
    $database= new Db();
    $db= $database->connect();

    // Añadir depuración para verificar el ID de la tarea
    error_log("Task ID: " . $taskId);

    $stmt = $db->prepare("SELECT * FROM tasks WHERE id= ?");
    $stmt->execute([$taskId]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$task) {
        error_log("Task not found for ID: " . $taskId);
        die('Task not found.');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($task['title']);?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title"><?php echo htmlspecialchars($task['title']);?></h2>
                <p class="card-text"><?php echo htmlspecialchars($task['description']);?></p>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Status:</strong> <?php echo htmlspecialchars($task['status']); ?>
                    </li>

                    <li class="list-group-item">
                        <strong>Created At:</strong> <?php echo htmlspecialchars($task['created_at']); ?>
                    </li>

                    <li class="list-group-item">
                        <strong>End Date:</strong> <?php echo htmlspecialchars($task['end_date']); ?>
                    </li>

                    <li class="list-group-item">
                        <strong>Priority:</strong> <span class="badge bg-primary"><?php echo htmlspecialchars($task['priority']); ?></span>
                    </li>

                    <li class="list-group-item">
                        <strong>Tags:</strong> 
                        <?php 
                        $tags = explode(',', $task['tags']);
                        foreach($tags as $tag) {
                            echo '<span class="badge bg-info me-1">' . htmlspecialchars($tag) . '</span>';
                        }
                        ?>
                    </li>

                    <li class="list-group-item">

                        <strong>Notes:</strong>
                        <form action="../controllers/notesController.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $taskId; ?>">
                            <div class="mb-3">
                                <label for="existing_notes" class="form-label text-secondary text-decoration-underline">Task Notes</label>
                                <textarea id="existing_notes" name="existing_notes" class="form-control" rows="5" readonly><?php echo htmlspecialchars($task['notes']); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="new_note" class="form-label">Add a new note</label>
                                <textarea id="new_note" name="new_note" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" name="submit_notes" class="btn btn-primary">Save Note</button>
                            
                            <form action="../controllers/deleteTaskController.php" method="post">
                                <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($task['project_id']); ?>">
                                <input type="hidden" name="id" value="<?php echo $taskId; ?>">
                                <button type="submit" class="btn btn-danger ml-2">Delete Task</button>
                            </form>
                            <a href="project.php?id=<?php echo htmlspecialchars($task['project_id']);?>"  class="btn btn-secondary mt-2" >Back to <?php echo htmlspecialchars($task['title']); ?></a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+ozpOn60pT9mYxIvC/N2JhvByj3Kd" crossorigin="anonymous"></script>
</body>
</html>
