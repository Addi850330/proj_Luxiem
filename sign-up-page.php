<?php
require './parts/connect-db.php';
$pageName = 'sign-up-page';
$title = '會員註冊';

?>





<?php include __DIR__ . '/parts/html-head.php' ?>

<link rel="stylesheet" href="./css/sign-up-page.css">
<link rel="stylesheet" href="./css/sign-up-page-rwd.css">

<?php include __DIR__ . '/parts/html-navbar-nologin.php' ?>

<!-- html會塞在這邊 -->
<section class="mc-bg">
    </div>
        <div class="container">
            <form name="form1" method="post" onsubmit="checkForm(); return false;">
                <svg class="mc-logo" width="50" height="49" viewBox="0 0 50 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25.0003 44.8904C36.5063 44.8904 45.8337 35.7549 45.8337 24.4857C45.8337 13.2165 36.5063 4.08105 25.0003 4.08105C13.4944 4.08105 4.16699 13.2165 4.16699 24.4857C4.16699 35.7549 13.4944 44.8904 25.0003 44.8904Z" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M30 12C31.1442 12.2843 32.1584 12.9299 32.8826 13.8352C33.6069 14.7405 34 15.854 34 17C34 18.146 33.6069 19.2595 32.8826 20.1648C32.1584 21.0701 31.1442 21.7157 30 22" stroke="#D3B572" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M39 35V32.615C38.9991 31.5581 38.6058 30.5314 37.8818 29.6961C37.1578 28.8608 36.1442 28.2642 35 28" stroke="#D3B572" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M21 22C23.7614 22 26 19.7614 26 17C26 14.2386 23.7614 12 21 12C18.2386 12 16 14.2386 16 17C16 19.7614 18.2386 22 21 22Z" stroke="#D3B572" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M31 35V32.3333C31 30.9188 30.4732 29.5623 29.5355 28.5621C28.5979 27.5619 27.3261 27 26 27H16C14.6739 27 13.4021 27.5619 12.4645 28.5621C11.5268 29.5623 11 30.9188 11 32.3333V35" stroke="#D3B572" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                             
                <table class="mc-link">
                    <tr>
                        <td class="sign-in"><a href="./sign-in-page.php">登入</a></td>
                        <td class="sign-up"><a href="./sign-up-page.php">註冊</a></td>
                    </tr>
                </table>
                <label class="sign-up-text" for="user_name" style="margin-bottom:0;"><span>*</span>設定暱稱</label>
                <div class="Icon-inside">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" placeholder="暱稱ID" class="box" id="user_name" name="user_name" require>
                </div>
                <p class="sign-up-text-hint" style="color:black ;">-</p>

                <label class="sign-up-text" for="user_email " style="margin-bottom:0;"><span>*</span>設定E-mail帳號</label>
                <div class="Icon-inside">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" placeholder="E-mail 信箱" class="box" id="user_email" name="user_email" require>
                </div>
                <p class="sign-up-text-hint">請以半形輸入，E-mail不能重複註冊</p>

                <label class="sign-up-text" for="user_password" style="margin-bottom:0;"><span>*</span>設定密碼</label>
                <div class="Icon-inside">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" placeholder="Password密碼" class="box" id="user_password" name="user_password" require>
                </div>
                <p class="sign-up-text-hint">請以半形輸入，8-15個大小寫英文與數字組合</p>

                <label class="sign-up-text" for="" style="margin-bottom:0;"><span>*</span>密碼確認</label>
                <div class="Icon-inside">
                    <i class="fa-solid fa-lock"></i>
                    <input name="" type="password" placeholder="Password密碼" class="box" id="" require>
                </div>
                <p class="sign-up-text-hint"  style="color:black ;">-</p>

                <label class="sign-up-text" for="user_mobile" style="margin-bottom:0;"><span>*</span>手機號碼</label>
                <div class="Icon-inside">
                    <i class="fa-solid fa-mobile-screen-button"></i>
                    <input name="user_mobile" type="text" placeholder="PhoneNumber" class="box" id="user_mobile" require>
                </div>
                <p class="sign-up-text-hint"  style="color:black ;">-</p>
                <div class="sign-up-btn">
                    <!-- <input type="submit" value="確認" class="mc-btn" style="font-size: 20px;"> -->
                    <button type="submit" class="mc-btn" style="font-size: 20px">確認</button>
                </div>
            </form>
            <img src="./imgs/member-center/Polygon 4.png" class="small-polygon" alt="">
            <img src="./imgs/member-center/Polygon 5.png" class="big-polygon" alt="">
            <div class="sign-in-footer">
                <p class="long-line"></p>
                <p><a href="">About us</a> | <a href="">Contect us</a></p>
                <p class="long-line"></p>
            </div>
        </div>
        <div class="sing-in-img">
            <div class="luxiem-logo">
                <img src="./imgs/member-center/Luxiem.png" alt="">
            </div>
            <div class="sign-in-logo">
                <img src="./imgs/member-center/sign-up.png" alt="">
            </div>
            <div class="sign-in-text">
                <h3>
                    Sign up
                </h3>
            </div>
            <div class="sign-in-img">
                <div class="sign-in-img1">
                    <img src="./imgs/member-center/liver-cropped_VoxAkuma.png" alt=""></div>
                <div class="sign-in-img2">
                    <img src="./imgs/member-center/drink.PNG" alt="">
                </div>
            </div>
        </div>
    </section>

<?php include __DIR__ . '/parts/html-script.php' ?>

<script>
function checkForm() {

   
    // AJAX
        $.post('sign-up-api.php', $(document.form1).serialize(), function(data) {
            console.log(data);
      
        }, 'json');
   

}
</script>

<?php include __DIR__ . '/parts/html-last.php' ?>