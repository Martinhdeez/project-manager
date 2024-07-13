<?php
require_once '../config/db.php'; 
require_once '../includes/functions.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            $database = new Db();
            $db = $database->connect();
            
            // Verifica si el correo electrónico existe en la base de datos
            $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user) {
                // Genera un token único
                $token = bin2hex(random_bytes(50));
                
                // Guarda el token en la base de datos con una validez de una hora
                $stmt = $db->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))");
                $stmt->execute([$email, $token]);
                
                // Enviar correo electrónico
                $resetLink = "http://project_manager/views/reset_password.php?token=$token";
                $subject = "Restablecer Contraseña";
                $message = "Haz clic en este enlace para restablecer tu contraseña: $resetLink";
                sendMail($email, $subject, $message);
            }
            echo "Si este correo está registrado, se ha enviado un enlace para restablecer la contraseña.";
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo "Hubo un error procesando su solicitud. Por favor, inténtelo de nuevo más tarde.";
        }
    } else {
        echo "Correo electrónico no válido.";
    }
}
