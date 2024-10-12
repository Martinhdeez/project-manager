<?php
require_once '../auth/auth.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

$isNew = isset($_GET['isNew']);
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp']; // Extensiones permitidas

// Conexión a la base de datos
$database = new Db();
$db = $database->connect();

function isImage($file) {
    global $allowedExtensions;
    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    return in_array($extension, $allowedExtensions);
}

if ($isNew) {
    $project = [
        'id' => '',
        'user_id' => $_SESSION['user_id'],
        'title' => '',
        'description' => '',
        'cover_name' => 'default.jpeg'  // Imagen por defecto cambiada a default.jpeg
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $project['title'] = $_POST['title'];
        $project['description'] = $_POST['description'];

        // Insertar el proyecto para obtener el ID
        $stmt = $db->prepare("INSERT INTO projects (user_id, title, description, cover_name) VALUES (?, ?, ?, ?)");
        $stmt->execute([$project['user_id'], $project['title'], $project['description'], $project['cover_name']]);
        $projectId = $db->lastInsertId();

        if (isset($_FILES['cover_name']) && $_FILES['cover_name']['error'] == UPLOAD_ERR_OK) {
            $coverName = $_FILES['cover_name']['name'];
            if (isImage($coverName)) {
                $target_dir = "../project_covers/";

                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                // Renombrar la imagen con la ID del proyecto
                $extension = strtolower(pathinfo($coverName, PATHINFO_EXTENSION));
                $newFileName = $projectId . '.' . $extension;
                $target_file = $target_dir . $newFileName;

                if (move_uploaded_file($_FILES['cover_name']['tmp_name'], $target_file)) {
                    $project['cover_name'] = $newFileName;

                    // Actualizar el nombre de la imagen en la base de datos
                    $stmt = $db->prepare("UPDATE projects SET cover_name = ? WHERE id = ?");
                    $stmt->execute([$newFileName, $projectId]);
                } else {
                    $_SESSION['error'] = "Failed to upload cover image.";
                }

                header("Location: project.php?id=$projectId");
                exit();
            } else {
                $_SESSION['error'] = "Invalid file type. Please upload a valid image.";
            }
        } else {
            header("Location: project.php?id=$projectId");
            exit();
        }
    }
} else {
    $projectId = $_GET['id'] ?? null;
    if (!$projectId) {
        die('Project not found');
    }

    // Obtener los detalles del proyecto
    $stmt = $db->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$projectId]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el proyecto existe y pertenece al usuario
    if (!$project || $project['user_id'] != $_SESSION['user_id']) {
        die('Project not found or access denied.');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $project['title'] = $_POST['title'];
        $project['description'] = $_POST['description'];

        if (isset($_FILES['cover_name']) && $_FILES['cover_name']['error'] == UPLOAD_ERR_OK) {
            $coverName = $_FILES['cover_name']['name'];
            if (isImage($coverName)) {
                $target_dir = "../project_covers/";

                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                // Renombrar la imagen con la ID del proyecto
                $extension = strtolower(pathinfo($coverName, PATHINFO_EXTENSION));
                $newFileName = $projectId . '.' . $extension;
                $target_file = $target_dir . $newFileName;

                if (move_uploaded_file($_FILES['cover_name']['tmp_name'], $target_file)) {
                    $project['cover_name'] = $newFileName;

                    // Actualizar el nombre de la imagen en la base de datos
                    $stmt = $db->prepare("UPDATE projects SET title = ?, description = ?, cover_name = ? WHERE id = ?");
                    $stmt->execute([$project['title'], $project['description'], $project['cover_name'], $projectId]);
                } else {
                    $_SESSION['error'] = "Failed to upload cover image.";
                }

                header("Location: project.php?id=$projectId");
                exit();
            } else {
                $_SESSION['error'] = "Invalid file type. Please upload a valid image.";
            }
        } else {
            // Actualizar sin cambiar la imagen
            $stmt = $db->prepare("UPDATE projects SET title = ?, description = ? WHERE id = ?");
            $stmt->execute([$project['title'], $project['description'], $projectId]);
            header("Location: project.php?id=$projectId");
            exit();
        }
    }
}
if(!$isNew){
    //Obtener las tareas del proyecto
    $stmt = $db->prepare("SELECT * FROM tasks WHERE project_id = ?");
    $stmt->execute([$projectId]);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/project_manager/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title><?= htmlspecialchars($project['title']) ?></title>
</head>
<body>
    <div class="xdashboard container">
        <form action="project.php<?php echo $isNew ? '?isNew=true' : '?id=' . $projectId; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Project Title:</label>
                <input type="text" id="title" name="title" class="form-control" required value="<?php echo htmlspecialchars($project['title']); ?>">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control"><?php echo htmlspecialchars($project['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="cover_name">Cover Image:</label>
                <input type="file" id="cover_name" name="cover_name" class="form-control">
                <?php if (!empty($project['cover_name'])): ?>
                    <img src="../project_covers/<?php echo htmlspecialchars($project['cover_name']); ?>" alt="Project Cover" style="width: 100px; height: auto;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-success"><?php echo $isNew ? 'Create Project' : 'Update Project'; ?></button>
        </form>
        <?php if (!$isNew): ?>
            <h3>Tasks</h3>
            <?php success();?>
            <a href="task.php?isNew=true&project_id=<?php echo $projectId;?>" class="btn btn-success mb-3">Create New Task</a>
            <ul class="list-group mb-3">
                <?php displayTasks($tasks); ?>
            </ul>
            <form action="../controllers/deleteProjectController.php" method="post">
                <input type="hidden" name="project_id" value="<?php echo $projectId;?>">
                <button type="submit" class="btn btn-danger">Delete Project</button>
            </form>
        <?php endif; ?>
        <a href="../index.php" class="btn btn-secondary">Back to Projects</a>
    
        <script>
            $(document).ready(function(){
                $('.task-checkbox').on('change', function() {
                    var taskId = $(this).data('task-id');
                    var isCompleted = $(this).is(':checked');
                    
                    $.ajax({
                        url: '../controllers/statusTaskController.php',
                        type: 'POST',
                        data: {
                            id: taskId,
                            is_completed: isCompleted
                        },
                        success: function(response) {
                            var result = JSON.parse(response);
                            if (result.status === 'success') {
                                console.log('Task status updated successfully');
                            } else {
                                console.log('Failed to update task status');
                            }
                        },
                        error: function() {
                            console.log('Error occurred while updating task status');
                        }
                    });
                });
            });
        </script>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0sG1M5b4hcpxyD9F7jL+O2eF0LgPpLTn8K0q5r5a5Y7rbHp" crossorigin="anonymous"></script>
</body>
</html>
