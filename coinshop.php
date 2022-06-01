<?php
session_start();
require './parts/connect-db.php';
$pageName = 'coinshop';
$title = '代幣商店頁';



?>

<?php include __DIR__ . '/parts/html-head.php' ?>
<!-- 這邊放其他css link -->
<link rel="stylesheet" href="./css/Vtuber_main.css">
<?php include __DIR__ . '/parts/html-navbar.php' ?>


<!-- 代幣商店頁 登入獎勵光箱頁--------------- -->
<div class="mission-login">
    <div class="mission-login-wrap">
        <div class="mission-login-name d-flex justify-content-center align-items-center">
            <svg width="47" height="47" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.3928 3.91666H31.6078L43.0837 15.3925V31.6075L31.6078 43.0833H15.3928L3.91699 31.6075V15.3925L15.3928 3.91666Z" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M23.5 15.6667V23.5" stroke="#D3B572" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M23.5 31.3333H23.5196" stroke="#D3B572" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <p>領取登入獎勵</p>
        </div>

        <div class="mission-login-text">
            歡迎回來～ <br>
            恭喜完成每日登入任務，已發送25個銀幣囉！
        </div>

        <div class="mission-login-main">
            <!-- 按鈕 -->
            <div class="mission-login-btn">
                <div class="checkout">
                    <button class="">確定</button>
                </div>
            </div>

        </div>

        <!-- 關閉叉叉按鈕 -->
        <!-- <div class="mission-login-close">
                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25.5 8.5L8.5 25.5" stroke="#667080" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M8.5 8.5L25.5 25.5" stroke="#667080" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div> -->
    </div>
</div>




