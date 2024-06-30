<?php
    include '../config/db.php';

function displayProjects($userId){

    $database = new Db();
    $db = $database->connect();//devuelve conn
    $result = $db->query("SELECT * FROM projects WHERE user_id = " .$userId);//prepara consula para obtener proyectos del usuario

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {//bucle para mostrar todos los proyectos del usuario
    echo "<li><a href='views/project.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['title']) . "</a></li>";//cada proyecto del usuario
    }
}
    