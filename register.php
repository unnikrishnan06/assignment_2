<?php 
include 'includes/header.php'; 
include 'includes/db.php'; 
?>

<h2>Create Account</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['username'];
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $insertUser = $connection->prepare("INSERT INTO users (name, password) VALUES (?, ?)");
    $insertUser->execute([$newUsername, $hashedPassword]);

    echo "<p>Registration successful! <a href='login.php'>Login here</a></p>";
}
?>

<form method="post">
    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Register</button>
</form>

<?php include 'includes/footer.php'; ?>
