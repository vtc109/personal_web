<?php
    include 'header.php';
    $book_id = $_GET['id'];
    // var_dump($book_id);exit;

    $author = mysqli_query($con, "SELECT * FROM authors ;  ");  
    // var_dump($author);exit;
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
                        
                        if (isset($_GET['action']) && $_GET['action'] == 'create' && isset($_GET['id']) ) {
                            // include '../connect_db.php';

                            

                            $result = mysqli_query($con, "INSERT INTO `books_authors` (`author_id`,`book_id`)
                            VALUES ('" . $_POST['author_id'] . "' , '" . $book_id . "' ) ");
                            // var_dump($result);exit;
                            if (!$result) {
                                $error = "Bạn đã thêm trùng tác giả.";
                            }
                            mysqli_close($con);
                            if ($error !== false) {
                                ?>
                                <div class="content-container">
                                    <div id="error-notify" class="box-content">
                                        <h2>Thông báo</h2>
                                        <h4 style="margin-bottom: 20px;"><?= $error ?></h4>
                                        <a class="link-button" href="javascript:window.history.go(-1)">Quay lại</a>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="content-container">
                                    <div id="success-notify" class="box-content">
                                        <h2 style="margin-bottom: 10px;">Thêm tác giả thành công</h2>
                                        <a class="link-button" href="javascript:window.history.go(-2)">Quay lại</a>
                                    </div>
                                </div>
                            <?php } ?>


                        <?php } else {   
                            ?> 

                                <a class="fa fa-undo" href="javascript:window.history.go(-1)">  Quay lại</a>
                            </div><!-- end row1 -->
                            <div class="content-container">
                                <div class="box-content">
                                    <div class="row">
                                        <h1>Chọn tác giả cần thêm : </h1>
                                    </div>

                                    <div class="row">
                                        <form action="./book_add_author.php?action=create&id=<?=$book_id?>" method="Post" autocomplete="off">
                                            <div class="input-block">
                                                </br>
                                                <select name="author_id" id="">
                                        <?php while( $row = mysqli_fetch_array($author) ){ ?>
                                                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                        <?php } ?>
                                                </select>
                                                    <!-- <input class="input-area" type="text" name="author_id" value="" /> -->
                                            </div>
                                            <br>
                                            <input class="btn btn-success"  type="submit" value="Thêm tác giả" />
                                        </form> 
                                <?php } ?>
        
                                    </div>
                                </div>
                            </div>

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
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="vendor/vector-map/jquery.vmap.js"></script>
    <script src="vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="vendor/vector-map/jquery.vmap.world.js"></script>
    <script src="vendor/vector-map/jquery.vmap.brazil.js"></script>
    <script src="vendor/vector-map/jquery.vmap.europe.js"></script>
    <script src="vendor/vector-map/jquery.vmap.france.js"></script>
    <script src="vendor/vector-map/jquery.vmap.germany.js"></script>
    <script src="vendor/vector-map/jquery.vmap.russia.js"></script>
    <script src="vendor/vector-map/jquery.vmap.usa.js"></script>

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
                margin-top: 4rem;
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
                display: flex;
                flex-direction: column;
                align-items: center;
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
