<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/admin.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Manage Order</title>
</head>
<body>
<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <br/><br/><br/>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <tr>
                <td>1.</td>
                <td>Tesnim Strazimiri</td>
                <td>tesnimstrazimiri</td>
                <td>
                    <a href="update-admin.php?id=1" class="btn-secondary">Update Admin</a>
                    <a href="delete-admin.php?id=1" class="btn-danger">Delete Admin</a>
                </td>
            </tr>

            <tr>
                <td>2.</td>
                <td>Tesnim Strazimiri</td>
                <td>tesnimstrazimiri</td>
                <td>
                    <a href="update-admin.php?id=2" class="btn-secondary">Update Admin</a>
                    <a href="delete-admin.php?id=2" class="btn-danger">Delete Admin</a>
                </td>
            </tr>

            <tr>
                <td>3.</td>
                <td>Tesnim Strazimiri</td>
                <td>tesnimstrazimiri</td>
                <td>
                    <a href="update-admin.php?id=3" class="btn-secondary">Update Admin</a>
                    <a href="delete-admin.php?id=3" class="btn-danger">Delete Admin</a>
                </td>
            </tr>
        </table>
    </div>
</div>

<?php include('partials/footer.php');?>

</body>
</html>