<!-- ---代幣商店頁--------------------------------- -->
<section class="coinshop">
    <div class="freecoin-mission-title d-flex align-items-center">
        <h3 class="freecoin-mission-title-en">Free coins</h3>
        <h3 class="freecoin-mission-title-tc">免費銀幣</h3>
    </div>
    <br>

    <!-- 代幣商店 3D輪播牆 -->
    <section id="carousel">
        <input type="radio" name="slider" id="s1">
        <input type="radio" name="slider" id="s2">
        <input type="radio" name="slider" id="s3" checked>
        <input type="radio" name="slider" id="s4">
        <input type="radio" name="slider" id="s5">

        <label for="s1" id="slider1">
            <img class="mission-card" src="./imgs/Coinshop/freecoin_mission_luca1.png" alt="" width="100%" height="100%">
        </label>
        <label for="s2" id="slider2">
            <img class="mission-card" src="./imgs/Coinshop/freecoin_mission_shu1.png" alt="" width="100%" height="100%">
        </label>
        <label class="mission-card-login" for="s3" id="slider3">
            <div class="complete-imgwrap complete-login">
                <img src="./imgs/Coinshop/mission_complete.png" alt="">
            </div>
            <img class="mission-card" src="./imgs/Coinshop/freecoin_mission_ike1.png" alt="" width="100%" height="100%">
        </label>
        <label for="s4" id="slider4">
            <div class="complete-imgwrap">
                <img src="./imgs/Coinshop/mission_complete.png" alt="">
            </div>
            <img class="mission-card" src="./imgs/Coinshop/freecoin_mission_vox1.png" alt="" width="100%" height="100%">
        </label>
        <label for="s5" id="slider5">
            <img class="mission-card" src="./imgs/Coinshop/freecoin_mission_mysta1.png" alt="" width="100%" height="100%">
        </label>
    </section>

    <!-- Your coins -->
    <div class="coinshop-yourcoins">
        <h3>Your coins</h3>
        <div class="coinshop-yourcoin-type d-flex">
            <div class="coinshop-yourcoin-type-gold d-flex">
                <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 13.3334V6.66675C17.4997 6.37448 17.4225 6.08742 17.2763 5.83438C17.13 5.58134 16.9198 5.37122 16.6667 5.22508L10.8333 1.89175C10.58 1.74547 10.2926 1.66846 10 1.66846C9.70744 1.66846 9.42003 1.74547 9.16667 1.89175L3.33333 5.22508C3.08022 5.37122 2.86998 5.58134 2.72372 5.83438C2.57745 6.08742 2.5003 6.37448 2.5 6.66675V13.3334C2.5003 13.6257 2.57745 13.9127 2.72372 14.1658C2.86998 14.4188 3.08022 14.6289 3.33333 14.7751L9.16667 18.1084C9.42003 18.2547 9.70744 18.3317 10 18.3317C10.2926 18.3317 10.58 18.2547 10.8333 18.1084L16.6667 14.7751C16.9198 14.6289 17.13 14.4188 17.2763 14.1658C17.4225 13.9127 17.4997 13.6257 17.5 13.3334Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="coinshop-yourcoin-type-gold-number">80</div>
            </div>

            <div class="coinshop-yourcoin-type-free d-flex">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.99984 18.3334C14.6022 18.3334 18.3332 14.6025 18.3332 10.0001C18.3332 5.39771 14.6022 1.66675 9.99984 1.66675C5.39746 1.66675 1.6665 5.39771 1.6665 10.0001C1.6665 14.6025 5.39746 18.3334 9.99984 18.3334Z" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12.5 7.5H7.5V12.5H12.5V7.5Z" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <div class="coinshop-yourcoin-type-free-number">1200</div>
            </div>
        </div>
    </div>

    <!-- 金幣禮包 -->
    <div class="goldcoin-title d-flex align-items-center">
        <h3 class="goldcoin-title-en">Gold coins</h3>
        <h3 class="goldcoin-title-tc">金幣禮包</h3>
    </div>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <!-- 第一排 -->
            <div class="coinshop-gold-package-row coinshop-gold-package-row-no1 d-flex">
                <div class="coinshop-gold-package-unit">
                    <div class="coinshop-gold-package-unit-imgwrap">
                        <img src="./imgs/Coinshop/coinshop_gold_deco.png" alt="">
                        <div class="coinshop-gold-package-unit-goldnumber-wrap">
                            <div class="coinshop-gold-package-unit-goldnumber">+100</div>
                            <svg viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_593_2198)">
                                    <path d="M14.8209 11.1896V5.67722C14.8206 5.43556 14.757 5.19821 14.6365 4.98898C14.516 4.77975 14.3427 4.60601 14.1342 4.48518L9.32734 1.729C9.11856 1.60805 8.88173 1.54437 8.64065 1.54437C8.39958 1.54437 8.16274 1.60805 7.95396 1.729L3.14714 4.48518C2.93857 4.60601 2.76533 4.77975 2.6448 4.98898C2.52427 5.19821 2.4607 5.43556 2.46045 5.67722V11.1896C2.4607 11.4312 2.52427 11.6686 2.6448 11.8778C2.76533 12.087 2.93857 12.2608 3.14714 12.3816L7.95396 15.1378C8.16274 15.2587 8.39958 15.3224 8.64065 15.3224C8.88173 15.3224 9.11856 15.2587 9.32734 15.1378L14.1342 12.3816C14.3427 12.2608 14.516 12.087 14.6365 11.8778C14.757 11.6686 14.8206 11.4312 14.8209 11.1896Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_593_2198">
                                        <rect width="16.4805" height="16.5371" fill="white" transform="translate(0.400391 0.164856)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>

                        <div class="coinshop-gold-package-unit-ntd-wrap">
                            <div class="coinshop-gold-package-unit-ntd">NT$</div>
                            <div class="coinshop-gold-package-unit-ntd-price">50</div>
                        </div>

                        <div class="coinshop-gold-package-unit-deco-imgwrap">
                            <img src="./imgs/Coinshop/gold_package_deco1.png" alt="">
                        </div>
                    </div>
                </div>

                <div class="coinshop-gold-package-unit">
                    <div class="coinshop-gold-package-unit-imgwrap">
                        <img src="./imgs/Coinshop/coinshop_gold_deco.png" alt="">
                        <div class="coinshop-gold-package-unit-goldnumber-wrap">
                            <div class="coinshop-gold-package-unit-goldnumber">+180</div>
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_593_2198)">
                                    <path d="M14.8209 11.1896V5.67722C14.8206 5.43556 14.757 5.19821 14.6365 4.98898C14.516 4.77975 14.3427 4.60601 14.1342 4.48518L9.32734 1.729C9.11856 1.60805 8.88173 1.54437 8.64065 1.54437C8.39958 1.54437 8.16274 1.60805 7.95396 1.729L3.14714 4.48518C2.93857 4.60601 2.76533 4.77975 2.6448 4.98898C2.52427 5.19821 2.4607 5.43556 2.46045 5.67722V11.1896C2.4607 11.4312 2.52427 11.6686 2.6448 11.8778C2.76533 12.087 2.93857 12.2608 3.14714 12.3816L7.95396 15.1378C8.16274 15.2587 8.39958 15.3224 8.64065 15.3224C8.88173 15.3224 9.11856 15.2587 9.32734 15.1378L14.1342 12.3816C14.3427 12.2608 14.516 12.087 14.6365 11.8778C14.757 11.6686 14.8206 11.4312 14.8209 11.1896Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_593_2198">
                                        <rect width="16.4805" height="16.5371" fill="white" transform="translate(0.400391 0.164856)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>

                        <div class="coinshop-gold-package-unit-ntd-wrap">
                            <div class="coinshop-gold-package-unit-ntd">NT$</div>
                            <div class="coinshop-gold-package-unit-ntd-price">80</div>
                        </div>

                        <div class="coinshop-gold-package-unit-deco-imgwrap2">
                            <img src="./imgs/Coinshop/gold_package_deco2.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- 第二排 -->
            <div class="coinshop-gold-package-row coinshop-gold-package-row-no2 d-flex">
                <div class="coinshop-gold-package-unit">
                    <div class="coinshop-gold-package-unit-imgwrap">
                        <img src="./imgs/Coinshop/coinshop_gold_deco.png" alt="">
                        <div class="coinshop-gold-package-unit-goldnumber-wrap">
                            <div class="coinshop-gold-package-unit-goldnumber">+300</div>
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_593_2198)">
                                    <path d="M14.8209 11.1896V5.67722C14.8206 5.43556 14.757 5.19821 14.6365 4.98898C14.516 4.77975 14.3427 4.60601 14.1342 4.48518L9.32734 1.729C9.11856 1.60805 8.88173 1.54437 8.64065 1.54437C8.39958 1.54437 8.16274 1.60805 7.95396 1.729L3.14714 4.48518C2.93857 4.60601 2.76533 4.77975 2.6448 4.98898C2.52427 5.19821 2.4607 5.43556 2.46045 5.67722V11.1896C2.4607 11.4312 2.52427 11.6686 2.6448 11.8778C2.76533 12.087 2.93857 12.2608 3.14714 12.3816L7.95396 15.1378C8.16274 15.2587 8.39958 15.3224 8.64065 15.3224C8.88173 15.3224 9.11856 15.2587 9.32734 15.1378L14.1342 12.3816C14.3427 12.2608 14.516 12.087 14.6365 11.8778C14.757 11.6686 14.8206 11.4312 14.8209 11.1896Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_593_2198">
                                        <rect width="16.4805" height="16.5371" fill="white" transform="translate(0.400391 0.164856)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>

                        <div class="coinshop-gold-package-unit-ntd-wrap">
                            <div class="coinshop-gold-package-unit-ntd">NT$</div>
                            <div class="coinshop-gold-package-unit-ntd-price">120</div>
                        </div>

                        <div class="coinshop-gold-package-unit-deco-imgwrap3">
                            <img src="./imgs/Coinshop/gold_package_deco3.png" alt="">
                        </div>
                    </div>
                </div>

                <div class="coinshop-gold-package-unit">
                    <div class="coinshop-gold-package-unit-imgwrap">
                        <img src="./imgs/Coinshop/coinshop_gold_deco.png" alt="">
                        <div class="coinshop-gold-package-unit-goldnumber-wrap">
                            <div class="coinshop-gold-package-unit-goldnumber">+380</div>
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_593_2198)">
                                    <path d="M14.8209 11.1896V5.67722C14.8206 5.43556 14.757 5.19821 14.6365 4.98898C14.516 4.77975 14.3427 4.60601 14.1342 4.48518L9.32734 1.729C9.11856 1.60805 8.88173 1.54437 8.64065 1.54437C8.39958 1.54437 8.16274 1.60805 7.95396 1.729L3.14714 4.48518C2.93857 4.60601 2.76533 4.77975 2.6448 4.98898C2.52427 5.19821 2.4607 5.43556 2.46045 5.67722V11.1896C2.4607 11.4312 2.52427 11.6686 2.6448 11.8778C2.76533 12.087 2.93857 12.2608 3.14714 12.3816L7.95396 15.1378C8.16274 15.2587 8.39958 15.3224 8.64065 15.3224C8.88173 15.3224 9.11856 15.2587 9.32734 15.1378L14.1342 12.3816C14.3427 12.2608 14.516 12.087 14.6365 11.8778C14.757 11.6686 14.8206 11.4312 14.8209 11.1896Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_593_2198">
                                        <rect width="16.4805" height="16.5371" fill="white" transform="translate(0.400391 0.164856)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>

                        <div class="coinshop-gold-package-unit-ntd-wrap">
                            <div class="coinshop-gold-package-unit-ntd">NT$</div>
                            <div class="coinshop-gold-package-unit-ntd-price">150</div>
                        </div>

                        <div class="coinshop-gold-package-unit-deco-imgwrap4">
                            <img src="./imgs/Coinshop/gold_package_deco4.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 金幣購買流程QA -->
    <div class="coinshop-buy-qa">
        <div class="wrapper">
            <div class="collapsible">
                <input type="checkbox" id="collapsible-head1">
                <label for="collapsible-head1">Q1：金幣禮包購買流程？</label>
                <div class="collapsible-text">
                    <p>點選欲購買的禮包→選擇支付方式→完成禮包購買→成立購買訂單→寄送信箱確認信</p>
                </div>
            </div>
        </div>

        <div class="wrapper">
            <div class="collapsible">
                <input type="checkbox" id="collapsible-head2">
                <label for="collapsible-head2">Q2：購買金幣禮包的支付方式？</label>
                <div class="collapsible-text">
                    <p>您可以選擇信用卡支付，或選擇第三方支付平台（LINE Pay, Apple Pay）購買金幣禮包</p>
                </div>
            </div>
        </div>

        <div class="wrapper">
            <div class="collapsible">
                <input type="checkbox" id="collapsible-head3">
                <label for="collapsible-head3">Q3：信用卡付款注意事項？</label>
                <div class="collapsible-text">
                    <p>目前接受台灣地區及國外發行的VISA、MASTERCARD、JCB、美國運通、聯合信用卡及銀聯卡，使用上依實際授權為主</p>
                </div>
            </div>
        </div>
    </div>

</section>



<?php include __DIR__ . '/parts/html-script.php' ?>
<!-- 這邊放其他script link -->
<script>
    // 點擊登入任務卡，跑出光箱頁
    $('.mission-card-login').click(function() {
        // console.log('hello');
        $('.mission-login').addClass('mission-login-show');
    });


    // 點擊光箱頁的確定按鈕後，關閉光箱 以及 代幣數增加
    $('.mission-login-btn').click(function() {
        $('.mission-login').removeClass('mission-login-show');
    });
    
    $('.mission-login-btn').click(function() {
        $('.coinshop-yourcoin-type-free-number').text('1225');
    });

    $('.mission-login-btn').click(function() {
        $('.complete-login').addClass('complete-login-show');
    });

</script>


<?php include __DIR__ . '/parts/html-last.php' ?>