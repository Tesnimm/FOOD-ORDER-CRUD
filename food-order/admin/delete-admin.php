<?php

 include('../config/constants.php');
 include('../css/admin.css');
  

    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_Admin WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $res = mysqli_stmt_execute($stmt);

    if ($res) {
        $_SESSION['delete'] = "Admin deleted successfully";
    } else {
        $_SESSION['delete'] = "Failed to delete admin. Try Again Later.";
    }

    header("location:" . SITEURL . 'admin/manage-admin.php');

?>



