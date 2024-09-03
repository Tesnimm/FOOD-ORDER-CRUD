<?php 

    // Include Constants File
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])) 
    {
        // Process to delete
        // 1. Get ID and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // 2. Remove the image if available
        if($image_name != "")
        {
            // Image path
            $path = "../images/food/".$image_name;

            // Remove image file from folder
            $remove = unlink($path);

            // Check whether the image is removed or not
            if($remove == false)
            {
                // Failed to remove image
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Image File.</div>";
                // Redirect to Manage Food page
                header('location:'.SITEURL.'admin/manage-food.php');
                // Stop the process
                die();
            }
        }

        // 3. Delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        // Check whether the query executed or not and set the session message respectively
        if($res == true)
        {
            // Food Deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        }
        else
        {
            // Failed to Delete Food
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
        }

        // 4. Redirect to Manage Food page
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        // Redirect to Manage Food page if id or image_name is not set
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>
