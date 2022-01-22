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
         
    // THONG KE SO KHACH HANG MOI
    $where5 = ""; $new_users=""; $spend_users="";  
    if( isset($_GET['name']) && $_GET['name'] == "user_chart" && $_GET['year'] != "2022") {
        if( isset($_GET['year']) && $_GET['year'] =="2021"){
            $where5 .= "YEAR(customers.created_date) = 2021";
        }
    } else {
    $where5 .= "YEAR(customers.created_date) = 2022";
    }
    $user_new = mysqli_query($con,"SELECT MONTH(created_date) AS thang , COUNT(id) AS soluong
    FROM `customers` WHERE (".$where5.") 
    GROUP BY thang");

    $user_spend = mysqli_query($con,"SELECT MONTH(customers.created_date) AS thang , COUNT(DISTINCT customer_id) AS soluong
    FROM `customers` INNER JOIN orders ON customers.id = orders.customer_id
    WHERE (".$where5.") AND MONTH(orders.created_date)=MONTH(customers.created_date) AND YEAR(orders.created_date) = YEAR(customers.created_date)
    GROUP BY thang");

    while ($row_user = mysqli_fetch_array($user_new)){
      $new_user = $row_user['soluong'];
     $new_users = $new_users.$new_user.',';
    }
    while ($row_spend = mysqli_fetch_array($user_spend) ){
      $spend_user = $row_spend['soluong'];
      $spend_users = $spend_users.$spend_user.',';
    }

    $new_users = trim($new_users, "," );
    $spend_users = trim($spend_users, "," );
    // var_dump($new_users);




     ?>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    <div class="row">
                      <div class="col-lg-6">

                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Thống kê lượng người dùng mới theo tháng</h3>
                                        <select name="sort" id="sort" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" style="margin-bottom: 20px">
                                            <option selected value="?&name=user_chart&year=2022">Năm 2022</option>
                                            <option <?php if(isset($_GET['name']) && $_GET['name'] == "user_chart" && $_GET['year'] == "2021") { ?> selected <?php } ?> 
                                    value="?&name=user_chart&year=2021" data-year="2021" class="user_chart">Năm 2021</option>
                                        </select>
                                        <canvas id="lineChart"></canvas>
                                    </div>
                                </div>
                        </div>
                        
                          <div class="col-lg-6">
                            <div class="au-card m-b-30">
                              <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Top 10 khách hàng tương tác nhiều nhất </h3>
                                <select name="sort" id="sort" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" style="margin-bottom: 20px">
                                                <option selected value="?&name=top_comment&month=1&year=2022">Xếp theo tháng</option>
                                                <?php
                                                  $i = 1;
                                                  for ($i = 1; $i<=12; $i++){
                                                    ?>
                                                    <option <?php if(isset($_GET['name']) && $_GET['name'] == "top_comment" && $_GET['month'] == "$i"&& $_GET['year'] == "2021") { ?> selected <?php } ?> 
                                                      value="?&name=top_comment&month=<?=$i?>&year=2021">Tháng <?=$i?> - 2021</option>
                                                    <?php
                                                  }
                                                  for ($i = 1; $i<=12; $i++){
                                                    ?>
                                                    <option <?php if(isset($_GET['name']) && $_GET['name'] == "top_comment" && $_GET['month'] == "$i"&& $_GET['year'] == "2022") { ?> selected <?php } ?> 
                                                      value="?&name=top_comment&month=<?=$i?>&year=2022">Tháng <?=$i?> - 2022</option>
                                                    <?php
                                                  }
                                                ?>
                                </select>                              
                                  <?php
                                    $where = "";
                                    if (isset($_GET['name']) && $_GET['name'] == "top_comment" && $_GET['year'] !="2022") {
                                      if (isset($_GET['year']) && $_GET['year'] == "2021"){
                                        $where .= "YEAR(reviews.created_date) = 2021 ";
                                        switch ($_GET['month']){
                                          case 1:
                                            $where .= "AND MONTH(reviews.created_date) = 1";
                                            break;
                                          case 2:
                                            $where .= "AND MONTH(reviews.created_date) = 2";
                                            break; 
                                          case 3:
                                            $where .= "AND MONTH(reviews.created_date) = 3";
                                            break;   
                                          case 4:
                                            $where .= "AND MONTH(reviews.created_date) = 4";
                                            break; 
                                          case 5:
                                            $where .= "AND MONTH(reviews.created_date) = 5";
                                            break;   
                                          case 6:
                                            $where .= "AND MONTH(reviews.created_date) = 6";
                                            break;  
                                          case 7:
                                            $where .= "AND MONTH(reviews.created_date) = 7";
                                            break;
                                          case 8:
                                            $where .= "AND MONTH(reviews.created_date) = 8";
                                            break;
                                          case 9:
                                            $where .= "AND MONTH(reviews.created_date) = 9";
                                            break;
                                          case 10:
                                            $where .= "AND MONTH(reviews.created_date) = 10";
                                            break;
                                          case 11:
                                            $where .= "AND MONTH(reviews.created_date) = 11";
                                            break;
                                          case 12:
                                            $where .= "AND MONTH(reviews.created_date) = 12";
                                            break;
                                        }
                                      }
                                    }else{
                                      if (isset($_GET['year']) && $_GET['year'] == "2022"){
                                        $where .= "YEAR(reviews.created_date) = 2022 ";
                                        switch ($_GET['month']){
                                          case 1:
                                            $where .= "AND MONTH(reviews.created_date) = 1";
                                            break;
                                          case 2:
                                            $where .= "AND MONTH(reviews.created_date) = 2";
                                            break; 
                                          case 3:
                                            $where .= "AND MONTH(reviews.created_date) = 3";
                                            break;   
                                          case 4:
                                            $where .= "AND MONTH(reviews.created_date) = 4";
                                            break; 
                                          case 5:
                                            $where .= "AND MONTH(reviews.created_date) = 5";
                                            break;   
                                          case 6:
                                            $where .= "AND MONTH(reviews.created_date) = 6";
                                            break;  
                                          case 7:
                                            $where .= "AND MONTH(reviews.created_date) = 7";
                                            break;
                                          case 8:
                                            $where .= "AND MONTH(reviews.created_date) = 8";
                                            break;
                                          case 9:
                                            $where .= "AND MONTH(reviews.created_date) = 9";
                                            break;
                                          case 10:
                                            $where .= "AND MONTH(reviews.created_date) = 10";
                                            break;
                                          case 11:
                                            $where .= "AND MONTH(reviews.created_date) = 11";
                                            break;
                                          case 12:
                                            $where .= "AND MONTH(reviews.created_date) = 12";
                                            break;
                                        }
                                      }else{
                                      
                                        $where .= " MONTH(reviews.created_date) = MONTH(NOW() ) ";
                                      }                                     
                                    }
                                    // var_dump($where);exit;
                                    $topcmt = mysqli_query($con, "SELECT customer_id , customers.first_name, customers.last_name, COUNT(customer_id) AS socmt
                                    FROM reviews INNER JOIN customers ON reviews.customer_id = customers.id
                                    WHERE (".$where.") GROUP BY(customer_id) 
                                    ORDER BY socmt DESC
                                    LIMIT 10;");
                                  ?>
                                  <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                      <tr>
                                        <td style="text-align: center">ID</td>
                                        <td style="text-align: center">Họ và tên</td>
                                        <td style="text-align: center">Số comments</td>
                                      </tr>
                                    </thead>
                                    <?php

                                    // gán row = fetch arr vì fetch arr là duyệt từng hàng, còn assoc là lấy tất cả cho vào 1 hàng
                                    $i = 1;
                                    while ($rowcmt=mysqli_fetch_array($topcmt)) {       
                                      ?>
                                          <tr id="table-row">
                                            <td style="text-align: center">
                                                <?=$i++?>
                                            </td>
                                            <td style="text-align: left">
                                                <?=$rowcmt['first_name']." ".$rowcmt['last_name']?>
                                            </td>         
                                            <td style="text-align: center">
                                                <?=$rowcmt['socmt']?>
                                            </td>               
                                          </tr>
                                      </a>
                                    <?php 
                                    } 
                                    ?>
                                  </table>
                              </div>
                            </div>
                          </div>                          
                        </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-6">
                            <div class="au-card m-b-30">
                              <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Top 10 khách hàng đem lại nguồn doanh thu nhất</h3>
                                  <?php
                                    $topusers = mysqli_query($con, "SELECT id, first_name,last_name,money_spent
                                    FROM `customers`
                                    ORDER BY money_spent DESC
                                    LIMIT 10");
                                  ?>
                                  <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                      <tr>
                                        <td style="text-align: center">ID</td>
                                        <td style="text-align: center">Họ và tên</td>
                                        <td style="text-align: center">Số tiền đã mua</td>
                                      </tr>
                                    </thead>
                                    <?php
                                    
                                    // gán row = fetch arr vì fetch arr là duyệt từng hàng, còn assoc là lấy tất cả cho vào 1 hàng
                                    $i = 1;
                                    while ($rowuser=mysqli_fetch_array($topusers)) {       
                                      ?>
                                          <tr id="table-row">
                                            <td style="text-align: center">
                                                <?=$i++?>
                                            </td>
                                            <td style="text-align: left">
                                                <?=$rowuser['first_name']." ".$rowuser['last_name']?>
                                            </td>         
                                            <td style="text-align: center">
                                                <?=number_format($rowuser['money_spent'], 0, ",", ".") ?>đ
                                            </td>               
                                          </tr>
                                      </a>
                                    <?php 
                                    } 
                                    ?>
                                  </table>
                              </div>
                            </div>
                          </div>
                    </div>   <!-- end container -->
                </div>
            </div>
            <!-- END MAIN CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->

    </div>

    <!-- Jquery JS-->
     <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
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
    
    <script>
(function ($) {
  // USE STRICT
  "use strict";        
    //Sales chart
    try {

//line chart
var ctx = document.getElementById("lineChart");
if (ctx) {
  ctx.height = 150;
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["Thg1","Thg2","Thg3","Thg4","Thg5","Thg6","Thg7","Thg8","Thg9","Thg10","Thg11","Thg12"],
      defaultFontFamily: "Poppins",
      datasets: [
        {
          label: "Số người dùng mới trong tháng",
          borderColor: "rgba(43,195,9,0.9)",
          borderWidth: "1",
          backgroundColor: "rgba(43,195,9,0.2)",
          data: [ <?php echo $new_users ?> ]
        },
        {
          label: "Số người dùng mới trong tháng đó đã tham gia mua hàng",
          borderColor: "rgba(0, 45, 251, 0.9)",
          borderWidth: "1",
          backgroundColor: "rgba(0, 45, 251, 0.2)",
          pointHighlightStroke: "rgba(26,179,148,1)",
          data: [ <?php echo $spend_users ?> ]
        }
      ]
    },
    options: {
      legend: {
        position: 'top',
        labels: {
          fontFamily: 'Poppins'
        }

      },
      responsive: true,
      tooltips: {
        mode: 'index',
        intersect: false
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [{
          ticks: {
            fontFamily: "Poppins"

          }
        }],
        yAxes: [{
          ticks: {
            beginAtZero: true,
            fontFamily: "Poppins"
          }
        }]
      }

    }
  });
}


} catch (error) {
console.log(error);
}


  


})(jQuery);
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".sale_chart").click(function(event) {
                let year = $(this).data("year");
                // alert('Da bam san pham' + id);
                $.ajax({
                    url: "chart.php",
                    type: "GET",
                    // dataType: "dataType",
                    data: {name: "sale_chart",year: year},
                  })
                .done(function() {
                    console.log("success");
                    alert("OK");
                })
                .fail(function() {
                    console.log("error");
                    alert("Đã xảy ra lỗi!");
                });

            });

        });

    </script>


    
    <?php } ?><!-- end else -->
</body>
<style>
   * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
               
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
</style>
</html>
<!-- end document-->
