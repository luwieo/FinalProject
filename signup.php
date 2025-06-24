<?php
session_start();
require 'db.php'; // Assuming db.php contains your PDO database connection

// Enable error reporting for debugging (recommended during development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect input values
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $birth_date = $_POST['birth_date'] ?? '';
    $address = $_POST['address'] ?? '';
    $email = $_POST['email'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $password = $_POST['password'] ?? '';
    // IMPORTANT: You need to add name="confirm_password" to your HTML input for this to work
    $confirm_password = $_POST['confirm_password'] ?? '';
    $resident = isset($_POST['resident']) ? 1 : 0; // Checkbox value

    // --- Server-Side Validation ---

    // 1. Check if passwords match
    if ($password !== $confirm_password) {
        // Passwords do not match, redirect with error
        header('Location: login.html?signup_error=password_mismatch');
        exit;
    }

    // 2. Check if email or mobile already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email OR mobile = :mobile");
    $stmt->execute(['email' => $email, 'mobile' => $mobile]);
    if ($stmt->fetch(PDO::FETCH_ASSOC)) { // Use fetch(PDO::FETCH_ASSOC) instead of rowCount() for efficiency after execute
        // An account with this email or mobile already exists, redirect with error
        header('Location: login.html?signup_error=exists');
        exit;
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    try {
        // Assuming your 'users' table has a 'user_type' column with a default of 'public'
        // If not, you might need to adjust the INSERT statement or your DB schema.
        $insert = $pdo->prepare("INSERT INTO users (first_name, last_name, gender, birth_date, address, email, mobile, password, resident, user_type)
                                 VALUES (:first_name, :last_name, :gender, :birth_date, :address, :email, :mobile, :password, :resident, 'public')");
        $insert->execute([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'gender' => $gender,
            'birth_date' => $birth_date,
            'address' => $address,
            'email' => $email,
            'mobile' => $mobile,
            'password' => $hashedPassword,
            'resident' => $resident
        ]);

        // Signup successful
        // It's generally better to store user_id in session too after signup
        $_SESSION['user_id'] = $pdo->lastInsertId(); // Get the ID of the newly inserted user
        $_SESSION['user'] = [
            'name' => $first_name . ' ' . $last_name,
            'email' => $email,
            'user_type' => 'Resident' // Default user_type for new signups
        ];

        // Redirect to login page with success message
        header('Location: login.html?signup=success');
        exit;

    } catch (PDOException $e) {
        // Handle any database insertion errors
        error_log("Signup database error: " . $e->getMessage()); // Log the actual error for debugging
        header('Location: login.html?signup_error=db_error'); // Redirect with a generic DB error message
        exit;
    }

} else {
    // If accessed directly (not via POST), redirect to login form
    header('Location: login.html');
    exit;
}
?>
