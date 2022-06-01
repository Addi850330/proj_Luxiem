</head>

<body>
    <!-- Navbar -->
    <nav>
        <div class="desktop-menu-list">
            <div class="logo">
                <a href="#" class="logo-link">
                    <img src="./imgs/Navbar/logo_Luxiem.png" alt="">
                </a>
            </div>

            <div class="mobile-btn">
                <span class="mobilebtn-1"></span>
                <span class="mobilebtn-2"></span>
                <span class="mobilebtn-3"></span>
            </div>

            <div class="nav-right">
                <ul class="list-unstyled d-flex align-items-center">
                    <li>
                        <a href="#">首頁</a>
                    </li> 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            人物介紹
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item nav-list" href="#">心理測驗</a>
                            <a class="dropdown-item nav-list" href="#">人物介紹</a>
                            <a class="dropdown-item nav-list" href="#">粉絲創作</a>
                            <a class="dropdown-item nav-list" href="#">出道歷程</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            迷因配件
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item nav-list" onclick="location.href='itemshop.php'" href="itemshop.php">配件購物</a>
                            <a class="dropdown-item nav-list" onclick="location.href='coinshop.php'" href="coinshop.php">代幣商店</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            直播首頁
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item nav-list" href="#">直播間</a>
                            <a class="dropdown-item nav-list" href="#">烤肉區</a>
                            <a class="dropdown-item nav-list" href="#">抖內區</a>
                            <a class="dropdown-item nav-list" href="#">時差換算</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            會員中心
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item nav-list" href="#">資料修改</a>
                            <a class="dropdown-item nav-list" href="#">訂單查詢</a>
                            <a class="dropdown-item nav-list" onclick="location.href='item-followed.php'" href="#">喜好收藏</a>
                            <a class="dropdown-item nav-list" href="#">持有配件</a>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="desktop-user">
                <div class="desktop-user-nav">
                    <a class="user-info" href="#">
                        <div class="user-imgwrap">
                            <img src="./imgs/Navbar/user_img.png" alt="">
                        </div>
                        <div class="user-name">Allen</div>
                        <div class="user-login">登出</div>
                        <div class="log-icon">
                            <i class="fa-solid fa-right-to-bracket"></i>
                        </div>
                    </a>

                    <a class="user-cart" href="#">
                        <div class="user-login">購物車</div>
                        <div class="log-icon">
                            <i class="fa-solid fa-cart-plus"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- 漢堡夾清單mobile_menu_list -->
    <div class="mobile-menu">
        <a class="user-info" href="#">
            <div class="user-imgwrap">
                <img src="./imgs/Navbar/user_img.png" alt="">
            </div>
            <div class="user-name">Allen</div>
            <div class="user-login">登出</div>
        </a>

        <div class="mobile-menu-list">
            <ul>
                <li class="mobile-menu-title-all">
                    <a class="mobile-menu-maintitle" href="#">首頁</a>
                </li>
                <li class="mobile-menu-title-all">
                    <a class="mobile-menu-maintitle" href="#">人物介紹</a>
                    <ul>
                        <li>
                            <a class="mobile-menu-subtitle" href="#">心理測驗</a>
                        </li>
                        <li>
                            <a class="mobile-menu-subtitle" href="#">人物介紹</a>
                        </li>
                        <li>
                            <a class="mobile-menu-subtitle" href="#">粉絲創作</a>
                        </li>
                        <li>
                            <a class="mobile-menu-subtitle" href="#">出道歷程</a>
                        </li>
                    </ul>
                </li>
                <li class="mobile-menu-title-all">
                    <a class="mobile-menu-maintitle" href="#">迷因配件</a>
                    <ul>
                        <li>
                            <a class="mobile-menu-subtitle" href="itemshop.php">配件購物</a>
                        </li>
                        <li>
                            <a class="mobile-menu-subtitle" href="coinshop.php">代幣商店</a>
                        </li>
                    </ul>
                </li>
                <li class="mobile-menu-title-all">
                    <a class="mobile-menu-maintitle" href="#">直播首頁</a>
                    <ul>
                        <li>
                            <a class="mobile-menu-subtitle" href="#">直播間</a>
                        </li>
                        <li>
                            <a class="mobile-menu-subtitle" href="#">烤肉區</a>
                        </li>
                        <li>
                            <a class="mobile-menu-subtitle" href="#">抖內區</a>
                        </li>
                        <li>
                            <a class="mobile-menu-subtitle" href="#">時差換算</a>
                        </li>
                    </ul>
                </li>
                <li class="mobile-menu-title-all">
                    <a class="mobile-menu-maintitle" href="#">會員中心</a>
                    <ul>
                        <li>
                            <a class="mobile-menu-subtitle" href="#">資料修改</a>
                        </li>
                        <li>
                            <a class="mobile-menu-subtitle" href="#">訂單查詢</a>
                        </li>
                        <li>
                            <a class="mobile-menu-subtitle" href="#">喜好收藏</a>
                        </li>
                        <li>
                            <a class="mobile-menu-subtitle" href="#">持有配件</a>
                        </li>
                    </ul>
                </li>
                <li class="mobile-menu-title-all">
                    <a class="mobile-menu-maintitle" href="#">討論區</a>
                    <ul>
                        <li>
                            <a class="mobile-menu-subtitle" href="#">文章列表</a>
                        </li>
                        <li>
                            <a class="mobile-menu-subtitle" href="#">發表文章</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="mobile-menu-footer">
            Copyright © 2022 Design by Team3rd. All Rights Reserved. <br>
            此網站僅用於資策會專題發表
        </div>
    </div>