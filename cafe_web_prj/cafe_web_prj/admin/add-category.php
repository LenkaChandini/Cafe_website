<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <!-- Add Category from starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Tiltle: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value=" Yes"> Yes
                        <input type="radio" name="featured" value=" No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value=" Yes"> Yes
                        <input type="radio" name="active" value=" No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
                
            </table>
        </form>
        <!-- Add Category from Ends -->

        <?php 
            //check wheather the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "clicked";

                //1. get the vlaue  category form
                $title = $_POST['title'];

                //for radio input, we need check wheather the button is selected or not
                if(isset($_POST['featured']))
                {
                    //get the value from form
                    $featured = $_POST['featured'];

                }
                else
                {
                    //set the default value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //check wheather the image is selected or not and set the value for image name accoridingly
                //print_r($_FILES['image']);

                //die(); //break the code here

                if(isset($_FILES['image']['name']))
                {
                    //upload the image
                    //to uploade image we need image name and source path and destination path
                    $image_name = $_FILES['image']['name'];
                    
                    //upload the image only if image is selected
                    if($image_name != "")
                    {

                    //Auto rename our image
                    //get the extension of our image (jpg, png, gf, etc) e.g. "specialfood1.jpg"
                    $ext = end(explode('.', $image_name));

                    //rename the image
                    $image_name = "Food_Category_".rand(000, 999).'.'.$ext; //e.g. food_category_834.jpg
                    
                    $sourse_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/".$image_name;

                    //Finally upload the image
                    $upload = move_uploaded_file($sourse_path, $destination_path);

                    //check wheather the image is uploaded or not
                    //and if the image is not upload then we will stop the process and redirect with error message
                    if($upload==false)
                    {
                        //set message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                        //Redirect to add category page
                        header('location:'.SITEURL.'admin/add-category.php');
                        //stop the process
                        die();
                    }
                } 
                }
                else{
                    //don't upload image and set the image_name value as blank
                    $image_name="";
                }

                //2. create sql query to insert category into database
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    ";

                //3. execute the query and save in database
                $res = mysqli_query($conn, $sql);    

                //4. check whether the query executed or not and data added or not
                if($res==true)
                {
                    //Query executed and category added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    //Redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                    
                }
                else
                {
                    //Failed to add category
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/add-category.php');

                }
            }
        
        
        
        
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>