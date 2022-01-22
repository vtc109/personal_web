<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Đăng ký tài khoản</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://site.aace.org/wp-content/uploads/2018/04/Book-Icon.png" type="image/x-icon"/>
        <style>
            * {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
                color: #495057;
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            }
            h1 {
                margin-bottom: 50px;
            }
            .content-container {
                position: relative;
                height: 100vh;
                 background-image: linear-gradient(rgba(233, 236, 239, 0.603), rgba(233, 236, 239, 0.603));
                 background-image: linear-gradient(rgba(34, 34, 34, 0.603), rgba(34, 34, 34, 0.603)), url(assets/image/login-theme.jpg);
                background-size: cover;

            }
            .box-content{
                margin: 0 auto;
                width: 520px;
                border: 1px solid #ccc;
                text-align: center;
                padding: 20px;
                box-shadow: 0 20px 30px 0 rgba(0, 0, 0, 0.07);
                border: 1px solid #ccc;
                position: absolute;
                box-shadow: 0 20px 30px 0 rgba(0, 0, 0, 0.07);
                border-radius: 12px;
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
                /* background-color: rgba(39,174,96,0.8); */
                display: flex;
                align-items: center;
            }

            svg {
            stroke: #fff;
            width: 25px;
            height: 25px;
            }
        </style>
    </head>
    <body>
        <?php
        include './connect_db.php';
        include './function.php';
        $error = false;

        // check xem co action =reg khong
        if (isset($_GET['action']) && $_GET['action'] == 'reg') {
            if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
                // $fullname = $_POST['fullname'];
                    $result = mysqli_query($con, "INSERT INTO `customers` (`first_name`,`last_name`,`username`, `password`, `status`, `created_date`, `last_updated`) 
                    VALUES ('" . $_POST['first_name'] . "','" . $_POST['last_name'] . "', '" . $_POST['username'] . "', MD5('" . $_POST['password'] . "') ,1, NOW() , NOW() );");
                    if (!$result) {
                        if (strpos(mysqli_error($con), "Duplicate entry") !== FALSE) {
                            $error = "Tài khoản đã tồn tại. Bạn vui lòng chọn tài khoản khác.";
                        }
                    }
                    mysqli_close($con);

                if ($error !== false) {
                    ?>
                    <div class="content-container">
                        <div id="error-notify" class="box-content">
                            <h1>Thông báo</h1>
                            <h4><?= $error ?></h4>
                            <a href="./register.php">Quay lại</a>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="content-container">
                        <div id="edit-notify" class="box-content">
                            <h1><?= ($error !== false) ? $error : "Đăng ký tài khoản thành công" ?></h1>
                            <a href="./login.php">Mời bạn đăng nhập</a>
                        </div>
                    </div>
                <?php } ?>
            <?php } 
            else { ?>
                <div class="content-container">
                    <div id="edit-notify" class="box-content">
                        <h1>Vui lòng nhập đủ thông tin để đăng ký tài khoản</h1>
                        <a href="./register.php">Quay lại đăng ký</a>
                    </div>
                </div>
                <?php
            }
        }
        // Neu khong co action =reg thi hien thi form dang ki
        else {
            ?>
            <div class="content-container">
                <nav class="nav-bar">
                    <a href="./index.php" class="link-trang-chu">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg> Về trang chủ</a>
                </nav>
                <div id="user_register" class="box-content">
                    <h1>Đăng ký tài khoản</h1>
                    <form action="./register.php?action=reg" method="Post" autocomplete="off">
                        <div class="input-block">
                            <label>Username</label></br>
                            <input type="text" name="username" value="" class="input-area"  placeholder=""><br/>
                        </div>
                        <div class="input-block">
                            <label>Password</label></br>
                            <input type="password" name="password" value="" class="input-area" id="password" placeholder=""/></br>
                        </div>
                        <div class="input-block">
                            <label>Họ và tên đệm</label></br>
                            <input type="text" name="first_name" value="" class="input-area"  placeholder=""><br/>
                        </div>
                        <div class="input-block">
                            <label>Tên</label></br>
                            <input type="text" name="last_name" value="" class="input-area"  placeholder=""><br/>
                        </div>
                        
                        </br>
                        <input type="submit" value="Đăng ký" class="button"/>
                    </form>
                </div>
            </div>
            <?php
        }
        ?>
        <script src="./assets/js/register.js"></script>
    </body>
</html>
