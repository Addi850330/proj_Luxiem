<?php
$pageName = 'cart_pay';
$title = '購物車結帳完成頁面';
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

$rows = [];
$sids = [];
if (!empty($_SESSION['cart'])) {

    $sids = array_keys($_SESSION['cart']);
    $sql = sprintf("SELECT * FROM `items` WHERE sid IN (%s)", implode(',', $sids));
    $stmt = $pdo->query($sql);

    while ($r = $stmt->fetch()) {
        $r['quantity'] = $_SESSION['cart'][$r['sid']];
        $rows[$r['sid']] = $r;
    }

}

// 購物車內的商品資訊丟入

$rows = [];
$sids = [];
$totalPrice = 0; // 總價
$token_type = 0;


// $user_sid = 1;
$sids = array_keys($_SESSION['cart']);
$sql = sprintf("SELECT * FROM items WHERE sid IN (%s)", implode(',', $sids));
$stmt = $pdo->query($sql);

while ($r = $stmt->fetch()) {
    $r['quantity'] = $_SESSION['cart'][$r['sid']];  // 數量放進來
    $rows[$r['sid']] = $r;
    $totalPrice += $r['quantity'] * $r['item_price'];
    $token_type = 0;
}

$sql = sprintf("INSERT INTO `orders`(`user_sid`, `token_type`, `price_total`, `order_at`) VALUES
(%s, %s, %s, NOW())", intval($_SESSION['admin']['id']), $token_type, $totalPrice);

$pdo->query($sql);
$order_sid = $pdo->lastInsertId();

$stmt = $pdo->prepare("INSERT INTO `order_details`(`order_sid`, `items_sid`, `token_type`) VALUES (?, ?, ?)");

foreach ($sids as $sid) {
    $item = $rows[$sid];

    $stmt->execute([
        $order_sid,
        $item['sid'],
        $item['token_type']=0,
    ]);
}

// unset($_SESSION['cart']);

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
        <div class="sub_title">購物完成</div>
      </div>
    </div>
     <!-- shopping cart mobile -->
    <div class="container_mobile">
      <div class="shopping_cart_title">
        <div class="main_title" style="font-size:24px">Fin</div>
        <div class="sub_title style="font-size:14px">購物完成</div>
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
      訂單確認信已寄到 <span><?= $address['email']?></span>
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
      訂單確認信已寄到 <span><?= $address['email']?></span>
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




    <!-- item list PC -->
      <div class="container_pc">
          <div class="item_header item_header_pc">
              <div class="item_detail">商品資訊</div>
              <div class="count">數量</div> 
              <div class="price">價格</div>
              <div class="totalprice">小計</div>
          </div>
          <div class="underline"></div>

          <?php
                $total = 0; 
                foreach ($sids as $sid) :
                    $item = $rows[$sid];
                    $total += $item['item_price'] * $item['quantity'];
              ?>
            <div class="item_header item_body"  data-sid="<?= $item['sid'] ?>" > 
            
              <div class="item_detail">
                    <!-- item_img -->
                  <!-- <img src="" alt=""> -->
                  <div ><img src="imgs/Itemshop/Avatar_item/<?= $item['item_img'] ?>" alt=""></div>
                  <div class="name"><?= $item['item_name'] ?></div>
              </div>

              <div class="count quantity" data-quantity="<?= $item['quantity'] ?>"><?= $item['quantity'] ?></div> 
            
              <div class="price"> 
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 13.3334V6.66675C17.4997 6.37448 17.4225 6.08742 17.2763 5.83438C17.13 5.58134 16.9198 5.37122 16.6667 5.22508L10.8333 1.89175C10.58 1.74547 10.2926 1.66846 10 1.66846C9.70744 1.66846 9.42003 1.74547 9.16667 1.89175L3.33333 5.22508C3.08022 5.37122 2.86998 5.58134 2.72372 5.83438C2.57745 6.08742 2.5003 6.37448 2.5 6.66675V13.3334C2.5003 13.6257 2.57745 13.9127 2.72372 14.1658C2.86998 14.4188 3.08022 14.6289 3.33333 14.7751L9.16667 18.1084C9.42003 18.2547 9.70744 18.3317 10 18.3317C10.2926 18.3317 10.58 18.2547 10.8333 18.1084L16.6667 14.7751C16.9198 14.6289 17.13 14.4188 17.2763 14.1658C17.4225 13.9127 17.4997 13.6257 17.5 13.3334Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <p style=" color: #D3B572" class="money" data-price="<?= $item['item_price'] / 10 ?>"><?= $item['item_price'] / 10 ?></p>
                
              </div>

              <div class="sub-total totalprice">  
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.5 13.3334V6.66675C17.4997 6.37448 17.4225 6.08742 17.2763 5.83438C17.13 5.58134 16.9198 5.37122 16.6667 5.22508L10.8333 1.89175C10.58 1.74547 10.2926 1.66846 10 1.66846C9.70744 1.66846 9.42003 1.74547 9.16667 1.89175L3.33333 5.22508C3.08022 5.37122 2.86998 5.58134 2.72372 5.83438C2.57745 6.08742 2.5003 6.37448 2.5 6.66675V13.3334C2.5003 13.6257 2.57745 13.9127 2.72372 14.1658C2.86998 14.4188 3.08022 14.6289 3.33333 14.7751L9.16667 18.1084C9.42003 18.2547 9.70744 18.3317 10 18.3317C10.2926 18.3317 10.58 18.2547 10.8333 18.1084L16.6667 14.7751C16.9198 14.6289 17.13 14.4188 17.2763 14.1658C17.4225 13.9127 17.4997 13.6257 17.5 13.3334Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <p style=" color: #D3B572" data-price="<?= $item['item_price'] / 10 ?>"><?= $item['item_price'] / 10 ?></p>
              </div>

          </div>
          <?php endforeach; ?> 
      <!-- <div class="topline"></div> -->
      </div>    
    </div>
     
      

        <!-- item list mobile -->

        <div class="container_mobile">
          <div class="container_mobile_product">
            <div class="underline"></div>
  
            <?php
                $total = 0; 
                foreach ($sids as $sid) :
                    $item = $rows[$sid];
                    $total += $item['item_price'] * $item['quantity'];
              ?>
            <div class="item_body">
  
              <div class="item_img_wrap">
                <img src="imgs/Itemshop/Avatar_item/<?= $item['item_img'] ?>" alt="">
              </div>
              <div class="item_detail">
                <div class="item_upper">
                  <div class="name"> <?= $item['item_name'] ?></div>
                </div>
  
                <div class="item_under">
                  <div class="price"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 13.3334V6.66675C17.4997 6.37448 17.4225 6.08742 17.2763 5.83438C17.13 5.58134 16.9198 5.37122 16.6667 5.22508L10.8333 1.89175C10.58 1.74547 10.2926 1.66846 10 1.66846C9.70744 1.66846 9.42003 1.74547 9.16667 1.89175L3.33333 5.22508C3.08022 5.37122 2.86998 5.58134 2.72372 5.83438C2.57745 6.08742 2.5003 6.37448 2.5 6.66675V13.3334C2.5003 13.6257 2.57745 13.9127 2.72372 14.1658C2.86998 14.4188 3.08022 14.6289 3.33333 14.7751L9.16667 18.1084C9.42003 18.2547 9.70744 18.3317 10 18.3317C10.2926 18.3317 10.58 18.2547 10.8333 18.1084L16.6667 14.7751C16.9198 14.6289 17.13 14.4188 17.2763 14.1658C17.4225 13.9127 17.4997 13.6257 17.5 13.3334Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <p style=" color: #D3B572" class="money" data-price="<?= $item['item_price'] / 10 ?>"><?= $item['item_price'] / 10 ?></p>
                    
                    </div>
                     <div class="count quantity" data-quantity="<?= $item['quantity'] ?>"> x <?= $item['quantity'] ?></div>
                </div>
  
              </div>
            </div>
             <?php endforeach; ?> 

            <div class="underline"></div> 
          </div>
        </div>



  <!-- order taotal amount PC -->
  <div class="container_pc">
    <div class="ordertotal">
      <div>
        訂單總金額
      </div>
      <div class="" id="cart-total">
        <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M17.5 13.3334V6.66675C17.4997 6.37448 17.4225 6.08742 17.2763 5.83438C17.13 5.58134 16.9198 5.37122 16.6667 5.22508L10.8333 1.89175C10.58 1.74547 10.2926 1.66846 10 1.66846C9.70744 1.66846 9.42003 1.74547 9.16667 1.89175L3.33333 5.22508C3.08022 5.37122 2.86998 5.58134 2.72372 5.83438C2.57745 6.08742 2.5003 6.37448 2.5 6.66675V13.3334C2.5003 13.6257 2.57745 13.9127 2.72372 14.1658C2.86998 14.4188 3.08022 14.6289 3.33333 14.7751L9.16667 18.1084C9.42003 18.2547 9.70744 18.3317 10 18.3317C10.2926 18.3317 10.58 18.2547 10.8333 18.1084L16.6667 14.7751C16.9198 14.6289 17.13 14.4188 17.2763 14.1658C17.4225 13.9127 17.4997 13.6257 17.5 13.3334Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <p class="total-price icon_left_price" style=" color: #D3B572;"></p>  

      </div>
      <div class="far_right_space"></div>
    </div>
  </div>       

  <!-- order taotal amount mobile -->
  <div class="container_mobile">
    <div class="ordertotal">
      <div>
        訂單總金額
      </div>
      <div class="" id="cart-total">
        <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M17.5 13.3334V6.66675C17.4997 6.37448 17.4225 6.08742 17.2763 5.83438C17.13 5.58134 16.9198 5.37122 16.6667 5.22508L10.8333 1.89175C10.58 1.74547 10.2926 1.66846 10 1.66846C9.70744 1.66846 9.42003 1.74547 9.16667 1.89175L3.33333 5.22508C3.08022 5.37122 2.86998 5.58134 2.72372 5.83438C2.57745 6.08742 2.5003 6.37448 2.5 6.66675V13.3334C2.5003 13.6257 2.57745 13.9127 2.72372 14.1658C2.86998 14.4188 3.08022 14.6289 3.33333 14.7751L9.16667 18.1084C9.42003 18.2547 9.70744 18.3317 10 18.3317C10.2926 18.3317 10.58 18.2547 10.8333 18.1084L16.6667 14.7751C16.9198 14.6289 17.13 14.4188 17.2763 14.1658C17.4225 13.9127 17.4997 13.6257 17.5 13.3334Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <p class="total-price icon_left_price" style=" color: #D3B572;"></p>  
      </div>
    </div>
  </div>    

    <!-- checkout button  pc-->
    <div class="container_pc"> 
      <div class="checkout">
        <button class="">觀看持有配件</button>
        <?php if (isset($_SESSION['admin'])) : ?>
        <button class=""><a style="color:white" href="7.order_check.php">我的訂單</a></button>
        <?php endif; ?>
        <button class="">回到商品頁</button>
        
      </div>
    </div>

    <!-- checkout button  mobile  -->
    <div class="container_mobile"> 
      <div class="checkout">
        <!-- <button class="">回到商品頁</button>
        <button class="">我的訂單</button>
        <button class="button_far_right">觀看持有配件</button> -->
        <button class="">回到商品頁</button>
        <?php if (isset($_SESSION['admin'])) : ?>
        <button class=""><a style="color:white" href="7.order_check.php">我的訂單</a></button>
        <?php endif; ?>
        <button class="">觀看持有配件</button>
      </div>
    </div>
<?php include __DIR__ . '/parts/html-script.php' ?>

<script>
// 重新計算商品總價
const dallorCommas = function(n) {
    return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
};

const calcPrices = () => {
    const itemBodys = $('.container_pc > .item_body');

    let totalPrice = 0;
    itemBodys.each(function() { //每個itembody抓出來
        const itemBody = $(this); 
        const price = +itemBody.find('.money').attr('data-price'); // 顯示單價(沒有icon)
        itemBody.find('.money').text (dallorCommas(price)); // 顯示單價
        const quantity = +itemBody.find('.count').attr('data-quantity');
        itemBody.find('.money').text(dallorCommas(price * quantity)); // 顯示小計
        totalPrice += price * quantity;
    });

    $('.total-price').text(dallorCommas(totalPrice));
};
calcPrices();


</script>
<?php include __DIR__ . '/parts/html-last.php' ?>