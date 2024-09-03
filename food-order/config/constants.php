<?php
    // // Start session
    // session_start();

    // // Create constants to store non-repeating values
    // define('SITEURL', 'http://localhost/food-order/');
    // define('LOCALHOST', 'localhost');
    // define('DB_USERNAME', 'root');
    // define('DB_PASSWORD', '');
    // define('DB_NAME', 'food-order');

    // // Database connection
    // $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD,DB_NAME) or die(mysqli_connect_error());
    // $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

?>

<?php
    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Create constants to store non-repeating values
    if (!defined('SITEURL')) {
        define('SITEURL', 'http://localhost:8080/food-order/');
    }
    if (!defined('LOCALHOST')) {
        define('LOCALHOST', 'localhost');
    }
    if (!defined('DB_USERNAME')) {
        define('DB_USERNAME', 'root');
    }
    if (!defined('DB_PASSWORD')) {
        define('DB_PASSWORD', '');
    }
    if (!defined('DB_NAME')) {
        define('DB_NAME', 'food-order');
    }

    // Database connection
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }
?>

