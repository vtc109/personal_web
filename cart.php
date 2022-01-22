<?php 
    include 'header.php' ;
    $currentUser_id = $currentUser['id'];
    // var_dump($currentUser_id);exit;
    $user = mysqli_query($con, "SELECT * FROM customers where `id` = $currentUser_id ");

    $user_spent = mysqli_query($con, "SELECT * FROM customers where `id` = $currentUser_id ");
    $user_spent = mysqli_fetch_assoc($user_spent);
?>   

        <link rel="stylesheet" href="./assets/css/cart.css">
        
        <?php
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();    // khoi tao SESSION["cart"] = 1 array rong neu chua co
        }
        
        $GLOBALS['changed_cart'] = false;   // bien de check so luong sp khach nhap : true-quantity lon qua, false- quantity <d so luong trong kho
        $error = false;
        $success = false;
        $total_quantity = 0;


//NEU TON TAI ACTION get duoc        
        if (isset($_GET['action'] )) {

            // var_dump($_GET);exit;
            if( isset($_GET['id'] )){
                $book_id = $_GET["id"];
            }
            if( empty($_POST) ){
                $_POST['quantity'][$book_id] = 1;
            }
            // var_dump($_POST);exit;            
            // ham xu ly cong them san pham khi add hoac chi cap nhat lai sp    
            // $add : true-neu la them thi phai += quantity  false-neu chi cap nhat thi gan =
            function update_cart($con,$add ) {  
                foreach ($_POST['quantity'] as $id => $quantity) {
                    //trong bien POST['quantity'] co id:$book['id'] value: quantity[<?=$book['id']?]
                    if ($quantity <= 0) {   // neu so luong = 0 thi khong luu phien cua sp nua
                        unset($_SESSION["cart"][$id]);
                    } else {
                        if (!isset($_SESSION["cart"][$id])) {
                            $_SESSION["cart"][$id] = 0;
                        }
                        // var_dump($_SESSION["cart"][$id]);exit;


                        if ($add) { // neu la add=true thi phai += quantity
                            $_SESSION["cart"][$id] += $quantity;
                        } else {    // neu chi cap nhat thi gan =
                            $_SESSION["cart"][$id] = $quantity;
                            }

                        //Kiểm tra số lượng sản phẩm tồn kho
                        $addbook = mysqli_query($con, "SELECT `quantity` FROM `books` WHERE `id` = " . $id);
                        $addbook = mysqli_fetch_assoc($addbook);
                        if ($_SESSION["cart"][$id] > $addbook['quantity']) {
                            $_SESSION["cart"][$id] = $addbook['quantity'];
                            $GLOBALS['changed_cart'] = true;
                            }
                        
                        }// end else                   
                }   //end foreach
            }// end function

            switch ($_GET['action']) {
                case "add":
                    update_cart($con,true);  // vi la add nen truyen vao true cho $add
                    if ($GLOBALS['changed_cart'] == false) {
                    // header('Location: ./cart.php');
                    }
                    break;

                case "delete":
                    if (isset($_GET['id'])) {
                        unset($_SESSION["cart"][$_GET['id']]);
                    }
                    // header('Location: ./cart.php');
                    break;

                case "submit":
                    $soluong = 0;
                    $soam = 0;
                    if (isset($_POST['update_click'])) { //Cập nhật số lượng sản phẩm, update_click chinh la key
                        update_cart($con,false);    // Vi la update nen truyen vao false cho $add
                        // header('Location: ./cart.php');
                    } elseif ($_POST['order_click']) { //Đặt hàng sản phẩm
                       if (empty($_POST['fullname'])) {
                            $error = "Bạn chưa nhập tên của người nhận";
                        } elseif (empty($_POST['phone'])) {
                            $error = "Bạn chưa nhập số điện thoại người nhận";
                        } elseif (empty($_POST['address'])) {
                            $error = "Bạn chưa nhập địa chỉ người nhận";
                        } elseif (empty($_POST['quantity'])) {
                            $error = "Giỏ hàng rỗng";
                        }
                        // Ham xu ly luu gio hang database
                        if ($error == false && !empty($_POST['quantity']) && ($_POST['quantity'] > 0)) {    // chi xu ly dat hang khi khong co loi va co san pham trong gio
                            // var_dump( $_POST);exit;
                            $books = mysqli_query($con, "SELECT * FROM `books` WHERE `id` IN (" . implode(",", array_keys($_POST['quantity'])) . ")");
                            $total = 0;
                            $orderbooks = array();
                            $updateString = ""; // string de update so luong vao mang books


                            
                           // BANG ORDER
                            while ($row = mysqli_fetch_array($books)) {//gan row = tung phan tu cua books
                                $orderbooks[] = $row;// gan tung phan tu cua orderbook vs row de tranh viec row bi xoa di
                                if ($_POST['quantity'][$row['id']] > $row['quantity']) {    // neu quantity gui len lon hon quantity trong bang book
                                    $_POST['quantity'][$row['id']] = $row['quantity'];
                                    $soluong ++;
                                    $GLOBALS['changed_cart'] = true;    // So luong hang khach mua lon hon hang ton kho
                                }else if ($_POST['quantity'][$row['id']] <= 0){
                                    $_POST['quantity'][$row['id']] = 1;
                                    $GLOBALS['changed_cart'] = true;
                                    $soam ++;
                                }else {    // neu so luong nhap dung
                                    $total += ($row['price']-$row['discount']) * $_POST['quantity'][$row['id']];
                                    $updateString .= " when id = ".$row['id']." then quantity - ".$_POST['quantity'][$row['id']];
                                    // vd:   when id = 3 then quantity - 50 when id = 7 then quantity - 20
                                }                                
                            }   // end while
                            // var_dump($updateString);exit;

                            if ($GLOBALS['changed_cart'] == false) {    //neu ma nhap dung so luong
                            //sd ham : update a set b CASE when id= when id = 3 then quantity - 50 when id = 7 then quantity - 20 END
                            //            where id=..
                           $updateQuantity = mysqli_query($con, "update `books` set quantity = CASE".$updateString." END where id in (".implode(",", array_keys($_POST['quantity'])).")");
                            $insertOrder = mysqli_query($con,
                             "INSERT INTO `orders` (`id`, `customer_id` , `fullname`, `phone`, `address`, `note`, `total`, `created_date`, `last_updated`) 
                            VALUES (NULL, '" . $currentUser_id . "' , '" . $_POST['fullname'] . "', '" . $_POST['phone'] . "', '" . $_POST['address'] . "',
                             '" . $_POST['note'] . "', '" . $total . "', NOW() , NOW() );");
                            // var_dump($insertOrder);exit;
                            $orderID = $con->insert_id;
                            $insertString = ""; // viet gon lai string de insert vao
                           
                            // tinh tong so tien da tieu cua user
                            $user_spent['money_spent'] += $total;
                            $money_spent = $user_spent['money_spent'];
                            $updateSpend = mysqli_query($con, "UPDATE customers SET money_spent = $money_spent WHERE id = $currentUser_id");

                            // BANG ORDER_DETAIL
                            foreach ($orderbooks as $key => $book) {
                                $insertString .= "(NULL, '" . $orderID . "', '" . $book['id'] . "', '" . $_POST['quantity'][$book['id']] . "', '" . $book['price'] . "', '" . $book['discount'] . "' , '" . $book['import_price'] . "' )";
                                if ($key != count($orderbooks) - 1) {    // thi key= thang cuoi cung thi ko can dau , nua
                                    $insertString .= ",";   
                                }
                            }
                            $insertOrder = mysqli_query($con, "INSERT INTO `orders_details` (`id`, `order_id`, `book_id`, `quantity`, `price`, `discount` , `import_price`) VALUES " . $insertString . ";");
                            // var_dump($insertString);exit;
                            $success = "Đặt hàng thành công";
                            unset($_SESSION['cart']);   // xoa phien gio hang vua nap len csdl di

                            }   // END if ($GLOBALS['changed_cart'] == false)

                        }   // end if($error == false && !empty($_POST['quantity']))

                       
                    }   //end elseif ($_POST['order_click'])
                    break;
            
                } // end switch    
            }   // end if (isset($_GET['action'])) {
    
// NEU TON TAI phien gio hang thi lay du lieu gio hang tu SESSION ra        
        if (!empty($_SESSION["cart"])) {
            // su dung ham implode( a, b) => a la cai de noi giua cac thanh phan, array_keys de lay ra cac key cua SESSION["cart"]
            //var_dump(implode(",", array_keys($_SESSION["cart"])));exit;
            //$books = mysqli_query($con, "SELECT * FROM `book` WHERE `id` IN (7,8,5)");
            $books = mysqli_query($con, "SELECT * FROM `books` WHERE `id` IN ( ".implode(",", array_keys($_SESSION["cart"]))." )");  
        }
            //  $result = mysqli_query($con, "SELECT * FROM `book` WHERE `id` = ".$_GET['id']);
            //  $book = mysqli_fetch_assoc($result);
            //  $imgLibrary = mysqli_query($con, "SELECT * FROM `image_library` WHERE `book_id` = ".$_GET['id']);
            //  $book['images'] = mysqli_fetch_all($imgLibrary, MYSQLI_ASSOC);
        ?>

    
<!-- NEU KHONG GET DUOC DU LIEU THI => LOT VAO HAM DE POST LEN -->        
        <div class="container">
        <!-- KIEM TRA DIEU KIEN -->
            <?php if (!empty($error)) { ?> 
                <div class="content-container">
                    <div class="content-container" id="notify-msg">
                        <?= $error ?>. <a href="cart.php">Quay lại</a>
                    </div>
                </div>
            <?php } elseif (!empty($success)) { ?>
                <div class="content-container">
                    <div class="box-content" id="notify-msg">
                        <?= $success ?>. <a href="book.php">Tiếp tục mua hàng</a>
                    </div>
                </div>
            <?php } else { ?>
        <div class="back-to-shop"><a href="book.php" class="fa fa-undo" style="padding: 5px; margin-bottom: 10px;">  Quay lại Cửa hàng</a></div>
        <?php 
            if ($GLOBALS['changed_cart'] && $soluong!=0) { ?>  <!-- Check nhap qua quantity neu la true: so luong khach nhap lon qua-->  
                <div class="content-container">
                    <div class="box-content"> 
                    <h3>Số lượng sản phẩm tồn kho không đủ. Vui lòng <a href="javascript:window.history.go(-1)">tải lại</a> giỏ hàng</h3>
                    </div>
                </div>
            <?php 
            }else if ($GLOBALS['changed_cart'] && $soam!=0) { ?>
            <div class="content-container">
                <div class="box-content">
                <h3>Số lượng sản phẩm đã âm. Vui lòng <a href="javascript:window.history.go(-2)">tải lại</a> giỏ hàng</h3>
                </div>
            </div>
            <?php
            }else { 
            ?>

        <form id="cart-form" action="cart.php?action=submit" method="POST">
            <div class="card">
                <div class="row">
                    <div class="col-md-11 cart" style="margin:auto">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h2><b>GIỎ HÀNG</b></h2>
                                </div>
                                    <div class="col align-self-center text-right text-muted">
                                        <?php
                                             foreach ($_SESSION["cart"] as $id => $quantity) {
                                                $total_quantity += $quantity;
                                            }
                                        ?>
                                        <h4>Tổng số lượng: <?= $total_quantity ?></h4>
                                    </div>

                            </div>
                        </div>
                        <!-- Hàng tiêu đề -->
                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1);">
                            <div class="title-container row main align-items-center">
                                <div style="padding: 5px; margin-left: 10px; color: #fff; font-size: 15px;">STT</div>
                                <div  >
                                    <div class="row" style="color: #fff; font-size: 15px;" >Tên sách</div>
                                </div>
                                <div  style="color: #fff; font-size: 15px;" >Hình ảnh</div>
                                <div  >
                                    <p style="color: #fff; font-size: 15px;">Đơn giá</p>
                                </div>
                                <div style=" color: #fff; font-size: 15px;">
                                    Số lượng
                                 </div>
                                <div  style = "color: #fff; font-size: 15px;">Thành tiền</div>
                            </div>
                        </div>

                <?php 
                if (!empty($books)) {    //neu ton tai products thi moi in
                    $num = 1;
                    $total = 0;
                    while ($row = mysqli_fetch_array($books )) { ?>

                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1);">
                            <div class="detail-container row main align-items-center">
                                <div style="margin-left: 10px;padding: 5px;"><?=$num++;?></div>
                                <div >
                                    <div ><?=$row['tittle']?></div>
                                    <div ></div>
                                </div>
                                <div ><img class="img-fluid"  style="height: 100px; width: auto" src="<?=$row['image']?>"></div>
                                <div >
                                    <p><?=$row['price']-$row['discount']?></p>
                                </div>
                                <div  style="padding-right: 0;">
                                    <input style="width: 70px;"type="number" value="<?= $_SESSION['cart'][$row['id']] ?>" name="quantity[<?=$row['id']?>]" size=2 style="padding:0;text-align:center"/>
                                 </div>
                                <div ><?= number_format( ($row['price']-$row['discount']) * $_SESSION["cart"][$row['id']], 0, ",", ".") ?></div>
                               <a href="cart.php?action=delete&id=<?= $row['id'] ?>" class="fa fa-trash" style="padding: 2px;"></a>

                            </div>
                        </div>

                    <?php
                        $total += ($row['price']-$row['discount']) * $_SESSION["cart"][$row['id']];    //cap nhat tong so tien
                        // $num++;
                        }
                    ?>                      

                        <!-- row tính tổng tiền -->
                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); ">
                            <div class="sum-container row main align-items-center" style ="border-bottom: 1px solid rgba(0,0,0,.1);">
                                <div style="padding: 5px;">&nbsp;</div>
                                <div>
                                    <div class="row text-muted">Tổng Tiền Hàng</div>
                                </div>
                                <div >&nbsp;</div>
                                <div>&nbsp;</div>
                                <div style="padding-right: 0;">&nbsp;</div>
                                <div><?= number_format($total, 0, ",", ".") ?></div>
                                
                            </div>
                            <div class="button-container">
                            <input class="update-button" type="submit" name="update_click" value="Cập nhật" />
                            </div>
                        </div>

                        <?php   }   ?>

                    </div>
                </div> 

                <?php
                while ($row_user = mysqli_fetch_array($user)) {
                ?>
                <div class="row">
                    <div class="col-md-11 summary" style="margin:auto;">
                        <div>
                            <h5 style="text-align: center; margin-bottom: 50px;"><b style="font-size: 30px;"> ĐƠN HÀNG </b></h5>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col text-left" style="margin-bottom: 10px">TỔNG TIỀN HÀNG</div>
                            <div class="col text-right"> <?= isset($total) ? number_format($total, 0, ",", ".") : "" ?></div>
                        </div>

                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                            <div class="col-6">
                                <p style="margin-bottom: 10px">Người nhận hàng</p> <input style="padding: 5px; border-radius: 3px" type="text" value="<?= isset($row_user['last_name']) ? $row_user['first_name']." ".$row_user['last_name'] : ""?>" name="fullname"  placeholder="Nhập Tên">
                            </div>
                            <div class="col-6">
                                <p style="margin-bottom: 10px">Số điện thoại</p> <input style="padding: 5px; border-radius: 3px" type="text" value="<?= isset($row_user['phone']) ? $row_user['phone'] : ""?>" name="phone" placeholder="Nhập SĐT">
                            </div>
                        </div>   
                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                            <div class="col-6">
                                <p style="margin-bottom: 10px">Địa chỉ</p> <input style="padding: 5px; border-radius: 3px" type="text" value="<?= isset($row_user['address']) ? $row_user['address'] : ""?>" name="address" placeholder="Nhập Địa chỉ">
                            </div>
                            <div class="col-6">
                                <p style="margin-bottom: 10px">Cách giao hàng</p> 
                                <select style="padding: 5px; border-radius: 3px">
                                    <option class="text-muted">Giao hàng thông thường - 5.000đ</option>
                                    <option class="text-muted">Giao hàng nhanh - 20000đ</option>
                                </select>
                            </div>
                        </div>   
                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                            <p style="margin-bottom: 10px">Ghi chú: </p><textarea style="padding: 5px; border-radius: 3px" name="note" cols="128" rows="6" style="margin:auto;"></textarea>
                        </div>
                        <div class="row" style="justify-content:center; border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                            <p>TỔNG THANH TOÁN : <b class="text-danger" style="font-size:1.5rem"><?= isset($total) ? number_format($total, 0, ",", ".") : "" ?></b></p>   
                        </div>
                        <div class="button-container">
                           <input class="order-button" type="submit" name="order_click" value="Đặt hàng" />
                        </div>
                    </div>
                </div>    
                <?php } ?>

            </div> <!-- end card -->       
        </form>   

        <?php } ?>
        <?php } ?>


    
    </div> <!--container.//-->
       


