<?php 
    include 'header.php' ;

    //$books = mysqli_query($con, "SELECT books.* FROM `books`  ORDER BY `id` ASC " );

    $genres = mysqli_query($con, "SELECT * FROM genres ;  "); 
    $publisher = mysqli_query($con, "SELECT * FROM publishers ;  ");  
    $author = mysqli_query($con, "SELECT * FROM authors ;  ");  
    

    if( isset($_GET['genres_id'])|| isset($_GET['publisher_id']) || isset($_GET['sort_price']) || isset($_GET['author_id'])){
        // var_dump(1);exit;
        if( isset($_GET['genres_id'])){
            $genres_id = $_GET['genres_id'];
        // PHAN TRANG
            $orderConditon = "";  //  String chua dieu kien order : vd ORDER BY product.name ASC/DESC
            
            $where = "WHERE genres_id = $genres_id";
            $sortParam = "genres_id=".$genres_id."&";
            $param = "genres_id=".$genres_id."&";

            //Tìm kiếm
            $search = isset($_GET['tittle']) ? $_GET['tittle'] : "";// khoi tao bien search =rong hoac = get[name]
            if ($search) {//TRONG TH co FILTER
            $where .= "AND `tittle` LIKE '%" . $search . "%'";
            $param .= "tittle=".$search."&";      //noi chuoi param thanh dang : name="zzzzz"&
            $sortParam .=  "genres_id=".$genres_id."&tittle=".$search."&";  // noi chuoi sortParam voi order de ket hop
            }

            //Sắp xếp
            $orderField = isset($_GET['field']) ? $_GET['field'] : "";  // gan vs feild GET dc
            // var_dump($orderField);exit;
            $orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";     // gan voi orderSort GET duoc
            if(!empty($orderField) && !empty($orderSort)){
                if( $orderField == "price" ){
                    $orderConditon = "ORDER BY (`books`.`".$orderField."`- books.discount) ".$orderSort; // = ORDER BY product.name ASC/DESC
                    $param .= "field=".$orderField."&sort=".$orderSort."&";   // gan them orderField(name) va orderSort(asc,desc) vao chuoi phan trang
                } else {
              $orderConditon = "ORDER BY `books`.`".$orderField."` ".$orderSort; // = ORDER BY product.name ASC/DESC
              $param .= "field=".$orderField."&sort=".$orderSort."&";   // gan them orderField(name) va orderSort(asc,desc) vao chuoi phan trang
                }
            }

            $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 4;
            $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
            $offset = ($current_page - 1) * $item_per_page;
            if ($search) { // neu co search thi lot vao ham nay , ko thi lot vao duoi vs dk order
                $books = mysqli_query($con, "SELECT * 
                FROM `books` INNER JOIN `books_genres` ON books.id = books_genres.book_id 
                WHERE `genres_id` = $genres_id AND `tittle` LIKE '%" . $search . "%' ".$orderConditon."  
                LIMIT " . $item_per_page . " OFFSET " . $offset);

                $totalRecords = mysqli_query($con, "SELECT * FROM `books` INNER JOIN `books_genres` ON books.id = books_genres.book_id 
                WHERE `genres_id` = $genres_id AND `tittle` LIKE '%" . $search . "%'");
            } else {
            $books = mysqli_query($con, "SELECT * 
            FROM `books` INNER JOIN `books_genres` ON books.id = books_genres.book_id 
            WHERE `genres_id` = $genres_id
             ".$orderConditon."  LIMIT " . $item_per_page . " OFFSET " . $offset . " ");   // sau khi cap nhat va sd orderCondition

            $totalRecords = mysqli_query($con, "SELECT * FROM `books` INNER JOIN `books_genres` ON books.id = books_genres.book_id 
            WHERE `genres_id` = $genres_id ");
            }
            $totalRecords = $totalRecords->num_rows;
            $totalPages = ceil($totalRecords / $item_per_page);
            // $books = mysqli_query($con, "SELECT * FROM `books` ORDER BY `id` ASC LIMIT " . $item_per_page . " OFFSET " . $offset);


        } else if( isset($_GET['publisher_id'])) {
            $publisher_id = $_GET['publisher_id'];
        // PHAN TRANG
            $orderConditon = "";  //  String chua dieu kien order : vd ORDER BY product.name ASC/DESC
            
            $where = "WHERE publisher_id = $publisher_id";
            $sortParam = "publisher_id=".$publisher_id."&";
            $param = "publisher_id=".$publisher_id."&";

            //Tìm kiếm
            $search = isset($_GET['tittle']) ? $_GET['tittle'] : "";// khoi tao bien search =rong hoac = get[name]
            if ($search) {//TRONG TH co FILTER
            $where .= "AND `tittle` LIKE '%" . $search . "%'";
            $param .= "tittle=".$search."&";      //noi chuoi param thanh dang : name="zzzzz"&
            $sortParam .=  "tittle=".$search."&";  // noi chuoi sortParam voi order de ket hop
            }

            //Sắp xếp
            $orderField = isset($_GET['field']) ? $_GET['field'] : "";  // gan vs feild GET dc
            // var_dump($orderField);exit;
            $orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";     // gan voi orderSort GET duoc
            if(!empty($orderField) && !empty($orderSort)){
                if( $orderField == "price" ){
                    $orderConditon = "ORDER BY (`books`.`".$orderField."`- books.discount) ".$orderSort; // = ORDER BY product.name ASC/DESC
                    $param .= "field=".$orderField."&sort=".$orderSort."&";   // gan them orderField(name) va orderSort(asc,desc) vao chuoi phan trang
                } else {
              $orderConditon = "ORDER BY `books`.`".$orderField."` ".$orderSort; // = ORDER BY product.name ASC/DESC
              $param .= "field=".$orderField."&sort=".$orderSort."&";   // gan them orderField(name) va orderSort(asc,desc) vao chuoi phan trang
                }
            }

            $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 4;
            $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
            $offset = ($current_page - 1) * $item_per_page;
            if ($search) { // neu co search thi lot vao ham nay , ko thi lot vao duoi vs dk order
                $books = mysqli_query($con, "SELECT * 
                FROM `books` INNER JOIN `books_publishers` ON books.id = books_publishers.book_id 
                WHERE `publisher_id` = $publisher_id AND started_date = (SELECT MAX(started_date) FROM books_publishers WHERE `book_id` = books.id  AND started_date <=NOW() )
                 AND `tittle` LIKE '%" . $search . "%' ".$orderConditon."  
                LIMIT " . $item_per_page . " OFFSET " . $offset);

                $totalRecords = mysqli_query($con, "SELECT * FROM `books` INNER JOIN `books_publishers` ON books.id = books_publishers.book_id 
                WHERE `publisher_id` = $publisher_id AND started_date = (SELECT MAX(started_date) FROM books_publishers WHERE `book_id` = books.id  AND started_date <=NOW() )
                 AND `tittle` LIKE '%" . $search . "%'");
            } else {
            $books = mysqli_query($con, "SELECT * 
            FROM `books` INNER JOIN `books_publishers` ON books.id = books_publishers.book_id 
            WHERE `publisher_id` = $publisher_id AND started_date = (SELECT MAX(started_date) FROM books_publishers WHERE `book_id` = books.id  AND started_date <=NOW() )
             ".$orderConditon."  LIMIT " . $item_per_page . " OFFSET " . $offset . " ");   // sau khi cap nhat va sd orderCondition

            $totalRecords = mysqli_query($con, "SELECT * FROM `books` INNER JOIN `books_publishers` ON books.id = books_publishers.book_id 
            WHERE `publisher_id` = $publisher_id AND started_date = (SELECT MAX(started_date) FROM books_publishers WHERE `book_id` = books.id  AND started_date <=NOW() )");
            }
            $totalRecords = $totalRecords->num_rows;
            $totalPages = ceil($totalRecords / $item_per_page);
            // $books = mysqli_query($con, "SELECT * FROM `books` ORDER BY `id` ASC LIMIT " . $item_per_page . " OFFSET " . $offset);

        } else if( isset($_GET['author_id'])) { 
            $author_id = $_GET['author_id'];
            // PHAN TRANG
                $orderConditon = "";  //  String chua dieu kien order : vd ORDER BY product.name ASC/DESC
                
                $where = "WHERE author_id = $author_id";
                $sortParam = "author_id=".$author_id."&";
                $param = "author_id=".$author_id."&";
    
                //Tìm kiếm
                $search = isset($_GET['tittle']) ? $_GET['tittle'] : "";// khoi tao bien search =rong hoac = get[name]
                if ($search) {//TRONG TH co FILTER
                $where .= "AND `tittle` LIKE '%" . $search . "%'";
                $param .= "tittle=".$search."&";      //noi chuoi param thanh dang : name="zzzzz"&
                $sortParam .=  "tittle=".$search."&";  // noi chuoi sortParam voi order de ket hop
                }
    
                //Sắp xếp
                $orderField = isset($_GET['field']) ? $_GET['field'] : "";  // gan vs feild GET dc
                // var_dump($orderField);exit;
                $orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";     // gan voi orderSort GET duoc
                if(!empty($orderField) && !empty($orderSort)){
                    if( $orderField == "price" ){
                        $orderConditon = "ORDER BY (`books`.`".$orderField."`- books.discount) ".$orderSort; // = ORDER BY product.name ASC/DESC
                        $param .= "field=".$orderField."&sort=".$orderSort."&";   // gan them orderField(name) va orderSort(asc,desc) vao chuoi phan trang
                    } else {
                  $orderConditon = "ORDER BY `books`.`".$orderField."` ".$orderSort; // = ORDER BY product.name ASC/DESC
                  $param .= "field=".$orderField."&sort=".$orderSort."&";   // gan them orderField(name) va orderSort(asc,desc) vao chuoi phan trang
                    }
                }
    
                $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 4;
                $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
                $offset = ($current_page - 1) * $item_per_page;
                if ($search) { // neu co search thi lot vao ham nay , ko thi lot vao duoi vs dk order
                    $books = mysqli_query($con, "SELECT * 
                    FROM `books` INNER JOIN `books_authors` ON books.id = books_authors.book_id 
                    WHERE `author_id` = $author_id AND `tittle` LIKE '%" . $search . "%' ".$orderConditon."  
                    LIMIT " . $item_per_page . " OFFSET " . $offset);
    
                    $totalRecords = mysqli_query($con, "SELECT * FROM `books` INNER JOIN `books_authors` ON books.id = books_authors.book_id 
                    WHERE `author_id` = $author_id AND `tittle` LIKE '%" . $search . "%'");
                } else {
                $books = mysqli_query($con, "SELECT * 
                FROM `books` INNER JOIN `books_authors` ON books.id = books_authors.book_id 
                WHERE `author_id` = $author_id
                 ".$orderConditon."  LIMIT " . $item_per_page . " OFFSET " . $offset . " ");   // sau khi cap nhat va sd orderCondition
    
                $totalRecords = mysqli_query($con, "SELECT * FROM `books` INNER JOIN `books_authors` ON books.id = books_authors.book_id 
                WHERE `author_id` = $author_id ");
                }
                $totalRecords = $totalRecords->num_rows;
                $totalPages = ceil($totalRecords / $item_per_page);
                // $books = mysqli_query($con, "SELECT * FROM `books` ORDER BY `id` ASC LIMIT " . $item_per_page . " OFFSET " . $offset);            
        } else {
            // var_dump($_GET['sort_price']);exit;
            $sort_price = $_GET['sort_price'];

                // PHAN TRANG
                $orderConditon = "";  //  String chua dieu kien order : vd ORDER BY product.name ASC/DESC
                
                $where = "WHERE (price - discount) <= $sort_price ";
                $sortParam = "sort_price=".$sort_price."&";
                $param = "sort_price=".$sort_price."&";
    
                //Tìm kiếm
                $search = isset($_GET['tittle']) ? $_GET['tittle'] : "";// khoi tao bien search =rong hoac = get[name]
                if ($search) {//TRONG TH co FILTER
                $where .= "AND `tittle` LIKE '%" . $search . "%'";
                $param .= "tittle=".$search."&";      //noi chuoi param thanh dang : name="zzzzz"&
                $sortParam .=  "tittle=".$search."&";  // noi chuoi sortParam voi order de ket hop
                }
    
                //Sắp xếp
                $orderField = isset($_GET['field']) ? $_GET['field'] : "";  // gan vs feild GET dc
                // var_dump($orderField);exit;
                $orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";     // gan voi orderSort GET duoc
                if(!empty($orderField) && !empty($orderSort)){
                    if( $orderField == "price" ){
                        $orderConditon = "ORDER BY (`books`.`".$orderField."`- books.discount) ".$orderSort; // = ORDER BY product.name ASC/DESC
                        $param .= "field=".$orderField."&sort=".$orderSort."&";   // gan them orderField(name) va orderSort(asc,desc) vao chuoi phan trang
                    } else {
                  $orderConditon = "ORDER BY `books`.`".$orderField."` ".$orderSort; // = ORDER BY product.name ASC/DESC
                  $param .= "field=".$orderField."&sort=".$orderSort."&";   // gan them orderField(name) va orderSort(asc,desc) vao chuoi phan trang
                    }
                }else {
                    $orderConditon = "ORDER BY (price-discount) DESC";
                }
    
                $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 8;
                $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
                $offset = ($current_page - 1) * $item_per_page;
                if ($search) { // neu co search thi lot vao ham nay , ko thi lot vao duoi vs dk order
                    $books = mysqli_query($con, "SELECT * 
                    FROM `books` 
                    WHERE (price-discount) <= $sort_price AND `tittle` LIKE '%" . $search . "%' ".$orderConditon."  
                    LIMIT " . $item_per_page . " OFFSET " . $offset);
    
                    $totalRecords = mysqli_query($con, "SELECT * FROM `books`
                    WHERE (price-discount) <= $sort_price AND `tittle` LIKE '%" . $search . "%'");
                } else {
                $books = mysqli_query($con, "SELECT * 
                FROM `books` 
                WHERE (price-discount) <= $sort_price
                 ".$orderConditon."  LIMIT " . $item_per_page . " OFFSET " . $offset . " ");   // sau khi cap nhat va sd orderCondition
    
                $totalRecords = mysqli_query($con, "SELECT * FROM `books` 
                WHERE (price-discount) <= $sort_price ");
                }
                $totalRecords = $totalRecords->num_rows;
                $totalPages = ceil($totalRecords / $item_per_page);
                // $books = mysqli_query($con, "SELECT * FROM `books` ORDER BY `id` ASC LIMIT " . $item_per_page . " OFFSET " . $offset);
    

        }



    } else {

        // PHAN TRANG
            $param = "";          // khoi tao bien param la chuoi trong filter de gan vs perpage va page
            $sortParam = "";      // khoi tao sortParam la chuoi trong filter ket hop vs order
            $orderConditon = "";  //  String chua dieu kien order : vd ORDER BY product.name ASC/DESC
        //Tìm kiếm
        $search = isset($_GET['tittle']) ? $_GET['tittle'] : "";// khoi tao bien search =rong hoac = get[name]
        if ($search) {//TRONG TH co FILTER
        $where = "WHERE `tittle` LIKE '%" . $search . "%'";
        $param .= "tittle=".$search."&";      //noi chuoi param thanh dang : name="zzzzz"&
        $sortParam .=  "tittle=".$search."&";  // noi chuoi sortParam voi order de ket hop
        }

        //Sắp xếp
        $orderField = isset($_GET['field']) ? $_GET['field'] : "";  // gan vs feild GET dc
        // var_dump($orderField);exit;
        $orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";     // gan voi orderSort GET duoc
        if(!empty($orderField) && !empty($orderSort)){
            if( $orderField == "price" ){
                $orderConditon = "ORDER BY (`books`.`".$orderField."`- books.discount) ".$orderSort; // = ORDER BY product.name ASC/DESC
                $param .= "field=".$orderField."&sort=".$orderSort."&";   // gan them orderField(name) va orderSort(asc,desc) vao chuoi phan trang
            } else {
          $orderConditon = "ORDER BY `books`.`".$orderField."` ".$orderSort; // = ORDER BY product.name ASC/DESC
          $param .= "field=".$orderField."&sort=".$orderSort."&";   // gan them orderField(name) va orderSort(asc,desc) vao chuoi phan trang
            }
        }

        $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 12;
        $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;
        if ($search) { // neu co search thi lot vao ham nay , ko thi lot vao duoi vs dk order
            $books = mysqli_query($con, "SELECT * FROM `books` WHERE `tittle` LIKE '%" . $search . "%' ".$orderConditon."  LIMIT " . $item_per_page . " OFFSET " . $offset);
            $totalRecords = mysqli_query($con, "SELECT * FROM `books` WHERE `tittle` LIKE '%" . $search . "%'");
        } else {
        $books = mysqli_query($con, "SELECT * FROM `books` ".$orderConditon."  LIMIT " . $item_per_page . " OFFSET " . $offset . " ");   // sau khi cap nhat va sd orderCondition
        $totalRecords = mysqli_query($con, "SELECT * FROM `books`");
        }
        $totalRecords = $totalRecords->num_rows;
        $totalPages = ceil($totalRecords / $item_per_page);
        // $books = mysqli_query($con, "SELECT * FROM `books` ORDER BY `id` ASC LIMIT " . $item_per_page . " OFFSET " . $offset);

    }
?>

<?php //var_dump($sortParam);exit; ?>
        <link rel="stylesheet" href="./assets/css/book.css">
        <link rel="stylesheet" href="./assets/js/book.js">


        <div class="container">
            <div class="bg-white rounded d-flex align-items-center justify-content-between" id="header"> <button class="btn btn-hide text-uppercase" type="button" data-toggle="collapse" data-target="#filterbar" aria-expanded="false" aria-controls="filterbar" id="filter-btn" onclick="changeBtnTxt()"> <span class="fas fa-angle-left" id="filter-angle"></span> <span id="btn-txt">Filters</span> </button>
                <nav class="navbar navbar-expand-lg navbar-light pl-lg-0 pl-auto"> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynav" aria-controls="mynav" aria-expanded="false" aria-label="Toggle navigation" onclick="chnageIcon()" id="icon"> <span class="navbar-toggler-icon"></span> </button>
                    <div class="collapse navbar-collapse" id="mynav">
                        <ul class="navbar-nav d-lg-flex align-items-lg-center">
                            <li class="nav-item active" style="border:1px solid #777;margin-left:0.5rem">
                                <form id="book-search" method="GET">
                                    <?php if ( isset($_GET['genres_id'])|| isset($_GET['publisher_id']) ){?>
                                        <input style="width:300px;" type="text" value="<?=isset($_GET['tittle']) ? $_GET['tittle'] : ""?>" name="tittle" placeholder="Nhập tên sách" />
                                        <input type="submit" value="Tìm kiếm" class="btn btn-secondary"/>
                                    <?php } else { ?>
                                        <input style="width:300px;" type="text" value="<?=isset($_GET['tittle']) ? $_GET['tittle'] : ""?>" name="tittle" placeholder="Nhập tên sách" />
                                        <input type="submit" value="Tìm kiếm" class="btn btn-secondary"/>
                                    <?php } ?>    
                                </form>
                            </li>

                            <li class="nav-item active" style="border:1px solid #777;margin-left:0.5rem"> 
                                <select name="sort" id="sort" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                    <option value="" hidden selected>Sắp xếp theo</option>
                                        <!-- selected: thuoc tinh html khi click vao thi the do van hien thi value do  -->
                                        <option <?php if( isset($_GET['sort']) && $_GET['field'] == "price" && $_GET['sort'] == "desc") { ?> selected <?php } ?>
                                         value="?<?=$sortParam?>field=price&sort=desc">Giá giảm dần</option>

                                        <!-- Neu TON TAI sortParam(1 str khac cua search) thi se KET HOP ca dk search va order -->
                                        <option <?php if((isset($_GET['sort']) && $_GET['field']) =="price" && $_GET['sort'] == "asc") { ?> selected <?php } ?>
                                         value="?<?=$sortParam?>field=price&sort=asc">Giá tăng dần</option>
                                        
                                         <option <?php if(isset($_GET['sort']) && $_GET['field'] == "created_date" && $_GET['sort'] == "desc") { ?> selected <?php } ?> 
                                         value="?<?=$sortParam?>field=created_date&sort=desc">Mới nhất</option>
                                         
                                         <!-- Neu TON TAI sortParam(1 str khac cua search) thi se KET HOP ca dk search va order -->
                                        <option <?php if(isset($_GET['sort']) && ($_GET['field'])== "created_date" && $_GET['sort'] == "asc") { ?> selected <?php } ?> 
                                        value="?<?=$sortParam?>field=created_date&sort=asc">Cũ nhất</option>                                        
                                </select> 
                            </li>
                            <li class="nav-item d-lg-none d-inline-flex"> </li>
                        </ul>
                    </div>
                </nav>
                <div class="ml-auto mt-3 mr-2">
                    <nav aria-label="Page navigation example">
                        <!-- top pagination -->
                        <ul class="pagination">
                            <?php 
                            if($current_page > 3){
                            	$first_page = 1;?>
                            	<a class="page-item" href="?<?=$param?>per_page=<?=$item_per_page?>&page=<?=$first_page?>">First</a>
                            <?php }
                            if($current_page > 1){
                            	$prev_page = $current_page - 1;?>
                            	<a class="page-item"  aria-label="Previous" href="?<?=$param?>per_page=<?=$item_per_page?>&page=<?=$prev_page?>" ><span aria-hidden="true" class="font-weight-bold">&lt;</span> <span class="sr-only">Previous</span></a>
                            <?php }
                            for($num = 1; $num <= $totalPages; $num++){?>
                            	<?php if($num != $current_page){ ?>
                            		<?php if($num >  $current_page - 3 && $num < $current_page + 3){?>
                            			<a class="page-item" href="?<?=$param?>per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a>
                            		<?php } ?>
                            	<?php }else{ ?>
                            		<strong class="current-page page-item"><?=$num?></strong>
                            	<?php } ?>
                            <?php }
                            if($current_page < $totalPages - 1){
                            	$next_page = $current_page + 1;?>
                            	<a class="page-item" href="?<?=$param?>per_page=<?=$item_per_page?>&page=<?=$next_page?>"><span aria-hidden="true" class="font-weight-bold">&gt;</span> <span class="sr-only">Next</span></a>
                            <?php }
                            if($current_page <= $totalPages - 3){
                            	$end_page = $totalPages;?>
                            	<a class="page-item" href="?<?=$param?>per_page=<?=$item_per_page?>&page=<?=$end_page?>">Last</a>
                            	<?php 
                            }
                            ?>                  
                        </ul>
                    </nav>
                </div>
            </div>
            
            <div id="content" class="my-5">
                
                <div id="filterbar" class="collapse">
                    <div class="box border-bottom">
                        <div class="form-group text-center">
                            <div class="btn-group" data-toggle="buttons">
                                <input class=" btn btn-success" type="submit" value="Apply">
                            </div>
                        </div>
                    </div>

                    <div class="box border-bottom">
                        <div class="box-label text-uppercase d-flex align-items-center">Thể loại<button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#inner-box" aria-expanded="false" aria-controls="inner-box" id="out" onclick="outerFilter()"> <span class="fas fa-plus"></span> </button> </div>
                        <div id="inner-box" class="collapse mt-2 mr-1">
                            <?php while( $row1 = mysqli_fetch_array($genres) ){ ?>
                                <div class="my-1"> <a href="./book.php?genres_id=<?=$row1['id']?>"><?=$row1['name']?></a> </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="box border-bottom">
                        <div class="box-label text-uppercase d-flex align-items-center">Nhà xuất bản<button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#inner-box2" aria-expanded="false" aria-controls="inner-box2"><span class="fas fa-plus"></span></button> </div>
                        <div id="inner-box2" class="collapse mt-2 mr-1">
                            <?php while( $row2 = mysqli_fetch_array($publisher) ){ ?>
                                <div class="my-1"> <a href="./book.php?publisher_id=<?=$row2['id']?>"><?=$row2['name']?></a> </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="box border-bottom">
                        <div class="box-label text-uppercase d-flex align-items-center">Tác giả<button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#inner-box3" aria-expanded="false" aria-controls="inner-box3"><span class="fas fa-plus"></span></button> </div>
                        <div id="inner-box3" class="collapse mt-2 mr-1">
                            <?php while( $row3 = mysqli_fetch_array($author) ){ ?>
                                <div class="my-1"> <a href="./book.php?author_id=<?=$row3['id']?>"><?=$row3['name'] ?></a> </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-label text-uppercase d-flex align-items-center">Giá<button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#size" aria-expanded="false" aria-controls="size"><span class="fas fa-plus"></span></button> </div>
                        <div id="size" class="collapse">
                            <div class="btn-group d-flex align-items-center flex-wrap">
                                <label><a href="./book.php?sort_price=50000">< 50.000</a></label> 
                                <label><a href="./book.php?sort_price=100000">< 100.000</a></label>
                                <label><a href="./book.php?sort_price=150000">< 150.000</a></label> 
                                <label><a href="./book.php?sort_price=200000">< 200.000</a></label> 
                                <label><a href="./book.php?sort_price=300000">< 300.000</a> </label> 
                                <label><a href="./book.php?sort_price=400000">< 400.000</a> </label> 
                                <label><a href="./book.php?sort_price=500000">< 500.000</a> </label> 
                                <label><a href="./book.php?sort_price=1000000">< 1.000.000</a> </label> 
                                <label><a href="./book.php?sort_price=999999999">> 1.000.000</a> </label> 
                            </div>
                        </div>
                    </div>
                </div>

                <div id="products">
            <?php if(isset($_GET['genres_id'])){ 
                $sort_genres = mysqli_query($con, "SELECT * FROM genres WHERE id = $genres_id ;  ");     
                $sort_genres = mysqli_fetch_assoc($sort_genres) ;
            ?>
                    <h2>Tìm kiếm theo thể loại: <?= $sort_genres['name'] ?></h2>

            <?php } else if( isset($_GET['publisher_id'])) {
                $sort_publisher = mysqli_query($con, "SELECT * FROM publishers WHERE id = $publisher_id ;  ");     
                $sort_publisher = mysqli_fetch_assoc($sort_publisher) ;    
            ?>
                    <h2>Tìm kiếm theo Nhà xuất bản: <?= $sort_publisher['name'] ?></h2>
                
            <?php } else if( isset($_GET['sort_price']) ){ ?>
                <h2>Tìm kiếm theo giá < <?= $sort_price ?></h2>

            <?php } else if( isset($_GET['author_id'])){ 
                $sort_author = mysqli_query($con, "SELECT * FROM authors WHERE id = $author_id ;  ");     
                $sort_author = mysqli_fetch_assoc($sort_author) ;         
            ?>
                <h2>Tìm kiếm theo tác giả: <?= $sort_author['name']?></h2>

            <?php } ?>
            
                    <div class="row mx-0">
                <?php
                  while ($row = mysqli_fetch_array($books)) {
                        // đặt biến $row_id để sau này gọi trong mysqli khôn gbị lỗi
                        $row_id = $row['id'];
                ?>
                        <div class="col-lg-3 col-md-6 pt-md-4 pt-3">
                            <div class="card d-flex flex-column">
                                <a href="book_detail.php?id=<?= $row['id'] ?>" class="card-img" > <img src="<?= $row['image'] ?>" alt=""> </a>
                                <a href="book_detail.php?id=<?= $row['id'] ?>" class="product-name" style="font-size:1.4rem;"><?= $row['tittle'] ?></a>
                                <div class="card-info" style="margin-top: 0.5rem;">
                                    <div class="text-muted mt-auto">
                                        <?php
                                        $author = mysqli_query($con, "SELECT authors.name
                                                                    FROM `books_authors`  INNER JOIN `authors` ON books_authors.author_id = authors.id
                                                                                        INNER JOIN `books` ON books_authors.book_id = books.id
                                                                    WHERE `books_authors`.`book_id` = $row_id                    
                                                                                  ");  
                                        while ($row2 = mysqli_fetch_array($author)){ ?>
                                            <a href="" style="font-size: 1.2rem;color:#219150;"><?= $row2['name'].","?></a>
                                        <?php } ?>
                                    </div>

                                    <div class="d-flex price">
                                        <p class="price" style="margin-top: 0.6rem; font-weight: 600; font-size: 20px;color: #f33f3f;"><?= number_format($row['price']-$row['discount'], 0, ",", ".") ?>đ<span><?=number_format($row['price'], 0, ",", ".") ?>đ</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php } ?>
                    </div>

                </div>
                <?php
                //bottom-pagination
                    include './pagination.php';
                ?>
            </div>
        </div><!-- end container -->


        <script src="./vendor/jquery/jquery.min.js"></script>
        <script src="./vendor/jquery/jquery.slim.min.js"></script>
        <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
        <script type='text/javascript' src=''></script>
        <script type='text/javascript' src=''></script>
        <script src="./assets/js/header.js"></script>

        </div>
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