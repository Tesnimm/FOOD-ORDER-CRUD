<?php include('partials/menu.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/admin.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">

        <tr>
            <td>Title: </td>
            <td>
                <input type="text" name="title" placeholder="Title of the Food">
            </td>
        </tr>

        <tr>
            <td>Description: </td>
            <td>
                <textarea name="description" cols="30" rows="10" placeholder="Description of the Food"></textarea>
            </td>
        </tr>

        <tr>
            <td>Price: </td>
            <td>
                <input type="number" name="price">
            </td>
        </tr>


        <tr>
            <td>Select Image: </td>
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
                            $id=$row['id'];
                            $title=$row['title'];
                            ?>
                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
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
                <input type="radio" name="featured" value="Yes">Yes
                <input type="radio" name="featured" value="No">No
            </td>
        </tr>

        <tr>
            <td>Active: </td>
            <td>
            <input type="radio" name="active" value="Yes">Yes
            <input type="radio" name="active" value="No">No
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Food" class="btn-secondary">
            </td>
        </tr>

        </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {

                $title=mysqli_real_escape_string($conn, $_POST['title']);
                $description=mysqli_real_escape_string($conn, $_POST['description']);
                $price=$_POST['price'];
                $category=$_POST['category'];

                $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
                $active = isset($_POST['active']) ? $_POST['active'] : "No";

                if(isset($_FILES['image']['name']))
                {
                    $image_name=$_FILES['image']['name'];

                    if($image_name!="")
                    {
                        $ext=pathinfo($image_name, PATHINFO_EXTENSION);

                        $image_name="Food-Name-".rand(0000,9999).".".$ext;

                        $src=$_FILES['image']['tmp_name'];
                        $dst="../images/food/".$image_name;

                        $upload=move_uploaded_file($src,$dst);

                        if($upload==false)
                        {
                            $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                            header('location: '.SITEURL.'admin/add-food.php');
                            die();
                        }

                    }
                }
                else
                {
                    $image_name="";
                }

                $sql2="INSERT INTO tbl_food SET 
                    title='$title',
                    description='$description',
                    price='$price',
                    image_name='$image_name',
                    category_id='$category',
                    featured='$featured',
                    active='$active'
                ";

                $res2=mysqli_query($conn,$sql2);

                if($res2==true)
                {
                    $_SESSION['add']="<div class='success'>Food Added Succesfully</div>";
                    header('location:' .SITEURL.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['add']="<div class='error'>Failed to Add Food</div>";
                    header('location:' .SITEURL.'admin/manage-food.php');
                }
            }
        
        ?>

    </div>
</div>

<?php  include('partials/footer.php'); ?>
