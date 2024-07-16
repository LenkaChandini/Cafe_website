<?php include ('partials/menu.php'); ?>



<div class="main.content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br>

        <?php 
            if(isset($_SESSION['add'])) //checking whether the session is set of not
            {
                echo $_SESSION['add']; //Display the session message if set
                unset($_SESSION['add']); //remove session message
            }
        ?>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name: </td>
                <td>
                    <input type="text" name="full_name" placeholder="Enter Your Name">
                </td>
            </tr>

            <tr>
                <td>Username: </td>
                <td>
                    <input type="text" name="username" placeholder="Your Username">
                </td>
            </tr>

            <tr>
                <td>password: </td>
                <td>
                    <input type="password" name="password" placeholder="Your Pass">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>

        </table>




        </form>
    </div>



</div>
<br>
<?php include('partials/footer.php'); ?>


<?php
   //process the value from Form and Save it in Database

   //check whether the submit button is clicked or not

   if(isset($_POST['submit']))
   {
    //Button Clicked
        //echo "Button Clicked";

        //Get the Data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password Encryption with MDS

        //2. SQL Query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        
        ";

        //3 .Executing and Saving Data into Database

        $res = mysqli_query($conn, $sql);
        if (!$res) {
            die(mysqli_error($conn));
        }

         //4. Check wheather the (Query is executed)data is inserated  or niot and display appropriate message
         if($res==true)
         {
            //data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success1'>Admin Added Successfully</div>";
            //Redirect Page to Managa Admin
            header("location:".SITEURL.'admin/manage-admin.php');
         }
         else
         {
            //failed to insert data
           //echo "Faile to Insert Data";
           //Create a Session Variable to Display Message
           $_SESSION['add'] = "<div class='error1'>Failed to Add Admin</div>";
           //Redirect Page to Add Admin
           header("location:".SITEURL.'admin/add-admin.php');
        
         }


        
   }

    


?>