        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/Book-Icon.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                    <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-chart-bar"></i>Thống kê</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="statistic_sale.php">Thống kê doanh số</a>
                                </li>
                                <li>
                                    <a href="statistic_user.php">Thống kê người dùng</a>
                                </li>
                                <li>
                                    <a href="statistic_book.php">Thống kê sách</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="user.php">
                                <i class="fas fa-user"></i>User</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Product</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="book.php">Book</a>
                                </li>
                                <li>
                                    <a href="author.php">Author</a>
                                </li>
                                <li>
                                    <a href="genres.php">Genres</a>
                                </li>
                                <li>
                                    <a href="publisher.php">Publisher</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="order.php">
                                <i class="fas fa-shopping-cart"></i>Order</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>
                       
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="index.php">
                    <div style="display:flex; align-items:center;gap: 10px">
                        <img src="images/icon/Book-Icon.png" alt="Admin" style="width: 50px;height:auto;"/>
                        <p style="font-size:30px;font-weight: 600;color:#27ae60">ADMIN</p>
                    </div>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">

                    <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-chart-bar"></i>Thống kê</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="statistic_sale.php">Thống kê doanh số</a>
                                </li>
                                <li>
                                    <a href="statistic_user.php">Thống kê người dùng</a>
                                </li>
                                <li>
                                    <a href="statistic_book.php">Thống kê sách</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="user.php">
                                <i class="fas fa-user"></i>Quản lý thành viên</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tags"></i>Quản lý sản phẩm</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="book.php"><i class="fas fa-book"></i>Quản lý sách</a>
                                </li>
                                <li>
                                    <a href="author.php"><i class="fas fa-book"></i>Quản lý Tác giả</a>
                                </li>
                                <li>
                                    <a href="genres.php"><i class="fas fa-book"></i>Quản lý Thể loại</a>
                                </li>
                                <li>
                                    <a href="publisher.php"><i class="fas fa-book"></i>Quản lý Nhà xuất bản</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="order.php">
                                <i class="fas fa-shopping-cart"></i>Quản lý đơn hàng</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->