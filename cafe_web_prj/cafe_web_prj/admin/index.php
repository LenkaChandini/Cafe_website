<?php include('partials/menu.php'); ?>



        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>
                <div class="col-4 text-center" style="width: 21%;">
                    <?php
                        $sql = "SELECT * FROM tbl_category";
                        //execute query
                        $res = mysqli_query($conn, $sql);
                        //count Rows
                        $count = mysqli_num_rows($res);
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br />
                    Categories
                </div>

                <div class="col-4 text-center" style="width: 21%;">

                    <?php
                        $sql2 = "SELECT * FROM tbl_food";
                        //execute query
                        $res2 = mysqli_query($conn, $sql2);
                        //count Rows
                        $count2 = mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2; ?></h1>
                    <br />
                    Foods
                </div>

                <div class="col-4 text-center" style="width: 21%;">
                    <?php
                        $sql3 = "SELECT * FROM tbl_order";
                        //execute query
                        $res3 = mysqli_query($conn, $sql3);
                        //count Rows
                        $count3 = mysqli_num_rows($res3);
                    ?>
                    <h1><?php echo $count3; ?></h1>
                    <br />
                    Total Orders
                </div>

                <div class="col-4 text-center" style="width: 21%;">
                    
                    <?php
                        //create sql query to get total revenue generated
                        //aggregate function in sql
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                        //execute query
                        $res4 = mysqli_query($conn, $sql4);
                        //count Rows
                        $row4 = mysqli_fetch_assoc($res4);

                        //get the total revenue
                        $total_revenue = $row4['Total'];
                       
                    ?>
                    <h1>₹<?php echo $total_revenue; ?></h1>
                    <br />
                    Revenue Generated
                </div>

                
                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>        