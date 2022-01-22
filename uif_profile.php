<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------ Include the above in your HEAD tag ---------->
<?php 
    include 'header.php';
    $user_id = $currentUser['id'];
    // var_dump($user_id);exit;

    $result = mysqli_query($con, "SELECT * FROM `customers` WHERE `id` = $user_id ");
    // var_dump( $result );exit;
    if (!$result) {
        $error = mysqli_error($con);
    } else {
        $user = mysqli_fetch_assoc($result);
        // echo '<pre>';
        // var_dump($user);exit;
        // echo '</pre>';
        $_SESSION['current_user'] = $user;
    }
    // var_dump($user);
    $currentUser = $_SESSION['current_user'];
    // var_dump($currentUser);exit;

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

            input[type='file'] {
            color: transparent;
            width: 90px;
            }

            .image_and_button {
                display: flex;
                flex-direction: column; 
                align-items: center;
            }
        </style>
</head>


<!-- <hr></hr> -->
    <div class="container bootstrap snippet">
        <!-- name -->
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
                    <div class="text-center">   
                        <?php
                        if (isset($_GET['action']) && $_GET['action'] == 'pic'){
                            ?>
                            <!-- in kiểm tra -->
                            <?php
                        // var_dump( empty($_FILES['avatar']['name'] ));exit;
                            if( empty($_FILES['avatar']['name']) ){
                                $avatar = $user['avatar'];
                            } else {
                                $uploadedFiles = $_FILES['avatar']; // uploadFile get duoc anh 
                                if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'][0])) { // Dieu Kien cua thu vien anh
                                    $uppic = uploadAvatarUif($uploadedFiles);  // upload file anh len(TV upload anh)
                                    if (!empty($uppic['errors'])) { // neu co loi
                                        $error = $uppic['errors'];
                                    } else {
                                            $avatar = $uppic['path'];
                                    }
                                }
                            }
                            // var_dump($avatar);
                            $picid = $user['id'];
                            $result = mysqli_query($con, "UPDATE `customers` SET
                            `avatar` =  '" . $avatar . "' ,
                            `last_updated` = NOW()
                            WHERE `customers`.`id` = " . $picid . ";");
                            ?>
                                <img src="<?= $user['avatar'] ?>" class="avatar img-circle img-thumbnail" alt="avatar" style="width:180px;height:180px;">
                                <p style="text-align: center;font-size:20px">Đang xử lí . . . </p>   
                                <!-- in thử ảnh ra và nút back  -->
                                <a  class="button" href="uif_profile.php"  >Cập nhật</a> 
                        <?php
                        }else{
                            ?>
                            <form action="./uif_profile.php?action=pic" method="Post" enctype="multipart/form-data" autocomplete="off"> 
                                <div class="input-block">
                                        <input type="hidden" name="id" value="<?= $user['id'] ?>" />
                                </div> 
                                <?php 
                                    if (isset($user['avatar'])) { 
                                        ?>  <!-- Neu co anh dai dien  -->
                                        <div class="image_and_button">
                                            <img src="<?= $user['avatar'] ?>" class="avatar img-circle img-thumbnail" alt="avatar" style="width:180px;height:180px;">
                                            <br>
                                            <input type="file" name="avatar"/><br>
                                        </div>
                                    <?php   
                                    } else { 
                                        ?>
                                        <div class="image_and_button">
                                            <img src="../assets/image/user/user.png"  class="avatar img-circle img-thumbnail" alt="avatar" style="width:180px;height:180px;">
                                            <br>
                                            <input type="file" name="avatar" /><br>      <!-- nut choosen file-->
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                    <!-- submit -->
                                        <button class="btn btn-lg btn-success" type="submit" >
                                        <i class="glyphicon glyphicon-ok-sign"></i> Lưu ảnh</button>
                            </form>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- text center -->
                    </hr><br></br>
                    <?php
                        $current_id = $currentUser['id'];
                        $totalmoney = mysqli_query($con, "SELECT SUM(total) AS sum FROM orders 
                        WHERE customer_id = $current_id");
                        $totalmoney = mysqli_fetch_assoc($totalmoney);
                    ?>
                    <?php
                        $current_id = $currentUser['id'];
                        $boughtbook = mysqli_query($con, "SELECT SUM(quantity) AS bought FROM orders INNER JOIN orders_details 
                        ON orders.id = orders_details.order_id 
                        WHERE customer_id = $current_id;");
                        $boughtbook = mysqli_fetch_assoc($boughtbook);
                    ?>
                    <?php
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
                <!--col-3-sm-3-->
            
       
            <div class="col-sm-8">
                <ul class="nav nav-tabs">
                    <li style = "background-color :#ddd"><a href="uif_profile.php">Cập nhật Thông tin</a></li>
                    <li><a href="uif_passedit.php">Đổi mật khẩu </a></li>
                    <li><a href="uif_favorite.php">Yêu thích</a></li>
                    <li ><a href="uif_orderhis.php">Lịch sử mua hàng</a></li>
                </ul>

                <?php 
                $user = $currentUser;
                ?>
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        
                        <?php 
                        $error = false;
                        if (isset($_GET['action']) && $_GET['action'] == 'edit') 
                        {
                            if (isset($_POST['id']) && $_POST['id'] == $user['id']) {
                            
                            $result = mysqli_query($con, "UPDATE `customers` SET 
                                `first_name` = '" . $_POST['first_name'] ."',
                                `last_name` = '" . $_POST['last_name'] ."' , 
                                `birthday` = '" . $_POST['birthday'] ."' ,
                                `phone` = '" . $_POST['phone'] ."' , 
                                `address` = '" . $_POST['address'] ."' ,
                                `email` = '" . $_POST['email'] . "',
                                `last_updated` = NOW()
                                WHERE `customers`.`id` = " . $_POST['id'] . ";");
                            
                            if (!$result) {
                                $error = "Không thể cập nhật tài khoản";
                            }
                            mysqli_close($con);
                            if ($error !== false) 
                            {
                                ?>
                                <div id="error-notify" class="box-content">
                                    <h1>Thông báo</h1>
                                    <h4><?= $error ?></h4>
                                </div>
                            <?php 
                            } else { 
                                ?>
                                <div class="content-container">
                                    <div id="edit-notify" class="box-content">
                                        <h1><?= ($error !== false) ? $error : "Sửa tài khoản thành công" ?></h1>
                                        <a class="link-button" href="uif_profile.php"> Reset</a>
                                    </div>
                                </div>
                            <?php 
                            }
                            } else { 
                                ?>
                                <div class="content-container">
                                    <div id="edit-notify" class="box-content">
                                        <h1>Vui lòng nhập đủ thông tin để sửa tài khoản</h1>
                                        <a class="link-button" href="uif_profile.php?id=<?= $_POST['id'] ?>">Quay lại sửa tài khoản</a>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {

                            if (!empty($user)) {
                            ?>
                            <form action="./uif_profile.php?action=edit" method="Post" enctype="multipart/form-data"autocomplete="off" id="registrationForm">
                                
                                <div class="input-block">
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>" />
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="first_name">
                                            <h4>Họ tên đệm</h4>
                                        </label>
                                        <input type="text" class="form-control" name="first_name" id="first_name"
                                        value="<?= (!empty($user) ? $user['first_name'] : "") ?>" title="enter your first name if any.">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="last_name">
                                            <h4>Tên</h4>
                                        </label>
                                        <input type="text" class="form-control" name="last_name" id="last_name"
                                        value="<?= (!empty($user) ? $user['last_name'] : "") ?>" title="enter your last name if any.">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="phone">
                                            <h4>Điện thoại</h4>
                                        </label>
                                        <input type="text" class="form-control" name="phone" id="phone"
                                        value="<?= (!empty($user) ? $user['phone'] : "") ?>" title="enter your phone number if any.">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="birthday">
                                            <h4>Ngày sinh</h4>
                                        </label>
                                        <input type="date" class="form-control" name="birthday" id="birthday"
                                        value="<?=$user['birthday']?>" title="enter your mobile number if any.">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="email">
                                            <h4>Email</h4>
                                        </label>
                                        <input type="email" class="form-control" name="email" id="email"
                                        value="<?= (!empty($user) ? $user['email'] : "") ?>" title="enter your email.">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="address">
                                            <h4>Địa chỉ</h4>
                                        </label>
                                        <input type="text" class="form-control" name="address" id="address"
                                        value="<?= (!empty($user) ? $user['address'] : "") ?>" title="enter a location">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <br>
                                        <button class="btn btn-lg btn-success" type="submit">
                                        <i class="glyphicon glyphicon-ok-sign"></i> Lưu lại </button>
                                    </div>
                                </div>
                            </form>

                            <?php
                            }
                        }
                        ?>
                       

                    </div>
                    <!--/tab-pane active-->
                </div>
                <!--/tab-content-->
            </div>
            <!--/col-9-->
        </div>
        <!--/row-->
    </div>
    <!-- container -->





