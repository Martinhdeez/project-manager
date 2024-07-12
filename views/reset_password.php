<?php

require_once '../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    $database = new Db();
    $db = $database->connect();

    if ($password === $confirm_password) {
        // Verifica si el token es válido y no ha expirado
        $stmt = $db->prepare("SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()");
        $stmt->execute([$token]);
        $resetRequest = $stmt->fetch();

        if ($resetRequest) {
            $email = $resetRequest['email'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Actualiza la contraseña del usuario
            $stmt = $db->prepare("UPDATE users SET password = ? WHERE email = ?");
            $stmt->execute([$hashedPassword, $email]);

            // Elimina el token de restablecimiento
            $stmt = $db->prepare("DELETE FROM password_resets WHERE token = ?");
            $stmt->execute([$token]);

            echo "Su contraseña ha sido restablecida exitosamente.";
        } else {
            echo "El enlace de restablecimiento de contraseña es inválido o ha expirado.";
        }
    } else {
        echo "Las contraseñas no coinciden.";
    }
}

