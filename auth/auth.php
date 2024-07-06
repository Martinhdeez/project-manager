<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:/project_manager/views/login.php");
    exit();
}

