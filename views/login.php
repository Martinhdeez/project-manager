<?php
require_once("../parts/header.php");
require_once("../includes/functions.php");
?>
    <div class="container mt-5">
        <form action="../controllers/LoginController.php" class="form" method="post">
            <h2 class="mb-4">User Login</h2>
            <?php
                session_start();
                success();
            ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" class="form-control" placeholder="Username" name="username" value="<?php echo isset($_SESSION['form_data']['username']) ? htmlspecialchars($_SESSION['form_data']['username']) : ''; ?>" required>
            </div>
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
                <button type="button" id="toggle-password" class="btn btn-outline-secondary position-absolute end-0 top-0 mt-2 me-2">
                    <i class="eye-icon">👁️</i>
                </button>
            </div>
            <button type="submit" name="login_submit" class="btn btn-primary">Login</button>
            <a href="register.php" class="btn btn-link">You still do not have an account?</a>
        </form>
        <script src="../js/showPasword.js"></script>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>