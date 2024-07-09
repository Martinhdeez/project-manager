<?php
    require_once __DIR__ . '/../config/db.php';

    define('BASE_URL', '/project_manager'); // Define la URL base de tu aplicación
function displayProjects($userId) {
    $database = new Db();
    $db = $database->connect(); // devuelve conn
    $result = $db->query("SELECT * FROM projects WHERE user_id = " . $userId); // prepara consulta para obtener proyectos del usuario

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) { // bucle para mostrar todos los proyectos del usuario
        echo "
        <li class='col-12 col-sm-6 col-md-4 project' id='project'>
        <a href='" . BASE_URL . "/views/project.php?id=" . $row['id'] . " class= 'list-group-item-action text-black fw-bold fs-5'>
        <img src='" . BASE_URL . "/project_covers/" . $row['cover_name'] . "' class='img-fluid me-2'>
        " . htmlspecialchars($row['title']) . "
        </a>
        </li>";

    }
}

function success() {
    
    if (isset($_SESSION['success'])) {
        echo "<p class='success'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo "<p class='error'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }

}

function displayTasks($tasks) {
    foreach ($tasks as $task) {
        $tags = explode(',', $task['tags']);
        echo "<li id='task' class='list-group-item list-group-item-action d-flex justify-content-between align-items-center'>
        <form action='../controllers/statusTaskController.php' method='post' class='mt-2'>
            <input type='hidden' name='id' value='" . $task['id'] . "'>
            <input type='hidden' name='project_id' value='" . $task['project_id'] . "'>
            <a href='task.php?id=" . $task['id'] . "' class='d-flex justify-content-between align-items-center w-100 text-decoration-none text-dark'>    
                <div class='form-check'>
                    <input class='form-check-input aling-item-left' type='checkbox' name='is_completed' id='is_completed_" . $task['id'] . "' value='1' " . ($task['status'] == 'Completed' ? "checked" : '') . ">
                </div>
            
                <span id='task_title' class='flex-grow-1 text-center'>" . htmlspecialchars($task['title']) . "</span>
                <div class='d-flex align-items-center'>";
                    foreach($tags as $tag) {
                        echo "<span class='badge bg-info me-4'>" . htmlspecialchars($tag) . "</span>";
                    }
                    echo "<span class='badge bg-primary me-4'>" . htmlspecialchars($task['priority']) . "</span>
                        <span class='text-muted'>" . htmlspecialchars($task['end_date']) . "</span>
                </div>
            </a>
        </form>
        </li>";
    }
}

    