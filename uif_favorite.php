
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
  <script src="./assets/js/header.js"></script>

</head>
<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    color: #495057;
}
            
.page-img {
  display: block;
  margin-left: auto;
  margin-right: auto;
}

#bottom-pagination{
    text-align: left;
    margin-top: 15px;
}
.page-item{
    border: 1px solid #ccc;
    padding: 5px 9px;
    color: #333;
}
.current-page{
    background-color: var(--green);
    border: 1px solid var(--white);
    color: var(--white);
    font-weight: 600;
}
h1 {
    font-size: 3rem; 
    margin-bottom: 3rem;
}


table {
  border-collapse: collapse;
  border-radius: 5px;
  overflow: hidden;
  box-shadow: 0px 2px 5px 0px rgb(0 0 0 / 10%);
}

thead tr {
        background-color: #434343;
        color: #fff;
      }

thead td {
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

.fa-trash {
  color: #fa5252;
}

.fa-trash:hover {
  color: #e03131;
}

.nav-tabs {
                display: flex; 
                justify-content: space-between;
            }
  
.book-link:link, .book-link:visited {
  text-decoration: none;
  color: #495057;
}

.book-link:hover, .book-link:active {
  text-decoration: underline;
}


</style>

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
          <img src="<?= $currentUser['avatar'] ?>" class="page-img avatar img-circle img-thumbnail" alt="avatar" style="width:180px;height:180px;">
        </div>

        <br>
          
          
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
               
          
      </div><!--/col-4-->
      
    	<div class="col-sm-8">
            <ul class="nav nav-tabs">
                <!-- <li class="active"><a data-toggle="tab" href="user_profile.php">Thông tin</a></li> -->
                <li><a href="uif_profile.php">Cập nhật Thông tin</a></li>
                <li><a href="uif_passedit.php" >Đổi mật khẩu </a></li>
                <li style = "background-color :#ddd"><a href="uif_favorite.php" >Yêu thích</a></li>
                <li><a href="uif_orderhis.php" >Lịch sử mua hàng</a></li>
            </ul>
        <!-- <hr> -->

        <?php 
          $param = "";          // khoi tao bien param la chuoi trong filter de gan vs perpage va page
          $sortParam = "";      // khoi tao sortParam la chuoi trong filter ket hop vs order
          $orderConditon = "";  //  String chua dieu kien order : vd ORDER BY product.name ASC/DESC

          $user = $currentUser;
          $userid = $user['id'];

          $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 3;
          $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
          $offset = ($current_page - 1) * $item_per_page;

          $result = mysqli_query($con, "SELECT * FROM  books 
          INNER JOIN favorites ON books.id = favorites.book_id WHERE customer_id= $userid
          ORDER BY books.id ASC
          LIMIT " . $item_per_page . " OFFSET " . $offset . " " );
          
          $totalRecords = mysqli_query($con, "SELECT * FROM  books 
          INNER JOIN favorites ON books.id = favorites.book_id WHERE customer_id= $userid ORDER BY books.id ASC");
          $totalRecords = $totalRecords->num_rows;
          $totalPages = ceil($totalRecords / $item_per_page);
          ?>
  
          <table class="table table-borderless table-striped table-earning">
          <?php include 'pagination.php'?>
          <br>
            <thead>
              <tr>
                <td style="text-align: center">ID</td>
                <td style="text-align: center; width: 35%">
                  Tên sách
                </td>
                <td style="text-align: center">Ảnh</td>
                <td style="text-align: center">Giảm giá</td>
                <td style="text-align: center">Giá </td>
                <td style="text-align: center">Xóa</td>
              </tr>
            </thead>
            <?php
           
            while ($row = mysqli_fetch_array($result)) {
              ?>
                <a href="book_detail.php?id=<?= $row['id'] ?>">  
                  <tr id="table-row">
                    <td style="text-align: center">
                      <a class="book-link" href="book_detail.php?id=<?= $row['id']?>"> 
                        <?= $row['id'] ?>
                      </a>
                    </td>
                    <td style="text-align: center">
                      <a class="book-link" href="book_detail.php?id=<?= $row['id']?>"> 
                        <?= $row['tittle'] ?>
                      </a>
                    </td>                  
                    <td>
                      <a class="book-link" href="book_detail.php?id=<?= $row['id'] ?>" class="card-img" >  
                        <img class="page-img" style="width: 80px;height: 100px;"
                          src="./<?= $row['image'] ?>" alt="<?= $row['tittle'] ?>"title="<?= $row['tittle']?>" >
                      </a>
                    </td>
                    <td style="text-align: center"><?=ceil($row['discount'] / $row['price']*100) ?>%</td>
                    <td style="text-align: center"><?=number_format($row['price'] - $row['discount'], 0, ",", ".") ?>đ</td>
                    <td style="text-align: center"><a class="fa fa-trash" href="./uif_favor_del.php?id=<?= $row['id'] ?>" ></a></td>
                  </tr>
              </a>
            <?php 
            } ?>
          </table>
      </div><!--/col-8-->
    </div><!--/row-->
    
