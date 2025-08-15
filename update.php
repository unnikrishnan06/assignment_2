<?php 
include 'includes/header.php'; 
include 'includes/db.php'; 

if (empty($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userId = $_GET['id'] ?? null;


$getUser = $connection->prepare("SELECT * FROM users WHERE id = ?");
$getUser->execute([$userId]);
$userInfo = $getUser->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedName = $_POST['name'];

    if (!empty($_FILES['image']['name'])) {
        $newImageName = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $newImageName);

        $updateQuery = $connection->prepare("UPDATE users SET name = ?, image = ? WHERE id = ?");
        $updateQuery->execute([$updatedName, $newImageName, $userId]);
    } else {
        $updateQuery = $connection->prepare("UPDATE users SET name = ? WHERE id = ?");
        $updateQuery->execute([$updatedName, $userId]);
    }

    echo "<p>User details updated successfully!</p>";
}
?>

<h2>Edit User</h2>
<form method="post" enctype="multipart/form-data">
    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($userInfo['name']) ?>" required>

    <label>Image:</label>
    <input type="file" name="image">

    <?php if (!empty($userInfo['image'])): ?>
        <img src="uploads/<?= htmlspecialchars($userInfo['image']) ?>" width="100"><br><br>
    <?php endif; ?>

    <button type="submit">Update</button>
</form>

<?php include 'includes/footer.php'; ?>
