<?php
include('../config/constants.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>

        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username" required><br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password" required><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
        </form>

        <p class="text-center">Created By - <a href="https://www.tesnimstrazimiri.com">Tesnim Strazimiri</a></p>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    // Get user input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Encrypt the password
    $password = md5($password);

    // Prepare SQL query
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            // Login successful
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; // Store user session
            header('Location: ' . SITEURL . 'admin/');
            exit(); // Stop further script execution
        } else {
            // Login failed
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            header('Location: ' . SITEURL . 'admin/login.php');
            exit(); // Stop further script execution
        }
    } else {
        // SQL query failed
        $_SESSION['login'] = "<div class='error text-center'>Database query failed. Try again later.</div>";
        header('Location: ' . SITEURL . 'admin/login.php');
        exit(); // Stop further script execution
    }
}
?>
