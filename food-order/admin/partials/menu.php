<?php
include('../config/constants.php');
// include('login-check.php'); 
?>



<html>

<head>
    <title>Food Order Website - Home Page</title>

    <link rel="stylesheet" href="../css/admin.css"> <!-- Correct path to CSS file -->
</head>

<body>

    <!-- menu.php -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Food House</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage-admin.php">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage-food.php">Food</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage-category.php">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage-order.php">Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>


</body>

</html>