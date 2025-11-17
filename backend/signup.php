<?php
// backend/signup.php
require_once __DIR__ . '/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../frontend/index.html');
    exit;
}

// Get and trim inputs
$username = trim($_POST['username'] ?? '');
$full_name = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';
$gender = $_POST['gender'] ?? '';

// Basic validation
$errors = [];

if ($username === '' || $email === '' || $password === '') {
    $errors[] = 'Please fill required fields.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email.';
}
if (strlen($password) < 8) {
    $errors[] = 'Password must be at least 8 characters.';
}
if ($password !== $confirm) {
    $errors[] = 'Passwords do not match.';
}

if ($errors) {
    // For simplicity, return to index with first error (adjust as needed)
    echo htmlspecialchars($errors[0]);
    exit;
}

// Check duplicate username/email
$stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
$stmt->bind_param('ss', $username, $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo "Username or email already exists.";
    $stmt->close();
    exit;
}
$stmt->close();

// Insert user
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $mysqli->prepare("INSERT INTO users (username, full_name, email, phone_number, password, gender) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param('ssssss', $username, $full_name, $email, $phone, $hash, $gender);

if ($stmt->execute()) {
    // Redirect to login page on success
    header('Location: ../frontend/login.html');
    exit;
} else {
    echo "Error creating user: " . $stmt->error;
}
