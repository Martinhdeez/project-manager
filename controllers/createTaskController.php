<?php
include '../config/db.php';
session_start();

if(isset($_POST['task_submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $project_id = $_SESSION['project_id'];

    $database = new Db();
    $db = $database->connect();

    $stmt = $db->prepare("INSERT INTO tasks(title, description, project_id) VALUES(?, ?, ?)");
    if($stmt->execute([$title, $descrption, $project_id])){
        $_SESSION['success'] = "Project created successfully!";
    } else {
        $_SESSION['error'] = "Error creating project.";
    }

    header("Location: ../views/tasks.php");
    exit();
}