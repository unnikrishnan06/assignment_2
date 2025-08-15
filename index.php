<?php
include 'includes/header.php';


if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<h2>Welcome to my page</h2>
<p>page functions <a href="login.php">login</a> or <a href="register.php">register</a></p>

<?php include 'includes/footer.php'; ?>
