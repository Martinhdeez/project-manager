<?php
require_once '../config/db.php';

session_start();

if(isset($_POST['project_id'])){
    
    $project_id = $_POST['project_id'];

    $database = new Db();
    $db = $database->connect();
    try{
    $stmt = $db->prepare("SELECT * FROM PROJECTS WHERE id= ? AND user_id = ?");
    $stmt->execute([$project_id, $_SESSION['user_id']]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($project){
            //Eliminar tareas asociadas
            $stmt = $db->prepare("DELETE FROM tasks WHERE project_id= ?");
            $stmt->execute([$project_id]);

            //Eliminar proyecto
            $stmt=$db->prepare("DELETE FROM projects WHERE id=?");
            if( $stmt->execute([$project_id]) ){
                $_SESSION['success'] = "Project deleteed succesfully";
            }else{
                $_SESSION['error'] = "Project not found or access denied.";    
            }
        }
    }catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
    }
    header("Location: ../index.php");
    exit();

} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../index.php");
    exit();
}

