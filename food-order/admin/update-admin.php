<?php
    include('partials/menu.php');
    include('../config/constants.php'); // Veritabanı bağlantısını sağlama

    // Başlangıçtan önce bir şey yazılmışsa, header() fonksiyonu çalışmaz.
    ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Update Admin</title>
</head>
<body>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>

            <br><br>

            <?php
                // Ensure ID is set
                if (!isset($_GET['id'])) {
                    header('Location: ' . SITEURL . 'admin/manage-admin.php');
                    exit();
                }

                $id = $_GET['id'];

                // Prepare and execute query to get admin details
                $stmt = $conn->prepare("SELECT * FROM tbl_admin WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();

                if ($res->num_rows == 1) {
                    $row = $res->fetch_assoc();
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                } else {
                    header('Location: ' . SITEURL . 'admin/manage-admin.php');
                    exit();
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" value="<?php echo htmlspecialchars($full_name); ?>" required></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>

<?php
    if (isset($_POST['submit'])) {
        // Process the form
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        // Prepare and execute update query
        $stmt = $conn->prepare("UPDATE tbl_admin SET full_name = ?, username = ? WHERE id = ?");
        $stmt->bind_param("ssi", $full_name, $username, $id);
        $res = $stmt->execute();

        if ($res) {
            $_SESSION['update'] = "Admin Updated Successfully";
            header('Location: ' . SITEURL . 'admin/manage-admin.php');
            exit();
        } else {
            $_SESSION['update'] = "Failed to update admin";
            header('Location: ' . SITEURL . 'admin/manage-admin.php');
            exit();
        }
    }
?>

<?php include('partials/footer.php'); ?>
