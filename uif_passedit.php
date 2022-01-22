<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------ Include the above in your HEAD tag ---------->
<?php 
    include 'header.php';
    $user = $currentUser;
?>

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="./assets/js/header.js"></script>

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

            .glyphicon {
                color: #fff;
            }

            h1 {
                font-size: 3rem;
                margin-bottom: 3rem;
            }

            h4 {
                font-size: 1.5rem; 
                margin-bottom: 1rem;
            }
            label {
                margin: 0;
            }
            .content-container {
                margin-top: 5rem;
                position: relative;
                height: 20vh;
                 /* background-image: linear-gradient(rgba(233, 236, 239, 0.603), rgba(233, 236, 239, 0.603));
                 background-image: linear-gradient(rgba(34, 34, 34, 0.603), rgba(34, 34, 34, 0.603)), url(assets/image/login-theme.jpg);
                background-size: cover; */
                

            }
            .box-content{
                margin: 0 auto;
                width: 500px;
                
                text-align: center;
                padding: 20px;
                
                /* border: 1px solid #ccc; */
                position: absolute;
                box-shadow: 0 20px 30px 0 rgba(0, 0, 0, 0.07);
               
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: rgb(256,256,256,0.9);
            }
           
            .link-button:link, .link-button:visited {
                display: inline-block; 
                width: 25%;
                text-decoration: none; 
                font-size: 17px;
                font-weight: 600;
                background-color: #27ae60;
                color: #fff;
                text-decoration: none;
                cursor: pointer;
                border-radius: 5px;
                border: 0;
                padding: 7px 10px;
            }

            .link-button:hover, .link-button:active {
                background-color: #219150;
            }

            .btn {
                background-color: #27ae60;
            }

            .btn:hover {
                background-color: #219150;
            }

            .nav-tabs {
                display: flex; 
                justify-content: space-between;
            }
        </style>
</head>

