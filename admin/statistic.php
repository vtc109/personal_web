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
        // include 'admin_navbar.php';
         

// DOANH THU, LAI SUAT TRONG NAM 2021    
    $where1 = "";
    if( isset($_GET['name']) && $_GET['name'] == "sale_chart" && $_GET['year'] != "2022") {
        if( isset($_GET['year']) && $_GET['year'] =="2021"){
            $where1 .= "YEAR(created_date) = 2021";
        }
    } else {
    $where1 .= "YEAR(created_date) = 2022";
    }
    $month1s = ''; $sales = ''; $imports = ''; $profits = '';   
    $sale_chart = mysqli_query($con, 
    "SELECT MONTH(created_date) AS month, SUM((price-discount)*quantity) AS sale,SUM(import_price*quantity) AS import, SUM((price-discount-import_price)*quantity) AS profit 
    FROM `orders_details` INNER JOIN orders ON orders_details.order_id = orders.id
    WHERE (".$where1.") 
    GROUP BY (month)");

    while ($row = mysqli_fetch_array($sale_chart)){
        $month1 =  $row['month'];
        $sale = $row['sale'];
        $import = $row['import'];
        $profit = $row['profit'];

        $month1s = $month1s.$month1.',';
        $sales = $sales.$sale.',';
        $imports = $imports.$import.',';
        $profits = $profits.$profit.',';
    }
    $month1s = trim($month1s, "," );
    $sales = trim($sales, "," );
    $imports = trim($imports, "," );
    $profits = trim($profits, "," ); 
    // var_dump( $month1s, $sales, $imports);


// SO LUONG SACH VA DON HANG TRONG NAM
    $where2 = "";
    if( isset($_GET['name']) && $_GET['name'] == "bookorder_chart" && $_GET['year'] != "2022") {
        if( isset($_GET['year']) && $_GET['year'] =="2021"){
            $where2 .= "YEAR(created_date) = 2021";
        }
    } else {
    $where2 .= "YEAR(created_date) = 2022";
    }
    $month2s = ''; $book2s = ''; $order2s = '';   
    $bookorder_chart = mysqli_query($con, 
    "SELECT MONTH(created_date) AS thang ,SUM(quantity) AS sach, COUNT(DISTINCT orders.id) AS donhang
    FROM `orders_details` INNER JOIN orders ON orders_details.order_id = orders.id
    WHERE (".$where2.") 
    GROUP BY thang");

    while ($row = mysqli_fetch_array($bookorder_chart)){
        $month2 =  $row['thang'];
        $book2 = $row['sach'];
        $order2 = $row['donhang'];

        $month2s = $month2s.$month2.',';
        $book2s = $book2s.$book2.',';
        $order2s = $order2s.$order2.',';
    }
    $month2s = trim($month2s, "," );
    $book2s = trim($book2s, "," );
    $order2s = trim($order2s, "," );



//  THONG KE THEO THE LOAI SACH
    $where3 = "";
    if( isset($_GET['name']) && $_GET['name'] == "genres_chart" && $_GET['year'] != "2022") {
        if( isset($_GET['year']) && $_GET['year'] =="2021"){
            $where3 .= "YEAR(created_date) = 2021";
        }
    } else {
    $where3 .= "YEAR(created_date) = 2022";
    }
    $genres3s = ''; $quantities = ''; $total ='';
    $total = mysqli_query($con,"SELECT SUM(quantity) AS tongsoluong  FROM `orders_details` 
    INNER JOIN books_genres ON orders_details.book_id = books_genres.book_id
    INNER JOIN orders ON orders_details.order_id = orders.id
    INNER JOIN genres ON genres.id = books_genres.genres_id
    WHERE (".$where3.") ");
    $total = mysqli_fetch_assoc($total);
    // var_dump($total);
    
    $genres_chart = mysqli_query($con, 
    "SELECT genres.name AS theloai ,SUM(quantity) AS soluong  FROM `orders_details` 
    INNER JOIN books_genres ON orders_details.book_id = books_genres.book_id
    INNER JOIN orders ON orders_details.order_id = orders.id
    INNER JOIN genres ON genres.id = books_genres.genres_id
    WHERE (".$where3.") 
    GROUP BY(genres_id)");

    while ($row = mysqli_fetch_array($genres_chart)){
        $genres3 = '"'.$row['theloai'].'"' ;
        $quantity = ceil($row['soluong']/$total['tongsoluong']*100);

        $genres3s = $genres3s.$genres3.',';
        $quantities = $quantities.$quantity.',';
    }
    $genres3s = trim($genres3s, "," );
    $quantities = trim($quantities, "," );
    // $test = '"a","b"';
    // var_dump($genres3s,$quantities);




     ?>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div class="row">
                          
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Doanh số bán hàng theo đầu sách</h3>
                                        <select name="sort" id="sort" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" style="margin-bottom: 20px">
                                            <option selected value="?&name=sale_chart&year=2022">Năm 2022</option>
                                            <option <?php if(isset($_GET['name']) && $_GET['name'] == "sale_chart" && $_GET['year'] == "2021") { ?> selected <?php } ?> 
                                    value="?&name=sale_chart&year=2021" data-year="2021" class="sale_chart">Năm 2021</option>
                                        </select>
                                        <canvas id="sales-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Số lượng sách và đơn hàng trong năm</h3>
                                        <select name="sort" id="sort" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" style="margin-bottom: 20px">
                                            <option selected value="?&name=bookorder_chart&year=2022">Năm 2022</option>
                                            <option <?php if(isset($_GET['name']) && $_GET['name'] == "bookorder_chart" && $_GET['year'] == "2021") { ?> selected <?php } ?> 
                                    value="?&name=bookorder_chart&year=2021" data-year="2021" class="sale_chart">Năm 2021</option>
                                        </select>
                                        <canvas id="barChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Tỉ lệ số lượng sách bán được theo Thể loại (%)</h3>
                                        <select name="sort" id="sort" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" style="margin-bottom: 20px">
                                            <option selected value="?&name=genres_chart&year=2022">Năm 2022</option>
                                            <option <?php if(isset($_GET['name']) && $_GET['name'] == "genres_chart" && $_GET['year'] == "2021") { ?> selected <?php } ?> 
                                    value="?&name=genres_chart&year=2021" data-year="2021" class="genres_chart">Năm 2021</option>
                                        </select>
                                        <canvas id="doughutChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Single Bar Chart</h3>
                                        <canvas id="singelBarChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Team Commits</h3>
                                        <canvas id="team-chart"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Rader chart</h3>
                                        <canvas id="radarChart"></canvas>
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
                                        $topfvr = mysqli_query($con, "SELECT id, first_name,last_name,money_spent
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
                                        while ($rowfvr=mysqli_fetch_array($topfvr)) {       
                                          ?>
                                              <tr id="table-row">
                                                <td style="text-align: center">
                                                    <?=$rowfvr['id']?>
                                                </td>
                                                <td style="text-align: center">
                                                    <?=$rowfvr['first_name']." ".$rowfvr['last_name']?>
                                                </td>         
                                                <td style="text-align: center">
                                                    <?=number_format($rowfvr['money_spent'], 0, ",", ".") ?>đ
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

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                      <h3 class="title-2 m-b-40">Top 10 cuốn sách được yêu thích nhất</h3>
                                      <?php
                                        $topfvr = mysqli_query($con, "SELECT book_id, books.tittle AS bname ,COUNT(book_id) AS b_id
                                        FROM `favorites`INNER JOIN books ON favorites.book_id = books.id 
                                        GROUP BY(book_id)
                                        ORDER BY b_id DESC 
                                        LIMIT 10;");
                                      ?>
                                      <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                          <tr>
                                            <td style="text-align: center">ID</td>
                                            <td style="text-align: center">Tên sách</td>
                                            <td style="text-align: center">Số lượt yêu thích</td>
                                          </tr>
                                        </thead>
                                        <?php

                                        // gán row = fetch arr vì fetch arr là duyệt từng hàng, còn assoc là lấy tất cả cho vào 1 hàng
                                        while ($rowfvr=mysqli_fetch_array($topfvr)) {       
                                          ?>
                                              <tr id="table-row">
                                                <td style="text-align: left">
                                                    <?=$rowfvr['book_id']?>
                                                </td>
                                                <td style="text-align: left">
                                                    <?=$rowfvr['bname']?>
                                                </td>         
                                                <td style="text-align: left">
                                                    <?=$rowfvr['b_id']?>
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
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                      <h3 class="title-2 m-b-40">Top 10 cuốn sách bán chạy nhất</h3>
                                        <?php
                                        $topsell = mysqli_query($con, "SELECT book_id,SUM(orders_details.quantity) AS tongsoluong, books.tittle AS btittle
                                        FROM `orders_details` 
                                        INNER JOIN books
                                        ON orders_details.book_id = books.id
                                        GROUP BY book_id
                                        ORDER BY tongsoluong DESC
                                        LIMIT 10");
                                        ?>
                                        <table class="table table-borderless table-striped table-earning">
                                          <thead>
                                            <tr>
                                              <td style="text-align: center">ID</td>
                                              <td style="text-align: center; width: 35%">Tên sách</td>
                                              <td style="text-align: center">Số lượng đã bán</td>
                                            </tr>
                                          </thead>
                                          <?php

                                          while ($rowsell=mysqli_fetch_array($topsell)) {
                                            ?>
                                                <tr id="table-row">
                                                  <td style="text-align: left">
                                                      <?=$rowsell['book_id']?>
                                                  </td>
                                                  <td style="text-align: left">
                                                      <?=$rowsell['btittle']?>
                                                  </td>         
                                                  <td style="text-align: left">
                                                      <?=$rowsell['tongsoluong']?>
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

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="au-card recent-report">
                                    <div class="au-card-inner">
                                    <h3 class="title-2 m-b-40">Top 10 cuốn sách ít được mua</h3>
                                        <?php
                                        $topsell = mysqli_query($con, "SELECT book_id,SUM(orders_details.quantity) AS tongsoluong, books.tittle AS btittle
                                        FROM `orders_details` 
                                        INNER JOIN books
                                        ON orders_details.book_id = books.id
                                        GROUP BY book_id
                                        ORDER BY tongsoluong ASC
                                        LIMIT 10");
                                        ?>
                                        <table class="table table-borderless table-striped table-earning">
                                          <thead>
                                            <tr>
                                              <td style="text-align: center">ID</td>
                                              <td style="text-align: center; width: 35%">Tên sách</td>
                                              <td style="text-align: center">Số lượng đã bán</td>
                                            </tr>
                                          </thead>
                                          <?php

                                          while ($rowsell=mysqli_fetch_array($topsell)) {
                                            ?>
                                                <tr id="table-row">
                                                  <td style="text-align: left">
                                                      <?=$rowsell['book_id']?>
                                                  </td>
                                                  <td style="text-align: left">
                                                      <?=$rowsell['btittle']?>
                                                  </td>         
                                                  <td style="text-align: left">
                                                      <?=$rowsell['tongsoluong']?>
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

                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
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
    var ctx = document.getElementById("sales-chart");
    if (ctx) {
      ctx.height = 150;
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Thg1","Thg2","Thg3","Thg4","Thg5","Thg6","Thg7","Thg8","Thg9","Thg10","Thg11","Thg12" ],
          type: 'line',
          defaultFontFamily: 'Poppins',
          datasets: [{
            label: "Doanh thu",
            data: [ <?php echo $sales ?> ],
            backgroundColor: 'transparent',
            borderColor: 'rgba(0,103,255,0.5)',
            borderWidth: 3,
            pointStyle: 'circle',
            pointRadius: 5,
            pointBorderColor: 'transparent',
            pointBackgroundColor: 'rgba(0,103,255,0.75)',
          }, {
            label: "Chi phí gốc",
            data: [ <?php echo $imports ?> ],
            backgroundColor: 'transparent',
            borderColor: 'rgba(220,53,69,0.5)',
            borderWidth: 3,
            pointStyle: 'circle',
            pointRadius: 5,
            pointBorderColor: 'transparent',
            pointBackgroundColor: 'rgba(220,53,69,0.75)',
          }, {
            label: "Lãi",
            data: [ <?php echo $profits ?> ],
            backgroundColor: 'transparent',
            borderColor: 'rgba(40,167,69,0.5)',
            borderWidth: 3,
            pointStyle: 'circle',
            pointRadius: 5,
            pointBorderColor: 'transparent',
            pointBackgroundColor: 'rgba(40,167,69,0.75)',
          }]
        },
        options: {
          responsive: true,
          tooltips: {
            mode: 'index',
            titleFontSize: 12,
            titleFontColor: '#000',
            bodyFontColor: '#000',
            backgroundColor: '#fff',
            titleFontFamily: 'Poppins',
            bodyFontFamily: 'Poppins',
            cornerRadius: 3,
            intersect: false,
          },
          legend: {
            display: false,
            labels: {
              usePointStyle: true,
              fontFamily: 'Poppins',
            },
          },
          scales: {
            xAxes: [{
              display: true,
              gridLines: {
                display: false,
                drawBorder: false
              },
              scaleLabel: {
                display: false,
                labelString: 'Month'
              },
              ticks: {
                fontFamily: "Poppins"
              }
            }],
            yAxes: [{
              display: true,
              gridLines: {
                display: false,
                drawBorder: false
              },
              scaleLabel: {
                display: true,
                labelString: 'Value',
                fontFamily: "Poppins"

              },
              ticks: {
                fontFamily: "Poppins"
              }
            }]
          },
          title: {
            display: false,
            text: 'Normal Legend'
          }
        }
      });
    }
  } catch (error) {
    console.log(error);
  }

  try {
    //bar chart
    var ctx = document.getElementById("barChart");
    if (ctx) {
      ctx.height = 200;
      var myChart = new Chart(ctx, {
        type: 'bar',
        defaultFontFamily: 'Poppins',
        data: {
          labels: ["Thg1","Thg2","Thg3","Thg4","Thg5","Thg6","Thg7","Thg8","Thg9","Thg10","Thg11","Thg12"],
          datasets: [
            {
              label: "Tổng số sách bán được",
              data: [ <?php echo $book2s ?> ],
              borderColor: "rgba(0, 123, 255, 0.9)",
              borderWidth: "0",
              backgroundColor: "rgba(0, 123, 255, 0.5)",
              fontFamily: "Poppins"
            },
            {
              label: "Tổng số đơn hàng",
              data: [ <?php echo $order2s ?> ],
              borderColor: "rgba(255,0,68,0.9)",
              borderWidth: "0",
              backgroundColor: "rgba(255,0,68,0.5)",
              fontFamily: "Poppins"
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

  //doughut chart
  try {
    var ctx = document.getElementById("doughutChart");
    if (ctx) {
      ctx.height = 150;
      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          datasets: [{
            data: [ <?php echo $quantities ?> ],
            backgroundColor: [
              "rgba(255,0,0,0.65)",
              "rgba(0,239,255,0.65)",
              "rgba(255,137,0,0.65)",
              "rgba(145,0,255,0.65)",
              "rgba(0,255,60,0.65)",
              "rgba(255,0,179,0.65)",
              "rgba(239,255,0,0.65)",
              "rgba(9,0,255,0.65)",
              "rgba(80,80,80,0.65)",
              "rgba(6,255,173,0.65)",
              "rgba(255,6,106,0.65)",
              "rgba(165,255,6,0.65)"
            ],
            hoverBackgroundColor: [
              "rgba(255,0,0,0.9)",
              "rgba(0,239,255,0.9)",
              "rgba(255,137,0,0.9)",
              "rgba(145,0,255,0.9)",
              "rgba(0,255,60,0.9)",
              "rgba(255,0,179,0.9)",
              "rgba(239,255,0,0.9)",
              "rgba(9,0,255,0.9)",
              "rgba(80,80,80,0.9)",
              "rgba(6,255,173,0.9)",
              "rgba(255,6,106,0.9)",
              "rgba(165,255,6,0.9)"
            ]
          }],
          labels: [ <?php echo $genres3s ?>]
        },
        options: {
          legend: {
            position: 'top',
            labels: {
              fontFamily: 'Poppins'
            }

          },
          responsive: true
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

</html>
<!-- end document-->
