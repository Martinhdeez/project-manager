<?php
require_once '../config/db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : NULL;

    // Verificar si se recibió el project_id
    if (!$project_id) {
        $_SESSION['error'] = "Project ID missing.";
        echo "NO hay PORJECT ID";
        header("Location: ../index.php");
        exit();
    }

    $database = new Db();
    $db = $database->connect();

    try {
        echo "PROJECT_ID= ". $project_id."<br>";
        echo "USER_ID= ".$_SESSION["user_id"]."<br>";
        echo "Entra en eliminar tareas<br>";
        // Verificar si el proyecto existe y pertenece al usuario
        $stmt = $db->prepare("SELECT * FROM projects WHERE id = ? AND user_id = ?");
        $stmt->execute([$project_id, $_SESSION['user_id']]);

        echo "tareas eliminadas correctamente<br>";

        $project = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$project) echo "no cogido bien el proyecto<br>";
        
        
        if ($project) {
            echo "Entra en proyecto<br>";
            // Eliminar tareas asociadas
            try {
                $stmt = $db->prepare("DELETE FROM tasks WHERE project_id = ?");
                $stmt->execute([$project_id]);
                echo "Eliminó tareas<br>";
            } catch (PDOException $e) {
                $_SESSION['error'] = "Error deleting tasks: " . $e->getMessage();
                header("Location: ../index.php");
                exit();
            }

            // Eliminar proyecto
            try {
                $stmt = $db->prepare("DELETE FROM projects WHERE id = ?");
                if ($stmt->execute([$project_id])) {
                    $_SESSION['success'] = "Project deleted successfully.";
                    
                } else {
                    $_SESSION['error'] = "Project not found or access denied.";
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = "Error deleting project: " . $e->getMessage();
            }
        } else {
            $_SESSION['error'] = "Project not found.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
    }

    header("Location: ../index.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request.";
    
    header("Location: ../index.php");
    exit();
}