</body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="./assets/js/header.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script></body>
<!-- <script src="./vendor/jquery/jquery.min.js"></script>
<script src="./vendor/jquery/jquery.slim.min.js"></script>
<script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
<script type='text/javascript' src=''></script>
<script type='text/javascript' src=''></script> -->
<style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
  color: #495057;
  font-size: 15px;
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
        .title-container {
            color: #fff;
            background-color: #434343;
            display: grid;
            grid-template-columns: 1fr 2fr 1fr 1.5fr 1fr 1.5fr;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

.detail-container {
    display: grid;
    grid-template-columns: 1fr 2fr 1fr 1.5fr 1fr 1fr 0.5fr;
    
    
}
.sum-container {
    display: grid;
    display: grid;
    grid-template-columns: 1fr 2fr 1fr 1.5fr 1fr 1fr 0.5fr;
    
}
p {
    margin-bottom: 0;
}

.update-button {
    background-color: #27ae60;
    color: #fff;
    border-radius: 5px;
    margin-top: 50px;
    width: 400px;
}

.update-button:hover {
    background-color: #219150;
    cursor: pointer;
}

.button-container {
    width: 100%;
    display: flex; 
    justify-content: center; 
    align-items: center;
}

.order-button {
    background-color: #27ae60;
    color: #fff;
    border-radius: 5px;
    margin-top: 50px;
    width: 400px;
}

.order-button:hover {
    background-color: #219150;
    cursor: pointer;
}
</style>
</html>