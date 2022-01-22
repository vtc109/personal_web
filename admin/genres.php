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
        
        $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 8;
        $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;

        $totalRecords = mysqli_query($con, "SELECT * FROM `genres`");
        $totalRecords = $totalRecords->num_rows;
        $totalPages = ceil($totalRecords / $item_per_page);
        
        $result = mysqli_query($con, "SELECT * FROM genres ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
        mysqli_close($con);

        ?>
        <style>
            /* table, th, td {
                border: 1px solid black;
            }
            #user-info{
                border: 1px solid #ccc;
                width: 960px;
                margin: 0 auto;
                padding: 25px;
            }
            #user-info table{
                margin: 10px auto 0 auto;
                text-align: center;
            }
            #user-info h1{
                text-align: center;
            } */

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
                color: #495057;
            }
        </style>


            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- <div id="user-info"> -->
                             <div class="col-xl-12">
                                    <h1>Danh sách các thể loại</h1>
                                    <a class="fa fa-user-plus" href="./genres_create.php">Tạo thể loại mới</a>
                                <div class="table-responsive table--no-card m-b-30">
                                    <!-- <table id = "user-listing" style="width: 700px;"> -->

                            <?php
                            include './pagination.php';
                            ?>                                    
                                    <table class="table table-borderless table-striped table-earning">
                                        <tr>
                                            <td>ID</td>
                                            <td>Tên thể loại</td>
                                            <td>Sửa</td>
                                            <td>Xóa</td>
                                            <td>Cập nhật lần cuối</td>
                                            <!-- <td class="text-right">Ngày tạo tài khoản</td> -->
                                        </tr>
                                        <?php
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <tr>
                                                <td><?= $row['id'] ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><a class="fa fa-edit" href="./genres_edit.php?id=<?= $row['id'] ?>" style="color:dodgerblue"></a></td>
                                                <td><a class="fa fa-trash" href="./genres_delete.php?id=<?= $row['id'] ?>" style="color:crimson"></a></td>
                                                <td><?= $row['last_updated'] ?></td>
                                                <!-- <td> date('d/m/Y H:i', $row['created_date']) </td> -->
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