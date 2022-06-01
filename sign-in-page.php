<?php

//SELECT * FROM `members` WHERE `user_email`='allen123@gmail.com' AND `user_password`=SHA1('123456')

require './parts/connect-db.php';
$pageName = 'sign-in-page';
$tite = '會員登入';


?>

<?php include __DIR__ . '/parts/html-head.php' ?>

    <link rel="stylesheet" href="./css/sign-in-page.css">
    <link rel="stylesheet" href="./css/sign-in-page-rwd.css">

<?php include __DIR__ . '/parts/html-navbar-nologin.php' ?>

<!-- html會塞在這邊 -->
<section class="mc-bg">
        <div class="container">
            <form name="form1" method="post" onsubmit="checkForm(); return false;" novalidate>
                <svg class="mc-logo" width="50" height="49" viewBox="0 0 50 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M35.8085 36.5573V33.9306C35.8085 32.5374 35.2249 31.2011 34.1861 30.2159C33.1473 29.2307 31.7384 28.6772 30.2692 28.6772H19.1907C17.7215 28.6772 16.3126 29.2307 15.2738 30.2159C14.235 31.2011 13.6514 32.5374 13.6514 33.9306V36.5573" stroke="#D3B572" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M24.7307 23.3526C27.79 23.3526 30.27 20.9688 30.27 18.0282C30.27 15.0876 27.79 12.7038 24.7307 12.7038C21.6714 12.7038 19.1914 15.0876 19.1914 18.0282C19.1914 20.9688 21.6714 23.3526 24.7307 23.3526Z" stroke="#D3B572" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M25.0003 44.8903C36.5063 44.8903 45.8337 35.7548 45.8337 24.4856C45.8337 13.2164 36.5063 4.08093 25.0003 4.08093C13.4944 4.08093 4.16699 13.2164 4.16699 24.4856C4.16699 35.7548 13.4944 44.8903 25.0003 44.8903Z" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                    
                <table class="mc-link">
                    <tr>
                        <td class="sign-in"><a href="./sign-in-page.php">登入</a></td>
                        <td class="sign-up"><a href="./sign-up-page.php">註冊</a></td>
                    </tr>
                </table>
                <label class="sign-up-text" for="user_email"></label>
                <div class="Icon-inside">
                    <i class="fa-regular fa-envelope"></i>
                    <input name="user_email" type="email" placeholder="E-mail信箱" class="box" id="user_email">
                </div>
                <label class="sign-up-text" for="user_password"></label>
                <div class="Icon-inside">
                    <i class="fa-solid fa-lock"></i>
                    <input name="user_password" type="password" placeholder="Password密碼" class="box" id="user_password">
                </div>
                <label class="" for="" style="margin-bottom:0;"></label>
                <div>
                    <button type="submit" value="登入" class="mc-btn" style="font-size: 20px;">登入</button>
                    <!-- <input type="submit" value="登入" class="mc-btn" style="font-size: 20px;"> -->
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
                <img src="./imgs/member-center/sign-in.png" alt="">
            </div>
            <div class="sign-in-text">
                <h3>
                    Sign in
                </h3>
            </div>
            <div class="sign-in-img">
                <div class="sign-in-img1">
                    <img src="./imgs/member-center/liver-cropped_IkeEveland.png" alt=""></div>
                <div class="sign-in-img2">
                    <img src="./imgs/member-center/swedish class (1).png" alt="">
                </div>
            </div>
        </div>
    </section>

<?php include __DIR__ . '/parts/html-script.php' ?>
  
    <script>
 function checkForm() {

// TODO: 檢查欄位資料.

let isPass = true; // 有沒有通過檢查

if (!$('#user_email').val().trim() || !$('#user_password').val().trim()) {  //如果 沒有填寫信箱 或 沒有填寫密碼 （.trim()是去掉頭尾空白）
    isPass = false;

    alert('兩個欄位都要填寫');
}


// AJAX
if (isPass) {
    $.post('sign-in-api.php', $(document.form1).serialize(), function(data) {
        console.log(data);
        if (data.success) {
            alert('登入成功');
            location.href = 'merber-center.php'; //登入成功時轉向到首頁
        } else {
            alert(data.error || '登入失敗');
        }
    }, 'json');
}
}
    </script>
    


<?php include __DIR__ . '/parts/html-last.php' ?>