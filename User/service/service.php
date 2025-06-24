<?php
ob_start(); 

set_exception_handler(function($exception) {
    ob_clean();
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'A server error occurred. Please try again.',
        'detail' => [
            'error' => $exception->getMessage(),
            'file' => basename($exception->getFile()),
            'line' => $exception->getLine()
        ]
    ]);
    exit;
});

set_error_handler(function($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

try {
require_once '../../db.php';
} catch (PDOException $e) {
    ob_clean();
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Database connection failed. Please check server configuration.',
        'detail' => [
            'error' => $e->getMessage()
        ]
    ]);
    exit;
} catch (Throwable $e) { 
    ob_clean();
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'An unexpected error occurred during database setup.',
        'detail' => [
            'error' => $e->getMessage(),
            'file' => basename($e->getFile()),
            'line' => $e->getLine()
        ]
    ]);
    exit;
}


$upload_dir = 'uploads/'; 
header('Content-Type: application/json');

function send_error($message, $code = 400) {
    http_response_code($code);
    ob_clean(); 
    echo json_encode(['status' => 'error', 'message' => $message]);
    exit;
}

if (!is_dir($upload_dir)) {
    if (!mkdir($upload_dir, 0755, true)) {
        if (!is_dir($upload_dir)) {
            send_error('Failed to create upload directory. Please check server permissions.', 500);
        }
    }
}

$pdo->exec("CREATE TABLE IF NOT EXISTS `document_tracker` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `tracking_number` varchar(50) NOT NULL,
    `appdocu` varchar(255) DEFAULT NULL,
    `suppdocu` text DEFAULT NULL,
    `service_type` varchar(255) DEFAULT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `tracking_number` (`tracking_number`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    send_error('Only POST method is accepted.', 405);
}
if (!isset($_FILES['documents']) || !is_array($_FILES['documents']['name'])) {
    send_error('No file data received. Ensure files are sent correctly.');
}

$files = $_FILES['documents'];
$service_type = isset($_POST['serviceType']) ? trim($_POST['serviceType']) : 'N/A';
$upload_type = isset($_POST['uploadType']) ? trim($_POST['uploadType']) : 'N/A';
$tracking_number = isset($_POST['trackingNumber']) ? trim($_POST['trackingNumber']) : null;


if ($upload_type === 'application') {
    if (count($files['name']) !== 1) {
        send_error('Please upload exactly one application form.');
    }
    if ($files['error'][0] !== UPLOAD_ERR_OK) {
        send_error('An error occurred during file upload. Code: ' . $files['error'][0]);
    }
    
    $tracking_number = 'DOC-' . time() . '-' . mt_rand(1000, 9999);
    $original_filename = basename($files['name'][0]);
    $file_extension = pathinfo($original_filename, PATHINFO_EXTENSION);
    $new_filename = $tracking_number . '-application.' . $file_extension;
    $destination_path = $upload_dir . $new_filename;

    if (!move_uploaded_file($files['tmp_name'][0], $destination_path)) {
        send_error('Failed to move uploaded application file.', 500);
    }

    $sql = "INSERT INTO document_tracker (tracking_number, appdocu, service_type) VALUES (:tracking_number, :appdocu, :service_type)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':tracking_number' => $tracking_number,
        ':appdocu' => $new_filename,
        ':service_type' => $service_type
    ]);

    echo json_encode([
        'status' => 'success',
        'message' => 'Application form uploaded successfully!',
        'trackingNumber' => $tracking_number
    ]);

} elseif ($upload_type === 'supporting') {
    if (empty($tracking_number)) {
        send_error('A tracking number is required for supporting documents.');
    }

    $stmt = $pdo->prepare("SELECT suppdocu FROM document_tracker WHERE tracking_number = :tracking_number");
    $stmt->execute([':tracking_number' => $tracking_number]);
    $result = $stmt->fetch();

    if (!$result) {
        send_error('Invalid tracking number provided.', 404);
    }
    
    $existing_docs = []; 
    
    if (!empty($result['suppdocu'])) { 
        $existing_docs = json_decode($result['suppdocu'], true);
  
        if (json_last_error() !== JSON_ERROR_NONE) {
            send_error('Could not parse existing document data in the database.', 500);
        }
    }

    $newly_uploaded_docs_filenames = [];
    
    $pdo->beginTransaction();
    try {
        $file_count = count($files['name']);
        for ($i = 0; $i < $file_count; $i++) {
            if ($files['error'][$i] !== UPLOAD_ERR_OK) {
                throw new Exception('An error occurred during file upload. Code: ' . $files['error'][$i]);
            }
            $original_filename = basename($files['name'][$i]);
            $file_extension = pathinfo($original_filename, PATHINFO_EXTENSION);
            $new_filename = $tracking_number . '-support-' . time() . '-' . uniqid() . '.' . $file_extension;
            $destination_path = $upload_dir . $new_filename;

            if (move_uploaded_file($files['tmp_name'][$i], $destination_path)) {
                $newly_uploaded_docs_filenames[] = $new_filename;
            } else {
                throw new Exception('Failed to move an uploaded file.');
            }
        }

        $all_supporting_docs = array_merge($existing_docs, $newly_uploaded_docs_filenames);
        $sql = "UPDATE document_tracker SET suppdocu = :suppdocu WHERE tracking_number = :tracking_number";
        $update_stmt = $pdo->prepare($sql);
        $update_stmt->execute([
            ':suppdocu' => json_encode($all_supporting_docs),
            ':tracking_number' => $tracking_number
        ]);
        $pdo->commit();
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Supporting document(s) uploaded successfully!',
            'trackingNumber' => $tracking_number
        ]);

    } catch (Exception $e) {
        $pdo->rollBack();
        foreach ($newly_uploaded_docs_filenames as $filename) {
            if (file_exists($upload_dir . $filename)) {
                unlink($upload_dir . $filename);
            }
        }
        throw $e; 
    }

} else {
    send_error('Invalid upload type specified.');
}
?>