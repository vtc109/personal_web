<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Đăng xuất tài khoản</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://site.aace.org/wp-content/uploads/2018/04/Book-Icon.png" type="image/x-icon"/>
        <style>
            /* .box-content{
                margin: 0 auto;
                width: 800px;
                border: 1px solid #ccc;
                text-align: center;
                padding: 20px;
            }
            #user_logout form{
                width: 200px;
                margin: 40px auto;
            }
            #user_logout form input{
                margin: 5px 0;
            } */
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
                 background-image: linear-gradient(rgba(34, 34, 34, 0.603), rgba(34, 34, 34, 0.603)), url(../assets/image/login-theme.jpg);
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
            
           
            h1 {
                font-size: 1.5rem;
                margin-bottom: 2rem;
            }

            .button-container {
                display: flex; 
                justify-content: center;
            }
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
               
            }

            .back-button:hover, .back-button:active {
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
        </style>
    </head>
    <body>
        <?php
        session_start();
        unset($_SESSION['current_user']);
        ?>
        <div class="content-container">
            <nav class="nav-bar">
                <a href="../index.php" class="link-trang-chu">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg> Về trang chủ</a>
            </nav>
            <div id="user_logout" class="box-content">
                <h1>Đăng xuất tài khoản thành công</h1>
                
                <a class="back-button" href="../login.php">Đăng nhập lại</a>
            </div>
        </div>
    </body>
</html>
