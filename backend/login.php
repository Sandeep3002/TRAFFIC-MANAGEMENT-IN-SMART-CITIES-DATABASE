<?php
// backend/login.php
require_once __DIR__ . '/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../frontend/login.html');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    echo "Please enter username and password.";
    exit;
}

$stmt = $mysqli->prepare("SELECT id, password, full_name FROM users WHERE username = ?");
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 0) {
    echo "Invalid username or password.";
    $stmt->close();
    exit;
}
$stmt->bind_result($id, $hash, $full_name);
$stmt->fetch();

if (password_verify($password, $hash)) {
    // secure session
    session_regenerate_id(true);
    $_SESSION['user_id'] = $id;
    $_SESSION['username'] = $username;
    $_SESSION['full_name'] = $full_name;

    header('Location: ../backend/dashboard.php');
    exit;
} else {
    echo "Invalid username or password.";
}
$stmt->close();
