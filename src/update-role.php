<?php
require_once 'user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $newRole = $_POST['role'];

    if (User::updateRole($userId, $newRole)) {
        header('Location: /users.php?message=Role updated successfully');
        exit;
    } else {
        header('Location: /users.php?error=Failed to update role');
        exit;
    }
}
?>
