<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>my web</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav>
    <a href="index.php">Home</a> |
    <?php if (isset($_SESSION['user'])): ?>
        <a href="dashboard.php">Dashboard</a> |
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a> |
        <a href="register.php">Register</a>
    <?php endif; ?>
</nav>
<hr>
