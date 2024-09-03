<?php
include('../config/constants.php');

// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destroy the session and clear session variables
session_unset();
session_destroy();

// Redirect to login page
header('Location: ' . SITEURL . 'admin/login.php');
exit(); // Optional but recommended
?>
