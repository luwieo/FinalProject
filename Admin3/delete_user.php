<?php
session_start();
require '../db.php';

if ($_SESSION['user']['user_type'] !== 'System Administrator') {
    http_response_code(403);
    exit("Access Denied.");
}

if (isset($_POST['user_id'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_POST['user_id']]);
}

header('Location: admin_users.php');
exit;