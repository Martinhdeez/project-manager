<?php
session_start();
require_once("../config/db.php");

if(isset($_POST['submit_notes'])){

    $taskId = $_POST['id'];
    $new_note = $_POST['new_note'];
    $existing_note = $_POST['existing_notes'];
    $updated_note = $existing_note ? $existing_note. "\n" . $new_note: $new_note;

    $database = new Db();
    $db = $database->connect();

    $updateStmt = $db->prepare("UPDATE tasks SET notes = :notes WHERE id= :id ");
    
    $updateStmt->bindParam(':notes', $updated_note);
    $updateStmt->bindParam(':id', $taskId);
    if ($updateStmt->execute()) {
        $_SESSION['success'] = "Note added successfully.";
    } else {
        $_SESSION['error'] = "Failed to add note.";
    }
    // Redirigir de vuelta a la página de la tarea
    header('Location: ../views/task.php?id=' . $taskId);
    exit();

} else {
    $_SESSION['error'] = "Invalid request method.";
    header('Location: ../views/task.php?id=' . $taskId);
    exit();
}