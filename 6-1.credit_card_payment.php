<?php
$pageName = 'credit_card_payment';
$title = '信用卡結帳頁面';
require './parts/connect-db.php';

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

<link rel="stylesheet" href="./css/credit_card_payment.css">

<?php include __DIR__ . '/parts/html-navbar.php' ?>
 <!-- token store PC -->
<div class="container_pc">
  <div class="token_store_title">
    <div class="main_title">Token Store</div>
    <div class="sub_title">支付頁面</div>
  </div>
</div>
 <!-- token store mobile -->
<div class="container_mobile">
  <div class="token_store_title">
    <div class="main_title" style="font-size:24px">Token Store</div>
    <div class="sub_title" style="font-size:14px">支付頁面</div>
  </div>
</div>

<!-- duo button pc -->
<div class="container_pc">
    <div class="duo_button_wrap">
        <label class="container_duo_button">
            信用卡
            <input type="radio" checked="checked" name="radio">
            <span class="checkmark"></span>
          </label>
          <label class="container_duo_button">
            第三方支付
            <input type="radio" name="radio">
            <span class="checkmark"></span>
          </label>
    </div>
</div>

<!-- duo button mobile -->
<div class="container_mobile">
    <div class="duo_button_wrap">
        <label class="container_duo_button">
            信用卡
            <input type="radio" checked="checked" name="radio">
            <span class="checkmark"></span>
          </label>
          <label class="container_duo_button">
            第三方支付
            <input type="radio" name="radio">
            <span class="checkmark"></span>
          </label>
    </div>
</div>

<!-- credit card pc -->
<div class="container_pc">
    <div class="credit_card" >
      <div class="card__front card__part">
        <img class="card__front-square card__square" src="imgs/Shoppingcard/chip.png">
        <img class="card__front-logo card__logo" src="imgs/Shoppingcard/L-2.ico">
        <p class="card_numer">**** **** **** 6258</p>
        <div class="card__space-75">
          <span class="card__label">Card holder</span>
          <p class="card__info">Luxiem Hope</p>
        </div>
        <div class="card__space-25">
          <span class="card__label">Expires</span>
                <p class="card__info">05/30</p>
        </div>
      </div>
      
      <div class="card__back card__part">
        <div class="card__black-line"></div>
        <div class="card__back-content">
          <div class="card__secret">
            <p class="card__secret--last">555</p>
          </div>
          <img class="card__back-logo card__logo" src="imgs/Shoppingcard/L-2.ico">
          
        </div>
      </div>    
    </div>
</div>

<!-- credit card mobile -->
<div class="container_mobile">
    <div class="credit_card">
        <div class="card__front card__part">
        <img class="card__front-square card__square" src="imgs/Shoppingcard/chip.png">
        <img class="card__front-logo card__logo" src="imgs/Shoppingcard/L-2.ico">
        <p class="card_numer">**** **** **** 6258</p>
        <div class="card__space-75">
            <span class="card__label">Card holder</span>
            <p class="card__info">Luxiem Hope</p>
        </div>
        <div class="card__space-25">
            <span class="card__label">Expires</span>
                <p class="card__info">05/30</p>
        </div>
        </div>
        
        <div class="card__back card__part">
        <div class="card__black-line"></div>
        <div class="card__back-content">
            <div class="card__secret">
            <p class="card__secret--last">555</p>
            </div>
            <!-- <img class="card__back-square card__square" src="img/chip.png"> -->
            <img class="card__back-logo card__logo" src="imgs/Shoppingcard/L-2.ico">
            
        </div>
        </div>    
    </div>
</div>

<!-- credit card info pc -->

<div class="container_pc">
  <div class="creditcard_info">
      <form action="" onsubmit="checkForm(); return false;" novalidate>
            <label for="card-number">請輸入信用卡卡號</label>
            <input type="text" id="card-number" name="card-number" placeholder="Card Number">
          <div class="duo_info">
                <div class="firstname">
                    <label for="fname">持卡人姓名</label>
                    <input type="text" id="first-name" name="first-name" placeholder="First Name">
                </div>
                <div class="lastname duo_info_right">
                    <label for="lname" style="opacity: 0;">持卡人姓名</label>
                    <input type="text" id="last-name" name="last-name" placeholder="Last Name">
                </div>
          </div>
      
          <div class="duo_info">
            <div>
              <label for="valid-date">有效月／年</label>
              <input type="text" id="valid-date" name="valid-date" placeholder="ＭＭ／YY">
            </div>

          <div class="duo_info_right" >
            <label for="cvc-number">驗證碼</label>
            <input type="text" id="cvc-number" name="cvc-number" placeholder="CVC ">
          </div>
          </div>
      
      </form>
  </div>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- credit card info mobile -->

