<?php include('../config/constants.php');
    include('partials/menu.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/admin.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Add Admin</title>
   
</head>
<body>
    <h1>Add Admin</h1>
    <form action="" method="POST">
        <table>
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="Please enter your Full Name" required></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" placeholder="Please enter your Username" required></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" placeholder="Please enter your Password" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
    // Veritabanı bağlantısı ve diğer ayarlar...
    
    if (isset($_POST['submit'])) {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Şifreyi hash'le

        $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$full_name', '$username', '$password')";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            $_SESSION['add'] = "Admin added successfully";
            header('Location: ' . SITEURL . 'admin/manage-admin.php');
            exit(); // Yönlendirme sonrası kodun çalışmaması için
        } else {
            $_SESSION['add'] = "Failed to add admin";
            header('Location: ' . SITEURL . 'admin/add-admin.php');
            exit(); // Yönlendirme sonrası kodun çalışmaması için
        }
    }
?>



<?php include('partials/footer.php'); ?>
