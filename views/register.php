<?php
require_once("../parts/header.php");
require_once("../includes/functions.php");
session_start();
?>
     <div class="container mt-5">
        <form action="../controllers/registerController.php" class="form" method="post">
            <h2 class="mb-4">User Registration</h2>
            <?php success(); ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" class="form-control" placeholder="Username" name="username" value="<?=isset($_SESSION['form_data']['username']) ? htmlspecialchars($_SESSION['form_data']['username']) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Email" name="email" value="<?=isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>" required>
            </div>
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
                <button type="button" id="toggle-password" class="btn btn-outline-secondary position-absolute end-0 top-0 mt-2 me-2">
                    <i class="eye-icon">👁️</i>
                </button>
            </div>
            <div class="mb-3 position-relative">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
                <button type="button" id="toggle-password-confirm" class="btn btn-outline-secondary position-absolute end-0 top-0 mt-2 me-2">
                    <i class="eye-icon">👁️</i>
                </button>
            </div>
            <button type="submit" name="register_submit" class="btn btn-primary">Register</button>
            <a href="login.php" class="btn btn-link">Do you already have an account?</a>
        </form>
    </div>
    <script src="../js/showPasword.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>