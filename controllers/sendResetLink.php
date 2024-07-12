
<?php
require_once '../config/db.php'; 
require_once '../includes/functions.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
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
        $subject = "Restore Password";
        $message = "Click in this link to restore the password: $resetLink";
        sendMail($email, $subject, $message);
    } 
        echo "if this mail have an account , an email has been sent to reset your password";
    
}
?>
