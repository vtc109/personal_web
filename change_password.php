<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Đổi thông tin thành viên</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>
    <body>
        <?php
        include './connect_db.php';
        $error = false;
        //  Neu ma da ton tai phuong thuc GET thi lot vao ham nay de check mk
        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            if (isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['old_password']) && !empty($_POST['old_password']) && isset($_POST['new_password']) && !empty($_POST['new_password'])
            ) {
                $userResult = mysqli_query($con, "Select * from `user` WHERE (`id` = " . $_POST['user_id'] . " AND `password` = '" . md5($_POST['old_password']) . "')");
            // khih userResult->numrow > 0 co nghia la da ton tai password vua nhap trong csdl
                if ($userResult->num_rows > 0) {
                    $result = mysqli_query($con, "UPDATE `user` SET `password` = MD5('" . $_POST['new_password'] . "'), `last_updated`=" . time() . " WHERE (`id` = " . $_POST['user_id'] . " AND `password` = '" . md5($_POST['old_password']) . "')");
                    if (!$result) {
                        $error = "Không thể cập nhật tài khoản";
                    }
                } else {
                    $error = "Mật khẩu cũ không đúng.";
                }
                mysqli_close($con);
                if ($error !== false) {
                    ?>
                    <div class="content-container">
                        <div id="error-notify" class="box-content">
                            <h1>Thông báo</h1>
                            <h4><?= $error ?></h4>
                            <div class="link-container">
                                <a class="dang-nhap-lai" href="./change_password.php">Đổi lại mật khẩu</a>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="content-container">
                        <div id="edit-notify" class="box-content">
                            <h1><?= ($error !== false) ? $error : "Sửa tài khoản thành công" ?></h1>
                            <div class="link-container">
                                <a class="dang-nhap-lai" href="./login.php">Quay lại tài khoản</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="content-container">
                    <div id="thieu-info-notify" class="box-content">
                        <h1>Vui lòng nhập đủ thông tin để sửa tài khoản</h1>
                        <div class="link-container">
                            <a class="dang-nhap-lai" href="./change_password.php">Quay lại tài khoản</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            session_start();
            $user = $_SESSION['current_user'];
            if (!empty($user)) {
                ?>

                <div class="content-container">
                    <nav class="nav-bar">
                        <a href="./index.php" class="link-trang-chu">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg> Về trang chủ</a>
                    </nav>
                    <div id="edit_user" class="box-content">
                        <h1>Xin chào. Bạn đang thay đổi mật khẩu</h1>
                        <form action="./change_password.php?action=edit" method="Post" autocomplete="off">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <div class="input-block">
                                <label>Password cũ</label></br>
                                <input class="input-area" type="password" name="old_password" value="" /></br>
                            </div>
                            <div class="input-block">
                                <label>Password mới</label></br>
                                <input class="input-area" type="password" name="new_password" value="" /></br>
                            </div>
                            <br>
                            <div class="button-container">
                                <input class="button" type="submit" value="Thay đổi" />
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </body>
    <style>
             * {
                padding: 0;
                margin: 0;
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
                box-sizing: border-box;
                color: #495057;
            }
            .content-container {
                position: relative;
                height: 100vh;
                 background-image: linear-gradient(rgba(233, 236, 239, 0.603), rgba(233, 236, 239, 0.603));
                 background-image: linear-gradient(rgba(34, 34, 34, 0.603), rgba(34, 34, 34, 0.603)), url(assets/image/login-theme.jpg);
                background-size: cover;
            }

            .box-content{
                background: rgb(256,256,256,0.8);
                position: absolute;
                box-shadow: 0 20px 30px 0 rgba(0, 0, 0, 0.07);
                border-radius: 12px;
                top: 50%;
                right: 50%;
                border: 1px solid #ccc;
                padding: 20px;
                transform: translate(50%, -40%);
                height: 300px;
                width: 520px;
            }

            h1 {
                font-size: 1.3rem;
                margin-bottom: 50px;
            }
            #edit_user form{
               
            }
            #edit_user form input{
                margin: 5px 0;
            }
            
            form input{
                padding: 10px;
                width: 360px;
                height: 40px;
                margin: 5px 0;
                border-radius: 9px;
                border: 1px solid #ccc;
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

            .button-container {
                text-align: center;
            }
            .button {
                height: 40px;
                width: 120px;
                font-size: 14px;
                font-weight: 600;
                background-color: #27ae60;
                color: #fff;
                text-decoration: none;
                cursor: pointer;
                border-radius: 5px;
                border: 0;
                padding: 5px 10px;
                letter-spacing: 0.3px;
            }

            .button:hover, .button:active {
                background-color: #219150;
            }

            nav a:link, nav a:visited {
                font-size: 20px;
                margin-left: 20px;
                color: #fff;
                text-decoration: none;
                text-transform: uppercase;
                font-weight: 500;
                display: inline-block;
                border-radius: 100px;
                display: flex;
                border-radius: 100px;
                align-items: center;
                gap: 4px;
            }

            nav a:hover, nav a:active {
                text-decoration: underline;
            }

            nav {
                position: absolute;
                width: 100%;
                height: 60px;
                top: 0;
                display: flex;
                align-items: center;
            }

            svg {
            stroke: #fff;
            width: 25px;
            height: 25px;
            }
            /* Bao loi doi mat khau khong thanh cong */
            #error-notify h1 {
                margin-bottom: 1rem;
            }
            h4 {
                margin-bottom: 2.5rem;
            }
            #error-notify {
                text-align: center;
                width: 350px;
                height: 200px;
            }
            .link-container {

                display: flex;
                align-items: center;
                justify-content: center;
            }
            .dang-nhap-lai:link, .dang-nhap-lai:visited {
                font-size: 15px;
                font-weight: 600;
                background-color: #27ae60;
                color: #fff;
                text-decoration: none;
                display: flex;
                width: 150px;
                height: 40px;
                cursor: pointer;
                justify-content: center;
                align-items: center;
                border-radius: 5px;
            }

            .dang-nhap-lai:hover, .dang-nhap-lai:active {
                background-color: #219150;
            }

            /* Nhap day du thong tin mat khau form */
            #thieu-info-notify {
                text-align: center;
                width: 350px;
                height: 200px;
            }
        </style>
</html>
