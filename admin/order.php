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

    $config_name = "order";
    $config_title = "ĐƠN HÀNG   ";
    $param = "";          // khoi tao bien param la chuoi trong filter de gan vs perpage va page

        if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
            $_SESSION[$config_name.'_filter'] = $_POST;
            // header('Location: '.$config_name.'.php');
        }
        if(!empty($_SESSION[$config_name.'_filter'])){
            $where = "";
            foreach ($_SESSION[$config_name.'_filter'] as $field => $value) {
                if(!empty($value)){
                    switch ($field) {
                        case 'fullname':
                        $where .= (!empty($where))? " AND "."`orders`.`".$field."` LIKE '%".$value."%'" : "`orders`.`".$field."` LIKE '%".$value."%'";
                        $param .= "".$field."=".$value."&";
                        break;
                        default:
                        $where .= (!empty($where))? " AND "."`orders`.`".$field."` = ".$value."": "`orders`.`".$field."` = ".$value."";
                        $param .= "".$field."=".$value."&";
                        break;
                    }
                }
            }
            extract($_SESSION[$config_name.'_filter']);
        }
        if(!empty( $_GET['field'] )){
            // var_dump($_GET['field']);
            if( $_GET['field'] == 'day'){
                // var_dump(1);
                $where .= (!empty($where))? " AND "."DAY(`orders`.`created_date`) = DAY(NOW())" : "DAY(`orders`.`created_date`) = DAY(NOW())";
                $where .= " AND YEAR(`orders`.`created_date`) = YEAR(NOW())";
                $param .= "field=day&";
            }
            if( $_GET['field'] == 'month'){
                // var_dump(1);
                $where .= (!empty($where))? " AND "."MONTH(`orders`.`created_date`) = MONTH(NOW())  " : "MONTH(`orders`.`created_date`) = MONTH(NOW())";
                $where .= " AND YEAR(`orders`.`created_date`) = YEAR(NOW())";
                $param .= "field=month&";
            }
            if( $_GET['field'] == 'year' && $_GET['year'] == '2022'){
                // var_dump(1);
                $where .= (!empty($where))? " AND "."YEAR(`orders`.`created_date`) = YEAR(NOW())  " : "YEAR(`orders`.`created_date`) = YEAR(NOW())";
                $param .= "field=year&year=2022&";
            }
            if( $_GET['field'] == 'year' && $_GET['year'] == '2021'){
                // var_dump(1);
                $where .= (!empty($where))? " AND "."YEAR(`orders`.`created_date`) = 2021  " : "YEAR(`orders`.`created_date`) = 2021 ";
                $param .= "field=year&year=2021&";
            }
        }
        // var_dump($where);

        $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
        $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;
        if(!empty($where)){
            $totalRecords = mysqli_query($con, "SELECT * FROM `orders` where (".$where.")");
        }else{
            $totalRecords = mysqli_query($con, "SELECT * FROM `orders`");
        }
        $totalRecords = $totalRecords->num_rows;
        $totalPages = ceil($totalRecords / $item_per_page);
        if(!empty($where)){
            $orders = mysqli_query($con, "SELECT `orders`.*,`customers`.`first_name`,`customers`.`last_name`  
            FROM `orders` INNER JOIN `customers` ON `customers`.id = `orders`.`customer_id`
            WHERE (".$where.") 
            ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
        }else{
            $orders = mysqli_query($con, "SELECT `orders`.*,`customers`.`first_name`,`customers`.`last_name`
            FROM `orders` INNER JOIN `customers` ON `customers`.id = `orders`.`customer_id`
            ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
        }
        // mysqli_close($con);
    ?>




            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <p style="text-align:center;padding: 5px;font-size: 30px;"><b>DANH SÁCH <?= $config_title ?></b></p>
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom:10px">
                                <form id="<?= $config_name ?>-search-form" action="<?= $config_name ?>.php?action=search" method="POST">
                                    <fieldset class="flex-fieldset">
                                        <p>ID: <input class="input-area" type="text" name="id" value="<?= !empty($id) ? $id : "" ?>" /> </p>
                                        <p>Tên người nhận: <input class="input-area" type="text" name="fullname" value="<?= !empty($fullname) ? $fullname : "" ?>" /> </p>
                                        <input class="button" type="submit" value="Tìm" />
                                    </fieldset>
                                </form>
                                <select name="sort" id="sort" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                    <option value="" hidden selected>Sắp xếp theo</option>
                                    <!-- selected: thuoc tinh html khi click vao thi the do van hien thi value do  -->
                                    <option <?php if(isset($_GET['field']) && $_GET['field'] == "day") { ?> selected <?php } ?> value="?field=day">Trong hôm nay</option>

                                    <option <?php if(isset($_GET['field']) && $_GET['field'] == "month") { ?> selected <?php } ?> value="?field=month">Trong tháng này</option>

                                    <option <?php if(isset($_GET['field']) && $_GET['field'] == "year" && $_GET['year'] == "2022") { ?> selected <?php } ?> 
                                    value="?field=year&year=2022">Trong năm nay</option>

                                    <option <?php if(isset($_GET['field']) && $_GET['field'] == "year" && $_GET['year'] == "2021") { ?> selected <?php } ?> 
                                    value="?field=year&year=2021">Trong năm 2021</option>
                                </select> 
                            </div>
                                

                            <div class="col-md-12">
                    
                                 <!-- DATA TABLE -->
                                <div class="table-responsive table-responsive-data2">
                            <?php
                            include './pagination.php';
                            ?>
                                    <table class="table table-data2" style="margin-top:5px;">
                                        <thead style="background-color:#444;color:#f4f4f4">
                                            <tr>
                                                <th style="color:#f4f4f4;text-align: center;">ID</th>
                                                <th style="color:#f4f4f4;text-align: center;">Tài khoản</th>
                                                <th style="color:#f4f4f4;text-align: center;">Địa chỉ nhận hàng</th>
                                                <th style="color:#f4f4f4;text-align: center;width: 15%;">Số điện thoại</th>
                                                <th style="color:#f4f4f4;text-align: center;">Ngày tạo</th>
                                                <th style="color:#f4f4f4;text-align: center;width: 15%;">Tổng tiền</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                <?php  while ($row = mysqli_fetch_array($orders)) { ?>                                    
                                        <tbody>
                                            <tr class="tr-shadow">
                                                <td style="text-align:center;"><?=$row['id']?></td>
                                                <td style="text-align:center;"><?=$row['first_name']." ".$row['last_name']?></td>
                                                <td style="text-align:center;"><?=$row['address']?></td>
                                                <td style="text-align:center;"><?=$row['phone']?></td>
                                                <td style="text-align:center;"><?=$row['created_date']?></td>
                                                <td style="text-align:center;"><?= number_format($row['total'], 0, ",", ".")?></td>
                                                <td style="text-align:center;"><a class="fa fa-print" href="order_printing.php?id=<?=$row['id']?>" target="_blank"></a></td>
                                                <td style="text-align:center;"><a class="fa fa-trash" href="order_delete.php?id=<?=$row['id']?>"></a></td>
                                            </tr><tr class="spacer"></tr>
                                        </tbody> 
                                 <?php  } ?>
                                    </table><!-- end table -->
                                </div>
                                <!-- END DATA TABLE -->
                            <?php
                            include './pagination.php';
                            ?>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
<style>
    * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
                color: #495057;
            }
    .fa-trash {
        color: #f03e3e;
    }

    .fa-trash:hover {
        color: #f03e3e;
    }

    .flex-fieldset {
        margin-top: 30px;
        display: flex;
        gap: 40px;
        margin-bottom: 30px;
        align-items: center;
    }

    .input-area {
        height: 30px;
        width: 330px;
        
        right: 10px;
        border-radius: 9px;
        border: 1px solid #ccc;
        padding: 5px;
    }

    .button {
                
                font-size: 15px;
                font-weight: 600;
                background-color: #f59f00;
                color: #fff;
                text-decoration: none;
                cursor: pointer;
                border-radius: 5px;
                border: 0;
                padding: 5px 15px;
                
            }

            .button:hover, .button:active {
                background-color: #f08c00;
            }
</style>
</html>
<!-- end document-->
