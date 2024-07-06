<?php
include("../parts/header.php");
?>
<body>
    <form action="../controllers/registerController.php" method="post">
        <h2>User Registration</h2>
        
        <?php
            session_start();
            if (isset($_SESSION['error'])) {
                echo "<div class='error'>" . $_SESSION['error'] . "</div>";
                unset($_SESSION['error']); // Limpiar el mensaje de error después de mostrarlo
            }
            if (isset($_SESSION['success'])) {
                echo "<div class='success'>" . $_SESSION['success'] . "</div>";
                unset($_SESSION['success']); // Limpiar el mensaje de éxito después de mostrarlo
            }
        ?>

        <input type="text" placeholder="username" id="username" name="username"  
            value="<?php echo isset($_SESSION['form_data']['username']) ? htmlspecialchars($_SESSION['form_data']['username']) : ''; ?>" required>
        
        <br>
        
        <input type="email" placeholder="email" id="email" name="email" 
            value="<?php echo isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>" required>
        
        <br>

        <input type="password" placeholder="password" id="password" name="password" required>
        <br>
        
        <button type="submit" name="register_submit">Register</button>

        <a href="login.php" class="link">Do you already have an account?</a>
    </form>

</body>
</html>