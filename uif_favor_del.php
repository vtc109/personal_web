





<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="./assets/js/header.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------ Include the above in your HEAD tag ---------->
<?php 
    include 'header.php';
?>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
  		<div class="col-sm-4"><!--left col-->
      <div class="text-center">
        <img src="<?= $currentUser['avatar'] ?>" class="avatar img-circle img-thumbnail" alt="avatar" style="width:200px;height:200px;">
      </div>
</hr>
    <br>

               
          <div class="panel panel-default">
            <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
          </div>
          
          
          <ul class="list-group">
            <li class="list-group-item text-muted">Hoạt động<i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
          </ul> 
               
          <div class="panel panel-default">
            <div class="panel-heading">Social Media</div>
            <div class="panel-body">
            	<i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
            </div>
          </div>
          
        </div><!--/col-3-->
    	<div class="col-sm-8">
            <ul class="nav nav-tabs">
                <!-- <li class="active"><a data-toggle="tab" href="user_profile.php">Thông tin</a></li> -->
                <li><a  href="uif_profile.php">Cập nhật Thông tin</a></li>
                <li><a href="uif_passedit.php" >Đổi mật khẩu </a></li>
                <li style = "background-color :#ddd"><a href="uif_favorite.php" >Yêu thích</a></li>
                <li ><a href="uif_orderhis.php" >Lịch sử mua hàng</a></li>

            </ul>
            <?php {
        $currentUser = $_SESSION['current_user'];
        ?>

        <!-- PAGE CONTAINER-->
        <div class="page-container">

    <?php 
         
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
                margin-bottom: 3rem;
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
        </style>
        <?php
        $error = false;
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            // include '../connect_db.php';
            $result = mysqli_query($con, "DELETE FROM `favorites` WHERE book_id = " . $_GET['id']);
            if (!$result) {
                $error = "Không thể xóa tài khoản.";
            }
            mysqli_close($con);
            if ($error !== false) {
                ?>
                <div class="content-container">
                    <div id="error-notify" class="box-content">
                        <h1>Thông báo</h1>
                        <h4><?= $error ?></h4>
                        <a class="link-button" href="./uif_favorite.php">Quay lại trang yêu thích</a>
                    </div>
                </div>
            <?php } else { ?>
                <div class="content-container">
                    <div id="success-notify" class="box-content">
                        <h1>Đã xóa sách yêu thích</h1>
                        <a class="link-button" href="./uif_favorite.php">Quay lại</a>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>

            </div><!-- end container -->
            
        <?php } ?>


        </div><!--/col-9-->
    </div><!--/row-->
                                                      