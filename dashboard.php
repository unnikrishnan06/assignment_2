<?php 
include 'includes/header.php'; 
include 'includes/db.php'; 

if (empty($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>All Users</h2>
<a href="create.php"><button>Add New User</button></a>

<table>
    <tr>
        <th>Name</th>
        <th>Photo</th>
        <th>Actions</th>
    </tr>
    <?php
    
    $query = $connection->query("SELECT * FROM users ORDER BY id DESC");
    while ($userData = $query->fetch()):
    ?>
    <tr>
        <td><?= htmlspecialchars($userData['name']) ?></td>
        <td>
            <?php if (!empty($userData['image'])): ?>
                <img src="uploads/<?= htmlspecialchars($userData['image']) ?>" width="80" alt="User Photo">
            <?php endif; ?>
        </td>
        <td>
            <a href="update.php?id=<?= $userData['id'] ?>">Edit</a> | 
            <a href="delete.php?id=<?= $userData['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include 'includes/footer.php'; ?>
