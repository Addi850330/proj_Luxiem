<?php
require './parts/connect-db.php';
$pageName = 'forget-password-mail';
$title = '找回密碼-mail';

?>

<?php include __DIR__ . '/parts/html-head.php' ?>

<!-- 各個網頁所使用的css會放在這 -->
<link rel="stylesheet" href="./css/forget-password-email.css">
<link rel="stylesheet" href="./css/forget-password-email-rwd.css">

<?php include __DIR__ . '/parts/html-navbar.php' ?>

<!-- html會塞在這邊 -->
<section class="mc-bg">
        <div class="container">
            <div class="password-page-logo">
                <img src="./imgs/member-center/Luxiem.png" alt="">
            </div>
            <form action="">           
                <h4>找回密碼</h4>
                <p>輸入E-mail帳號</p>
                <div class="Icon-inside">
                    <i class="fa-regular fa-envelope"></i>
                    <input name="email" type="email" placeholder="" class="box" required>
                </div>
                <p>輸入驗證碼</p>
                <div class="Icon-inside">
                    <i class="fa-solid fa-lock"></i>
                    <input name="password" type="password" placeholder="" class="box" required>
                </div>
                <div class="verification-code">
                    <img src="./imgs/member-center/textdemo.png" alt="">
                    <a href="">更新驗證碼</a>
                </div>
                <div>
                    <input type="submit" value="確認" class="mc-btn" style="font-size: 20px;">
                </div>
            </form>
            <img src="./imgs/member-center/Polygon 4.png" class="small-polygon" alt="">
            <img src="./imgs/member-center/Polygon 5.png" class="big-polygon" alt="">
        </div>
        <div class="fond-password-img">
            <img class="password-img1" src="./imgs/member-center/mysta.png" alt="">
            <img class="password-img2" src="./imgs/member-center/mysta-hand.png" alt="">
        </div>
    </section>

<?php include __DIR__ . '/parts/html-script.php' ?>

<!-- 各個網頁所使用的javascript會放在這 -->
<!-- <script src="./js/jquery-3.6.0.js"></script>
<script src="./bootstrap-4.2.1-dist/js/bootstrap.bundle.js"></script> -->

<?php include __DIR__ . '/parts/html-last.php' ?>