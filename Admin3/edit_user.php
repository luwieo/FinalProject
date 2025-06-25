<?php
session_start();
require '../db.php';

if ($_SESSION['user']['user_type'] !== 'System Administrator') {
    http_response_code(403);
    exit("Access Denied.");
}

if (isset($_POST['user_id'], $_POST['user_type'])) {
    $stmt = $pdo->prepare("UPDATE users SET user_type = ? WHERE id = ?");
    $stmt->execute([$_POST['user_type'], $_POST['user_id']]);
}

header('Location: usermanagement.php');
exit;