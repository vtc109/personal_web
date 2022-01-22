<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        color: #495057;
    }
    #main-content {
        padding-top: 80px;
    }
    .content-container {
               
                position: relative;
                height: 200vh;
                 background-image: linear-gradient(rgba(233, 236, 239, 0.603), rgba(233, 236, 239, 0.603));
                 background-image: linear-gradient(rgba(34, 34, 34, 0.603), rgba(34, 34, 34, 0.603)), url(assets/image/login-theme.jpg);
                background-size: cover;
                background-image: linear-gradient(#f4f4f4, #7ac187);

            }
            .box-content{
                margin: 0 auto;
                margin-top: 10px;
                width: 800px;
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

            .wrap-field {
                width: 100%;
                display: flex;
                align-items: center;
                gap: 20px;
                margin-bottom: 40px;
                position: relative;
            }

            .content-wrap-field {
                width: 100%;
                display: flex;
                align-items: center;
                gap: 20px;
                margin-bottom: 30px;
                position: relative;
                height: 300px;
            }

            .input-area {
                height: 34px;
                width: 600px;
                position: absolute; 
                right: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                padding: 5px;
            }

            .image-content-block {
                display: flex;
            }

            .label-style {
                margin-bottom: 0;
            }

            .button-container {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 20px;
            }
            .button {
               
                font-size: 17px;
                font-weight: 600;
                background-color: #f59f00;
                color: #fff;
                text-decoration: none;
                cursor: pointer;
                border-radius: 5px;
                border: 0;
                padding: 5px 40px;
                margin-top: 20px;
                
            }

            .button:hover, .button:active {
                background-color: #f08c00;
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
                border-radius: 5px;
                border: 0;
                padding: 5px 10px;
            }

            .link-button:hover, .link-button:active {
                background-color: #f08c00;
            }
</style>
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
    ?>

            <!-- MAIN CONTENT-->
            <div id="main-content" class="main-content">
                <div >
                    <div >
                        <div >
                            <div >
            <?php
// Neu phuong thuc truyen vao la add(copy) hoac edit : DA THEM SUA ROI        
            //echo ($_GET['id']);exit;
            if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {
                //  var_dump($_FILES['image']);exit;
                //  var_dump($_POST);
               if (isset($_POST['tittle']) && !empty($_POST['tittle']) && isset($_POST['price']) && !empty($_POST['price'])) { // ham check xem nhap du thong tin sp chua
                    $galleryImages = array();
                    if (empty($_POST['tittle'])) {
                        $error = "Bạn phải nhập tên sản phẩm";
                    } elseif (empty($_POST['price'])) {
                        $error = "Bạn phải nhập giá sản phẩm";
                    } elseif (!empty($_POST['price']) && is_numeric($_POST['price']) == false) {
                        $error = "Giá nhập không hợp lệ";
                    }
                    //upload anh dai dien
                    if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) { // Dieu Kien cua thu vien anh
                        $uploadedFiles = $_FILES['image']; // uploadFile get duoc anh 
                        $result = uploadFiles($uploadedFiles);  // upload file anh len(TV upload anh)
                        if (!empty($result['errors'])) { // neu co loi
                            $error = $result['errors'];
                        } else {
                            $image = $result['path'];
                        }
                    }
                    if (!isset($image) && !empty($_POST['image'])) {
                        $image = $_POST['image'];
                    }
                    // var_dump($image);    exit;                 

                    //khi up load nhieu anh trong thu vien anh , du lieu anh dc luu lai o truong $_FILES['gallery'
                    if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) {
                        $uploadedFiles = $_FILES['gallery'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $galleryImages = $result['uploaded_files'];
                            
                        }
                    }
                    if (!empty($_POST['gallery_image'])) {
                        $galleryImages = array_merge($galleryImages, $_POST['gallery_image']);
                    }


                    // Cap nhat vao database
                    if (!isset($error)) {
                        if ($_GET['action'] == 'edit' && !empty($_GET['id'])) { 
                            //Cập nhật lại sản phẩm
                            $result = mysqli_query($con, "UPDATE `books` SET `tittle` = '" . $_POST['tittle'] . "', `quantity` = '" . $_POST['quantity'] . "' ,`image` =  '" . $image . "',
                             `price` = '" . $_POST['price'] . "' ,  `discount` = '" . $_POST['discount'] . "' , `import_price` = '" . $_POST['import_price'] . "' , `content` = '" . $_POST['content'] . "', `last_updated` = NOW() 
                             WHERE `books`.`id` = " . $_GET['id']);
                        //    $result2 = mysqli_query($con, "UPDATE `books_authors` SET `author_id` = '" . $_POST['author_id'] . "' WHERE `books_authors`.`book_id` = " . $_GET['id']);
                        } else { 
                            //Thêm sản phẩm hoac copy san pham
                            $result = mysqli_query($con, "INSERT INTO `books` (`id`, `tittle` , `quantity` , `image`, `price`, `discount` , `import_price` , `content`, `created_date`, `last_updated`) 
                            VALUES (NULL, '" . $_POST['tittle'] . "', '" . $_POST['quantity'] . "' , '" . $image . "',
                             '" . $_POST['price'] . "', '" . $_POST['discount'] . "' , '" . $_POST['import_price'] . "' , '" . $_POST['content'] . "', NOW() , NOW() );");
                            
                            // lay ra id sa'ch lo'n nhat chinh la id cua sach mi`nh vu`a tao 
                            //$book_add = mysqli_query($con, "SELECT MAX(id) FROM `books` "); 
                            //$book_add_id = $book_add->fetch_assoc();
                            // var_dump($book_add_id['MAX(id)']);var_dump($_POST['author_id']); exit;
                            //$result2 = mysqli_query($con, "INSERT INTO `books_authors` (`author_id`,`book_id`)
                            //VALUES ('" . $_POST['author_id'] . "',  '" . $book_add_id['MAX(id)'] . "'  )   ") ;
                            // var_dump($result);exit;
                        }

                        if (!$result) { //Nếu có lỗi xảy ra
                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        } else { //Nếu thành công
                            //them link book_id cua thu vien gan voi tung id cua book
                            if (!empty($galleryImages)) {
                                $book_id = ($_GET['action'] == 'edit' && !empty($_GET['id'])) ? $_GET['id'] : $con->insert_id;
                                $insertValues = "";
                                foreach ($galleryImages as $path) {
                                    if (empty($insertValues)) {
                                        $insertValues = "(NULL, " . $book_id . ", '" . $path . "', NOW() , NOW() )";
                                    } else {
                                        $insertValues .= ",(NULL, " . $book_id . ", '" . $path . "', NOW() , NOW() )";
                                    }
                                }
                                $result = mysqli_query($con, "INSERT INTO `books_library` (`id`, `book_id`, `path`, `created_time`, `last_updated`) 
                                VALUES " . $insertValues . ";");
                            }
                        }
                    }
                } 
                else {
                    $error = "Bạn chưa nhập thông tin sản phẩm.";
                }
                ?>


                <!-- neu cap nhat xongthanh cong -->
                <div class="content-container"  style="height:90vh;">
                <div class = "box-content" style="width:500px">
                    <div class = "error" style="margin-bottom:20px; font-size: 20px;"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                    <a href = "book.php" class="link-button">Quay lại trang quản lý sách</a>
                </div>
            </div>
            </div><!-- end col-md-12 -->
            <?php
            }   
// Neu khong ton tai 1 phuong thuc nao (chua them or sua,copy) thi render ra giao dien              
            else {     
                if (!empty($_GET['id'])) {      // HAM XU LY LAY VE TUNG ANH TU THU VIEN ANH ( neu co phuong thuc get id )
                    $result = mysqli_query($con, "SELECT *
                    FROM `books` WHERE `id` = " . $_GET['id']);  // lay du lieu tu bang books vs id = $_Get['id]
                    // var_dump($result);exit;  

                    $result2 = mysqli_query($con, "SELECT books_authors.author_id,authors.name
                    FROM `books_authors` INNER JOIN `authors` ON books_authors.author_id = authors.id
                      WHERE `book_id` = " . $_GET['id']);  // lay du lieu tu bang books vs id = $_Get['id]
                    //var_dump($result2);exit;

                    $result3 = mysqli_query($con, "SELECT books_genres.genres_id,genres.name
                    FROM `books_genres` INNER JOIN `genres` ON books_genres.genres_id = genres.id
                      WHERE `book_id` = " . $_GET['id']);  // lay du lieu tu bang books vs id = $_Get['id]
                    //var_dump($result3);exit;

                    $book_id = $_GET['id']; 
                    // var_dump($book_id);exit;
                    $result4 = mysqli_query($con, "SELECT books_publishers.publisher_id,publishers.name,books_publishers.started_date
                    FROM `books_publishers` INNER JOIN `publishers` ON books_publishers.publisher_id = publishers.id
                      WHERE  `book_id` = $book_id AND started_date IN (SELECT MAX(started_date) FROM books_publishers WHERE `book_id` = $book_id AND started_date <=NOW() )");
                    // var_dump($result4);exit;

                    $book = $result->fetch_assoc();  // dua du lieu tu json ve dang array

                    $gallery = mysqli_query($con, "SELECT * FROM `books_library` WHERE `book_id` = " . $_GET['id']); // lay du lieu tu bag image_library
                    if (!empty($gallery) && !empty($gallery->num_rows)) {
                        while ($row = mysqli_fetch_array($gallery)) {   
                            // Tao ta 1 mang gallery moi trong book de luu id va duong dan anh cua thu vien anh sp
                            $book['gallery'][] = array(
                                'id' => $row['id'],
                                'path' => $row['path']
                            );
                        }
                    }
                }
            ?>
                    <div class="content-container">
                    <div class = "box-content">
                        <div class="row"><a href="javascript:window.history.go(-1)" class="fa fa-undo" style="padding: 5px; margin-bottom: 10px;">  Quay lại</a></div>
                        <form id="book-form" method="POST" action="<?= (!empty($book) && !isset($_GET['task'])) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>"  enctype="multipart/form-data">
                            <!-- neu ma sp khong rong va ko co $_GET['task'] thi la edit =>  neu ko co sp nhan ve thi la THEM, neu co task thi la COPY  -->
                            

                                <div class="clear-both"></div>
                                <div class="wrap-field">
                                    <label class="label-style">Tên sách : </label>
                                    <!-- Neu TH la sua sp thi co book ko empty -> tra ve book'tittle' -->
                                    <input class="input-area" type="text" name="tittle" value="<?= (!empty($book) ? $book['tittle'] : "") ?>" />
                                    <div class="clear-both"></div>
                                </div>
                                
                                <?php if (!empty($_GET['id'])) {  ?> 
                            <!-- TAC GIA -->
                            <div class="wrap-field">
                                <!-- Neu TH la sua sp thi co book ko empty -> tra ve book'tittle' -->
                                <label>Tác giả : </label>
                                <a href="book_add_author.php?id=<?= $book['id']?>" class="fas fa-plus-circle"></a>
                                
                                <div class="clear-both"></div>
                        <?php
                            while ($author = mysqli_fetch_array($result2)){ 
                            // var_dump($author['author_id']);
                        ?>
                                <span style="padding: 5px;background-color:white;" ><?=$author['name']?></span>
                                <a href="book_delete_author.php?author_id=<?= $author['author_id']?>&id=<?= $book['id'] ?>" class="fa fa-trash"></a>
                                <div class="clear-both"></div>                            
                        <?php } ?>
                                <div class="clear-both"></div>                            
                            </div>

                            <!-- THE LOAI -->
                            <div class="wrap-field">
                                <!-- Neu TH la sua sp thi co book ko empty -> tra ve book'tittle' -->
                                <label>Thể loại : </label>
                                <a href="book_add_genres.php?id=<?= $book['id']?>" class="fas fa-plus-circle"></a>
                                
                                <div class="clear-both"></div>
                        <?php
                            while ($genres = mysqli_fetch_array($result3)){ 
                            // var_dump($author['author_id']);
                        ?>
                                <span style="padding: 5px;background-color:white;" ><?=$genres['name']?></span>
                                <a href="book_delete_genres.php?genres_id=<?= $genres['genres_id']?>&id=<?= $book['id'] ?>" class="fa fa-trash"></a>
                                <div class="clear-both"></div>                            
                        <?php } ?>
                                <div class="clear-both"></div>                            
                            </div>

                            <!-- NHA XUAT BAN -->
                            <div class="wrap-field">
                                <!-- Neu TH la sua sp thi co book ko empty -> tra ve book'tittle' -->
                                <label>Nhà xuất bản : </label>
                                <a href="book_add_publisher.php?id=<?= $book['id']?>" class="fas fa-plus-circle"></a>
                                
                                <div class="clear-both"></div>
                        <?php
                            while ($publisher = mysqli_fetch_array($result4)){ 
                            // var_dump($author['author_id']);
                        ?>
                                <span style="padding: 5px;background-color:white;" ><?=$publisher['name']?></span>
                                <a href="book_delete_publisher.php?publisher_id=<?= $publisher['publisher_id']?>&id=<?= $book['id'] ?>" class="fa fa-trash"></a>
                                <div class="clear-both"></div>                            
                        <?php } ?>
                                <div class="clear-both"></div>                            
                            </div>                            

                    <?php } ?>

                                <div class="wrap-field">
                                    <label class="label-style">Giá gốc: </label>
                                    <input class="input-area" type="text" name="import_price" value="<?= (!empty($book) ? $book['import_price'] : "") ?>" />
                                    <div class="clear-both"></div>
                                </div>
                                                    
                                <div class="wrap-field">
                                    <label class="label-style">Giá bán hiện tại: </label>
                                    <input class="input-area" type="text" name="price" value="<?= (!empty($book) ? $book['price'] : "") ?>" />
                                    <div class="clear-both"></div>
                                </div>

                                <div class="wrap-field">
                                    <label class="label-style">Giảm giá: </label>
                                    <input class="input-area" type="text" name="discount" value="<?= (!empty($book) ? $book['discount'] : "") ?>" />
                                    <div class="clear-both"></div>
                                </div>

                                <div class="wrap-field">
                                    <label class="label-style">Số lượng hiện có: </label>
                                    <input class="input-area" type="text" name="quantity" value="<?= (!empty($book) ? $book['quantity'] : "") ?>" />
                                    <div class="clear-both"></div>
                                </div>
                                
                               
                                <div class="wrap-field" style = "margin-bottom: 70px" >
                                    <label class="label-style">Ảnh bìa: </label>
                                    <div class="align-content" style="margin-left: 70px; display: flex; align-items: center; gap: 105px">
                                        <div class="right-wrap-field" style="width:100px;">
                                        
                                    <?php if (!empty($book['image'])) { ?>  <!-- Neu co anh dai dien (copy hoac sua) -->
                                            <img src="../<?= $book['image'] ?>" /><br/>
                                            <input type="hidden" name="image" value="<?= $book['image'] ?>" />
                                    <?php   } ?>
                                            
                                        </div>
                                        <input type="file" name="image" />      <!-- nut choosen file-->
                                    </div>
                                <div class="clear-both"></div>
                                </div>

                                
                                    <div class="wrap-field">
                                        <label class="label-style">Thư viện ảnh: </label>
                                        <div class="align-content" style="margin-left:35px; display: flex; align-items: center; gap: 20px">
                                        <div class="right-wrap-field">
                                            <!-- Neu ma co trong thu vien anh sp (copy or sua-->
                                                <?php if (!empty($book['gallery'])) { ?>
                                                <ul style="list-style:none; display:flex">
                                <?php foreach ($book['gallery'] as $image) { ?>
                                <!-- Duyet tung phan tu gallery trong book -->
                                                        <li style="width:80px;height: 120px; margin-right: 15px;">
                                                            <img  src="../<?= $image['path'] ?>"/>
                                                            <a href="book_library_delete.php?id=<?= $image['id'] ?>">Xóa</a>
                                                            <!-- Render ra tung phan tu va nut xoa -->
                                                        </li>
                                <?php } ?>
                                                </ul>
                                            <?php } ?>
                                    
                                <?php if (isset($_GET['task']) && !empty($book['gallery'])) { ?> <!-- trong TH copy (vi neu tham thi gallery la rong) -->
                                        <?php foreach ($book['gallery'] as $image) { ?>
                                            <input type="hidden" name="gallery_image[]" value="<?= $image['path'] ?>" />
                                        <?php } ?>
                                <?php } ?>

                                        
                                        </div>
                                        <input multiple="" type="file" name="gallery[]" />  <!-- Nut upload thu vien co okieu multiple -->
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                             
                        



                                <div class="content-wrap-field">
                                    <label class="label-style">Nội dung: </label>
                                    <textarea class="input-area" name="content" id="book-content" style="height: 300px;width: 610px;">
                                        <?= (!empty($book) ? $book['content'] : "") ?>
                                    </textarea>
                                    <div class="clear-both"></div>
                                </div>
                                <div class="button-container wrap-field">
                                    <input class=" save_form button"   type="submit" title="Lưu" value="Lưu" />
                                </div>
                        </form>
                    </div>
                    </div>
                    <div class="clear-both"></div>
              
                               

                               
                        </div>     <!-- end row  -->
                        
                       
                    </div><!-- end containẻ fluid -->
                
                </div>  <!-- end section__content section__content--p30-->
            </div>  <!-- end main content -->
        </div> <!-- end page container -->
    <!-- </div> -->

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
         
    <?php } ?>   <!-- end else -->

</body>

</html>
<!-- end document-->