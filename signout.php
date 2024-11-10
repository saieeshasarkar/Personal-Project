<?php
// Check if user exists
// Set content type to JSON
header('Content-Type: application/json');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Allow only POST requests
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

$Response = [
    'status' => 'success',
    'message' => 'loguout successful'
];

echo json_encode($Response);
exit;
?>
