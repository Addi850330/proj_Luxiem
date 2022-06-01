<?php
$pageName = 'credit card pay';
$title = '信用卡結帳完成';
require './parts/connect-db.php';

$_SESSION['admin'] = [
  'id' => '20220525',
  'email' => 'allen@gmail.com',
  'nickname' => 'allen',
];

$address = [
  'id' => '20220525',
  'email' => 'allen@gmail.com',
  'nickname' => 'allen',
];

//訂單資訊 
$sql = sprintf("SELECT * FROM orders ORDER BY `orders`.`sid` ASC;");
$output['rows'] = $pdo->query($sql)->fetchAll();
foreach ($output['rows'] as $o);


?>

<?php include __DIR__ . '/parts/html-head.php' ?>

<link rel="stylesheet" href="./css/shopping_cart.css">
<link rel="stylesheet" href="./css/shopping_cart_fin.css">

<?php include __DIR__ . '/parts/html-navbar.php' ?>

<!-- shopping cart PC -->
<div class="container_pc">
  <div class="shopping_cart_title">
    <div class="main_title">Fin</div>
    <div class="sub_title">結帳完成</div>
  </div>
</div>

  <!-- shopping cart mobile -->
<div class="container_mobile">
  <div class="shopping_cart_title">
    <div class="main_title" style="font-size:24px">Fin</div>
    <div class="sub_title style="font-size:14px">結帳完成</div>
  </div>
</div>

<!-- fin title pc -->
<div class="container_pc">
  <div class="fin_title">
    <!--  -->
    <div class="fin_title_left">
      <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M27.5 13.8498V14.9998C27.4985 17.6954 26.6256 20.3182 25.0117 22.4771C23.3977 24.6361 21.1291 26.2154 18.5442 26.9797C15.9593 27.744 13.1966 27.6522 10.6681 26.7181C8.1396 25.7839 5.98082 24.0575 4.5137 21.7962C3.04658 19.5349 2.34974 16.8599 2.5271 14.1702C2.70445 11.4805 3.74651 8.92024 5.49785 6.87117C7.24919 4.8221 9.61598 3.39406 12.2452 2.80001C14.8745 2.20597 17.6253 2.47775 20.0875 3.57483" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M27.5 5L15 17.5125L11.25 13.7625" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <!--  -->
    <div class="fin_title_right">
      您已經完成本筆交易的訂購程序，感謝您的訂購。</br>
      訂單確認信已寄到<span><?= $address['email']?></span>
    </div>
  </div> 
</div>  

<!-- fin title mobile -->
<div class="container_mobile">
  <div class="fin_title">
    <!--  -->
    <div class="fin_title_left">
      <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M27.5 13.8498V14.9998C27.4985 17.6954 26.6256 20.3182 25.0117 22.4771C23.3977 24.6361 21.1291 26.2154 18.5442 26.9797C15.9593 27.744 13.1966 27.6522 10.6681 26.7181C8.1396 25.7839 5.98082 24.0575 4.5137 21.7962C3.04658 19.5349 2.34974 16.8599 2.5271 14.1702C2.70445 11.4805 3.74651 8.92024 5.49785 6.87117C7.24919 4.8221 9.61598 3.39406 12.2452 2.80001C14.8745 2.20597 17.6253 2.47775 20.0875 3.57483" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M27.5 5L15 17.5125L11.25 13.7625" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <!--  -->
    <div class="fin_title_right">
      您已經完成本筆交易的訂購程序，感謝您的訂購。
      訂單確認信已寄到<span><?= $address['email']?></span>
    </div>
  </div> 
</div> 

<!-- order number pc -->

<div class="container_pc">
  <div class="order_number">
  訂單編號：<span>#202206<?= $o['sid'] ?></span>
  </div>

</div>

<!-- order number mobile -->

<div class="container_mobile">
  <div class="order_number">
  訂單編號：<span>#202206<?= $o['sid'] ?></span>
  </div>

</div>


    <!-- checkout button  pc-->
    <div class="container_pc"> 
      <div class="checkout">
        <button class="">我的訂單</button>
        <button class="">回到商品頁</button>
        
      </div>
    </div>

    <!-- checkout button  mobile  -->
    <div class="container_mobile"> 
      <div class="checkout">
        <button class="">回到商品頁</button>
        <button class="">我的訂單</button>
      </div>
    </div>

<?php include __DIR__ . '/parts/html-script.php' ?>

<script>

</script>

<?php include __DIR__ . '/parts/html-last.php' ?>