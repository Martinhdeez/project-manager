<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <form action="../controllers/LoginController.php" method="post">
        <h2>User Login</h2>
        <?php
            session_start();
            if (isset($_SESSION['error'])) {
                echo "<div class='error'>" . $_SESSION['error'] . "</div>";
                unset($_SESSION['error']); // Limpiar el mensaje de error después de mostrarlo
            }
        ?>
        <input type="text" id="username" placeholder="username" name="username" value="<?php echo isset($_SESSION['form_data']['username']) ? htmlspecialchars($_SESSION['form_data']['username']) : ''; ?>" required>
        <br>
        <input type="password" placeholder="password" id="password" name="password" required>
        <br>
        <button type="submit" name="login_submit">Login</button>
        <a href="register.php">You still do not have an account?</a>
    </form>
</body>
</html>
