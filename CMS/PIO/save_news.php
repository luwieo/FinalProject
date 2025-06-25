<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $video_url = $_POST['youtube_link'] ?? '';
    $publish_date = $_POST['publish_date'] ?? date('Y-m-d');

    $imagePath = '';

    $uploadDir = 'uploads/news/';
    $absoluteDir = __DIR__ . '/' . $uploadDir;

    if (!is_dir($absoluteDir)) {
        mkdir($absoluteDir, 0755, true);
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $filename = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetPath = $absoluteDir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            // IMPORTANT: Save relative path for <img src>
            $imagePath = $uploadDir . $filename; // e.g., "uploads/news/abc123.jpg"
        }
    }

    $stmt = $pdo->prepare("INSERT INTO news (title, content, image, video_url, publish_date)
                           VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $content, $imagePath, $video_url, $publish_date]);

    header("Location: cms.php?success=1");
    exit;
}
?>