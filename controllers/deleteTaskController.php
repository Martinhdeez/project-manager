<?php
require_once("../config/db.php");
session_start();

if(isset($_POST['id'])){
    
    $id = $_POST['id'];
    $projectId = $_POST['project_id'];

    $database= new Db();

    $db = $database->connect();

    try{
        $stmt = $db -> prepare("DELETE FROM tasks WHERE id = ? ");
        if( $stmt->execute([$id]) ){
            $_SESSION['success'] = "Task deleteed succesfully";
        }else{
            $_SESSION['error'] = "Task not found or access denied.";    
        }
    
    }catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
    }
    header("Location: ../views/project.php?id=".$projectId."");
    exit();
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../index.php");
    exit();
}


    
