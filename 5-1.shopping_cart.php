<?php
session_start();
$pageName = 'cart';
$title = '購物車列表';
require './parts/connect-db.php';

$_SESSION['admin'] = [
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

/*
echo json_encode([
    'rows' => $rows,
    'sids' => $sids,
]);
*/
?>

<?php include __DIR__ . '/parts/html-head.php' ?>

<link rel="stylesheet" href="./css/shopping_cart.css">

<?php include __DIR__ . '/parts/html-navbar.php' ?>

    <!-- shopping cart PC -->
    <div class="container_pc">
      <div class="shopping_cart_title">
        <div class="main_title">Shopping Cart</div>
        <div class="sub_title">購物車</div>
      </div>
    </div>
     <!-- shopping cart mobile -->
     
    <div class="container_mobile">
      <div class="shopping_cart_title">
        <div class="main_title" style="font-size:24px">Shopping Cart</div>
        <div class="sub_title" style="font-size:14px">購物車</div>
      </div>
    </div>
     

    <!-- your coins PC-->
    <div class="container_pc">
      <div class="yourcoins">
        <div class="main_title" style="font-size:20px">Your coins</div>
        <div class="sub_title" style="font-size:16px; text-align: baseline;">  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M17.5 13.3334V6.66669C17.4997 6.37442 17.4225 6.08736 17.2763 5.83432C17.13 5.58128 16.9198 5.37116 16.6667 5.22502L10.8333 1.89169C10.58 1.74541 10.2926 1.6684 10 1.6684C9.70744 1.6684 9.42003 1.74541 9.16667 1.89169L3.33333 5.22502C3.08022 5.37116 2.86998 5.58128 2.72372 5.83432C2.57745 6.08736 2.5003 6.37442 2.5 6.66669V13.3334C2.5003 13.6256 2.57745 13.9127 2.72372 14.1657C2.86998 14.4188 3.08022 14.6289 3.33333 14.775L9.16667 18.1084C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1084L16.6667 14.775C16.9198 14.6289 17.13 14.4188 17.2763 14.1657C17.4225 13.9127 17.4997 13.6256 17.5 13.3334Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
          <div class="yourcoins_price">300</div>
          </div>
        <div class="sub_title" style="font-size:16px"> <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M15 9H9V15H15V9Z" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <div class="yourcoins_price"> 1000</div>
          </div>
    </div>
  </div>

     <!-- your coins mobile-->
    <div class="container_mobile">
      <div class="yourcoins">
        <div class="main_title" style="font-size:16px">Your coins</div>
        <div class="sub_title" style="font-size:16px; text-align: baseline;">  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M17.5 13.3334V6.66669C17.4997 6.37442 17.4225 6.08736 17.2763 5.83432C17.13 5.58128 16.9198 5.37116 16.6667 5.22502L10.8333 1.89169C10.58 1.74541 10.2926 1.6684 10 1.6684C9.70744 1.6684 9.42003 1.74541 9.16667 1.89169L3.33333 5.22502C3.08022 5.37116 2.86998 5.58128 2.72372 5.83432C2.57745 6.08736 2.5003 6.37442 2.5 6.66669V13.3334C2.5003 13.6256 2.57745 13.9127 2.72372 14.1657C2.86998 14.4188 3.08022 14.6289 3.33333 14.775L9.16667 18.1084C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1084L16.6667 14.775C16.9198 14.6289 17.13 14.4188 17.2763 14.1657C17.4225 13.9127 17.4997 13.6256 17.5 13.3334Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
          <div class="yourcoins_price">300</div>
          </div>
        <div class="sub_title" style="font-size:16px"> <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M15 9H9V15H15V9Z" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <div class="yourcoins_price"> 1000</div>
          </div>
      </div>
    </div>
    <!-- progress section PC-->
    <div class="container_pc">
      <ul class="shopping_cart_progress">
        <li class="active">確認購買清單</li>
        <li class="">代幣結帳</li>
        <li>購物完成</li>
      </ul>
    </div>
    <!-- progress section mobile -->
    <div class="container_mobile">
      <ul class="shopping_cart_progress" style="font-size:12px">
        <li class="active" >確認購買清單</li>
        <li class="">代幣結帳</li>
        <li>購物完成</li>
      </ul>  
    </div>
    

    <!-- item list PC -->
      <div class="container_pc">

          <div class="item_header item_header_pc">
              <div class="item_detail">商品資訊</div>
              <div class="count">數量</div> 
              <div class="price">價格</div>
              <div class="totalprice">小計</div>
              <div class="buynexttime">下次買</div>
              <div class="delete">刪除</div>
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
                <p style=" color: #D3B572" class="money" data-price="<?= $item['item_price'] / 10  ?>"><?= $item['item_price'] / 10  ?></p>
                
              </div>

              <div class="sub-total totalprice">  
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.5 13.3334V6.66675C17.4997 6.37448 17.4225 6.08742 17.2763 5.83438C17.13 5.58134 16.9198 5.37122 16.6667 5.22508L10.8333 1.89175C10.58 1.74547 10.2926 1.66846 10 1.66846C9.70744 1.66846 9.42003 1.74547 9.16667 1.89175L3.33333 5.22508C3.08022 5.37122 2.86998 5.58134 2.72372 5.83438C2.57745 6.08742 2.5003 6.37448 2.5 6.66675V13.3334C2.5003 13.6257 2.57745 13.9127 2.72372 14.1658C2.86998 14.4188 3.08022 14.6289 3.33333 14.7751L9.16667 18.1084C9.42003 18.2547 9.70744 18.3317 10 18.3317C10.2926 18.3317 10.58 18.2547 10.8333 18.1084L16.6667 14.7751C16.9198 14.6289 17.13 14.4188 17.2763 14.1658C17.4225 13.9127 17.4997 13.6257 17.5 13.3334Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <p style=" color: #D3B572" data-sid="<?= $item['sid'] ?> data-price="<?= $item['item_price'] / 10 ?>"><?= $item['item_price'] / 10 ?></p>
              </div>

              <div class="buynexttime add-to-follow-list-btn" onclick="likeItem(event); event.preventDefault()" data-sid="<?= $item['sid'] ?>">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M17.3667 3.84166C16.9411 3.41583 16.4357 3.07803 15.8795 2.84757C15.3233 2.6171 14.7271 2.49847 14.1251 2.49847C13.523 2.49847 12.9268 2.6171 12.3706 2.84757C11.8144 3.07803 11.309 3.41583 10.8834 3.84166L10.0001 4.725L9.11673 3.84166C8.25698 2.98192 7.09092 2.49892 5.87506 2.49892C4.6592 2.49892 3.49314 2.98192 2.63339 3.84166C1.77365 4.70141 1.29065 5.86747 1.29065 7.08333C1.29065 8.29919 1.77365 9.46525 2.63339 10.325L3.51672 11.2083L10.0001 17.6917L16.4834 11.2083L17.3667 10.325C17.7926 9.89937 18.1304 9.39401 18.3608 8.83779C18.5913 8.28158 18.7099 7.6854 18.7099 7.08333C18.7099 6.48126 18.5913 5.88508 18.3608 5.32887C18.1304 4.77265 17.7926 4.26729 17.3667 3.84166V3.84166Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                
              </div>
              <div class="delete" onclick="removeItem(event); event.preventDefault()" data-sid="<?= $item['sid'] ?> data-sid="<?= $item['sid'] ?>">
                <a>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.99996 18.3334C14.6023 18.3334 18.3333 14.6024 18.3333 10C18.3333 5.39765 14.6023 1.66669 9.99996 1.66669C5.39759 1.66669 1.66663 5.39765 1.66663 10C1.66663 14.6024 5.39759 18.3334 9.99996 18.3334Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.5 7.5L7.5 12.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.5 7.5L12.5 12.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
              </div>
          </div>
          <?php endforeach; ?> 
          <!-- topline start -->
          <div class="topline"></div>

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
          <div class="item_body" data-sid="<?= $item['sid'] ?>" >

            <div class="item_img_wrap">
            <img src="imgs/Itemshop/Avatar_item/<?= $item['item_img'] ?>" alt="">
            </div>
            <div class="item_detail">

              <div class="item_upper">
                <div class="name"><?= $item['item_name'] ?></div>
                <div class="buynexttime" onclick="likeItem(event); event.preventDefault()" data-sid="<?= $item['sid'] ?>">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.3667 3.84166C16.9411 3.41583 16.4357 3.07803 15.8795 2.84757C15.3233 2.6171 14.7271 2.49847 14.1251 2.49847C13.523 2.49847 12.9268 2.6171 12.3706 2.84757C11.8144 3.07803 11.309 3.41583 10.8834 3.84166L10.0001 4.725L9.11673 3.84166C8.25698 2.98192 7.09092 2.49892 5.87506 2.49892C4.6592 2.49892 3.49314 2.98192 2.63339 3.84166C1.77365 4.70141 1.29065 5.86747 1.29065 7.08333C1.29065 8.29919 1.77365 9.46525 2.63339 10.325L3.51672 11.2083L10.0001 17.6917L16.4834 11.2083L17.3667 10.325C17.7926 9.89937 18.1304 9.39401 18.3608 8.83779C18.5913 8.28158 18.7099 7.6854 18.7099 7.08333C18.7099 6.48126 18.5913 5.88508 18.3608 5.32887C18.1304 4.77265 17.7926 4.26729 17.3667 3.84166V3.84166Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
              </div>

              <div class="item_under">

                <div class="price">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M17.5 13.3334V6.66675C17.4997 6.37448 17.4225 6.08742 17.2763 5.83438C17.13 5.58134 16.9198 5.37122 16.6667 5.22508L10.8333 1.89175C10.58 1.74547 10.2926 1.66846 10 1.66846C9.70744 1.66846 9.42003 1.74547 9.16667 1.89175L3.33333 5.22508C3.08022 5.37122 2.86998 5.58134 2.72372 5.83438C2.57745 6.08742 2.5003 6.37448 2.5 6.66675V13.3334C2.5003 13.6257 2.57745 13.9127 2.72372 14.1658C2.86998 14.4188 3.08022 14.6289 3.33333 14.7751L9.16667 18.1084C9.42003 18.2547 9.70744 18.3317 10 18.3317C10.2926 18.3317 10.58 18.2547 10.8333 18.1084L16.6667 14.7751C16.9198 14.6289 17.13 14.4188 17.2763 14.1658C17.4225 13.9127 17.4997 13.6257 17.5 13.3334Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <p style=" color: #D3B572" class="money" data-price="<?= $item['item_price'] / 10 ?>"><?= $item['item_price']  / 10 ?></p>    
                </div>

                <div class="count quantity" data-quantity="<?= $item['quantity'] ?>"> x <?= $item['quantity'] ?></div> 

                <div class="delete" onclick="removeItem(event); event.preventDefault()">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.99996 18.3334C14.6023 18.3334 18.3333 14.6024 18.3333 10C18.3333 5.39765 14.6023 1.66669 9.99996 1.66669C5.39759 1.66669 1.66663 5.39765 1.66663 10C1.66663 14.6024 5.39759 18.3334 9.99996 18.3334Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M12.5 7.5L7.5 12.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M7.5 7.5L12.5 12.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                  </div>
              </div>

            </div>
          </div>
          <?php endforeach; ?>
          <div class="underline"></div>
          </div>
        </div>

    <!-- Totals section PC -->
    <div class="container_pc">
      <div class="totals">
        <div class="totals-item">
          <label>商品總金額</label>
          <div class="totals-value" id="cart-subtotal">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M17.5 13.3334V6.66669C17.4997 6.37442 17.4225 6.08736 17.2763 5.83432C17.13 5.58128 16.9198 5.37116 16.6667 5.22502L10.8333 1.89169C10.58 1.74541 10.2926 1.6684 10 1.6684C9.70744 1.6684 9.42003 1.74541 9.16667 1.89169L3.33333 5.22502C3.08022 5.37116 2.86998 5.58128 2.72372 5.83432C2.57745 6.08736 2.5003 6.37442 2.5 6.66669V13.3334C2.5003 13.6256 2.57745 13.9127 2.72372 14.1657C2.86998 14.4188 3.08022 14.6289 3.33333 14.775L9.16667 18.1084C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1084L16.6667 14.775C16.9198 14.6289 17.13 14.4188 17.2763 14.1657C17.4225 13.9127 17.4997 13.6256 17.5 13.3334Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <p class="total-price"></p>
              </div>
        </div>
        <div class="totals-item totals-item-total">
          <label>應付總金額</label>
          <div class="totals-value" id="cart-total">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M17.5 13.3334V6.66669C17.4997 6.37442 17.4225 6.08736 17.2763 5.83432C17.13 5.58128 16.9198 5.37116 16.6667 5.22502L10.8333 1.89169C10.58 1.74541 10.2926 1.6684 10 1.6684C9.70744 1.6684 9.42003 1.74541 9.16667 1.89169L3.33333 5.22502C3.08022 5.37116 2.86998 5.58128 2.72372 5.83432C2.57745 6.08736 2.5003 6.37442 2.5 6.66669V13.3334C2.5003 13.6256 2.57745 13.9127 2.72372 14.1657C2.86998 14.4188 3.08022 14.6289 3.33333 14.775L9.16667 18.1084C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1084L16.6667 14.775C16.9198 14.6289 17.13 14.4188 17.2763 14.1657C17.4225 13.9127 17.4997 13.6256 17.5 13.3334Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <p class="total-price"></p>
        </div>
            
        </div>
      </div>  
    </div>

    <!-- Totals section mobile -->
    <div class="container_mobile">
      <div class="totals">
        <div class="totals-item">
          <label>商品總金額</label>
          <div class="totals-value" id="cart-subtotal">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M17.5 13.3334V6.66669C17.4997 6.37442 17.4225 6.08736 17.2763 5.83432C17.13 5.58128 16.9198 5.37116 16.6667 5.22502L10.8333 1.89169C10.58 1.74541 10.2926 1.6684 10 1.6684C9.70744 1.6684 9.42003 1.74541 9.16667 1.89169L3.33333 5.22502C3.08022 5.37116 2.86998 5.58128 2.72372 5.83432C2.57745 6.08736 2.5003 6.37442 2.5 6.66669V13.3334C2.5003 13.6256 2.57745 13.9127 2.72372 14.1657C2.86998 14.4188 3.08022 14.6289 3.33333 14.775L9.16667 18.1084C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1084L16.6667 14.775C16.9198 14.6289 17.13 14.4188 17.2763 14.1657C17.4225 13.9127 17.4997 13.6256 17.5 13.3334Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <p class="total-price"></p>
          </div>
        </div>  
        <div class="totals-item totals-item-total">
          <label>應付總金額</label>
          <div class="totals-value" id="cart-total">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M17.5 13.3334V6.66669C17.4997 6.37442 17.4225 6.08736 17.2763 5.83432C17.13 5.58128 16.9198 5.37116 16.6667 5.22502L10.8333 1.89169C10.58 1.74541 10.2926 1.6684 10 1.6684C9.70744 1.6684 9.42003 1.74541 9.16667 1.89169L3.33333 5.22502C3.08022 5.37116 2.86998 5.58128 2.72372 5.83432C2.57745 6.08736 2.5003 6.37442 2.5 6.66669V13.3334C2.5003 13.6256 2.57745 13.9127 2.72372 14.1657C2.86998 14.4188 3.08022 14.6289 3.33333 14.775L9.16667 18.1084C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1084L16.6667 14.775C16.9198 14.6289 17.13 14.4188 17.2763 14.1657C17.4225 13.9127 17.4997 13.6256 17.5 13.3334Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <p class="total-price"></p>
          </div>
        </div>

    </div>
  </div>

    <!-- checkout button  -->
    <div class="container_pc"> 
      <div class="checkout">
        <button class=""><a style="color:white;" href="5-2.shopping_cart_pay.php">結帳</a></button>
        <button class="">繼續購物</button>
        <button class="">前往加值</button>
        
      </div>
    </div>

    <!-- checkout mobile  -->
    <div class="container_mobile"> 
      <div class="checkout">
        <button class="">前往加值</button>
        <button class="">繼續購物</button>
        <button class=""><a style="color:white;" href="5-2.shopping_cart_pay.php">結帳</a></button>
      </div>
    </div>

    <!-- recommendation section PC -->
    <div class="container_pc">
      <div class="recommendation-title">
        <div class="main-title">你的專屬推薦</div>
      </div>
      <div class="recommendation_card_wrap">
        
        <!-- 加購商品 start -->
        <div class="recommendation_card"> 
          <div class="recommendation_card_pic">
            <img src="imgs/Itemshop/Avatar_item/Vox/object/vox_object_right_OniGiri3.png" alt=""> 
          </div>
          <div class="recommendation_card_detail">
            <div class="recommendation_card_name">Onigiri</div>
            <div class="sub_recommendation_card_detail">
                <div class="price">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 13.3333V6.66666C17.4997 6.37439 17.4225 6.08733 17.2763 5.83429C17.13 5.58125 16.9198 5.37113 16.6667 5.22499L10.8333 1.89166C10.58 1.74538 10.2926 1.66837 10 1.66837C9.70744 1.66837 9.42003 1.74538 9.16667 1.89166L3.33333 5.22499C3.08022 5.37113 2.86998 5.58125 2.72372 5.83429C2.57745 6.08733 2.5003 6.37439 2.5 6.66666V13.3333C2.5003 13.6256 2.57745 13.9126 2.72372 14.1657C2.86998 14.4187 3.08022 14.6289 3.33333 14.775L9.16667 18.1083C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1083L16.6667 14.775C16.9198 14.6289 17.13 14.4187 17.2763 14.1657C17.4225 13.9126 17.4997 13.6256 17.5 13.3333Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                <p class="icon_left money" data-price="30">30</p>   
                </div>

                <div class="info">
                  <svg width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 9.99999C18.3334 5.39762 14.6024 1.66666 10 1.66666C5.39765 1.66666 1.66669 5.39762 1.66669 9.99999C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 13.3333V10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 6.66666H10.0083" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>
            <div class="car_detail_buymore">
              <button class="add-to-cart-btn" data-sid="217">加購</button>
            </div>
          </div>
        </div>
        <div class="recommendation_card"> 
          <div class="recommendation_card_pic">
            <img src="imgs/Itemshop/Avatar_item/Vox/object/vox_object_right_OniGiri2.png" alt=""> 
          </div>
          <div class="recommendation_card_detail">
            <div class="recommendation_card_name">Oni.拿指揮棒</div>
            <div class="sub_recommendation_card_detail">
                <div class="price">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 13.3333V6.66666C17.4997 6.37439 17.4225 6.08733 17.2763 5.83429C17.13 5.58125 16.9198 5.37113 16.6667 5.22499L10.8333 1.89166C10.58 1.74538 10.2926 1.66837 10 1.66837C9.70744 1.66837 9.42003 1.74538 9.16667 1.89166L3.33333 5.22499C3.08022 5.37113 2.86998 5.58125 2.72372 5.83429C2.57745 6.08733 2.5003 6.37439 2.5 6.66666V13.3333C2.5003 13.6256 2.57745 13.9126 2.72372 14.1657C2.86998 14.4187 3.08022 14.6289 3.33333 14.775L9.16667 18.1083C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1083L16.6667 14.775C16.9198 14.6289 17.13 14.4187 17.2763 14.1657C17.4225 13.9126 17.4997 13.6256 17.5 13.3333Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                <p class="icon_left money" data-price="30">30</p>   
                </div>

                <div class="info">
                  <svg width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 9.99999C18.3334 5.39762 14.6024 1.66666 10 1.66666C5.39765 1.66666 1.66669 5.39762 1.66669 9.99999C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 13.3333V10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 6.66666H10.0083" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>
            <div class="car_detail_buymore">
              <button class="add-to-cart-btn" data-sid="216">加購</button>
            </div>
          </div>
        </div>
        <div class="recommendation_card"> 
          <div class="recommendation_card_pic">
            <img src="imgs/Itemshop/Avatar_item/Vox/object/vox_object_right_OniGiri1.png" alt=""> 
          </div>
          <div class="recommendation_card_detail">
            <div class="recommendation_card_name">Onigiri拿狼牙棒 </br></div>
            <div class="sub_recommendation_card_detail">
                <div class="price">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 13.3333V6.66666C17.4997 6.37439 17.4225 6.08733 17.2763 5.83429C17.13 5.58125 16.9198 5.37113 16.6667 5.22499L10.8333 1.89166C10.58 1.74538 10.2926 1.66837 10 1.66837C9.70744 1.66837 9.42003 1.74538 9.16667 1.89166L3.33333 5.22499C3.08022 5.37113 2.86998 5.58125 2.72372 5.83429C2.57745 6.08733 2.5003 6.37439 2.5 6.66666V13.3333C2.5003 13.6256 2.57745 13.9126 2.72372 14.1657C2.86998 14.4187 3.08022 14.6289 3.33333 14.775L9.16667 18.1083C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1083L16.6667 14.775C16.9198 14.6289 17.13 14.4187 17.2763 14.1657C17.4225 13.9126 17.4997 13.6256 17.5 13.3333Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                <p class="icon_left money" data-price="20">20</p>   
                </div>

                <div class="info">
                  <svg width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 9.99999C18.3334 5.39762 14.6024 1.66666 10 1.66666C5.39765 1.66666 1.66669 5.39762 1.66669 9.99999C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 13.3333V10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 6.66666H10.0083" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>
            <div class="car_detail_buymore">
              <button class="add-to-cart-btn" data-sid="215">加購</button>
            </div>
          </div>
        </div>
        <div class="recommendation_card"> 
          <div class="recommendation_card_pic">
            <img src="imgs/Itemshop/Avatar_item/Vox/object/vox_object_right_Microphone4.png" alt=""> 
          </div>
          <div class="recommendation_card_detail">
            <div class="recommendation_card_name">復古麥克風</div>
            <div class="sub_recommendation_card_detail">
                <div class="price">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 13.3333V6.66666C17.4997 6.37439 17.4225 6.08733 17.2763 5.83429C17.13 5.58125 16.9198 5.37113 16.6667 5.22499L10.8333 1.89166C10.58 1.74538 10.2926 1.66837 10 1.66837C9.70744 1.66837 9.42003 1.74538 9.16667 1.89166L3.33333 5.22499C3.08022 5.37113 2.86998 5.58125 2.72372 5.83429C2.57745 6.08733 2.5003 6.37439 2.5 6.66666V13.3333C2.5003 13.6256 2.57745 13.9126 2.72372 14.1657C2.86998 14.4187 3.08022 14.6289 3.33333 14.775L9.16667 18.1083C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1083L16.6667 14.775C16.9198 14.6289 17.13 14.4187 17.2763 14.1657C17.4225 13.9126 17.4997 13.6256 17.5 13.3333Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                <p class="icon_left money" data-price="10">10</p>   
                </div>

                <div class="info">
                  <svg width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 9.99999C18.3334 5.39762 14.6024 1.66666 10 1.66666C5.39765 1.66666 1.66669 5.39762 1.66669 9.99999C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 13.3333V10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 6.66666H10.0083" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>
            <div class="car_detail_buymore">
              <button class="add-to-cart-btn" data-sid="214">加購</button>
            </div>
          </div>
        </div>
        <div class="recommendation_card"> 
          <div class="recommendation_card_pic">
            <img src="imgs/Itemshop/Avatar_item/Vox/object/vox_object_right_Microphone3.png" alt=""> 
          </div>
          <div class="recommendation_card_detail">
            <div class="recommendation_card_name">專業麥克風</div>
            <div class="sub_recommendation_card_detail">
                <div class="price">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 13.3333V6.66666C17.4997 6.37439 17.4225 6.08733 17.2763 5.83429C17.13 5.58125 16.9198 5.37113 16.6667 5.22499L10.8333 1.89166C10.58 1.74538 10.2926 1.66837 10 1.66837C9.70744 1.66837 9.42003 1.74538 9.16667 1.89166L3.33333 5.22499C3.08022 5.37113 2.86998 5.58125 2.72372 5.83429C2.57745 6.08733 2.5003 6.37439 2.5 6.66666V13.3333C2.5003 13.6256 2.57745 13.9126 2.72372 14.1657C2.86998 14.4187 3.08022 14.6289 3.33333 14.775L9.16667 18.1083C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1083L16.6667 14.775C16.9198 14.6289 17.13 14.4187 17.2763 14.1657C17.4225 13.9126 17.4997 13.6256 17.5 13.3333Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                <p class="icon_left money" data-price="30">30</p>   
                </div>

                <div class="info">
                  <svg width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 9.99999C18.3334 5.39762 14.6024 1.66666 10 1.66666C5.39765 1.66666 1.66669 5.39762 1.66669 9.99999C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 13.3333V10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 6.66666H10.0083" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>
            <div class="car_detail_buymore">
              <button class="add-to-cart-btn" data-sid="213">加購</button>
            </div>
          </div>
        </div>
        <div class="recommendation_card"> 
          <div class="recommendation_card_pic">
            <img src="imgs/Itemshop/Avatar_item/Vox/object/vox_object_right_Microphone2.png" alt=""> 
          </div>
          <div class="recommendation_card_detail">
            <div class="recommendation_card_name">專業收音麥克風</div>
            <div class="sub_recommendation_card_detail">
                <div class="price">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 13.3333V6.66666C17.4997 6.37439 17.4225 6.08733 17.2763 5.83429C17.13 5.58125 16.9198 5.37113 16.6667 5.22499L10.8333 1.89166C10.58 1.74538 10.2926 1.66837 10 1.66837C9.70744 1.66837 9.42003 1.74538 9.16667 1.89166L3.33333 5.22499C3.08022 5.37113 2.86998 5.58125 2.72372 5.83429C2.57745 6.08733 2.5003 6.37439 2.5 6.66666V13.3333C2.5003 13.6256 2.57745 13.9126 2.72372 14.1657C2.86998 14.4187 3.08022 14.6289 3.33333 14.775L9.16667 18.1083C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1083L16.6667 14.775C16.9198 14.6289 17.13 14.4187 17.2763 14.1657C17.4225 13.9126 17.4997 13.6256 17.5 13.3333Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                <p class="icon_left money" data-price="40">40</p>   
                </div>

                <div class="info">
                  <svg width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 9.99999C18.3334 5.39762 14.6024 1.66666 10 1.66666C5.39765 1.66666 1.66669 5.39762 1.66669 9.99999C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 13.3333V10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 6.66666H10.0083" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>
            <div class="car_detail_buymore">
              <button class="add-to-cart-btn" data-sid="212">加購</button>
            </div>
          </div>
        </div>
        <div class="recommendation_card"> 
          <div class="recommendation_card_pic">
            <img src="imgs/Itemshop/Avatar_item/Vox/object/vox_object_right_Microphone1.png" alt=""> 
          </div>
          <div class="recommendation_card_detail">
            <div class="recommendation_card_name">復古麥克風</div>
            <div class="sub_recommendation_card_detail">
                <div class="price">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 13.3333V6.66666C17.4997 6.37439 17.4225 6.08733 17.2763 5.83429C17.13 5.58125 16.9198 5.37113 16.6667 5.22499L10.8333 1.89166C10.58 1.74538 10.2926 1.66837 10 1.66837C9.70744 1.66837 9.42003 1.74538 9.16667 1.89166L3.33333 5.22499C3.08022 5.37113 2.86998 5.58125 2.72372 5.83429C2.57745 6.08733 2.5003 6.37439 2.5 6.66666V13.3333C2.5003 13.6256 2.57745 13.9126 2.72372 14.1657C2.86998 14.4187 3.08022 14.6289 3.33333 14.775L9.16667 18.1083C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1083L16.6667 14.775C16.9198 14.6289 17.13 14.4187 17.2763 14.1657C17.4225 13.9126 17.4997 13.6256 17.5 13.3333Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                <p class="icon_left money" data-price="20">20</p>   
                </div>

                <div class="info">
                  <svg width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 9.99999C18.3334 5.39762 14.6024 1.66666 10 1.66666C5.39765 1.66666 1.66669 5.39762 1.66669 9.99999C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 13.3333V10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 6.66666H10.0083" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>
            <div class="car_detail_buymore">
              <button class="add-to-cart-btn" data-sid="211">加購</button>
            </div>
          </div>
        </div>
        <div class="recommendation_card"> 
          <div class="recommendation_card_pic">
            <img src="imgs/Itemshop/Avatar_item/Vox/object/vox_object_right_Flower.png" alt=""> 
          </div>
          <div class="recommendation_card_detail">
            <div class="recommendation_card_name">玫瑰花花束</div>
            <div class="sub_recommendation_card_detail" >
                <div class="price">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 13.3333V6.66666C17.4997 6.37439 17.4225 6.08733 17.2763 5.83429C17.13 5.58125 16.9198 5.37113 16.6667 5.22499L10.8333 1.89166C10.58 1.74538 10.2926 1.66837 10 1.66837C9.70744 1.66837 9.42003 1.74538 9.16667 1.89166L3.33333 5.22499C3.08022 5.37113 2.86998 5.58125 2.72372 5.83429C2.57745 6.08733 2.5003 6.37439 2.5 6.66666V13.3333C2.5003 13.6256 2.57745 13.9126 2.72372 14.1657C2.86998 14.4187 3.08022 14.6289 3.33333 14.775L9.16667 18.1083C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1083L16.6667 14.775C16.9198 14.6289 17.13 14.4187 17.2763 14.1657C17.4225 13.9126 17.4997 13.6256 17.5 13.3333Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                <p class="icon_left money" data-price="50">50</p>   
                </div>

                <div class="info">
                  <svg width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 9.99999C18.3334 5.39762 14.6024 1.66666 10 1.66666C5.39765 1.66666 1.66669 5.39762 1.66669 9.99999C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 13.3333V10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 6.66666H10.0083" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>
            <div class="car_detail_buymore">
              <button class="add-to-cart-btn" data-sid="210">加購</button>
            </div>
          </div>
        </div>
        <!-- 加購商品 end -->
        </div>
      </div>
   
     <!-- recommendation section mobile -->
     <div class="container_mobile">
      <div class="recommendation-title">
        <div class="main-title">你的專屬推薦</div>
      </div>
      <div class="recommendation_card_wrap">
        <div class="arrow">
          <i class="fa-solid fa-angle-left"></i>
        </div>

        <div class="recommendation_card"> 
          <div class="recommendation_card_pic">
            <img src="imgs/Itemshop/Avatar_item/Vox/object/vox_object_right_OniGiri3.png" alt=""> 
          </div>
          <div class="recommendation_card_detail">
            <div class="recommendation_card_name">Onigiri</div>
            <div class="sub_recommendation_card_detail">
                <div class="price">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 13.3333V6.66666C17.4997 6.37439 17.4225 6.08733 17.2763 5.83429C17.13 5.58125 16.9198 5.37113 16.6667 5.22499L10.8333 1.89166C10.58 1.74538 10.2926 1.66837 10 1.66837C9.70744 1.66837 9.42003 1.74538 9.16667 1.89166L3.33333 5.22499C3.08022 5.37113 2.86998 5.58125 2.72372 5.83429C2.57745 6.08733 2.5003 6.37439 2.5 6.66666V13.3333C2.5003 13.6256 2.57745 13.9126 2.72372 14.1657C2.86998 14.4187 3.08022 14.6289 3.33333 14.775L9.16667 18.1083C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1083L16.6667 14.775C16.9198 14.6289 17.13 14.4187 17.2763 14.1657C17.4225 13.9126 17.4997 13.6256 17.5 13.3333Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                <p class="icon_left money" data-price="30">30</p>   
                </div>

                <div class="info">
                  <svg width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 9.99999C18.3334 5.39762 14.6024 1.66666 10 1.66666C5.39765 1.66666 1.66669 5.39762 1.66669 9.99999C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 13.3333V10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 6.66666H10.0083" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>
            <div class="car_detail_buymore">
              <button class="add-to-cart-btn" data-sid="217">加購</button>
            </div>
          </div>
        </div>
        <div class="recommendation_card"> 
          <div class="recommendation_card_pic">
            <img src="imgs/Itemshop/Avatar_item/Vox/object/vox_object_right_OniGiri2.png" alt=""> 
          </div>
          <div class="recommendation_card_detail">
            <div class="recommendation_card_name">Oni.拿指揮棒</div>
            <div class="sub_recommendation_card_detail">
                <div class="price">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 13.3333V6.66666C17.4997 6.37439 17.4225 6.08733 17.2763 5.83429C17.13 5.58125 16.9198 5.37113 16.6667 5.22499L10.8333 1.89166C10.58 1.74538 10.2926 1.66837 10 1.66837C9.70744 1.66837 9.42003 1.74538 9.16667 1.89166L3.33333 5.22499C3.08022 5.37113 2.86998 5.58125 2.72372 5.83429C2.57745 6.08733 2.5003 6.37439 2.5 6.66666V13.3333C2.5003 13.6256 2.57745 13.9126 2.72372 14.1657C2.86998 14.4187 3.08022 14.6289 3.33333 14.775L9.16667 18.1083C9.42003 18.2546 9.70744 18.3316 10 18.3316C10.2926 18.3316 10.58 18.2546 10.8333 18.1083L16.6667 14.775C16.9198 14.6289 17.13 14.4187 17.2763 14.1657C17.4225 13.9126 17.4997 13.6256 17.5 13.3333Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                <p class="icon_left money" data-price="30">30</p>   
                </div>

                <div class="info">
                  <svg width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 9.99999C18.3334 5.39762 14.6024 1.66666 10 1.66666C5.39765 1.66666 1.66669 5.39762 1.66669 9.99999C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 13.3333V10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 6.66666H10.0083" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>
            <div class="car_detail_buymore">
              <button class="add-to-cart-btn" data-sid="216">加購</button>
            </div>
          </div>
        </div>

          <div class="arrow">
            <i class="fa-solid fa-angle-right"></i>
          </div>


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

//啟用加購按鈕

$('.add-to-cart-btn').on('click', event => {
    const btn = $(event.currentTarget);
    const sid = btn.attr('data-sid');
    // const quantity = btn.prev().val();
    const quantity = 1;
    // const quantity = btn.closest('.card').find('select').val();
    console.log({
        sid,
        quantity
    });

    $.get('5-4.cart-api.php', {sid, quantity}, function(data){
        console.log(data)
        window.location.reload() 
        calcPrices();
      }, 'json');
});

//啟用收藏icon功能------------------------

$('.add-to-follow-list-btn').on('click', event => {
    const btn = $(event.currentTarget);
    const sid = btn.attr('data-sid');
    const quantity = 1;

    console.log({
        sid,
    });

    $.get('item-follow-api.php', {
        sid,
      
    }, function(data) {
        console.log(data);
    }, 'json');
});


// // 點擊remove，跳出確認訊息（光箱）------------------------

// $('.delete').click(function() {
//         $('.sure-delete-item').addClass('show');
//       });
// $('.itemshop-itemdetails-close').click(function() {
//     $('.sure-delete-item').removeClass('show');
// });

//按下刪除icon刪除商品------------------------

const removeItem = event => {
    const me = $(event.currentTarget);
    const sid = me.closest('.item_body').attr('data-sid');
    const quantity =1;

    $.get('5-4.cart-api.php', {sid, quantity}, function(data){
        me.closest('.item_body').remove(); //先清除
        // console.log(data);
        calcPrices();
    }, 'json');
};

//啟用收藏按鈕------------------------

const likeItem = event => {
    const me = $(event.currentTarget);
    const sid = me.closest('.item_body').attr('data-sid');
    const quantity =1;

    $.get('5-4.cart-api.php', {sid, quantity}, function(data){
        me.closest('.item_body').remove(); //先清除
        // console.log(data);
        calcPrices();
    }, 'json');
};

// 數量變更觸發重新計算價格

// $('.delete').on('click', function() {
//     const me = $('.quantity');
//     // console.log('me:', me);
//     const quantity = 1;
//     // console.log('quantity:', val() );
//     const sid = me.closest('.item_body').attr('data-sid'); //closest 不是find

//     $.get('5-4.cart-api.php', {
//         sid,
//         quantity
//     }, function(data) {
//         console.log(data);
//         // showCount(data);
//         calcPrices(); // 重算所有價格
//     }, 'json');

// });


</script>
<?php include __DIR__ . '/parts/html-last.php' ?>