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
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <?php 
        include 'admin_navbar.php';
         

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

    // $data = array();
    // while($row = mysqli_fetch_array($genres_chart))
    // {
    // $data[] = array(
    // 'label'  => $row['theloai'],
    // 'value'  => ceil($row['soluong']/$total['tongsoluong']*100)
    // );
    // }
    // $data = json_encode($data);
    $genres = '';
    while($row = mysqli_fetch_array($genres_chart))
    {
     $genres .= "{ label: '".$row["theloai"]."', value: ".$row['soluong']."}, ";
    }
    $genres = substr($genres, 0, -2);
    // var_dump($genres);



//THONG KE THEO GIA
    $where4 = "";
    if( isset($_GET['name']) && $_GET['name'] == "price_chart" && $_GET['year'] != "2022") {
        if( isset($_GET['year']) && $_GET['year'] =="2021"){
            $where4 .= "YEAR(created_date) = 2021";
        }
    } else {
    $where4 .= "YEAR(created_date) = 2022";
    }
    $price = ''; $quantity4 = '';$quantity4s;
    $price1=0;$price2=0;$price3=0;$price4=0;$price5=0;$price6=0;$price7=0;$price8=0;$price9=0;
    $price1s=0;$price2s=0;$price3s=0;$price4s=0;$price5s=0;$price6s=0;$price7s=0;$price8s=0;$price9s=0;

    $price_chart = mysqli_query($con," SELECT price- discount AS gia , SUM(quantity) AS soluong 
    FROM `orders_details` INNER JOIN orders ON orders_details.order_id = orders.id
    WHERE (".$where4.") 
    GROUP BY (gia) ASC ");

    $price_charts = mysqli_query($con," SELECT book_id ,price- discount AS gia , COUNT( book_id) AS soluong 
    FROM `books` INNER JOIN favorites ON favorites.book_id = books.id
    WHERE (".$where4.") 
    GROUP BY (gia) ASC");


    while ($row4 = mysqli_fetch_array($price_chart)){
      // var_dump($row4['gia'],$row4['soluong']);
      if($row4['gia'] <= 50000 ){
          $price1 += $row4['soluong'];
      } else if( 50000 < $row4['gia'] && $row4['gia'] <= 100000  ){
        $price2 += $row4['soluong'];
      } else if( 100000 < $row4['gia'] && $row4['gia'] <= 150000 ){
        $price3 += $row4['soluong'];
      } else if( 150000 < $row4['gia'] && $row4['gia'] <= 200000 ){
        $price4 += $row4['soluong'];
      } else if( 200000 < $row4['gia'] && $row4['gia'] <= 300000 ){
        $price5 += $row4['soluong'];
      } else if( 300000 < $row4['gia'] && $row4['gia'] <= 400000 ){
        $price6 += $row4['soluong'];
      } else if( 400000 < $row4['gia'] && $row4['gia'] <= 500000 ){
        $price7 += $row4['soluong'];
      } else if( 500000 < $row4['gia'] && $row4['gia'] <= 1000000 ){
        $price8 += $row4['soluong'];
      } else {
        $price9 += $row4['soluong'];
      }
    }
    $quantity4=array($price1,$price2,$price3,$price4,$price5,$price6,$price7,$price8,$price9); 
    $quantity4 = json_encode($quantity4);

    while ($row4s = mysqli_fetch_array($price_charts)){
      // var_dump($row4['gia'],$row4['soluong']);
      if($row4s['gia'] <= 50000 ){
          $price1s += $row4s['soluong'];
      } else if( 50000 < $row4s['gia'] && $row4s['gia'] <= 100000  ){
        $price2s += $row4s['soluong'];
      } else if( 100000 < $row4s['gia'] && $row4s['gia'] <= 150000 ){
        $price3s += $row4s['soluong'];
      } else if( 150000 < $row4s['gia'] && $row4s['gia'] <= 200000 ){
        $price4s += $row4s['soluong'];
      } else if( 200000 < $row4s['gia'] && $row4s['gia'] <= 300000 ){
        $price5s += $row4s['soluong'];
      } else if( 300000 < $row4s['gia'] && $row4s['gia'] <= 400000 ){
        $price6s += $row4s['soluong'];
      } else if( 400000 < $row4s['gia'] && $row4s['gia'] <= 500000 ){
        $price7s += $row4s['soluong'];
      } else if( 500000 < $row4s['gia'] && $row4s['gia'] <= 1000000 ){
        $price8s += $row4s['soluong'];
      } else {
        $price9s += $row4s['soluong'];
      }
    }
    $quantity4s=array($price1s,$price2s,$price3s,$price4s,$price5s,$price6s,$price7s,$price8s,$price9s); 
    $quantity4s = json_encode($quantity4s);

     ?>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2" style="margin-bottom:10px">Tỉ lệ số lượng sách bán được theo Thể loại (%)</h3>
                                        <select name="sort" id="sort" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" style="margin-bottom: 20px">
                                            <option selected value="?&name=genres_chart&year=2022">Năm 2022</option>
                                            <option <?php if(isset($_GET['name']) && $_GET['name'] == "genres_chart" && $_GET['year'] == "2021") { ?> selected <?php } ?> 
                                    value="?&name=genres_chart&year=2021" data-year="2021" class="genres_chart">Năm 2021</option>
                                        </select>
                                           <div id="genres_chart"></div>
                                          <div id="legend" class="donut-legend"></div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Số sách bán được theo giá</h3>
                                        <select name="sort" id="sort" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" style="margin-bottom: 20px">
                                            <option selected value="?&name=price_chart&year=2022">Năm 2022</option>
                                            <option <?php if(isset($_GET['name']) && $_GET['name'] == "price_chart" && $_GET['year'] == "2021") { ?> selected <?php } ?> 
                                    value="?&name=price_chart&year=2021" data-year="2021" class="price_chart">Năm 2021</option>
                                        </select>
                                        <canvas id="singelBarChart"></canvas>
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
                                                <td style="text-align: center">
                                                    <?=$rowfvr['book_id']?>
                                                </td>
                                                <td style="text-align: left">
                                                    <?=$rowfvr['bname']?>
                                                </td>         
                                                <td style="text-align: center">
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
                                              <td style="text-align: center">Tên sách</td>
                                              <td style="text-align: center">Số lượng đã bán</td>
                                            </tr>
                                          </thead>
                                          <?php

                                          while ($rowsell=mysqli_fetch_array($topsell)) {
                                            ?>
                                                <tr id="table-row">
                                                  <td style="text-align: center">
                                                      <?=$rowsell['book_id']?>
                                                  </td>
                                                  <td style="text-align: left">
                                                      <?=$rowsell['btittle']?>
                                                  </td>         
                                                  <td style="text-align: center">
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
                                        $topbad = mysqli_query($con, "SELECT book_id,SUM(orders_details.quantity) AS tongsoluong, books.tittle AS btittle
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
                                              <td style="text-align: center">Tên sách</td>
                                              <td style="text-align: center">Số lượng đã bán</td>
                                            </tr>
                                          </thead>
                                          <?php

                                          while ($rowbad=mysqli_fetch_array($topbad)) {
                                            ?>
                                                <tr id="table-row">
                                                  <td style="text-align: center">
                                                      <?=$rowbad['book_id']?>
                                                  </td>
                                                  <td style="text-align: left">
                                                      <?=$rowbad['btittle']?>
                                                  </td>         
                                                  <td style="text-align: center">
                                                      <?=$rowbad['tongsoluong']?>
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
    

      // single bar chart
      try {
    var ctx = document.getElementById("singelBarChart");
    if (ctx) {
      ctx.height = 230;
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["<50k", "50-100k", "100-150k", "150-200k", "200-300k", "300-400k", "400-500k","500-1000k",">1000k"],
          datasets: [
            {
              label: "Số sách bán được",
              data: <?php echo $quantity4 ?> ,
              borderColor: "rgba(121, 14, 201, 0.9)",
              borderWidth: "0",
              backgroundColor: "rgba(121, 14, 201, 0.5)"
            },
            {
              label: "Số sách được yêu thích",
              data: <?php echo $quantity4s ?> ,
              borderColor: "rgba(223, 225, 6, 0.9)",
              borderWidth: "0",
              backgroundColor: "rgba(223, 225, 6, 0.5)"
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

    

// DONUT CHART
  var total = <?= $total['tongsoluong'] ?>;
   console.log(total);
  var donutChart = Morris.Donut({
    element: 'genres_chart',
    resize: true,
    data: [<?php echo $genres ?>],
     formatter: function (value, data) { 
     return Math.round(value/total*100) + '%'; 
    },
    colors: [
        'rgba(255,0,0,0.65)',
        'rgba(0,239,255,0.65)',
        'rgba(255,137,0,0.65)',
        'rgba(145,0,255,0.65)',
        'rgba(0,255,60,0.65)',
        'rgba(255,0,179,0.65)',
        'rgba(239,255,0,0.65)',
        'rgba(9,0,255,0.65)',
        'rgba(80,80,80,0.65)',
        'rgba(6,255,173,0.65)',
        'rgba(255,6,106,0.65)',
        'rgba(165,255,6,0.65)'
      ]
  });
    donutChart.options.data.forEach(function(label, i) {
      var legendItem = $('<span></span>').text( label['label'] + " ( " +label['value'] + " )" ).prepend('<span>&nbsp;</span>');
      legendItem.find('span')
        .css('backgroundColor', donutChart.options.colors[i])
        .css('width', '20px')
        .css('display', 'inline-block')
        .css('margin', '2px');
      $('#legend').append(legendItem)
    });


    </script>
    <?php } ?><!-- end else -->
</body>

</html>
<!-- end document-->
<style>
   * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
                
            }
    .donut-legend {
      font-size: 13px;
      display: grid;
      grid-template-columns: 1fr 1fr;
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

.au-card {
  overflow: scroll;
}
.table td {
  vertical-align: middle;
}
</style>