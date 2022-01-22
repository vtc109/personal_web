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
         
        // include 'admin_navbar.php';
    ?>
        <style>
            /* .box-content{
                margin: 76px auto 0;
                width: 800px;
                border: 1px solid #ccc;
                text-align: center;
                padding: 20px;
            }
            #create_user form{
                width: 200px;
                margin: 40px auto;
            }
            #create_user form input{
                margin: 5px 0;
            } */
           
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
                color: #495057;
            }
            h1 {
                margin-bottom: 2.5rem;
            }

            h4 {
                font-size: 1rem; 
                margin-bottom: 1rem;
            }
            label {
                margin: 0;
            }
            .content-container {
                margin-top: 5rem;
                position: relative;
                height: 90vh;
                 /* background-image: linear-gradient(rgba(233, 236, 239, 0.603), rgba(233, 236, 239, 0.603));
                 background-image: linear-gradient(rgba(34, 34, 34, 0.603), rgba(34, 34, 34, 0.603)), url(assets/image/login-theme.jpg);
                background-size: cover; */
                /* background-color: #27ae60; */
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
           
            
            .input-block {
                width: 100%;
                display: flex;
                align-items: center;
                gap: 20px;
                margin-bottom: 10px;
                position: relative;
            }

            .input-area {
                height: 30px;
                width: 350px;
                position: absolute; 
                right: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                padding: 5px;
                
            }
            .button {
                
                font-size: 17px;
                font-weight: 600;
                background-color: #f59f00;
                color: #fff;
                text-decoration: none;
                cursor: pointer;
                border-radius: 5px;
                border: 0;
                padding: 5px 15px;
                
            }

            .button:hover, .button:active {
                background-color: #f08c00;
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
        <?php
        include 'admin_navbar.php';
        $error = false;
        // var_dump($_POST['first_name']);exit;
        // neu ton tai cation GET = create
        if (isset($_GET['action']) && $_GET['action'] == 'create') {
            if ( !empty($_POST['name'])) {
            // POST nhan dc day du username va password
                include '../connect_db.php';
                // Thêm bản ghi vào cơ sở dữ liệu
                $result = mysqli_query($con, "INSERT INTO `publishers` (`id`, `name`, `last_updated`) VALUES (NULL, '" . $_POST['name'] . "' , NOW() );");
                // neu nhu ko insert dc : trung ten user
                if (!$result) {
                    if (strpos(mysqli_error($con), "Duplicate entry") !== FALSE) {
                        $error = "Nhà xuất bản này đã tồn tại. Bạn vui lòng nhập Nhà xuất bản khác.";
                    }
                }
                mysqli_close($con);
                // trong TH ma ko dang ki duoc
                if ($error !== false) {
                    ?>
                    <div class="content-container">
                        <div id="error-notify" class="box-content">
                            <h1>Thông báo</h1>
                            <h4><?= $error ?></h4>
                            <a href="javascript:window.history.go(-1)" class="link-button">Tạo Nhà xuất bản khác</a>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="content-container">
                        <div id="success-notify" class="box-content">
                            <h1>Chúc mừng</h1>
                            <h4>Bạn đã tạo thành công Nhà xuất bản <?= $_POST['name']?></h4>
                            <a class="link-button" href="javascript:window.history.go(-2)">Danh sách Nhà xuất bản</a>
                        </div>
                    </div>
                <?php } ?>
            <?php }  else { ?>
                <div class="content-container">
                    <div id="edit-notify" class="box-content">
                        <h1>Vui lòng nhập đủ thông tin để thêm Nhà xuất bản</h1>
                        <a class="button" href="javascript:window.history.go(-1)">Quay lại thêm Nhà xuất bản</a>
                    </div>
                </div>
            <?php } ?>   
        <?php } else { ?>   
            <div class="content-container">   
            <a href="javascript:window.history.go(-1)" class="fa fa-undo" style="padding: 5px; margin-bottom: 10px;">  Quay lại</a>       
                <div id="create_user" class="box-content">
                    <h1>Tạo Nhà xuất bản</h1>
                    <form action="./publisher_create.php?action=create" method="Post" autocomplete="off">
                        <br>
                        <div class="input-block">
                            <label>Tên Nhà xuất bản</label></br>
                            <input class="input-area" type="text" name="name" value="" />
                        </div>
                        <br><br>
                        <input class="button "  type="submit" value="Tạo Nhà xuất bản" />
                    </form> 
                </div>
            </div>
        <?php } ?>

        </div><!-- end container -->

        <?php } ?>   <!-- end else -->
    </body>
</html>
