<?php
require("../parts/header.php");
?>
    <div class="container mt-5">
        <form action="../controllers/registerController.php" class="form" method="post">
            <h2 class="mb-4">User Registration</h2>
            <?php
                session_start();
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>" . htmlspecialchars($_SESSION['error']) . "</div>";
                    unset($_SESSION['error']); // Limpiar el mensaje de error después de mostrarlo
                }
                if (isset($_SESSION['success'])) {
                    echo "<div class='alert alert-success'>" . htmlspecialchars($_SESSION['success']) . "</div>";
                    unset($_SESSION['success']); // Limpiar el mensaje de éxito después de mostrarlo
                }
            ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" class="form-control" placeholder="Username" name="username" value="<?php echo isset($_SESSION['form_data']['username']) ? htmlspecialchars($_SESSION['form_data']['username']) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Email" name="email" value="<?php echo isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
            </div>
            <button type="submit" name="register_submit" class="btn btn-primary">Register</button>
            <a href="login.php" class="btn btn-link">Do you already have an account?</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
