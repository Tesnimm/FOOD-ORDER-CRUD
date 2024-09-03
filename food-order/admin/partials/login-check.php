<?php 
    // Session başlatılması
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Authorization - Access Control
    if(!isset($_SESSION['user']))
    {
        // User is not logged in
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
        
        // Redirection
        header('location: '.SITEURL.'admin/login.php');
        exit(); // It's good practice to include exit after a header redirect
    }
?>
