<? require_once '../parts/header.php'; ?>

<div class="container mt-5">
        <h2 class="mb-4">Recuperar Contraseña</h2>
        <form action="../controllers/sendResetLink.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar enlace de restablecimiento</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>