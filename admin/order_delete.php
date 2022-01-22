<?php
    include 'header.php';
     ?>
   <body>      
        <?php if (empty($_SESSION['current_user'])) { ?>
            <a href="login.php">Đăng nhập để vào trang Admin</a>
            <?php
         } else {
        
        include 'menu_sidebar.php';
        $currentUser = $_SESSION['current_user'];
        ?>

        <!-- PAGE CONTAINER-->
        <div class="page-container">

    <?php 
         
        include 'admin_navbar.php';
    ?>
        <!-- MAIN CONTENT -->
            
                    <?php
                    $error = false;
                    if (isset($_GET['id']) && !empty($_GET['id'])) {
                        $result = mysqli_query($con, "DELETE FROM `orders` WHERE `id` = " . $_GET['id']);
                        if (!$result) {
                            $error = "Không thể xóa đơn hàng.";
                        }
                        mysqli_close($con);
                        // var_dump($error);
                        if ($error !== false) {
                    ?>
                            <div class="content-container">
                                <div id="error-notify" class="box-content">
                                    <h2>Thông báo</h2>
                                    <h4><?= $error ?></h4>
                                    <a href="./order.php">Danh sách đơn hàng</a>
                                </div>
                            </div>
                    <?php } else { ?>
                            <div class="content-container">
                                <div id="success-notify" class="box-content">
                                    <h2>Xóa đơn hàng thành công</h2>
                                    <a class="link-button" href="./order.php">Danh sách đơn hàng</a>
                                </div>
                            </div>
                        <?php } ?>
                     <?php } ?>
 
                        

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

    <?php } ?>   <!-- end else -->

</body>
<style>
    * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
                color: #495057;
            }
            h2 {
                margin-bottom: 20px;
            }
            .content-container {
                margin-top: 5rem;
                position: relative;
                height: 90vh;
                 /* background-image: linear-gradient(rgba(233, 236, 239, 0.603), rgba(233, 236, 239, 0.603));
                 background-image: linear-gradient(rgba(34, 34, 34, 0.603), rgba(34, 34, 34, 0.603)), url(assets/image/login-theme.jpg);
                background-size: cover; */
                background-image: linear-gradient(#f4f4f4, #7ac187);

            }
            .box-content{
                margin: 0 auto;
                width: 500px;
                
                text-align: center;
                padding: 20px;
                box-shadow: 0 20px 30px 0 rgba(0, 0, 0, 0.07);
                border: 1px solid #ccc;
                position: absolute;
                box-shadow: 0 20px 30px 0 rgba(0, 0, 0, 0.07);
               
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: rgb(256,256,256,0.9);
            }

            .link-button:link, .link-button:visited {
                display: inline-block; 
                text-decoration: none; 
                font-size: 17px;
                font-weight: 600;
                background-color: #f59f00;
                color: #fff;
                text-decoration: none;
                cursor: pointer;
                border-radius: 5px;
                border: 0;
                padding: 5px 10px;
            }

            .link-button:hover, .link-button:active {
                background-color: #f08c00;
            }
</style>
</html>
<!-- end document-->
