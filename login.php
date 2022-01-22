<?php
@ob_start();
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
    <link rel="icon" href="https://site.aace.org/wp-content/uploads/2018/04/Book-Icon.png" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>BookOnlineShop</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
        <style>
            /* Login form */
            * {
                padding: 0;
                margin: 0;
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

            h1 {
                font-size: 1.8rem;
               margin-bottom: 2rem;
               font-weight: 700;
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
                height: 450px;
            }

            #user_login form{
                width: 380px;
                
                display: flex;
                gap: 0.8rem;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                margin-bottom: 2rem;
            }
            form input{
                padding: 10px;
                width: 360px;
                height: 40px;
                margin: 5px 0;
                border-radius: 9px;
                border: 1px solid #ccc;
            }

            .dang-nhap-button {
                font-size: 15px;
                font-weight: 600;
                background-color: #27ae60;
                color: #fff;
                text-decoration: none;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                border-radius: 5px;
            }

            .dang-nhap-button:hover, .dang-nhap-button:active {
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
                /* background-color: rgba(39,174,96,0.8); */
                display: flex;
                align-items: center;
            }

            .click-dang-ky {
                margin-left: 10px;
                margin-right: 10px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 3px;
                margin-top: 50px;
                margin-bottom: 20px;
            }

            .click-dang-ky a:link, .click-dang-ky a:visited {
                font-size: 15px;
                font-weight: 600;
                background-color: #f59f00;
                color: #fff;
                text-decoration: none;
                display: flex;
                width: 360px;
                height: 40px;
                cursor: pointer;
                justify-content: center;
                align-items: center;
                border-radius: 5px;
            }

            .click-dang-ky a:hover, .click-dang-ky a:active {
                background-color: #f08c00;
            }

            /* Form bao loi dang nhap khong thanh cong */
            .back-button:link, .back-button:visited {
                font-size: 15px;
                font-weight: 600;
                background-color: #27ae60;
                color: #fff;
                text-decoration: none;
                display: flex;
                height: 40px;
                cursor: pointer;
                justify-content: center;
                align-items: center;
                border-radius: 9px;
                text-align: center;
                
            }

            .back-button:hover, .back-button:active {
                background-color: #219150;
            }
            #login-notify {
                width: 400px;
                height: 300px;
            }
            h4 {
                font-size: 1rem;
                margin-bottom: 100px;
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
        // session_start();
        include './connect_db.php';
        $error = false;
        if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $result = mysqli_query($con, "Select * from `customers` WHERE (`username` ='" . $_POST['username'] . "' AND `password` = md5('" . $_POST['password'] . "'))");
            //var_dump( $result );
            if (!$result) {
                $error = mysqli_error($con);
            } else {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['current_user'] = $user;
            }
            // var_dump($user);
            mysqli_close($con);
            if ($error !== false || $result->num_rows == 0) {
                ?>
                <div class="content-container">
                    <div id="login-notify" class="box-content">
                        <h1>Thông báo</h1>
                        <h4><?= !empty($error) ? $error : "Thông tin đăng nhập không chính xác" ?></h4>
                        <a href="./login.php" class="back-button">Quay lại</a>
                    </div>
                </div>
                <?php
                exit;
            }
            ?>
        <?php } ?>
        <?php 
            //include './facebook_source.php';
            //include './google_source.php';
        if (empty($_SESSION['current_user'])) { ?>
            <div class="content-container">
                <nav class="nav-bar">
                <a href="./index.php" class="link-trang-chu">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg> Về trang chủ</a>
                </nav>
                <div id="user_login" class="box-content">
                    <h1>Đăng nhập tài khoản</h1>
                    <form action="./login.php" method="Post" autocomplete="off">
                        <!-- <label>Username</label></br> -->
                        <input type="text" name="username" value="" placeholder="Tên tài khoản" class="username"/>
                        <!-- <label>Password</label></br> -->
                        <input type="password" name="password" value="" placeholder="Mật khẩu" class="password"/>
                    
                        <input type="submit" value="Đăng nhập" class="dang-nhap-button"/>
                        
                    </form>
                    <div class="click-dang-ky">
                        <p>Chưa có tài khoản?</p>
                        <a href="./register.php">Đăng ký ngay &rarr;</a>
                    </div>
                    
                </div>
            </div>

            <!-- NEU NHU DANG NHAP THANH CONG -->
            <?php
        } else {
            $currentUser = $_SESSION['current_user'];
            // include './index.php';
            header('Location: index.php');exit; ?>
        <?php  } ?>             <!-- end else -->

        <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>
    <script src="assets/js/login.js"></script>
    </body>
</html>
