<?php
    include __DIR__ . '/../config/db.php';

    define('BASE_URL', '/project_manager');  // Define la URL base de tu aplicación
function displayProjects($userId){

    $database = new Db();
    $db = $database->connect();//devuelve conn
    $result = $db->query("SELECT * FROM projects WHERE user_id = " .$userId);//prepara consula para obtener proyectos del usuario

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {//bucle para mostrar todos los proyectos del usuario
    echo "<li><a href='" . BASE_URL . "/views/project.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['title']) . "</a></li>";//cada proyecto del usuario
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

    