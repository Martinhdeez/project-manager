<?php
include '../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title']; 
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];
    
    $coverName =  basename($_FILES['cover']['name']);
    $coverPath = '../project_covers/' .$coverName;
    move_uploaded_file($_FILES['cover']['tmp_name'], $coverPath);//guarda el archivo en el path

    // Conectar a la base de datos y crear el proyecto
    $database = new Db();
    $db = $database->connect();

    $stmt = $db->prepare("INSERT INTO projects (title, description, user_id, cover_name) VALUES (?, ?, ?, ?)");
    
        if ($stmt->execute([$title, $description, $user_id, $coverName])) {
            $_SESSION['success'] = "Project created successfully!";
        } else {
            $_SESSION['error'] = "Error creating project.";
        }

    header("Location: ../views/projects.php");
    exit();
    }