<!-- <hr> -->
    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-sm-4">
                <div class="text-center">  
                    <h1> <?= $currentUser['first_name']." ".$currentUser['last_name']?> </h1>
                </div>
            </div>
        </div>
        <!-- row -->
        
        <div class="row">
            <div class="col-sm-4">
                <!--left col-->

                <div class="text-center">
                    <img src="<?= $currentUser['avatar'] ?>" class="avatar img-circle img-thumbnail" alt="avatar" style="width:180px;height:180px;">
                </div>
                <br>
                

                <?php
                    $current_id = $currentUser['id'];
                    $totalmoney = mysqli_query($con, "SELECT SUM(total) AS sum FROM orders 
                    WHERE customer_id = $current_id");
                    $totalmoney = mysqli_fetch_assoc($totalmoney);

                    $current_id = $currentUser['id'];
                    $boughtbook = mysqli_query($con, "SELECT SUM(quantity) AS bought FROM orders INNER JOIN orders_details 
                    ON orders.id = orders_details.order_id 
                    WHERE customer_id = $current_id;");
                    $boughtbook = mysqli_fetch_assoc($boughtbook);
        
                    $current_id = $currentUser['id'];
                    $favorbook = mysqli_query($con, "SELECT COUNT(book_id) AS numbook FROM favorites WHERE customer_id = $current_id;");
                    $favorbook = mysqli_fetch_assoc($favorbook);
                ?>
                
                <ul class="list-group">
                    <li class="list-group-item text-muted">Hoạt động<i class="fa fa-dashboard fa-1x"></i></li> 
                    <li class="list-group-item text-right">
                        <span class="pull-left"><strong>Tổng tiền đã chi</strong></span>
                        <?=number_format($totalmoney['sum'], 0, ",", ".") ?>đ</li>
                    <li class="list-group-item text-right">
                    <span class="pull-left"><strong>Số sách đã mua</strong></span>
                    <?=$boughtbook['bought']?></li>
                    <li class="list-group-item text-right">
                    <span class="pull-left"><strong>Số sách đã yêu thích</strong></span>
                    <?=$favorbook['numbook']?></li>
                </ul>

            </div>
            <!--/col-4-->
            <div class="col-sm-8">
                <ul class="nav nav-tabs">
                    <!-- <li class="active"><a data-toggle="tab" href="user_profile.php">Thông tin</a></li> -->
                    <li><a href="uif_profile.php">Cập nhật Thông tin</a></li>
                    <li style = "background-color :#ddd"><a href="uif_passedit.php">Đổi mật khẩu </a></li>
                    <li><a href="uif_favorite.php">Yêu thích</a></li>
                    <li><a href="uif_orderhis.php">Lịch sử mua hàng</a></li>

                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <?php
                            $error = false;
                            if (isset($_GET['action']) && $_GET['action'] == 'edit'){
                                // check mật khẩu cũ 
                                if (isset($_POST['old_password']) && $_POST['old_password'] != $currentUser['password']){
                                    <div class="content-container">
                                            <div id="edit-notify" class="box-content">
                                                <h1>Mật khẩu không thể để trống</h1>
                                                <a class="link-button" href="uif_passedit.php">Quay lại</a>
                                            </div>
                                        </div>
                                }
                                if (isset($_POST['password']) && isset($_POST['password2'])){   //nếu tồn tại pass
                                    if (!empty($_POST['password']) && !empty($_POST['password2'])){         //nếu 2 pass đều không rỗng 
                                        if ( ($_POST['password'] == $_POST['password2'])){      //nếu mật khẩu khớp
                                            $result = mysqli_query($con, "UPDATE `customers` SET 
                                                `password` = MD5('" . $_POST['password'] ."'),
                                                `last_updated` = NOW() 
                                                 WHERE `customers`.`id` = " . $_POST['id'] . ";");
                                                ?>
                                                <div class="content-container">
                                                <div id="edit-notify" class="box-content">
                                                    <h1>Đổi mật khẩu thành công</h1>
                                                    <a class="link-button" href="uif_passedit.php">Quay lại</a>
                                                </div>
                                                </div>
                                            <?php
                                        }else {                     //mật khẩu không khớp
                                            ?>
                                            <div class="content-container">
                                                <div id="edit-notify" class="box-content">
                                                    <h1>Mật khẩu không trùng khớp</h1>
                                                    <a class="link-button" href="uif_passedit.php">Reset</a>
                                                </div>
                                            </div>
                                        <?php 
                                        }
                                    }else{
                                        ?>
                                        <div class="content-container">
                                            <div id="edit-notify" class="box-content">
                                                <h1>Mật khẩu không thể để trống</h1>
                                                <a class="link-button" href="uif_passedit.php">Quay lại</a>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                            }else{
                            ?>
                            <form action="./uif_passedit.php?action=edit" method="Post" enctype="multipart/form-data"
                                autocomplete="off" id="registrationForm">

                                <div class="input-block">
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>" />
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-9">
                                        <label for="old_password">
                                            <h4>Nhập mật khẩu cũ của bạn</h4>
                                        </label>
                                        <input type="password" class="form-control" name="old_password" id="old_password"
                                            placeholder="Nhập mật khẩu" title="enter your password.">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-9">
                                        <label for="password">
                                            <h4>Nhập mật khẩu</h4>
                                        </label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Nhập mật khẩu mới" title="enter your password.">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-9">
                                        <label for="password2">
                                            <h4>Nhập lại mật khẩu</h4>
                                        </label>
                                        <input type="password" class="form-control" name="password2" id="password2"
                                            placeholder="Nhập lại mật khẩu mới" title="enter your password2.">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <br>
                                        <button class="btn btn-lg btn-success" type="submit">
                                            <i class="glyphicon glyphicon-ok-sign" ></i> Save</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                            }
                            ?>
                        
                    </div>
                    <!--/tab-pane-->
                </div>
                <!--/tab-content-->
            </div>
            <!--/col-9-->
        </div>
        <!--/row-->
    </div>
    <!-- container bootstrap -->
</hr>






















<!--     
    <form action="./uif_passedit.php?action=edit" method="Post" enctype="multipart/form-data"autocomplete="off" id="registrationForm">
                            
      <div class="input-block">
            <input type="hidden" name="id" value="<?= $user['id'] ?>" />
      </div>

      <div class="form-group">
          <div class="col-xs-12">
              <br>
              <button class="btn btn-lg btn-success" type="submit">
                <i class="glyphicon glyphicon-ok-sign"></i> Lưu lại </button>
          </div>
      </div>
    </form> -->