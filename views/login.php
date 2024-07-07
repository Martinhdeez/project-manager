<?php
require_once("../parts/header.php");
?>
    <div class="container mt-5">
        <form action="../controllers/LoginController.php" class="form" method="post">
            <h2 class="mb-4">User Login</h2>
            <?php
                session_start();
                
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>" . htmlspecialchars($_SESSION['error']) . "</div>";
                    unset($_SESSION['error']); // Limpiar el mensaje de error después de mostrarlo
                }
            ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" class="form-control" placeholder="Username" name="username" value="<?php echo isset($_SESSION['form_data']['username']) ? htmlspecialchars($_SESSION['form_data']['username']) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
            </div>
            <button type="submit" name="login_submit" class="btn btn-primary">Login</button>
            <a href="register.php" class="btn btn-link">You still do not have an account?</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>