<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                // Get the ID of selected food
                $id = $_GET['id'];

                // Create SQL Query to Get the Details
                $sql = "SELECT * FROM tbl_food WHERE id=$id";

                // Execute the Query
                $res = mysqli_query($conn, $sql);

                // Check whether the query executed or not
                if($res == true)
                {
                    // Check whether the data is available or not
                    $count = mysqli_num_rows($res);
                    // Check whether we have food data or not
                    if($count == 1)
                    {
                        // Get the details
                        $row = mysqli_fetch_assoc($res);

                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $current_image = $row['image_name'];
                        $current_category = $row['category_id'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else
                    {
                        // Redirect to Manage Food with Session Message
                        $_SESSION['no-food-found'] = "<div class='error'>Food not found.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                }
            }
            else
            {
                // Redirect to Manage Food
                header('location:'.SITEURL.'admin/manage-food.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">

        <tr>
            <td>Title: </td>
            <td>
                <input type="text" name="title" value="<?php echo $title; ?>">
            </td>
        </tr>

        <tr>
            <td>Description: </td>
            <td>
                <textarea name="description" cols="30" rows="10"><?php echo $description; ?></textarea>
            </td>
        </tr>

        <tr>
            <td>Price: </td>
            <td>
                <input type="number" name="price" value="<?php echo $price; ?>">
            </td>
        </tr>

        <tr>
            <td>Current Image: </td>
            <td>
                <?php 
                if($current_image != "")
                {
                    // Display the Image
                    ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                    <?php
                }
                else
                {
                    // Display Message
                    echo "<div class='error'>Image Not Added.</div>";
                }
                ?>
            </td>
        </tr>

        <tr>
            <td>Select New Image: </td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td>Category: </td>
            <td>
                <select name="category">

                    <?php
                        $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                        $res=mysqli_query($conn,$sql);

                        $count=mysqli_num_rows($res);
                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $category_id=$row['id'];
                            $category_title=$row['title'];
                            ?>
                            <option <?php if($current_category == $category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <option value="0">No Category Found</option>
                        <?php
                    }

                    ?>

                </select>
            </td>
        </tr>

        <tr>
            <td>Featured: </td>
            <td>
                <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No">No
            </td>
        </tr>

        <tr>
            <td>Active: </td>
            <td>
                <input <?php if($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                <input <?php if($active == "No"){echo "checked";} ?> type="radio" name="active" value="No">No
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update Food" class="btn-secondary">
            </td>
        </tr>

        </table>

        </form>

        <?php
        
            if(isset($_POST['submit']))
            {
                // Get all the details from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // Updating New Image if Selected
                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name != "")
                    {
                        $ext = pathinfo($image_name, PATHINFO_EXTENSION);

                        $image_name = "Food-Name-".rand(0000, 9999).".".$ext;

                        $src = $_FILES['image']['tmp_name'];
                        $dst = "../images/food/".$image_name;

                        $upload = move_uploaded_file($src, $dst);

                        if($upload == false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();
                        }

                        // Remove the current image if available
                        if($current_image != "")
                        {
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);

                            if($remove == false)
                            {
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                // Create SQL Query to Update Food
                $sql3 = "UPDATE tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";

                // Execute the Query
                $res3 = mysqli_query($conn, $sql3);

                // Check whether the query is executed or not
                if($res3 == true)
                {
                    // Food Updated
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    // Failed to Update Food
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
