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
        <style>
            /* .box-content{
                margin: 74px auto 0;
                width: 800px;
                border: 1px solid #ccc;
                text-align: center;
                padding: 20px;
            }
            #edit_user form{
                width: 200px;
                margin: 40px auto;
            }
            #edit_user form input{
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
            label {
                margin: 0;
            }
            .content-container {
                margin-top: 5rem;
                position: relative;
                height: 125vh;
                background-image: linear-gradient(#f4f4f4, #7ac187);

                 /* background-image: linear-gradient(rgba(233, 236, 239, 0.603), rgba(233, 236, 239, 0.603));
                 background-image: linear-gradient(rgba(34, 34, 34, 0.603), rgba(34, 34, 34, 0.603)), url(assets/image/login-theme.jpg);
                background-size: cover; */
                /* background-color: #27ae60; */

            }
            .box-content{
                margin: 0 auto;
                width: 600px;
                
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
                margin-bottom: 30px;
                position: relative;
            }

            .input-area {
                height: 30px;
                width: 350px;
                position: absolute; 
                right: 10px;
                border-radius: 9px;
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
                padding: 5px 10px;
                
            }

            .button:hover, .button:active {
                background-color: #f08c00;
            }
            
            .kich-hoat-button {
                padding: 3px 10px;
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
        //include 'admin_navbar.php';
        $error = false;
        if (isset($_GET['action']) && $_GET['action'] == 'edit') 
        {
            // var_dump($_POST['name']);exit;
            if ( isset($_POST['name']) && !empty($_POST['name']) ) 
            {
                
                // CAP NHAT VAO DATABASE
                $result = mysqli_query($con, "UPDATE `publishers` 
                SET  `name` = '" . $_POST['name'] ."' ,
                   `last_updated`= NOW()  WHERE `publishers`.`id` = " . $_POST['id'] . ";");
                if (!$result) {
                    $error = "Không thể cập nhật Nhà xuất bản";
                }
                mysqli_close($con);
                if ($error !== false) 
                {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h1>Thông báo</h1>
                        <h4><?= $error ?></h4>
                        <a href="javascript:window.history.go(-1)">Danh sách Nhà xuất bản</a>
                    </div>
                <?php } else { ?>
                    <div class="content-container">
                        <div id="edit-notify" class="box-content">
                            <h1><?= ($error !== false) ? $error : "Sửa Nhà xuất bản thành công" ?></h1>
                            <a class="link-button" href="javascript:window.history.go(-2)">Danh sách Nhà xuất bản</a>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="content-container">
                    <div id="edit-notify" class="box-content">
                        <h1>Vui lòng nhập đủ thông tin để sửa Nhà xuất bản</h1>
                        <a class="button" href="javascript:window.history.go(-1)">Quay lại sửa Nhà xuất bản</a>
                    </div>
                </div>
            <?php
            }
        } else {
            //select p tu co id can sua
            $result = mysqli_query($con, "SELECT * FROM publishers where `id`=" . $_GET['id']);
            //lay ra toan bo gia tri cua phan tu co id do
            $publisher = $result->fetch_assoc();
            mysqli_close($con);
            if (!empty($user)) {
                ?>
                <div class="content-container">
                    <div id="edit_user" class="box-content">
                        <div class="row"><a href="javascript:window.history.go(-1)" class="fa fa-undo" style="padding: 5px; margin-bottom: 10px;">  Quay lại</a></div>
                        <h1>Sửa Nhà xuất bản "<?= $publisher['name'] ?>"</h1>
                        <form action="./publisher_edit.php?action=edit" method="Post" enctype="multipart/form-data" autocomplete="off">  
                            <div class="input-block">
                                <input class="input-area" type="hidden" name="id" value="<?= (!empty($publisher) ? $publisher['id'] : "") ?>" />
                            </div>
                            <div class="input-block">
                                <label>Tên</label></br>
                                <input class="input-area" type="text" name="name" value="<?= (!empty($publisher) ? $publisher['name'] : "") ?>" />
                            </div>
                            <input class="button btn-success"  type="submit" value=" Chỉnh sửa " />
                        </form>
                    </div>
                </div>
            <?php
            }
        }
        ?>
    
    </div> <!-- end container  -->
       
    <?php } ?>   <!-- end else -->
    </body>
</html>
