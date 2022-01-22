<?php 
    include 'header.php' ;
    $book_id = $_GET['id'];
    // var_dump($book_id);

    if(isset($_POST['content']) && isset($_POST['tittle']) ){
        $tittle = $_POST['tittle'];
        $content = $_POST['content'];

        if(isset($_SESSION['current_user'] )){
            $book_id = $_GET['id'];
            $user_id = $currentUser['id'];
            // var_dump($book_id,$user_id,$tittle,$content);exit;
             $result = mysqli_query($con, "INSERT INTO `reviews` (`id`, `book_id`, `customer_id`, `rating`, `tittle` , `content`, `created_date`, `last_updated`)
             VALUES (NULL, '$book_id', '$user_id', NULL, '$tittle' ,'$content', NOW() , NOW() );");
        }
    }

    // lay ra thong tin sach
    $result = mysqli_query($con, "SELECT * FROM `books` WHERE `id` =  $book_id");
    $book = mysqli_fetch_assoc($result);
    // var_dump($book);exit;

    $imgLibrary = mysqli_query($con, "SELECT * FROM `books_library` WHERE `book_id` = ".$_GET['id']);    // ket noi voi thu vien anh
    $book['images'] = mysqli_fetch_all($imgLibrary, MYSQLI_ASSOC);   // lay ra nhieu anh gan cho book[images]   ( # voi book[image] )
    $row_id = $book['id'];

    // Lay ra the loai
    $result3 = mysqli_query($con, "SELECT books_genres.genres_id,genres.name
    FROM `books_genres` INNER JOIN `genres` ON books_genres.genres_id = genres.id
      WHERE `book_id` = " . $_GET['id']);  // lay du lieu tu bang books vs id = $_Get['id]
    //var_dump($result3);exit;
    
    // Lay ra tac gia
    $result2 = mysqli_query($con, "SELECT authors.name, books_authors.author_id
                                FROM `books_authors`  INNER JOIN `authors` ON books_authors.author_id = authors.id
                                WHERE `book_id` = " . $_GET['id'] );
    // Lay ra NXB
    $book_id = $_GET['id']; 
    // var_dump($book_id);exit; 
    $result4 = mysqli_query($con, "SELECT books_publishers.publisher_id,publishers.name,books_publishers.started_date
    FROM `books_publishers` INNER JOIN `publishers` ON books_publishers.publisher_id = publishers.id
      WHERE  `book_id` = $book_id AND started_date IN (SELECT MAX(started_date) FROM books_publishers WHERE `book_id` = $book_id AND started_date <= NOW() )");
    // var_dump($result4);exit;                                
?>   

        <link rel="stylesheet" href="./assets/css/book_detail.css">
        <link rel="stylesheet" href="./assets/js/book.js">

   


        <div class="container">
        <a href="javascript:window.history.go(-1)" class="fa fa-undo" style="font-size: 1.5rem; margin: 10px; text-decoration: none; color: #434343; ">  Quay lại</a>
        <hr>
            <div class="card">
            	<div class="row">
            		<aside class="col-sm-5 border-right">
                  <article class="gallery-wrap"> 
                    <div class="img-big-wrap" >
                      <a href="#"><img src="<?=$book['image']?>"></a>
                    </div> <!-- book - image // -->

                  <?php if(!empty($book['images'])){ ?>
                    <div class="img-small-wrap" style="margin-top:20px;">
                      <?php foreach($book['images'] as $img) { ?>
                        <div class="item-gallery"> <img src="<?=$img['path']?>" > </div>
                      <?php } ?>
                    </div> <!-- slider-nav.// -->
                  <?php } ?>  

                  </article> <!-- gallery-wrap .end// -->
            		</aside>

            		<aside class="col-sm-7">
                  <article class="card-body p-5">
            	      <h3 class="product-name"><?= $book['tittle']?></h3>
            
                    <p class="author-detail-wrap" style="margin-top:20px;"> 
                      <span class="category">Tác giả: </span> 
                      <span class="category-info  h3 "> 

                        <?php
                            $where2 ="";                     
                            while ($author = mysqli_fetch_array($result2)){ 
                                $author_id = $author['author_id'];
                                $where2 .= (!empty($where2))? " OR "."`author_id` = $author_id" : "`author_id` = $author_id"; // neu rong thi luu luon chuoi, neu ko thi them AND
                                ?>
                            <a class="category-info" href="book.php?author_id=<?= $author['author_id']?>" ><?= $author['name'].","?></a> 
                            <?php }
                            // var_dump($where3);exit;

                                $author_same = mysqli_query($con, "SELECT DISTINCT books_authors.book_id,books.*
                                  FROM `books_authors`  INNER JOIN `books` ON books_authors.book_id = books.id
                                                      WHERE (".$where2.")  
                                                    ORDER BY RAND()
                                                    LIMIT 8;  ");  
                            // var_dump($genres_same);exit;
                            ?>

                    	</span> 
                    </p> <!-- author-detail-wrap .// -->

                    <p class="publisher-detail-wrap"> 
                        <span class="category">Nhà xuất bản: </span> 
                    	<span class="category-info  h3 "> 
                            <?php while ($publisher = mysqli_fetch_array($result4)){ ?>
                                <a class="category-info" href="book.php?publisher_id=<?= $publisher['publisher_id']?>" ><?= $publisher['name']?></a> 
                            <?php } ?>
                    	</span> 
                    </p> <!-- publicsher-detail-wrap .// -->


                    <p class="price-detail-wrap"> 
                        <span class="category">Giá: </span> 
                    	<span class="category-info price h3 "> 
                    		<span class="num"><?= number_format($book['price']-$book['discount'] , 0, ",", ".") ?>VNĐ</span>
                            <span style="color:black;font-size: 1.2rem;text-decoration: line-through;"><?=number_format($book['price'], 0, ",", ".") ?>đ</span>
                    	</span> 
                    </p> <!-- price-detail-wrap .// -->

                    <p class="discount-detail-wrap"> 
                        <span class="category">Tiết kiệm: </span> 
                    	<span class="category-info price h5 "> 
                    		<span class="num"><?= number_format($book['discount'], 0, ",", ".") ?></span><span class="currency"> VNĐ</span><span>( <?=ceil( $book['discount']/$book['price']*100 )?>% )</span>
                    	</span> 
                    </p> <!-- discount-detail-wrap .// -->
                    
                    <p class="quantity-detail-wrap"> 
                        <span class="category">Tình trạng: </span> 

                        <?php if ($book['quantity'] > 0) { ?>
                        	<span class="category-info  h5 text-success"> Còn hàng</span>
                        <?php } else { ?> 
                          <span class="category-info  h5 text-warning"> Hết hàng</span>
                        <?php } ?>  
                        
                    </p> <!-- quantity-detail-wrap .// -->
                        
                    <?php 
                    
                            if (!empty($currentUser)) {
                                $bo_id = $_GET['id'];
                                $u_id = $currentUser['id'];
                                $error = false;
                            }   
                            
                            $exists = mysqli_query($con, "SELECT * FROM favorites WHERE book_id = '$bo_id' AND customer_id = '$u_id'"); 
                            $numrecord = mysqli_num_rows($exists);      //sô bản ghi tìm được ứng với book_id hiện tại
                            $exists = mysqli_fetch_array($exists);
                            if ($numrecord != 0){           //nếu bản ghi tồn tại -> đã yêu thích 
                                if (isset($_GET['action']) && $_GET['action'] == 'delfvr')      //thực hiện xóa 
                                {
                                    $result = mysqli_query($con, "DELETE FROM favorites WHERE book_id = $bo_id AND customer_id = $u_id");
                                    // <div> Hiện lại form yêu thích 
                                    if (isset($_GET['action']) && $_GET['action'] == 'addfvr') 
                                    {
                                        $result = mysqli_query($con, "INSERT INTO favorites(book_id, customer_id)
                                        VALUES ('$bo_id', '$u_id')");
                                    }else {
                                            $bo_id = $_GET['id'];
                                            $u_id = $currentUser['id'];
                                            ?>
                                            <form action="./book_detail.php?action=addfvr&id=<?=$bo_id?>" method="Post" enctype="multipart/form-data"autocomplete="off" id="registrationForm">
                                                    <input type="hidden" name="book_id" id="book_id" value="<?= $bo_id ?>" />
                                                    <input type="hidden" name="user_id" id="user_id" value="<?= $u_id?>" />
                                                <div class=" form-group" >
                                                    <div class=" col-xs-12">
                                                        <br>
                                                        <button class="btn-hidden" type="submit" name ="submit1" onclick="alert('Đã thêm vào yêu thích');">
                                                        <i class="heart-position fas fa-heart" style="color :white" ></i>  </button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php
                                    }
                                    // <div >Hiện lại form yêu thích                                     
                                }else {     //form để hủy yêu thích
                                        $bo_id = $_GET['id'];
                                        $u_id = $currentUser['id'];
                                        ?>
                                        <form action="./book_detail.php?action=delfvr&id=<?=$bo_id?>" method="Post" enctype="multipart/form-data"autocomplete="off" id="registrationForm">
                                                <input type="hidden" name="book_id" id="book_id" value="<?= $bo_id ?>" />
                                                <input type="hidden" name="user_id" id="user_id" value="<?= $u_id?>" />
                                            <div class=" form-group">
                                                <div class=" col-xs-12">
                                                    <br>
                                                    <button class="btn-hidden" type="submit" name ="submit1" onclick="alert('Đã hủy yêu thích');">
                                                    <i class="heart-position fas fa-heart" style="color :#f03e3e" ></i> </button>     <!-- hủy yêu thích -->
                                                </div>
                                            </div>
                                        </form>
                                    <?php
                                }                                
                            }else{      //nếu chưa yêu thích
                                if (isset($_GET['action']) && $_GET['action'] == 'addfvr') 
                                {
                                    $result = mysqli_query($con, "INSERT INTO favorites(book_id, customer_id)
                                    VALUES ('$bo_id', '$u_id')");
                                    if (isset($_GET['action']) && $_GET['action'] == 'delfvr')      //form hủy yêu thích
                                    {
                                        $result = mysqli_query($con, "DELETE FROM favorites WHERE book_id = $bo_id AND customer_id = $u_id");
                                        
                                    }else {     //form để hủy yêu thích
                                            $bo_id = $_GET['id'];
                                            $u_id = $currentUser['id'];
                                            ?>
                                            <form action="./book_detail.php?action=delfvr&id=<?=$bo_id?>" method="Post" enctype="multipart/form-data"autocomplete="off" id="registrationForm">
                                                    <input type="hidden" name="book_id" id="book_id" value="<?= $bo_id ?>" />
                                                    <input type="hidden" name="user_id" id="user_id" value="<?= $u_id?>" />
                                                <div class=" form-group">
                                                    <div class=" col-xs-12">
                                                        <br>
                                                        <button class="btn-hidden" type="submit" name ="submit1" onclick="alert('Đã hủy yêu thích');">
                                                        <i class="heart-position fas fa-heart" style="color : #f03e3e"></i> </button>      <!-- hủy yêu thích -->
                                                    </div>
                                                </div>
                                            </form>
                                        <?php
                                    } 
                                }else {
                                        $bo_id = $_GET['id'];
                                        $u_id = $currentUser['id'];
                                        ?>
                                        <form action="./book_detail.php?action=addfvr&id=<?=$bo_id?>" method="Post" enctype="multipart/form-data"autocomplete="off" id="registrationForm">
                                                <input type="hidden" name="book_id" id="book_id" value="<?= $bo_id ?>" />
                                                <input type="hidden" name="user_id" id="user_id" value="<?= $u_id?>" />
                                            <div class=" form-group">
                                                <div class=" col-xs-12">
                                                    <br>
                                                    <button class="btn-hidden" type="submit" name ="submit1" onclick="alert('Đã thêm vào yêu thích');">
                                                    <i class="heart-position fas fa-heart" style="color :white"></i> </button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php
                                }
                            }
                            ?>
                        

                    <dl class="item-property">
                        <h4 class="category">Giới thiệu tóm tắt tác phẩm:</h4>
                        <dd>
                            <p class="overview-content"> <?= $book['content'] ?> </p>
                        </dd>
                    </dl>

                    <dl class="param param-feature">
                      <h4 class="category">Tags:</h4>
                            <div class="grid-3-col">
                            <?php
                            
                            $where3 =""; 
                                                
                            while ($genres = mysqli_fetch_array($result3)){ 
                                $genres_id = $genres['genres_id'];
                                $where3 .= (!empty($where3))? " OR "."`genres_id` = $genres_id" : "`genres_id` = $genres_id"; // neu rong thi luu luon chuoi, neu ko thi them AND
                                ?>
                            <a href="book.php?genres_id=<?= $genres['genres_id']?>" ><h4 class="tag-content"><?= $genres['name'] ?> </h4></a> 
                            <?php }
                            
                            // var_dump($where3);exit;

                                $genres_same = mysqli_query($con, "SELECT DISTINCT books_genres.book_id,books.*
                                  FROM `books_genres`  INNER JOIN `books` ON books_genres.book_id = books.id
                                                      WHERE (".$where3.")  
                                                    ORDER BY RAND()
                                                    LIMIT 8;  ");  
                            // var_dump($genres_same);exit;
                            ?>
                            </div>
                    </dl>  <!-- item-property-hor .// -->

                    <hr>
            	      <div class="row">
            	      	<div class="col-sm-6">
                      <?php if ($book['quantity'] > 0) { ?>
                            <div class="amount-selection-container">
            	      		  <p class="category delete-margin">Số lượng:</p>
                            <form id="add-to-cart-form" action="cart.php?action=add&id=<?=$book['id']?>" method="POST">
                                <div class="category row" ><input class="number-select" type="number" value="1" name="quantity[<?=$book['id']?>]" size="2" /></div> 
                                </div>

                                <div class="button-container">
                                    <input class="buy-button btn btn-lg text-uppercase" type="submit" value="Mua ngay"  />                       
                                </div>
                            </form>  <!-- item-property .// -->
                            <button data-id="<?=$book['id']?>" class="btn-add-to-cart btn btn-lg btn-outline-primary text-uppercase" style="background-color:#f59f00;color:#fff">
                             <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng </button>
                            
                            
                      <?php } else { ?>
                          <span class="h5 text-warning">Sản phẩm hiện chưa có hàng</span>
                      <?php } ?>
            	      	</div> <!-- col.// -->

            		      
            	      </div> <!-- row.// -->
            	      

                  </article> <!-- card-body.// -->
            		</aside> <!-- col.// -->
            	</div> <!-- row.// -->
            </div> <!-- card.// -->  
            
            <!-- COMMENT FORM -->
            <div class="review_card">
              <div class="row justify-content-left d-flex">
                    <h2>COMMENT  : </h2>
                    <form method="post">
                        <textarea class="form-control" name="tittle" rows="1" placeholder="Tiêu đề" style="width: 800px;"></textarea>                            
                        <textarea class="form-control" name="content" rows="5" placeholder="Nội dung" style="width: 800px;"></textarea>                            
                        <input type="submit" class="comment-button" onclick="alert('Bình luận đã được gửi');">
                    </form>
              </div><!-- end COMMENT FORM -->
            </div>  



        <?php
        $comments = mysqli_query($con, "SELECT customers.first_name, customers.last_name, customers.avatar, reviews.* 
        FROM reviews
        INNER JOIN books ON reviews.book_id = books.id
        INNER JOIN customers ON reviews.customer_id = customers.id
        WHERE book_id = $row_id ");
        // $comments = mysqli_fetch_all($comments, MYSQLI_ASSOC);
            // var_dump($comments);exit;                      
        ?>

        <?php  while ($row_comment = mysqli_fetch_array($comments) ){  
            // var_dump($row_comment);exit;                      
        ?>
            <!-- USER COMMENT ROW -->
            <div class="review_card">
                <div class="row d-flex">
                    <div class=""> <img class="profile-pic" src="./<?=  isset($row_comment['avatar']) ? $row_comment['avatar'] : "assets/image/user/user.png"?>" alt="" style="width: 40px;height:40px;border-radius: 100%;"> </div>
                    <div class="d-flex flex-column">
                        <h3 class="mt-2 mb-0"> <?= $row_comment['first_name']." ".$row_comment['last_name'] ?> </h3>
                    </div>
                    <div class="ml-auto">
                        <p class="text-muted pt-5 pt-sm-3"> <?= $row_comment['created_date'] ?> </p>
                    </div>
                </div>
                <div class="row text-left">
                    <h4 class="blue-text mt-3"> <?= $row_comment['tittle'] ?></h4> 
                </div>
                <div class="row text-left">
                    <p class="content"> <?= $row_comment['content'] ?></p> </p>
                </div>
                <!-- <div class="row text-left"> <img class="pic" src="https://i.imgur.com/kjcZcfv.jpg"> <img class="pic" src="https://i.imgur.com/SjBwAgs.jpg"> <img class="pic" src="https://i.imgur.com/IgHpsBh.jpg"> </div> -->
            </div><!-- end review card -->
        <?php } ?>


        </div>
        <!--container.//-->

        
    <!-- featured section starts  -->
    <section class="featured" id="featured">
    
        <h1 class="heading"> <span>Sách cùng thể loại</span> </h1>
    
        <div class="swiper featured-slider">
    
            <div class="swiper-wrapper">
    
            <?php while ($row_genres = mysqli_fetch_array($genres_same)) {?>
                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fas fa-search"></a>
                        <a href="#" class="fas fa-heart"></a>
                        <a href="book_detail.php?id=<?= $row_genres['id'] ?>" class="fas fa-eye"></a>
                    </div>
                    <div class="image">
                        <a href="book_detail.php?id=<?= $row_genres['id'] ?>"><img src="./<?= $row_genres['image'] ?>" alt="<?= $row_genres['tittle'] ?>" alt=""></a>
                    </div>
                    <div class="content">
                        <h3><?= $row_genres['tittle'] ?></h3>
                        <div class="price"><?= number_format($row_genres['price']-$row_genres['discount'], 0, ",", ".") ?>đ <span> <?= number_format($row_genres['price'], 0, ",", ".") ?></span></div>
                        <button data-id="<?=$row_genres['id']?>" class="btn-add-to-cart btn btn-lg btn-outline-primary text-uppercase" style="background-color:#f59f00;color:#fff">
                             <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng </button>
                    </div>
                </div>
            <?php } ?>
    
               
    
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
    <!-- featured section ends -->        

    <!-- featured section starts  -->
    <section class="featured" id="featured">
    
        <h1 class="heading"> <span>Sách cùng tác giả</span> </h1>
    
        <div class="swiper featured-slider">
    
            <div class="swiper-wrapper">

            <?php while ($row_author = mysqli_fetch_array($author_same)) {?>
                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fas fa-search"></a>
                        <a href="#" class="fas fa-heart"></a>
                        <a href="book_detail.php?id=<?= $row_author['id'] ?>" class="fas fa-eye"></a>
                    </div>
                    <div class="image">
                        <a href="book_detail.php?id=<?= $row_author['id'] ?>"><img src="./<?= $row_author['image'] ?>" alt="<?= $row_author['tittle'] ?>" alt=""></a>
                    </div>
                    <div class="content">
                        <h3><?= $row_author['tittle'] ?></h3>
                        <div class="price"><?= number_format($row_author['price']-$row_author['discount'], 0, ",", ".") ?>đ <span> <?= number_format($row_author['price'], 0, ",", ".") ?></span></div>
                        <button data-id="<?=$row_author['id']?>" class="btn-add-to-cart btn btn-lg btn-outline-primary text-uppercase" style="background-color:#f59f00;color:#fff">
                             <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng </button>
                    </div>
                </div>
            <?php } ?>
        
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>


            
  </body>
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script></body>
  <!-- <script src="./vendor/jquery/jquery.min.js"></script>
  <script src="./vendor/jquery/jquery.slim.min.js"></script>
  <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
  <script type='text/javascript' src=''></script>
  <script type='text/javascript' src=''></script> -->


  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    
    <!-- custom js file link  -->
  <script src="./assets/js/main.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-add-to-cart").click(function(event) {
                let id = $(this).data("id");
                // alert('Da bam san pham' + id);
                <?php $total_quantity+=1; ?>
                $.ajax({
                    url: "cart.php",
                    type: "GET",
                    // dataType: "dataType",
                    data: {action: "add",id: id},
                  })
                .done(function() {
                    console.log("success");
                    alert("Đã thêm sản phẩm vào giỏ hàng!");
                    document.getElementById("quantity").innerHTML = "<?=$total_quantity?>";
                })
                .fail(function() {
                    console.log("error");
                    alert("Đã xảy ra lỗi!");
                });

            });

        });

    </script>
<style>
     * {
            padding: 0;
            margin: 0;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            box-sizing: border-box;
            
        }
    .product-name {
        font-size: 3rem;
        margin-bottom: 4rem;
    }
    .category {
        font-size: 1.7rem;
        font-weight: 400;
    }
    .overview-content {
        font-size: 1.2rem;
        font-weight: 350;
    }
    .buy-button {
                height: 40px;
                width: 120px;
                font-size: 14px;
                font-weight: 600;
                background-color: #27ae60;
                color: #fff;
                text-decoration: none;
                cursor: pointer;
                
                border: 0;
                padding: 5px 10px;
                letter-spacing: 0.3px;
            }

    .buy-button:hover {
        background-color: #219150;
    }

    .category-info {
        font-size: 1.7rem;
        color: #000;
        font-weight: 600;
    }

    .amount-selection-container {
        
        display: flex;
        gap: 3rem;
        align-items: center;
        
        margin-bottom: 4rem;
    }

    .number-select {
        border: 0.3px solid;
        text-align: center;
        width: 100px;
    }

    .delete-margin {
        margin: 0;
    }

    .cart-button {
        height: 40px;
        width: 240px;
        font-size: 14px;
        font-weight: 600;
        background-color: #f59f00;
        color: #fff;
        text-decoration: none;
        cursor: pointer;
        
        border: 0;
        padding: 5px 10px;
        letter-spacing: 0.3px;
        display: flex;
        justify-content:center;
        align-items: center;
    }

    .cart-button:hover {
        background-color: #f08c00;
    }
    .button-container {
        gap: 1rem;
        display: flex; 
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .heart-position {
        
        font-size: 3rem;
        -webkit-text-stroke-width: 2px;
        -webkit-text-stroke-color: #f03e3e;
        

    }

    .col-sm-7 {
        position: relative;
    }

    .btn-hidden {
        position: absolute;
        
        top: 20px;
        right: 40px;
        padding: 0;
        border: none;
        display: inline;
        background: #fff;
        
    }
    button:focus {
        outline: none;
    }
    .btn-hidden:hover, .btn-hidden:active {
        background: #fff;
        border: none;
        cursor: pointer;
    }
    .form-group {
        height: 0; 
        margin-bottom: 0;
    }

    .price {
        color: #f03e3e;
        font-weight: 700;
    }

    .grid-3-col {
        margin-top: 1rem;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
    }

    .add-cart-button {
        background-color: #27ae60;
        padding: 5px 10px;
        letter-spacing: 0.3px;
        color: #fff;
        cursor: pointer;
        border-radius: 3px;
        margin-top: 10px;
        text-transform: uppercase;
        font-weight: 500;
        font-size: 17px;
        letter-spacing: 0.3px;
    }

    .add-cart-button:hover {
        background-color: #219150;
    }

    .form-control {
        margin-bottom: 10px;
        margin-left: 5px;
        font-size: 1.5rem;
    }

    .comment-button {
        background-color: #27ae60;
        padding: 5px 12px;
        letter-spacing: 0.3px;
        color: #fff;
        cursor: pointer;
        border-radius: 3px;
        margin-top: 5px;
        letter-spacing: 0.3px;
        font-weight: 500;
        font-size: 15px;
        margin-left: 5px;
    }
</style>
</html>