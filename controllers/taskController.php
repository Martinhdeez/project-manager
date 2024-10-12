<?php
session_start();

require_once __DIR__ . '/../config/db.php'; // Ruta absoluta para la inclusión

$action = $_GET['action'] ?? 'save';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Db();
    $db = $database->connect();

    $taskId = $_POST['id'] ?? null;
    $title = $_POST['title'];
    $description = $_POST['description'];
    $project_id = $_POST['project_id'];
    // Obtener la fecha de finalización del formulario
    $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d');
    $priority = $_POST['priority'];
    $notes = $_POST['notes'];
    $tags = $_POST['tags'];
    $status = $_POST['status'];

    if ($taskId && $action == 'save') {
        // Actualizar tarea existente
        try {
            $stmt = $db->prepare("UPDATE tasks SET title = ?, description = ?, end_date = ?, priority = ?, tags = ?, status = ?, notes = ? WHERE id = ?");
            if ($stmt->execute([$title, $description, $end_date, $priority, $tags, $status, $notes, $taskId])) {
                $_SESSION['success'] = "Task updated successfully!";
            } else {
                $_SESSION['error'] = "Error updating task.";
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Database error: " . $e->getMessage();
        }
    } elseif ($action == 'save') {
        // Crear nueva tarea
        try {

            $stmt = $db->prepare("INSERT INTO tasks (title, description, project_id, end_date, priority, tags, status, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$title, $description, $project_id, $end_date, $priority, $tags, $status, $notes])) {
                $_SESSION['success'] = "Task created successfully!";
            } else {
                $_SESSION['error'] = "Error creating task.";
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Database error: " . $e->getMessage();
        }
    } elseif ($action == 'delete') {
        // Eliminar tarea
        $taskId = $_POST['id'];
        $project_id = $_POST['project_id'];

        try {
            $stmt = $db->prepare("DELETE FROM tasks WHERE id = ?");
            if ($stmt->execute([$taskId])) {
                $_SESSION['success'] = "Task deleted successfully!";
            } else {
                $_SESSION['error'] = "Error deleting task.";
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Database error: " . $e->getMessage();
        }
    }

    header("Location: ../views/project.php?id=".$project_id);
    exit();
}
?>
