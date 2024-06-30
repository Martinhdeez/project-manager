<?php include 'auth.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Opcional: añade tu hoja de estilos -->
</head>
<body>
<div class="dashboard">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p><a href="controllers/logoutController.php">Logout</a></p>
    </div>
</body>
</html>
