<?php

include 'includes/header.php';
include 'includes/db.php';


if (empty($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userId = $_GET['id'] ?? null;

if ($userId) {

    $fetchImage = $connection->prepare("SELECT image FROM users WHERE id = ?");
    $fetchImage->execute([$userId]);
    $userRecord = $fetchImage->fetch();

    if ($userRecord) {

        $deleteUser = $connection->prepare("DELETE FROM users WHERE id = ?");
        $deleteUser->execute([$userId]);

        $uploadPath = __DIR__ . "/uploads/" . $userRecord['image'];
        if (!empty($userRecord['image']) && file_exists($uploadPath)) {
            unlink($uploadPath);
        }
    }
}

header("Location: dashboard.php");
exit();
?>
