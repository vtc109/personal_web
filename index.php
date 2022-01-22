<?php 
    include 'header.php';
    $rate = 25;

    //  Chon ra ngau nhien 9sp co giam gia > x%
    $result1 = mysqli_query($con, "SELECT books.image,books.id
    FROM `books`
    WHERE  (discount / price) >= ($rate / 100) 
    ORDER BY RAND()
    LIMIT 9;");
    // var_dump($result1);exit;

    // Chon ra 9 san pham ban chay nhat
    $result2 = mysqli_query($con, " SELECT SUM(orders_details.quantity)AS sum_qty , books.id,books.tittle,books.image,books.price,books.discount
    FROM orders_details INNER JOIN books ON books.id = orders_details.book_id
    GROUP BY book_id
    ORDER BY sum_qty DESC
    LIMIT 9 ");
    // var_dump($result2);exit;

    // Chon ra san pham moi nhat trong thang
    $result3 = mysqli_query($con, "SELECT * FROM books
    WHERE MONTH(created_date) = MONTH(NOW())");

    // Chon ra sp moi ra trong tuan nay
    $result4 = mysqli_query($con, "SELECT * FROM books
    WHERE MONTH(created_date) = MONTH(NOW())
    ORDER BY RAND()
    LIMIT 9");

?>

    <!-- home section starts  -->
    
    <section class="home" id="home">
    
        <div class="row">
    
            <div class="content">
                <h3><b>Giảm giá tới <?= $rate ?>% </b></h3>
                <a href="book.php" class="button">Mua ngay</a>
            </div>

            <div class="swiper books-slider">
                <div class="swiper-wrapper">
                    <?php while ($book1 =  mysqli_fetch_array($result1) ){?>
                        <a href="book_detail.php?id=<?=$book1['id']?>" class="swiper-slide"><img src="<?=$book1['image']?>" alt="" style="margin-bottom: 14px;"></a>
                    <?php } ?>
                </div>
                <img src="./assets/image/stand.png" class="stand" alt="">
            </div>

        </div>  

    </section>
    <!-- home section end  -->
    

    <!-- icons section starts  -->
    <section class="icons-container">
        <div class="icons">
            <i class="fas fa-shipping-fast"></i>
            <div class="content">
                <h3>free shipping</h3>
                <p>Với đơn lớn hơn 200k</p>
            </div>
        </div>
    
        <div class="icons">
            <i class="fas fa-lock"></i>
            <div class="content">
                <h3>Giao dịch an toàn</h3>
                <p>100% an toàn</p>
            </div>
        </div>
    
        <div class="icons">
            <i class="fas fa-redo-alt"></i>
            <div class="content">
                <h3>Hoàn tiền 100%</h3>
                <p>Trong vòng 10 ngày</p>
            </div>
        </div>
    
        <div class="icons">
            <i class="fas fa-headset"></i>
            <div class="content">
                <h3>Hỗ trợ 24/7</h3>
                <p>Trừ ngày lễ Tết</p>
            </div>
        </div>
    </section>
    <!-- icons section ends -->


    <!-- featured section starts  -->
    <section class="featured" id="featured">
    
        <h1 class="heading"> <span>Sách nổi bật</span> </h1>
    
        <div class="swiper featured-slider">
    
            <div class="swiper-wrapper">
                <?php while( $book2 = mysqli_fetch_array($result2) ){ ?>    
                    <div class="swiper-slide box">
                        <div class="icons">
                            <button data-id="<?=$book2['id']?>" class="btn-add-to-cart" style="background-color:var(--white)">
                             <i class="fas fa-shopping-cart"></i></button>
                            <a href="#" class="fas fa-heart"></a>
                            <a href="book_detail.php?id=<?= $book2['id'] ?>" class="fas fa-eye"></a>
                        </div>
                        <div class="image">
                            <a href="book_detail.php?id=<?= $book2['id'] ?>"><img src="./<?= $book2['image'] ?>" alt="<?= $book2['tittle'] ?>"></a>
                        </div>
                        <div class="content">
                            <h3><?= $book2['tittle'] ?></h3>
                            <div class="price"><?= number_format($book2['price']-$book2['discount'], 0, ",", ".") ?>đ <span><?= number_format($book2['price'], 0, ",", ".") ?>đ</span></div>

                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
    <!-- featured section ends -->


    <!-- newsletter section starts -->
    <!-- <section class="newsletter">
        <form action="">
            <h3>subscribe for latest updates</h3>
            <input type="email" name="" placeholder="enter your email" id="" class="box">
            <input type="submit" value="subscribe" class="button">
        </form>
    </section> -->
    <!-- newsletter section ends -->


    <!-- arrivals section starts  -->
    <section class="arrivals" id="arrivals">
        <h1 class="heading"> <span>Sách mới</span> </h1>
    
        <div class="swiper arrivals-slider">
            <a href="book.php">Tất cả sách mới <i class="fa fa-angle-right"></i></a>
            
            <br><span>Sách mới ra trong tháng này</span>
            <div class="swiper-wrapper">
                <?php while ($book3 = mysqli_fetch_array($result3)){ ?>    
                    <div class="swiper-slide box">
                        <div class="image">
                            <a href="book_detail.php?id=<?= $book3['id']?>"><img src="./<?= $book3['image']?>" alt="<?= $book3['tittle']?>"></a>
                        </div>
                        <div class="content">
                            <h3><?= $book3['tittle']?></h3>
                            <div class="price"><?= number_format($book3['price']-$book3['discount'], 0, ",", ".")?>đ <span><?= number_format($book3['price'], 0, ",", ".") ?>đ</span></div>
                            <br>
                            <button data-id="<?=$book3['id']?>" class="btn-add-to-cart btn btn-lg btn-outline-primary text-uppercase" style="background-color:#f59f00;color:#fff">
                             <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng </button>
                        </div>
                    </div>
                <?php } ?>
            </div>
    
        </div>
    
       
               
    </section>
    <!-- arrivals section ends -->



    <!-- deal section starts  -->
    <!-- <section class="deal">
    
        <div class="content">
            <h3>deal of the day</h3>
            <h1>upto 50% off</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde perspiciatis in atque dolore tempora quaerat at fuga dolorum natus velit.</p>
            <a href="#" class="button">shop now</a>
        </div>
    
        <div class="image">
            <img src="./assets/image/deal-img.jpg" alt="">
        </div>
    
    </section> -->
    <!-- deal section ends -->



    <!-- reviews section starts  -->
    <section class="reviews" id="reviews">
        <h1 class="heading"> <span>Review của khách hàng</span> </h1>
        <a href="reviews.php">Tất cả review  <i class="fa fa-angle-right"></i></a>
        
        <div class="swiper reviews-slider">
    
            <div class="swiper-wrapper">
    
                <div class="swiper-slide box">
                    <img src="./assets/image/pic-1.png" alt="">
                    <h3>Noobmaster69</h3>
                    <p>Mình thích cách sắp xếp ở đây, tầng 1 có khá nhiều sácht, nên ai muốn tìm những thể loại mình thích thì có thể tham khảo. Riêng mình thì mình thích tầng trên cùng, có nhiều cuốn sách kén người đọc vì to và nặng. Có các thể loại nhân chủng, chính trị, xã hội. Điểm cộng lớn nhất ở đây là cách sắp xếp sách.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
    
                <div class="swiper-slide box">
                    <img src="./assets/image/pic-2.png" alt="">
                    <h3>Dan Hauer</h3>
                    <p>Mình thích không khí của tiệm này, nằm một mình, không chen chúc với các tiệm sách cũ khác. Nên tránh được cảm giác “lựa hàng” khi đi mua sách. Đại loại là không ưng ở đây thì ghé qua chỗ khác… Bác chủ thoải mái, sách chuyên môn cũng có nhiều. Nếu có dịp đi đường sách cũ thì sau mình sẽ làm thêm review.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
    
                <div class="swiper-slide box">
                    <img src="./assets/image/pic-3.png" alt="">
                    <h3>John Wick</h3>
                    <p>Hiệu sách dành cho người đi làm là đây. Tầng 1 chọn sách, tầng 2 tha hồ chọn văn phòng phẩm, bút, sổ tay, giá phải chăng hơn các tiệm văn phòng phẩm khác. Nói chung là cách sắp xếp không gian sách ở tầng 1 khá là hiện đại, phù hợp cho người lớn tới lựa sách, chỗ gửi xe rộng, các đồ dùng văn phòng ở đây cũng nhiều.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <img src="./assets/image/pic-4.png" alt="">
                    <h3>Justin Bieber</h3>
                    <p>Hiệu sách dành cho người đi làm là đây. Tầng 1 chọn sách, tầng 2 tha hồ chọn văn phòng phẩm, bút, sổ tay, giá phải chăng hơn các tiệm văn phòng phẩm khác. Nói chung là cách sắp xếp không gian sách ở tầng 1 khá là hiện đại, phù hợp cho người lớn tới lựa sách, chỗ gửi xe rộng, các đồ dùng văn phòng ở đây cũng nhiều.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
    
                <div class="swiper-slide box">
                    <img src="./assets/image/pic-5.png" alt="">
                    <h3>Amber Heard</h3>
                    <p>Hiệu sách dành cho người đi làm là đây. Tầng 1 chọn sách, tầng 2 tha hồ chọn văn phòng phẩm, bút, sổ tay, giá phải chăng hơn các tiệm văn phòng phẩm khác. Nói chung là cách sắp xếp không gian sách ở tầng 1 khá là hiện đại, phù hợp cho người lớn tới lựa sách, chỗ gửi xe rộng, các đồ dùng văn phòng ở đây cũng nhiều.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
    
                <div class="swiper-slide box">
                    <img src="./assets/image/pic-6.png" alt="">
                    <h3>Johnny Depp</h3>
                    <p>Mình thích không khí của tiệm này, nằm một mình, không chen chúc với các tiệm sách cũ khác. Nên tránh được cảm giác “lựa hàng” khi đi mua sách. Đại loại là không ưng ở đây thì ghé qua chỗ khác… Bác chủ thoải mái, sách chuyên môn cũng có nhiều. Nếu có dịp đi đường sách cũ thì sau mình sẽ làm thêm review.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
    
            </div>
    
        </div>
        
    </section>
    <!-- reviews section ends -->



    <!-- blogs section starts  -->
    <!-- <section class="blogs" id="blogs">
    
        <h1 class="heading"> <span>our blogs</span> </h1>
        <a class="link_blogs" href="blogs.php">view all blogs <i class="fa fa-angle-right"></i></a>
        
        <div class="swiper blogs-slider">
    
            <div class="swiper-wrapper">
    
                <div class="swiper-slide box">
                    <div class="image">
                        <img src="./assets/image/blog-1.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>blog title goes here</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, odio.</p>
                        <a href="#" class="button">read more</a>
                    </div>
                </div>
    
                <div class="swiper-slide box">
                    <div class="image">
                        <img src="./assets/image/blog-2.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>blog title goes here</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, odio.</p>
                        <a href="#" class="button">read more</a>
                    </div>
                </div>
    
                <div class="swiper-slide box">
                    <div class="image">
                        <img src="./assets/image/blog-3.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>blog title goes here</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, odio.</p>
                        <a href="#" class="button">read more</a>
                    </div>
                </div>
    
                <div class="swiper-slide box">
                    <div class="image">
                        <img src="./assets/image/blog-4.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>blog title goes here</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, odio.</p>
                        <a href="#" class="button">read more</a>
                    </div>
                </div>
    
                <div class="swiper-slide box">
                    <div class="image">
                        <img src="./assets/image/blog-5.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>blog title goes here</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, odio.</p>
                        <a href="#" class="button">read more</a>
                    </div>
                </div>
    
            </div>
    
        </div>
    
    </section> -->
    <!-- blogs section ends -->



    <!-- footer section starts  -->
    <!-- <section class="footer">
    
        <div class="box-container">
    
            <div class="box">
                <h3>our locations</h3>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> india </a>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> USA </a>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> russia </a>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> france </a>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> japan </a>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> africa </a>
            </div>
    
            <div class="box">
                <h3>quick links</h3>
                <a href="#"> <i class="fas fa-arrow-right"></i> home </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> featured </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> arrivals </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> reviews </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> blogs </a>
            </div>
    
            <div class="box">
                <h3>extra links</h3>
                <a href="#"> <i class="fas fa-arrow-right"></i> account info </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> ordered items </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> privacy policy </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> payment method </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> our serivces </a>
            </div>
    
            <div class="box">
                <h3>contact info</h3>
                <a href="#"> <i class="fas fa-phone"></i> +123-456-7890 </a>
                <a href="#"> <i class="fas fa-phone"></i> +111-222-3333 </a>
                <a href="#"> <i class="fas fa-envelope"></i> shaikhanas@gmail.com </a>
                <img src="./assets/image/worldmap.png" class="map" alt="">
            </div>
            
        </div>
    
        <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
            <a href="#" class="fab fa-pinterest"></a>
        </div>
    
    </section> -->
    <!-- footer section ends -->

    
    <!-- loader  -->
    <div class="loader-container">
        <img src="./assets/image/loader-img.gif" alt="">
    </div>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    
    <!-- custom js file link  -->
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/header.js"></script>

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


</body>
<style>
     * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
  
}
</style>
</html>