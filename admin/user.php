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

    <?php include 'admin_navbar.php'; ?>

    <?php 
        include '../connect_db.php';
        $param ="";
        $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 8;
        $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;

        $totalRecords = mysqli_query($con, "SELECT * FROM `customers`");
        $totalRecords = $totalRecords->num_rows;
        $totalPages = ceil($totalRecords / $item_per_page);
        
        $result = mysqli_query($con, "SELECT * FROM customers ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
        mysqli_close($con);

        ?>
        <style>
            #user_listing td{
                padding: 12px 30px;
            }
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
                color: #495057;
            }
            .header-wrap {
                display: flex; 
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
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
                border-radius: 9px;
                border: 0;
                padding: 10px 10px;
            }

            .link-button:hover, .link-button:active {
                background-color: #f08c00;
            }
        </style>


            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- <div id="user-info"> -->
                             <div class="col-xl-12">
                                 <div class="header-wrap">
                                    <h1>Danh sách tài khoản</h1>
                                    <a class="link-button fa fa-user-plus" href="./user_create.php">Tạo tài khoản mới</a>
                                </div>
                                <div class="table-responsive table--no-card m-b-30">
                                    <!-- <table id = "user-listing" style="width: 700px;"> -->

                            <?php
                            include './pagination.php';
                            ?>                                    
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead id="user_listing" style="background-color: #444;color: #f4f4f4;">
                                            <td style="color:white; text-align:center">Tài khoản</td>
                                            <td style="color:white; text-align:center">Họ và tên đầy đủ</td>
                                            <td style="color:white; text-align:center">Ngày sinh</td>
                                            <td style="color:white; text-align:center">Số điện thoại</td>
                                            <td style="color:white; text-align:center">Trạng thái</td>
                                            <td style="color:white; text-align:center">Sửa</td>
                                            <td style="color:white; text-align:center">Xóa</td>
                                            <td style="color:white; text-align:center" class="text-right">Cập nhật lần cuối</td>
                                            <!-- <td class="text-right">Ngày tạo tài khoản</td> -->
                                        </thead>
                                        <?php
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <tr>
                                                <td style="text-align:center"><?= $row['username'] ?></td>
                                                <td style="text-align:center"><?= $row['first_name']." ".$row['last_name'] ?></td>
                                                <td style="text-align:center"><?= $row['birthday'] ?></td>
                                                <td style="text-align:center"><?= $row['phone'] ?></td>
                                                <td>
                                                    <?php if ($row['status'] == 1 ){ ?>
                                                        <span class="role member">Kich hoat</span>
                                                   <?php } else { ?>
                                                        <span class="role admin">Vo hieu hoa</span>
                                                    <?php } ?>
                                                </td>
                                        <?php if($row['id'] != 1){ ?>    
                                                <td style="text-align:center"><a class="fa fa-edit" href="./user_edit.php?id=<?= $row['id'] ?>" style="color:dodgerblue"></a></td>
                                                <td style="text-align:center"><a class="fa fa-trash" href="./user_delete.php?id=<?= $row['id'] ?>" style="color:crimson"></a></td>
                                                <td style="text-align:center"><?= $row['last_updated'] ?></td>
                                                <!-- <td> date('d/m/Y H:i', $row['created_date']) </td> -->
                                        <?php } else { ?>
                                                <td style="text-align:center"></td>
                                                <td style="text-align:center"></td>
                                                <td style="text-align:center"><?= $row['last_updated'] ?></td>
                                        <?php }  ?>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                                </div> <!-- end user info -->
                            </div><!-- end row -->
                            
                        

                        
                    </div><!-- end container fluid -->
                </div><!-- end section_content -->
            </div>
        </div><!-- end container -->
                                                
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

    <!-- Main JS-->
    <script src="js/main.js"></script>

    <?php } ?>   <!-- end else -->
</body>

</html>
<!-- end document-->