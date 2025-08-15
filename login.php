<?php 
include 'includes/header.php'; 
include 'includes/db.php'; 
?>

<h2>Login</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    $getUser = $connection->prepare("SELECT * FROM users WHERE name = ?");
    $getUser->execute([$inputUsername]);
    $userRecord = $getUser->fetch();

    if ($userRecord && password_verify($inputPassword, $userRecord['password'])) {
        $_SESSION['user'] = $userRecord['name'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<p>Incorrect username or password.</p>";
    }
}
?>

<form method="post">
    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>

<?php include 'includes/footer.php'; ?>
