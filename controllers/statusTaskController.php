<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskId = $_POST['id'];
    $projectId = $_POST['project_id'];
    $isCompleted = isset($_POST['is_completed']) ? 'Completed' : 'Pending';

    // Conexión a la base de datos
    $database = new Db();
    $db = $database->connect();

    // Actualizar el estado de la tarea en la base de datos
    $stmt = $db->prepare("UPDATE tasks SET status = ? WHERE id = ?");
    $stmt->execute([$isCompleted, $taskId]);

   // Devolver una respuesta JSON
    echo json_encode(['status' => 'success']);
}