<div class="container_mobile">
    <div class="creditcard_info">
        <form action="" onsubmit="checkForm(); return false;" novalidate>
            <label for="card-number">請輸入信用卡卡號</label>
            <input type="text" id="card-number" name="card-number" placeholder="Card Number">
            <div class="duo_info">
                <div class="firstname">
                    <label for="fname">持卡人姓名</label>
                    <input type="text" id="first-name" name="first-name" placeholder="First Name">
                </div>
                <div class="lastname duo_info_right">
                    <label for="lname" style="opacity: 0;">持卡人姓名</label>
                    <input type="text" id="last-name" name="last-name" placeholder="Last Name">
                </div>
            </div>
        
            <div class="duo_info">
                <div>
                  <label for="valid-date">有效月／年</label>
                  <input type="text" id="valid-date" name="valid-date" placeholder="ＭＭ／YY">
            </div>
            <div class="duo_info_right" >
                <label for="cvc-number">驗證碼</label>
                <input type="text" id="cvc-number" name="cvc-number" placeholder="CVC ">
            </div>
            </div>
        
        </form>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
    </div>
</div>

  <!-- checkout button  pc-->
  <div class="container_pc"> 

    <div class="checkout">
      <button  type="submit" class=""> <a style="color:white" href="6-2.credit_card_payment_fin.php">確認結帳</a></button>
      <button class="">取消</button>
    </div>
  </div>


       <!-- checkout button  pc-->
       <div class="container_mobile"> 
        <div class="checkout">
          <button  type="submit" class=""> <a style="color: white" href="6-2.credit_card_payment_fin.php">確認結帳</a></button>
          <button class="">取消</button> 
        </div>
      </div>

<?php include __DIR__ . '/parts/html-script.php' ?>

<script>

const $card-number = $('#card-number');
const $first-name = $('#first-name');
const $last-name = $('#last-name');
const $valid-date = $('#valid-date');
const $cvc-number = $('#cvc-number');
const msgFields = [$card-number, $first-name, $last-name, $valid-date, $cvc-number];

const $modal = $('#exampleModal');
const modal = new bootstrap.Modal($modal[0]);


function checkForm() {

    // 清除之前的檢查訊息
    for (let f of msgFields) {
        f.css('border', '#CCCCCC 1px solid');
        f.next().html('');
    }
        // TODO: 檢查欄位資料.

let isPass = true; // 有沒有通過檢查

const first-name = $first-name.val().trim();
const last-name = $last-name.val().trim();

function validateCardNumber(cardN) {
    return /^(?:3[47][0-9]{13})$/.test(cardN);
}


if (first-name.length < 2) {
    $first-name.next().html('請填寫正確的名');
    $first-name.css('border', 'red 1px solid');
    isPass = false;
}

if (last-name.length < 2) {
    $last-name.next().html('請填寫正確的姓');
    $last-name.css('border', 'red 1px solid');
    isPass = false;
}


if ($card-number.val() && !validateCardNumber($card-number.val())) {
    $card-number.next().html('請填寫正確的信用卡號碼');
    $card-number.css('border', 'red 1px solid');
    isPass = false;
}

if (cvc-number.length < 3) {
    $cvc-number.next().html('請填寫正確的cvc號碼');
    $cvc-number.css('border', 'red 1px solid');
    isPass = false;
}


// AJAX
if (isPass) {
    $.post('6-3.credit_card_info_add_api.php', $(document.form1).serialize(), function(data) {
        console.log(data);
        if (data.success) {
            // alert('資料新增成功');
            // location.href = 'ab-list.php';
            $modal.find('#exampleModalLabel').html('信用卡交易成功');
            $modal.find('.modal-body').html('謝謝');
            modal.show();

        } else {
            //alert(data.error || '資料新增失敗');
            $modal.find('#exampleModalLabel').html('信用卡交易失敗');
            $modal.find('.modal-body').html('...');
            modal.show();
        }
    }, 'json');
}

}

</script>
<?php include __DIR__ . '/parts/html-last.php' ?>