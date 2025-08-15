<?php 
include 'includes/header.php'; 
include 'includes/db.php'; 
?>

<h2>Add New User</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUserName = $_POST['name'];
    $profileImage = null;

    if (!empty($_FILES['image']['name'])) {
        $profileImage = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $profileImage);
    }

    $insertUser = $connection->prepare("INSERT INTO users (name, image) VALUES (?, ?)");
    $insertUser->execute([$newUserName, $profileImage]);

    echo "<p>User added successfully!</p>";
}
?>

<form method="post" enctype="multipart/form-data">
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Image:</label>
    <input type="file" name="image">

    <button type="submit">Add User</button>
</form>

<?php include 'includes/footer.php'; ?>
