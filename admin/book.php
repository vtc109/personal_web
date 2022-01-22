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
    
        // $books = mysqli_query($con, "SELECT books.* FROM `books`  ORDER BY `id` ASC " );
        
        //      PHÂN TRANG
        $param = "";          // khoi tao bien param la chuoi trong filter de gan vs perpage va page

    if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){//  Neu co action GET co ten la search
        $_SESSION['book_filter'] = $_POST;      // khai bao session  'book filter' = $_POST => Khi quay ve trang chinh thi van luu lai session
        // var_dump($_SESSION['book_filter']);exit;
        
    }
    if(!empty($_SESSION['book_filter'])){ // Neu ton tai phien co phan tu book_filter
        $where = "";
        foreach ($_SESSION['book_filter'] as $field => $value) { // gan field = key
            if(!empty($value)){
                switch ($field) {
                    case 'tittle':
                        $where .= (!empty($where))? " AND "."`".$field."` LIKE '%".$value."%'" : "`".$field."` LIKE '%".$value."%'"; // neu rong thi luu luon chuoi, neu ko thi them AND
                        $param .= "".$field."=".$value."&";
                    break;
                    default:
                        $where .= (!empty($where))? " AND "."`".$field."` = ".$value."": "`".$field."` = ".$value."";
                        $param .= "".$field."=".$value."&";
                    break;
                }
            }
        }
        // var_dump($where);exit;
        extract($_SESSION['book_filter']);
    }
    if(!empty( $_GET['field'] )){
        // var_dump($_GET['field']);
        if( $_GET['field'] == 'day'){
            // var_dump(1);
            $where .= (!empty($where))? " AND "."DAY(`books`.`created_date`) = DAY(NOW())" : "DAY(`books`.`created_date`) = DAY(NOW())";
            $where .= " AND YEAR(`books`.`created_date`) = YEAR(NOW())";
            $param .= "field=day&";
        }
        if( $_GET['field'] == 'month'){
            // var_dump(1);
            $where .= (!empty($where))? " AND "."MONTH(`books`.`created_date`) = MONTH(NOW())  " : "MONTH(`books`.`created_date`) = MONTH(NOW())";
            $where .= " AND YEAR(`books`.`created_date`) = YEAR(NOW())";
            $param .= "field=month&";
        }
        if( $_GET['field'] == 'year' && $_GET['year'] == '2022'){
            // var_dump(1);
            $where .= (!empty($where))? " AND "."YEAR(`books`.`created_date`) = YEAR(NOW())  " : "YEAR(`books`.`created_date`) = YEAR(NOW())";
            $param .= "field=year&year=2022&";
        }
        if( $_GET['field'] == 'year' && $_GET['year'] == '2021'){
            // var_dump(1);
            $where .= (!empty($where))? " AND "."YEAR(`books`.`created_date`) = 2021  " : "YEAR(`books`.`created_date`) = 2021 ";
            $param .= "field=year&year=2021&";
        }
    }

    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 8;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if(!empty($where)){ // Tinh toan lai tong so san pham khi co filter
        $totalRecords = mysqli_query($con, "SELECT * FROM `books` where (".$where.")");
    }else{
        $totalRecords = mysqli_query($con, "SELECT * FROM `books`");
    }
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($where)){ // neu ton tai where - tuc la dang filter thi su dung ham nay
        $books_filter = mysqli_query($con, "SELECT * FROM `books` where (".$where.") ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{  // neu ko thi phan trang binh thuong
        $books_filter = mysqli_query($con, "SELECT * FROM `books` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
  
    ?>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               

                                <!-- Filter -->
                                <h3 class="title-5 m-b-35" style="text-align: center; font-size: 30px; text-transform: uppercase; font-weight: 700; margin-bottom: 50px">Danh sách sản phẩm</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--sm" style="width:160px;">
                                            <select class="js-select2" name="sort" id="sort" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                                <option value="" hidden selected>Sắp xếp theo</option>
                                                <!-- selected: thuoc tinh html khi click vao thi the do van hien thi value do  -->
                                                <option <?php if(isset($_GET['field']) && $_GET['field'] == "day") { ?> selected <?php } ?> value="?field=day">Trong hôm nay</option>

                                                <option <?php if(isset($_GET['field']) && $_GET['field'] == "month") { ?> selected <?php } ?> value="?field=month">Trong tháng này</option>

                                                <option <?php if(isset($_GET['field']) && $_GET['field'] == "year" && $_GET['year'] == "2022") { ?> selected <?php } ?> 
                                                value="?field=year&year=2022">Trong năm nay</option>

                                                <option <?php if(isset($_GET['field']) && $_GET['field'] == "year" && $_GET['year'] == "2021") { ?> selected <?php } ?> 
                                                value="?field=year&year=2021">Trong năm 2021</option>
                                            </select> 
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="table-data__tool-center">
                                    <form id="book-search-form" action="book.php?action=search" method="POST">
                                    <fieldset>
                                    <p>ID: <input style="padding: 5px; border-radius: 5px; width: 160px;border: 1px solid rgba(0,0,0,.1);" type="text" name="id" value="<?=!empty($id)?$id:""?>" /></p>
                                    <p>Tên sản phẩm: <input style="padding: 5px; border-radius: 5px; width: 160px;border: 1px solid rgba(0,0,0,.1);" type="text" name="tittle" value="<?=!empty($tittle)?$tittle:""?>" /></p>
                                    <input  class="au-btn au-btn-icon au-btn--green au-btn--small" type="submit" value="Tìm" />
                                    </fieldset>
                                    </form>
                                    </div>

                                    <div class="table-data__tool-right">
                                        <a href="book_handle.php" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i> Thêm sản phẩm
                                        </a>
                                    </div>
                                </div><!-- end filter -->

                                 <!-- DATA TABLE -->
                                <div class="table-responsive table-responsive-data2">
                            <?php
                            include './pagination.php';
                            ?>
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </th>
                                                <th id="table-thead-color">Tên</th>
                                                <th id="table-thead-color">Ảnh</th>
                                                <th id="table-thead-color">Tác giả</th>
                                                <th id="table-thead-color">Cập nhật lần cuối</th>
                                                <th id="table-thead-color">Số lượng</th>
                                                <th id="table-thead-color" style="width: 20%">
                                                    <div class="row">Giá hiện tại (Giá gốc)</div>
                                                    
                                                </th class="table-thead-color">
                                                <th></th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                    <?php
                                    
                                    while ($row = mysqli_fetch_array($books_filter) ) {
                                        // đặt biến $row_id để sau này gọi trong mysqli không bị lỗi
                                        $row_id = $row['id'];
                                        // var_dump($row_id);exit;
                                    ?>
                                        
                                            <tr class="tr-shadow">
                                                <td>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td><?=$row['tittle']?></td>
                                                <td>
                                                    <img style="width: 60px;height: 80px;" src="../<?= $row['image'] ?>" alt="<?= $row['tittle'] ?>" title="<?= $row['tittle']?>">
                                                </td>
                                                
                                                <td class="desc">
                                        <?php
                                        $author = mysqli_query($con, "SELECT authors.name
                                                                    FROM `books_authors`  INNER JOIN `authors` ON books_authors.author_id = authors.id
                                                                                        INNER JOIN `books` ON books_authors.book_id = books.id
                                                                    WHERE `books_authors`.`book_id` = $row_id                    
                                                                                  ");  
                                        while ($row2 = mysqli_fetch_array($author)){ ?>
                                            <a href="" style="font-size: 0.8rem;"><?= $row2['name'].","?></a>
                                        <?php } ?>

                                                </td>
                                                
                                                <td><?= $row['last_updated'] ?></td>
                                                <td>
                                                    <?php if ($row['quantity'] > 0) { ?>
                                                    <span class="status--process"><?=$row['quantity']?></span>
                                                    <?php } else { ?>
                                                    <span class="status--denied">Hết hàng</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <div class="row"><?= number_format($row['price'], 0, ",", ".")?> đ</div> 
                                                    <div class="row">( <?= number_format($row['import_price'], 0, ",", ".")?> )</div> 
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <a href="./book_handle.php?id=<?= $row['id'] ?>&task=copy&task=copy" class="item" data-toggle="tooltip" data-placement="top" title="Copy">
                                                            <i class="zmdi zmdi-copy"></i>
                                                        </a>
                                                        <a href="./book_handle.php?id=<?= $row['id'] ?>" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                        <a href="./book_delete.php?id=<?= $row['id'] ?>" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                              
                                            
                                        
                                    <?php } ?>
                                    </tbody> 
                                    </table><!-- end table -->
                            <?php
                            include './pagination.php';
                            ?>
                                </div>
                                <!-- END DATA TABLE -->

                            </div>
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

         
    <?php }  ?>   <!-- end else -->

</body>
<style>
     * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            
        }
        .table {
            margin-top: 30px;
        }
        table {
            border-collapse: collapse;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0px 2px 5px 0px rgb(0 0 0 / 10%);
            
        }

        thead {
                background: #434343;
                margin-bottom: 10px;
            }

        #table-thead-color{
        color: #fff;
        }
        td {
        /* border: 1px solid #343a40; */
        padding: 16px 24px;
        text-align: left;
        
        }

       
    
    #table-row:nth-child(odd) {
    background-color: #fff;
    }

    #table-row:nth-child(even) {
    background-color: #f5f5f5;
    }
    fieldset {
        display: flex;
        align-items: center; 
        gap: 20px;
    }
</style>
</html>
<!-- end document-->
