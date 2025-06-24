<?php
session_start();
require 'db.php'; // Assuming db.php contains your PDO database connection

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = $_POST['email_or_phone'] ?? '';
    $password = $_POST['password'] ?? '';

    // Fetch user details including the 'user_type'
    $stmt = $pdo->prepare("SELECT id, first_name, last_name, email, mobile, address, birth_date, gender, password, user_type FROM users WHERE email = :id OR mobile = :id");
    $stmt->execute(['id' => $identifier]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user'] = [
                'name' => $user['first_name'] . ' ' . $user['last_name'],
                'email' => $user['email'],
                'mobile' => $user['mobile'] ?? 'N/A',
                'address' => $user['address'] ?? 'N/A',
                'birth_date' => $user['birth_date'] ?? 'N/A', // Using 'birth_date' as per your DB schema
                'gender' => $user['gender'] ?? 'N/A',
                'user_type' => $user['user_type'] ?? 'public' // Store the user type from the DB
            ];

            // Redirect based on user_type
            if ($_SESSION['user']['user_type'] === 'System Administrator') {
                header('Location: Admin/admin_dashboard.php'); // Redirect to your admin dashboard
                exit;
            } else {
                header('Location: User/home.php'); // Redirect to the public home page
                exit;
            }
        } else {
            // Login failed - Incorrect password
            header('Location: login.html?login_error=password'); // Specific error for incorrect password
            exit;
        }
    } else {
        // Login failed - Email or phone does not exist
        header('Location: login.html?login_error=not_found'); // Specific error for not found
        exit;
    }
} else {
    // If accessed directly (not via POST), redirect to login form
    header('Location: login.html');
    exit;
}