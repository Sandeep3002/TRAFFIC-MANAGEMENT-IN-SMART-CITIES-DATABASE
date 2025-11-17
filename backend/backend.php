<?php
// backend/db.php
// Database connection - adjust credentials as needed
ini_set('display_errors', 1);
error_reporting(E_ALL);

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';         // <-- set your DB password
$DB_NAME = 'traffic_management';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($mysqli->connect_errno) {
    http_response_code(500);
    die("DB connection failed: " . $mysqli->connect_error);
}

// set charset
$mysqli->set_charset('utf8mb4');