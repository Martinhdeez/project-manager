<?php
require_once '../config/db.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $project_id = $_POST['project_id'];
    $end_date= $_POST['end_date'];
    $priority= $_POST['priority'];

    $database = new Db();
    $db = $database->connect();
    try {
        $stmt = $db->prepare("INSERT INTO tasks (title, description, project_id, end_date, priority) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$title, $description, $project_id, $end_date, $priority])) {
            $_SESSION['success'] = "Task created successfully!";
        } else {
            $_SESSION['error'] = "Error creating task.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
    }

    header("Location: ../views/project.php?id=". $project_id);
    exit();
}