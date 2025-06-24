<?php
header('Content-Type: application/json');
require '../db.php'; // Make sure this exists and is correct

// Show all errors for debugging (temporarily)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Make sure it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

// Collect POST data
$reference_number = $_POST['reference_number'] ?? '';
$applicant_name = $_POST['applicant_name'] ?? '';
$amount = $_POST['amount'] ?? '';
$payment_method = $_POST['payment_method'] ?? '';
$transaction_number = $_POST['transaction_number'] ?? '';
$status = $_POST['status'] ?? 'Ready for Release'; // default

// Validate inputs
if (!$reference_number || !$applicant_name || !$amount || !$payment_method || !$transaction_number) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

// Save to DB
try {
    $stmt = $pdo->prepare("INSERT INTO payments (reference_number, applicant_name, amount, payment_method, transaction_number, payment_date, status)
                           VALUES (:reference_number, :applicant_name, :amount, :payment_method, :transaction_number, NOW(), :status)");
    $stmt->execute([
        ':reference_number' => $reference_number,
        ':applicant_name' => $applicant_name,
        ':amount' => $amount,
        ':payment_method' => $payment_method,
        ':transaction_number' => $transaction_number,
        ':status' => $status
    ]);

    echo json_encode(['status' => 'success', 'message' => 'Payment recorded successfully']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'DB Error: ' . $e->getMessage()]);
}
?>