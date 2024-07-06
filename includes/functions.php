<?php
    require __DIR__ . '/../config/db.php';

    define('BASE_URL', '/project_manager'); 
     // Define la URL base de tu aplicación
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

function displayTasks($projectId){

    $database = new Db();
    $db = $database->connect();//devuelve conn
    $result = $db->query("SELECT * FROM tasks WHERE project_id = " .$projectId);//prepara consula para obtener las tareas del proyecto

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {//bucle para mostrar todos los proyectos del usuario
    echo "<li><a href='" . BASE_URL . "/views/task.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['title']) . "</a></li>";//cada proyecto del usuario
    }
}

    