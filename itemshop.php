<?php
session_start();
require './parts/connect-db.php';
$pageName = 'itemshop';
$title = '配件購物頁';

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

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$cate = isset($_GET['cate']) ? intval($_GET['cate']) : 0; // 0表示 預設值為: 查看所有商品

// 熱門專區 和 #hashtags
$cate_hot = isset($_GET['cate_hot']) ? intval($_GET['cate_hot']) : 0;
$cate_tag = isset($_GET['cate_tag']) ? intval($_GET['cate_tag']) : 0;

// 依照時間篩選
$cate_price = isset($_GET['cate_price']) ? intval($_GET['cate_price']) : 0;


$params = []; //先設定一個空陣列

$where = ' WHERE 1 '; // 1表示true

if (!empty($cate)) { //如果$cate不為空值（表示有點選分類選單時）
    $where .= " AND item_categories_sid=$cate ";
    $params['cate'] = $cate;
} elseif (!empty($cate_hot)) {
    $where .= " AND `sid` IN (SELECT `items_sid` FROM `item_hot` WHERE `hots_sid`=$cate_hot) ";
    $params['cate_hot'] = $cate_hot;
}

if (!empty($cate_tag)) {
    $where .= " AND `sid` IN (SELECT `items_sid` FROM `item_tags` WHERE `tags_sid`=$cate_tag) ";
    $params['cate_tag'] = $cate_tag;
}

// 依照時間篩選
// if (!empty($cate_price)) {
//     $where .= " AND (SELECT * FROM `items` ORDER BY item_price $sort_option) ";
//     $params['cate_price'] = $cate_price;
// }

// $sort_option = "";
// if (isset($_GET['sort_numeric'])) {
//     if ($_GET['sort_numeric'] == "low-high") {
//         $sort_option = "ASC";
//     } elseif ($_GET['sort_numeric'] == "high-low") {
//         $sort_option = "DESC";
//     }
// }


$perPage = 6; // 每一頁有幾筆資料

$output = [
    'perPage' => $perPage,
    'totalRows' => 0,
    'totalPages' => 0,
    'page' => $page,
    'rows' => [],  // 分頁的資料
];

if ($page < 1) {
    header('Location: itemshop.php');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM items $where";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$output['totalRows'] = $totalRows;

$totalPages = ceil($totalRows / $perPage);
$output['totalPages'] = $totalPages;

if ($totalPages > 0) {
    if ($page > $totalPages) {
        header('Location: itemshop.php?page=' . $totalPages);
        exit;
    }

    // 讀取分頁的資料
    $sql = sprintf("SELECT `sid`, `item_categories_sid`, `item_name`, `item_img`, `item_img_position`, `item_price`, `item_created_at`, `item_introduction`, `item_author`, `item_story`, `item_type` FROM items $where ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

    $rows = $output['rows'] = $pdo->query($sql)->fetchAll(); // 設定$rows變數給下面使用
}

// *** 讀取分類選單的資料
$c_sql = "SELECT * FROM item_categories  ORDER BY sid"; //先拿categories的最上層（parent_sid=0）
$cates = $pdo->query($c_sql)->fetchAll();

// 讀取熱門專區的選單資料
$c_hot_sql = "SELECT * FROM hots";
$cates_hot = $pdo->query($c_hot_sql)->fetchAll();

// 讀取#hashtags的選單資料
$c_tag_sql = "SELECT * FROM tags";
$cates_tag = $pdo->query($c_tag_sql)->fetchAll();


// header('Content-Type: application/json');  // 伺服器告訴用戶端文件的格式為 JSON
// echo json_encode($output, JSON_UNESCAPED_UNICODE);



?>

<?php include __DIR__ . '/parts/html-head.php' ?>
<!-- 這邊放其他css link -->
<link rel="stylesheet" href="./css/Vtuber_main.css">
<?php include __DIR__ . '/parts/html-navbar.php' ?>


<!-- 配件詳細內容頁（光箱頁） -->
<div class="itemshop-itemdetails">
    <div class="itemshop-itemdetails-wrap">
        <div class="itemshop-itemdetails-name">珍珠奶茶</div>
        <div class="itemshop-itemdetails-main">
            <!-- 左邊配件圖和價錢 -->
            <div class="itemshop-itemdetails-item-unit">
                <div class="itemshop-itemdetailsm-item-imgwrap">
                    <!-- 喜愛追蹤 飄入愛心 -->
                    <div class="itemshop-itemdetails-follow-heart">
                        <svg viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.0895 3.17123L11.8924 3.37949L11.6842 3.18238C9.21847 0.848789 5.32788 0.955871 2.99429 3.42156C0.660692 5.88724 0.767773 9.77783 3.23346 12.1114L11.6445 20.0718L12.3708 20.7592L13.0581 20.0329L21.0186 11.6219C23.3522 9.15624 23.2451 5.26565 20.7794 2.93206C18.3137 0.598463 14.4231 0.705543 12.0895 3.17123Z" stroke="#D3B572" stroke-width="2" />
                        </svg>
                    </div>

                    <img src="./imgs/Itemshop/itemshop_banner_ikehand1.png" alt="">
                </div>

                <div class="d-flex itemshop-itemdetails-item-price">
                    <div class="d-flex itemshop-itemdetails-item-price-gold align-items-center">
                        <svg viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.25 9.33344V4.66677C12.2498 4.46218 12.1958 4.26125 12.0934 4.08412C11.991 3.90699 11.8438 3.7599 11.6667 3.65761L7.58333 1.32427C7.40598 1.22188 7.20479 1.16797 7 1.16797C6.79521 1.16797 6.59402 1.22188 6.41667 1.32427L2.33333 3.65761C2.15615 3.7599 2.00899 3.90699 1.9066 4.08412C1.80422 4.26125 1.75021 4.46218 1.75 4.66677V9.33344C1.75021 9.53803 1.80422 9.73897 1.9066 9.91609C2.00899 10.0932 2.15615 10.2403 2.33333 10.3426L6.41667 12.6759C6.59402 12.7783 6.79521 12.8322 7 12.8322C7.20479 12.8322 7.40598 12.7783 7.58333 12.6759L11.6667 10.3426C11.8438 10.2403 11.991 10.0932 12.0934 9.91609C12.1958 9.73897 12.2498 9.53803 12.25 9.33344Z" fill="#D3B572" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="itemshop-itemdetails-item-price-gold-number">10</div>

                    </div>
                    <div class="d-flex itemshop-itemdetails-item-price-free align-items-center">
                        <svg viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99984 12.8334C10.2215 12.8334 12.8332 10.2217 12.8332 7.00008C12.8332 3.77842 10.2215 1.16675 6.99984 1.16675C3.77818 1.16675 1.1665 3.77842 1.1665 7.00008C1.1665 10.2217 3.77818 12.8334 6.99984 12.8334Z" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8.75 5.25H5.25V8.75H8.75V5.25Z" stroke="#D3B572" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="itemshop-itemdetails-item-price-free-number">46</div>

                    </div>
                </div>
            </div>

            <!-- 右邊 配件詳細資訊介紹 -->
            <div class="itemshop-itemdetails-item-unit-info">
                <div class="itemshop-itemdetails-item-details">
                    <div class="itemshop-itemdetails-item-moretext-title">說明</div>
                    <div class="itemshop-itemdetails-item-moretext-content itemshop-itemdetails-conten1">為了給Shu
                        完整的卡拉OK體驗讓大家享受Shu美麗歌聲的同時也有視覺上的饗宴
                    </div>
                </div>

                <div class="itemshop-itemdetails-item-story">
                    <div class="itemshop-itemdetails-item-moretext-title">小故事</div>
                    <div class="itemshop-itemdetails-item-moretext-content itemshop-itemdetails-conten2">
                        加了咒術的火焰是不是會更火？</div>
                </div>

                <div class="itemshop-itemdetails-item-type-and-author d-flex align-items-center">
                    <div class="itemshop-itemdetails-item-type d-flex align-items-center">
                        <div class="itemshop-itemdetails-item-moretext-title itemshop-itemdetails-type-name ">類型
                        </div>
                        <div class="itemshop-itemdetails-item-moretext-content itemshop-itemdetails-type-name2">物品
                        </div>
                    </div>

                    <div class="itemshop-itemdetails-item-author d-flex align-items-center">
                        <svg viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.5 9.75C7.82209 10.1806 8.23302 10.5369 8.70491 10.7947C9.17681 11.0525 9.69863 11.2058 10.235 11.2443C10.7713 11.2827 11.3097 11.2053 11.8135 11.0173C12.3173 10.8294 12.7748 10.5353 13.155 10.155L15.405 7.905C16.0881 7.19775 16.4661 6.25049 16.4575 5.26725C16.449 4.28401 16.0546 3.34347 15.3593 2.64818C14.664 1.9529 13.7235 1.55852 12.7403 1.54998C11.757 1.54143 10.8098 1.91941 10.1025 2.6025L8.8125 3.885" stroke="#FCFCFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M10.5 8.24999C10.1779 7.81939 9.76701 7.4631 9.29511 7.20528C8.82322 6.94746 8.3014 6.79415 7.76504 6.75574C7.22868 6.71732 6.69034 6.79471 6.18652 6.98265C5.6827 7.17059 5.22519 7.46468 4.84503 7.84499L2.59503 10.095C1.91193 10.8022 1.53396 11.7495 1.5425 12.7327C1.55104 13.716 1.94543 14.6565 2.64071 15.3518C3.33599 16.0471 4.27653 16.4415 5.25977 16.45C6.24301 16.4586 7.19027 16.0806 7.89753 15.3975L9.18003 14.115" stroke="#FCFCFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <a class="itemshop-itemdetails-item-author-name" href="#">@FavoriteVoidPix</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- 加入喜愛追蹤 或 購物車 -->
        <div class="itemshop-itemdetails-addorbuy d-flex">
            <a class="itemshop-itemdetails-add" href="#">
                <div class="itemshop-itemdetails-add-text d-flex">
                    <p>喜愛收藏</p>
                    <i class="fa-solid fa-heart"></i>
                </div>
                <svg viewBox="0 0 102 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100.847 8.82428C101.238 8.43376 101.238 7.80059 100.847 7.41007L94.4832 1.04611C94.0927 0.655586 93.4595 0.655586 93.069 1.04611C92.6785 1.43663 92.6785 2.0698 93.069 2.46032L98.7259 8.11718L93.069 13.774C92.6785 14.1646 92.6785 14.7977 93.069 15.1882C93.4595 15.5788 94.0927 15.5788 94.4832 15.1882L100.847 8.82428ZM7.71588e-08 9.11719L100.14 9.11718L100.14 7.11718L-7.71588e-08 7.11719L7.71588e-08 9.11719Z" fill="#D3B572" />
                </svg>
            </a>

            <a class="itemshop-itemdetails-buy" href="#">
                <div class="itemshop-itemdetails-buy-text d-flex">
                    <p>購物車</p>
                    <i class="fa-solid fa-cart-plus"></i>
                </div>
                <svg viewBox="0 0 102 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100.847 8.82428C101.238 8.43376 101.238 7.80059 100.847 7.41007L94.4832 1.04611C94.0927 0.655586 93.4595 0.655586 93.069 1.04611C92.6785 1.43663 92.6785 2.0698 93.069 2.46032L98.7259 8.11718L93.069 13.774C92.6785 14.1646 92.6785 14.7977 93.069 15.1882C93.4595 15.5788 94.0927 15.5788 94.4832 15.1882L100.847 8.82428ZM7.71588e-08 9.11719L100.14 9.11718L100.14 7.11718L-7.71588e-08 7.11719L7.71588e-08 9.11719Z" fill="#D3B572" />
                </svg>
            </a>
        </div>

        <!-- 關閉叉叉按鈕 -->
        <div class="itemshop-itemdetails-close">
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M25.5 8.5L8.5 25.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8.5 8.5L25.5 25.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
    </div>
</div>



<!-- 選擇代幣購物頁（光箱頁） -->
<div class="itemshop-choose-coin">
    <div class="itemshop-choose-coin-wrap">
        <div class="itemshop-choose-coin-name">請選擇哪種代幣支付？</div>

        <div class="itemshop-choose-coin-main">

            <!-- 右邊 選擇代幣按鈕 -->
            <div class="itemshop-choose-coin-btn-group d-flex">
                <a class="itemshop-choose-coin-btn-gold d-flex align-items-center justify-content-center" href="#" data-sid="210" >
                    <svg viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.875 16.6667V8.33334C21.8746 7.968 21.7782 7.60919 21.5954 7.29289C21.4125 6.97659 21.1497 6.71393 20.8333 6.53126L13.5417 2.36459C13.225 2.18174 12.8657 2.08548 12.5 2.08548C12.1343 2.08548 11.775 2.18174 11.4583 2.36459L4.16667 6.53126C3.85027 6.71393 3.58748 6.97659 3.40465 7.29289C3.22182 7.60919 3.12537 7.968 3.125 8.33334V16.6667C3.12537 17.032 3.22182 17.3908 3.40465 17.7071C3.58748 18.0234 3.85027 18.2861 4.16667 18.4688L11.4583 22.6354C11.775 22.8183 12.1343 22.9145 12.5 22.9145C12.8657 22.9145 13.225 22.8183 13.5417 22.6354L20.8333 18.4688C21.1497 18.2861 21.4125 18.0234 21.5954 17.7071C21.7782 17.3908 21.8746 17.032 21.875 16.6667Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>金幣購買</span>
                </a>
                <a class="itemshop-choose-coin-btn-free d-flex align-items-center justify-content-center" href="#">
                    <svg viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.6999 22.9167C18.4528 22.9167 23.1165 18.253 23.1165 12.5C23.1165 6.74704 18.4528 2.08334 12.6999 2.08334C6.9469 2.08334 2.2832 6.74704 2.2832 12.5C2.2832 18.253 6.9469 22.9167 12.6999 22.9167Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M15.825 9.375H9.57495V15.625H15.825V9.375Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>銀幣購買</span>
                </a>

            </div>
        </div>



        <!-- 關閉叉叉按鈕 -->
        <div class="itemshop-choose-coin-close">
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M25.5 8.5L8.5 25.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8.5 8.5L25.5 25.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
    </div>
</div>


<!-- ---配件購物頁-------------------------------- -->
<!-- ---桌機＿主banner--- -->
<section class="desktop-itemshop-banner">
    <!-- 下面是主Banner輪播牆 -->
    <div class="desktop-itemshop-banner-carousel">
        <ul class="itemshop-banner-carousel-train d-flex list-unstyled">
            <!-- Vox -->
            <li>
                <div class="desktop-itemshop-banner-imgwrap">
                    <img src="./imgs/Itemshop/itemshop_banner_voxstage.png" alt="">
                </div>
                <div class="itemshop-banner-role1">
                    <div class="itemshop-banner-role-imgwrap">
                        <img src="./imgs/Itemshop/itemshop_banner_VoxAkuma.png" alt="">
                    </div>
                    <div class="itemshop-banner-role-hand-imgwrap1">
                        <img src="./imgs/Itemshop/itemshop_banner_voxhand1.png" alt="">
                    </div>
                    <div class="itemshop-banner-role-head-imgwrap1">
                        <img src="./imgs/Itemshop/Avatar_item/Vox/head/vox_head_top_Ear2.png" alt="">
                    </div>
                </div>
            </li>
            <!-- Ike -->
            <li>
                <div class="desktop-itemshop-banner-imgwrap">
                    <img src="./imgs/Itemshop/itemshop_banner_ikestage.png" alt="">
                </div>
                <div class="itemshop-banner-role2">
                    <div class="itemshop-banner-role-imgwrap">
                        <img src="./imgs/Itemshop/itemshop_banner_Ike.png" alt="">
                    </div>
                    <div class="itemshop-banner-role-head-imgwrap2">
                        <img src="./imgs/Itemshop/Avatar_item/Ike/head/ike_head_top_Earphone2.png" alt="">
                    </div>
                    <div class="itemshop-banner-role-hand-imgwrap2">
                        <img src="./imgs/Itemshop/Avatar_item/Ike/hand/ike_hand_center_GameHold2.png" alt="">
                    </div>
                </div>
            </li>
            <!-- Mysta -->
            <li>
                <div class="desktop-itemshop-banner-imgwrap">
                    <img src="./imgs/Itemshop/itemshop_banner_mystastage.png" alt="">
                    <div class="itemshop-banner-role-object-imgwrap3">
                        <img src="./imgs/Itemshop/Avatar_item/Mysta/object/mysta_object_Balloon.png" alt="">
                    </div>
                </div>
                <div class="itemshop-banner-role3">
                    <div class="itemshop-banner-role-imgwrap">
                        <img src="./imgs/Itemshop/itemshop_banner_Mysta.png" alt="">
                    </div>
                    <div class="itemshop-banner-role-hand-imgwrap3">
                        <img src="./imgs/Itemshop/Avatar_item/Mysta/hand/mysta_hand_left_Cup.png" alt="">
                    </div>
                </div>
            </li>
            <!-- Luca -->
            <li>
                <div class="desktop-itemshop-banner-imgwrap">
                    <img src="./imgs/Itemshop/itemshop_banner_lucastage.jpeg" alt="">
                </div>
                <div class="itemshop-banner-role4">
                    <div class="itemshop-banner-role-imgwrap itemshop-banner-role-imgwrap-luca">
                        <img src="./imgs/Itemshop/itemshop_banner_Luca.png" alt="">
                    </div>
                    <div class="itemshop-banner-role-hand-imgwrap4">
                        <img src="./imgs/Itemshop/itemshop_banner_lucahand1.png" alt="">
                    </div>
                </div>
            </li>
            <!-- Shu -->
            <li>
                <div class="desktop-itemshop-banner-imgwrap">
                    <img src="./imgs/Itemshop/itemshop_banner_shustage.png" alt="">
                    <div class="itemshop-banner-role-hand-imgwrap5">
                        <img src="./imgs/Itemshop/Avatar_item/Shu/hand/shu_hand_left_SmallHuman.png" alt="">
                    </div>
                </div>

                <div class="itemshop-banner-role5">
                    <div class="itemshop-banner-role-imgwrap">
                        <img src="./imgs/Itemshop/itemshop_banner_Shu.png" alt="">
                    </div>
                    <div class="itemshop-banner-role-object-imgwrap5">
                        <img src="./imgs/Itemshop/Avatar_item/Shu/head/shu_head_Glasses8.png" alt="">
                    </div>
                </div>
            </li>
        </ul>

    </div>

    <div class="container">
        <div class="row">
            <!-- slider dots -->
            <div class="desktop-itemshop-banner-carousel-slider-dots">
                <ul class="d-flex list-unstyled">
                    <li id="desktop-itemshop-banner-carousel-slider-dots-no1"></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </div>
    </div>
    </div>
</section>

<!-- Fitting Room -->
<section class="fitting-room">
    <div class="container">
        <div class="row">
            <div class="fitting-room-title">
                <h1>Fitting Room</h1>
                <div class="spot-light">
                    <div class="spot-light-ball"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- 下面是 兩個比較框 -->
    <div class="container">
        <div class="row fitting-room-row">
            <div class="fitting-room-main">
                <!-- 第一個比較框 -->
                <div class="col-6 fitting-room-no1">
                    <div class="fitting-room-compare-content">
                        <div class="dropdown fitting-room-compare-role">
                            <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                選擇角色
                            </a>
                            <div class="dropdown-menu fitting-room-compare-role-list" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item role-change1">Vox Akuma</a>
                                <a class="dropdown-item role-change2">Ike Eveland</a>
                                <a class="dropdown-item role-change3">Mysta Rias</a>
                                <a class="dropdown-item role-change4">Luca Kaneshiro</a>
                                <a class="dropdown-item role-change5">Shu Yamino</a>
                            </div>
                        </div>

                        <div class="fitting-room-compare-role-imgwrap fitting-room-roleplay">
                            <!-- 在這裡新增節點 append()/prepend() -->
                            <!-- 左手:Vox珍奶 -->
                            <div class="fitting-room-roleplay-hand">
                                <!-- <img class="roleplay-content-item"
                                        src="./imgs/Itemshop/Avatar_item/Vox/hand/vox_hand_left_BubbleTea.png" alt=""> -->
                                <!-- <img class="roleplay-content-item" src="./imgs/Itemshop/Avatar_item/Vox/hand/vox_hand_left_Radio.png" alt=""> -->
                            </div>

                            <!-- 物品:Vox麥克風 -->
                            <div class="fitting-room-roleplay-object">
                                <!-- <img class="roleplay-content-item"
                                        src="./imgs/Itemshop/Avatar_item/Vox/object/vox_object_right_Microphone2.png"
                                        alt=""> -->
                            </div>


                            <!-- 頭部:Vox機長帽 -->
                            <div class="fitting-room-roleplay-head">
                                <!-- <img class="roleplay-content-item"
                                        src="./imgs/Itemshop/Avatar_item/Vox/head/vox_head_top_CaptainHat.png" alt=""> -->
                            </div>

                            <!-- 角色本人圖 -->
                            <img class="roleplay-content-role" src="./imgs/Itemshop/itemshop_banner_VoxAkuma.png" alt="">
                        </div>

                        <div class="fitting-room-compare-role-imgwrap-other">
                            <div class="fitting-room-compare-role-change-imgwrap-no1">
                                <img src="./imgs/Itemshop/itemshop_banner_VoxAkuma.png" alt="">
                            </div>
                            <div class="fitting-room-compare-role-change-imgwrap-no2">
                                <img src="./imgs/Itemshop/itemshop_banner_Ike.png" alt="">
                            </div>
                            <div class="fitting-room-compare-role-change-imgwrap-no3">
                                <img src="./imgs/Itemshop/itemshop_banner_Mysta.png" alt="">
                            </div>
                            <div class="fitting-room-compare-role-change-imgwrap-no4">
                                <img src="./imgs/Itemshop/itemshop_banner_Luca.png" alt="">
                            </div>
                            <div class="fitting-room-compare-role-change-imgwrap-no5">
                                <img src="./imgs/Itemshop/itemshop_banner_Shu.png" alt="">
                            </div>
                        </div>

                        <div class="fitting-room-tryit">
                            <p>Try it</p>
                        </div>
                    </div>

                    <div class="fitting-room-addorbuy">
                        <div class="fitting-room-add">
                            <a href="#" class="fitting-room-add-text d-flex">
                                <p>喜愛收藏</p>
                                <i class="fa-solid fa-heart"></i>
                            </a>
                            <svg viewBox="0 0 93 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M92.7071 8.09821C93.0976 7.70769 93.0976 7.07452 92.7071 6.684L86.3431 0.320037C85.9526 -0.0704874 85.3194 -0.0704874 84.9289 0.320037C84.5384 0.710561 84.5384 1.34373 84.9289 1.73425L90.5858 7.3911L84.9289 13.048C84.5384 13.4385 84.5384 14.0716 84.9289 14.4622C85.3195 14.8527 85.9526 14.8527 86.3431 14.4622L92.7071 8.09821ZM7.71589e-08 8.39111L92 8.3911L92 6.3911L-7.71589e-08 6.39111L7.71589e-08 8.39111Z" fill="#D3B572" />
                            </svg>
                        </div>

                        <div class="fitting-room-buy">
                            <a class="fitting-room-buy-text d-flex">
                                <p>購物車</p>
                                <i class="fa-solid fa-cart-plus"></i>
                            </a>
                            <svg width="93" height="15" viewBox="0 0 93 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M92.7071 8.09821C93.0976 7.70769 93.0976 7.07452 92.7071 6.684L86.3431 0.320037C85.9526 -0.0704874 85.3194 -0.0704874 84.9289 0.320037C84.5384 0.710561 84.5384 1.34373 84.9289 1.73425L90.5858 7.3911L84.9289 13.048C84.5384 13.4385 84.5384 14.0716 84.9289 14.4622C85.3195 14.8527 85.9526 14.8527 86.3431 14.4622L92.7071 8.09821ZM7.71589e-08 8.39111L92 8.3911L92 6.3911L-7.71589e-08 6.39111L7.71589e-08 8.39111Z" fill="#D3B572" />
                            </svg>
                        </div>

                    </div>
                </div>

                <!-- 第二個比較框 -->
                <div class="col-6 fitting-room-no2">
                    <div class="fitting-room-compare-content">
                        <div class="dropdown fitting-room-compare-role">
                            <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                選擇角色
                            </a>
                            <div class="dropdown-menu fitting-room-compare-role-list" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item role2-change1">Vox Akuma</a>
                                <a class="dropdown-item role2-change2">Ike Eveland</a>
                                <a class="dropdown-item role2-change3">Mysta Rias</a>
                                <a class="dropdown-item role2-change4">Luca Kaneshiro</a>
                                <a class="dropdown-item role2-change5">Shu Yamino</a>
                            </div>
                        </div>

                        <div class="fitting-room-compare-role-imgwrap2 fitting-room-roleplay">
                            <!-- 在這裡新增節點 append()/prepend() -->
                            <!-- 左手:Vox珍奶 -->
                            <div class="fitting-room-roleplay-hand">
                                <!-- <img class="roleplay-content-item"
                                        src="./imgs/Itemshop/Avatar_item/Vox/hand/vox_hand_left_BubbleTea.png" alt=""> -->
                                <!-- <img class="roleplay-content-item" src="./imgs/Itemshop/Avatar_item/Vox/hand/vox_hand_left_Radio.png" alt=""> -->
                            </div>

                            <!-- 物品:Vox麥克風 -->
                            <div class="fitting-room-roleplay-object">
                                <!-- <img class="roleplay-content-item"
                                        src="./imgs/Itemshop/Avatar_item/Vox/object/vox_object_right_Microphone2.png"
                                        alt=""> -->
                            </div>


                            <!-- 頭部:Vox機長帽 -->
                            <div class="fitting-room-roleplay-head">
                                <!-- <img class="roleplay-content-item"
                                        src="./imgs/Itemshop/Avatar_item/Vox/head/vox_head_top_CaptainHat.png" alt=""> -->
                            </div>

                            <!-- 角色本人圖 -->
                            <img class="roleplay-content-role" src="./imgs/Itemshop/itemshop_banner_Ike.png" alt="">
                        </div>

                        <div class="fitting-room-tryit">
                            <p>Try it</p>
                        </div>
                    </div>

                    <div class="fitting-room-addorbuy">
                        <div class="fitting-room-add">
                            <a href="#" class="fitting-room-add-text d-flex">
                                <p>喜愛收藏</p>
                                <i class="fa-solid fa-heart"></i>
                            </a>
                            <svg width="93" height="15" viewBox="0 0 93 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M92.7071 8.09821C93.0976 7.70769 93.0976 7.07452 92.7071 6.684L86.3431 0.320037C85.9526 -0.0704874 85.3194 -0.0704874 84.9289 0.320037C84.5384 0.710561 84.5384 1.34373 84.9289 1.73425L90.5858 7.3911L84.9289 13.048C84.5384 13.4385 84.5384 14.0716 84.9289 14.4622C85.3195 14.8527 85.9526 14.8527 86.3431 14.4622L92.7071 8.09821ZM7.71589e-08 8.39111L92 8.3911L92 6.3911L-7.71589e-08 6.39111L7.71589e-08 8.39111Z" fill="#D3B572" />
                            </svg>
                        </div>

                        <div class="fitting-room-buy">
                            <a class="fitting-room-buy-text d-flex">
                                <p>購物車</p>
                                <i class="fa-solid fa-cart-plus"></i>
                            </a>
                            <svg width="93" height="15" viewBox="0 0 93 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M92.7071 8.09821C93.0976 7.70769 93.0976 7.07452 92.7071 6.684L86.3431 0.320037C85.9526 -0.0704874 85.3194 -0.0704874 84.9289 0.320037C84.5384 0.710561 84.5384 1.34373 84.9289 1.73425L90.5858 7.3911L84.9289 13.048C84.5384 13.4385 84.5384 14.0716 84.9289 14.4622C85.3195 14.8527 85.9526 14.8527 86.3431 14.4622L92.7071 8.09821ZM7.71589e-08 8.39111L92 8.3911L92 6.3911L-7.71589e-08 6.39111L7.71589e-08 8.39111Z" fill="#D3B572" />
                            </svg>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- 下面是 Your coins -->
        <div class="row justify-content-between">
            <div class="fitting-room-yourcoin">
                <h3>Your coins</h3>
                <div class="fitting-room-yourcoin-type d-flex">
                    <div class="fitting-room-yourcoin-type-gold d-flex">
                        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.5 13.3334V6.66675C17.4997 6.37448 17.4225 6.08742 17.2763 5.83438C17.13 5.58134 16.9198 5.37122 16.6667 5.22508L10.8333 1.89175C10.58 1.74547 10.2926 1.66846 10 1.66846C9.70744 1.66846 9.42003 1.74547 9.16667 1.89175L3.33333 5.22508C3.08022 5.37122 2.86998 5.58134 2.72372 5.83438C2.57745 6.08742 2.5003 6.37448 2.5 6.66675V13.3334C2.5003 13.6257 2.57745 13.9127 2.72372 14.1658C2.86998 14.4188 3.08022 14.6289 3.33333 14.7751L9.16667 18.1084C9.42003 18.2547 9.70744 18.3317 10 18.3317C10.2926 18.3317 10.58 18.2547 10.8333 18.1084L16.6667 14.7751C16.9198 14.6289 17.13 14.4188 17.2763 14.1658C17.4225 13.9127 17.4997 13.6257 17.5 13.3334Z" fill="#D3B572" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="fitting-room-yourcoin-type-gold-number">38</div>
                    </div>

                    <div class="fitting-room-yourcoin-type-free d-flex">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.99984 18.3334C14.6022 18.3334 18.3332 14.6025 18.3332 10.0001C18.3332 5.39771 14.6022 1.66675 9.99984 1.66675C5.39746 1.66675 1.6665 5.39771 1.6665 10.0001C1.6665 14.6025 5.39746 18.3334 9.99984 18.3334Z" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12.5 7.5H7.5V12.5H12.5V7.5Z" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <div class="fitting-room-yourcoin-type-free-number">169</div>
                    </div>
                </div>
                <div class="fitting-room-yourcoin-moreinfo">
                    <a href="#">想獲得更多金幣嗎？</a>
                </div>
            </div>
            <div class="fitting-room-select-wrap">
                <div class="dropdown fitting-room-select">
                    <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        篩選條件
                    </a>
                    <div class="dropdown-menu fitting-room-select-list" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">價錢 由低到高</a>
                        <a class="dropdown-item" href="#">價錢 由高到低</a>
                        <a class="dropdown-item" href="#">時間 由新到舊</a>
                        <a class="dropdown-item" href="#">時間 由舊到新</a>
                    </div>
                </div>
            </div>

            <div class="fitting-room-itemselect-menu">
                <p>配件類型
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </p>
            </div>
        </div>
    </div>

    <!-- 桌機 Hashtags -->
    <div class="desktop-itemshop-tags">
        <?php foreach ($cates_tag as $c_t) : ?>
            <a href="javascript:selectItems(window.cate, window.cate_hot, <?= $c_t['sid'] ?>, 1)" class="desktop-itemshop-tags-name"># <?= $c_t['tag_name'] ?></a>
        <?php endforeach; ?>


        <!-- <a href="#" class="desktop-itemshop-tags-name"># 美食</a>
        <a href="#" class="desktop-itemshop-tags-name"># 愛心</a>
        <a href="#" class="desktop-itemshop-tags-name"># 螢光棒</a>
        <a href="#" class="desktop-itemshop-tags-name"># 帽子</a> -->
    </div>

    <!-- 配件購物 桌機配件類型列表 -->
    <div class="desktop-itemtype-menu">
        <div class="desktop-itemtype-menu-all">
            <div class="desktop-itemtype-menu-hotfield">
                <h4 class="desktop-itemtype-menu-hotfield-title">熱門專區</h4>
                <ul>
                    <?php foreach ($cates_hot as $c_h) : ?>
                        <li class="desktop-itemtype-topic">
                            <a href="javascript:selectItems(0, <?= $c_h['sid'] ?>)" class="desktop-itemtype-topic-name"><?= $c_h['hot_name'] ?></a>
                        </li>
                    <?php endforeach; ?>

                    <!-- <li class="desktop-itemtype-topic">
                        <a href="#" class="desktop-itemtype-topic-name">情人節特輯</a>
                    </li>
                    <li class="desktop-itemtype-topic">
                        <a href="#" class="desktop-itemtype-topic-name">演唱會專場</a>
                    </li> -->
                </ul>
            </div>
            <div class="desktop-itemtype-menu-hotfield">
                <h4>配件類型</h4>
                <ul>
                    <li class="desktop-itemtype-topic">
                        <a href="javascript:selectItems(0, 0, 0)" class="desktop-itemtype-topic-name">全部配件</a>
                    </li>
                    <?php foreach ($cates as $c) :
                        if ($c['parent_sid'] == 0) :
                    ?>
                            <li class="desktop-itemtype-topic">
                                <!-- 下面是 拿大分類標題 -->
                                <a href="javascript:" class="desktop-itemtype-topic-name"><?= $c['category_name'] ?></a>

                                <!-- 下面是 拿小分類標題 -->
                                <ul class="desktop-itemtype-topic-list">

                                    <?php foreach ($cates as $d) :
                                        if ($c['sid'] == $d['parent_sid']) :
                                    ?>
                                            <li><a href="javascript:selectItems(<?= $d['sid'] ?>)"><?= $d['category_name'] ?></a></li>
                                    <?php
                                        endif;
                                    endforeach; ?>
                                    <!--
                                <li><a href="#">Ike Eveland</a></li>
                                <li><a href="#">Mysta Rias</a></li>
                                <li><a href="#">Luca Kaneshiro</a></li>
                                <li><a href="#">Shu Yamino</a></li>
                        -->
                                </ul>
                            </li>
                    <?php
                        endif;
                    endforeach; ?>

                </ul>
            </div>
        </div>
    </div>

    <!-- 配件購物 手機漢堡夾 -->
    <div class="container">
        <div class="row">
            <div class="mobile-itemtype-menu">
                <div class="mobile--itemtype-menu-close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="mobile-itemtype-menu-hotfield">
                    <h4 class="mobile-itemtype-menu-hotfield-title">熱門專區</h4>
                    <ul>
                        <?php foreach ($cates_hot as $c_h) : ?>
                            <li class="mobile-itemtype-topic">
                                <a href="javascript:selectItems(0, <?= $c_h['sid'] ?>)" class="mobile-itemtype-topic-name"><?= $c_h['hot_name'] ?></a>
                            </li>
                        <?php endforeach; ?>
                        <!-- <li class="mobile-itemtype-topic">
                            <a href="#" class="mobile-itemtype-topic-name">情人節特輯</a>
                        </li>
                        <li class="mobile-itemtype-topic">
                            <a href="#" class="mobile-itemtype-topic-name">演唱會專場</a>
                        </li> -->
                    </ul>
                </div>
                <div class="mobile-itemtype-menu-hotfield">
                    <h4 class="mobile-itemtype-menu-hotfield-title2">配件類型</h4>
                    <ul>
                        <li class="mobile-itemtype-topic">
                            <a href="javascript:selectItems(0, 0, 0)" class="mobile-itemtype-topic-name">全部配件</a>
                        </li>
                        <?php foreach ($cates as $c) :
                            if ($c['parent_sid'] == 0) :
                        ?>
                                <li class="mobile-itemtype-topic">
                                    <!-- 下面是 拿大分類標題 -->
                                    <a href="javascript:" class="mobile-itemtype-topic-name"><?= $c['category_name'] ?></a>

                                    <!-- 下面是 拿小分類標題 -->
                                    <ul class="mobile-itemtype-topic-list">
                                        <?php foreach ($cates as $d) :
                                            if ($c['sid'] == $d['parent_sid']) :
                                        ?>

                                                <li><a href="javascript:selectItems(<?= $d['sid'] ?>)"><?= $d['category_name'] ?></a></li>

                                        <?php
                                            endif;
                                        endforeach; ?>
                                        <!-- <li><a href="#">Ike Eveland</a></li>
                                    <li><a href="#">Mysta Rias</a></li>
                                    <li><a href="#">Luca Kaneshiro</a></li>
                                    <li><a href="#">Shu Yamino</a></li> -->
                                    </ul>
                                </li>
                        <?php
                            endif;
                        endforeach; ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- 配件清單 -->
    <div class="container">
        <div class="row fitting-room-items-list-wrap flex-wrap">

        </div>
    </div>

</section>



<?php include __DIR__ . '/parts/html-script.php' ?>
<!-- 這邊放其他script link -->
<script>
    // 配件購物頁漢堡夾 配件類型清單
    // 漢堡收合式
    $('.fitting-room-itemselect-menu').click(function() {
        console.log('hi');
        // $('.mobile-itemtype-menu').addClass('mobile-itemtype-menu-on');

        if ($('.mobile-itemtype-menu').hasClass('mobile-itemtype-menu-on')) {
            $('.mobile-itemtype-menu').removeClass('mobile-itemtype-menu-on');
        } else {
            $('.mobile-itemtype-menu').addClass('mobile-itemtype-menu-on');
        }
    })

    // 手機配件類型選單 叉叉按鈕
    $('.mobile--itemtype-menu-close').click(function() {
        // console.log('hi');
        // $('.mobile-itemtype-menu').addClass('mobile-itemtype-menu-hide');

        if ($('.mobile-itemtype-menu').hasClass('mobile-itemtype-menu-on')) {
            $('.mobile-itemtype-menu').removeClass('mobile-itemtype-menu-on');
        } else {
            $('.mobile-itemtype-menu').addClass('mobile-itemtype-menu-on');
        }
    })


    // Banner輪播牆
    var page = 0;
    let trainliWidth = $('.itemshop-banner-carousel-train li').innerWidth();
    let nowWindowWidth = $(window).width();

    $('.desktop-itemshop-banner-carousel-slider-dots li').click(function() {
        page = $(this).index();
        Carousel();
    });

    function Carousel() {
        trainliWidth = $('.itemshop-banner-carousel-train li').innerWidth();
        console.log('Carousel trainliWidth:', trainliWidth);

        $('.itemshop-banner-carousel-train').css('transform', `translateX(${page * -(trainliWidth)}px)`);

        // $('.desktop-itemshop-banner-carousel-slider-dots li').eq(page).css('width', '35px').siblings().css('width', '8px');
        $('.desktop-itemshop-banner-carousel-slider-dots li').eq(page).css('background-color', '#D3B572').siblings().css('background-color', '#fff');
    }

    // 選擇角色 dropdown換角色圖
    // 第一個人物比較框
    $('.role-change1').click(function() {

        $('.fitting-room-compare-role-imgwrap .roleplay-content-role').attr('src', $('.fitting-room-compare-role-change-imgwrap-no1 img').attr('src'));

    })
    $('.role-change2').click(function() {

        $('.fitting-room-compare-role-imgwrap .roleplay-content-role').attr('src', $('.fitting-room-compare-role-change-imgwrap-no2 img').attr('src'));

    })
    $('.role-change3').click(function() {

        $('.fitting-room-compare-role-imgwrap .roleplay-content-role').attr('src', $('.fitting-room-compare-role-change-imgwrap-no3 img').attr('src'));

    })
    $('.role-change4').click(function() {

        $('.fitting-room-compare-role-imgwrap .roleplay-content-role').attr('src', $('.fitting-room-compare-role-change-imgwrap-no4 img').attr('src'));

    })
    $('.role-change5').click(function() {

        $('.fitting-room-compare-role-imgwrap .roleplay-content-role').attr('src', $('.fitting-room-compare-role-change-imgwrap-no5 img').attr('src'));

    })

    // 第二個人物比較框
    $('.role2-change1').click(function() {

        $('.fitting-room-compare-role-imgwrap2 .roleplay-content-role').attr('src', $('.fitting-room-compare-role-change-imgwrap-no1 img').attr('src'));

    })
    $('.role2-change2').click(function() {

        $('.fitting-room-compare-role-imgwrap2 .roleplay-content-role').attr('src', $('.fitting-room-compare-role-change-imgwrap-no2 img').attr('src'));

    })
    $('.role2-change3').click(function() {

        $('.fitting-room-compare-role-imgwrap2 .roleplay-content-role').attr('src', $('.fitting-room-compare-role-change-imgwrap-no3 img').attr('src'));

    })
    $('.role2-change4').click(function() {

        $('.fitting-room-compare-role-imgwrap2 .roleplay-content-role').attr('src', $('.fitting-room-compare-role-change-imgwrap-no4 img').attr('src'));

    })
    $('.role2-change5').click(function() {

        $('.fitting-room-compare-role-imgwrap2 .roleplay-content-role').attr('src', $('.fitting-room-compare-role-change-imgwrap-no5 img').attr('src'));

    })


    // 點擊配件套上角色框內
    // 第一步：點選一個角色框時邊框會亮黃色，且add classname（另一個角色框則不會）
    $('.fitting-room-roleplay').click(function() {
        // console.log('hi');
        $(this).css('border', '2px solid #D3B572').parent().parent().siblings().children().children('.fitting-room-roleplay').css('border', '2px solid #667080');
    });

    $('.fitting-room-roleplay').click(function() {
        $(this).addClass('fitting-room-roleplay-start-wear').parent().parent().siblings().children().children('.fitting-room-roleplay').removeClass('fitting-room-roleplay-start-wear');
    });

    // 第二步：如果有拿到classname的角色框，點擊配件會append疊圖
    // 點擊+ icon
    $('.fitting-room-item-imgwrap-add-wear').click(function() {
        console.log('hi');
        // 如果角色框有classname
        if ($('.fitting-room-roleplay').hasClass('fitting-room-roleplay-start-wear')) {

            // 先判斷：在左手的div盒子有沒有東西
            if ($('.fitting-room-roleplay-start-wear .fitting-room-roleplay-hand').children().length == 0) {

                // 沒有東西的話
                // $(this).next()配件縮圖 帶有item-hand的classsname
                if ($(this).next().hasClass('left')) {

                    // 宣告變數：配件縮圖的src
                    var img = $(this).next().attr('src');

                    // 在左手的div盒子append 此配件縮圖的src
                    // 
                    $('.fitting-room-roleplay-start-wear .fitting-room-roleplay-hand').html(`<img class="roleplay-content-item" src="${img}"/>`);

                    // 同時此配件縮圖的邊框會變黃色
                    // $(this).parent().addClass('active');
                }


            } else {
                // console.log($('.fitting-room-roleplay-start-wear .fitting-room-roleplay-hand img').attr('src'));
                // console.log($(this).next().attr('src'));

                // 有東西的話再判斷：這個東西是不是自己（點擊的+ icon）？
                // 如果第二次點擊+ icon的src ，不是自己的src （和角色框內的配件圖src不一樣）
                if ($(this).next().attr('src') !== $('.fitting-room-roleplay-start-wear .fitting-room-roleplay-hand img').attr('src')) {

                    // 帶有item-hand的classsname才能配戴
                    if ($(this).next().hasClass('left')) {

                        // 第二次點擊的配件邊框變成黃色
                        // $(this).parent().addClass('active');
                        // 其他的配件邊框變成灰色
                        // $(this).parent().parent().siblings().children('.fitting-room-item-imgwrap').removeClass('active');

                        // 先清空原本左手div盒子的配件圖
                        // $('.fitting-room-roleplay-start-wear .fitting-room-roleplay-hand').empty();

                        // 再將左手的div盒子append 第二次點擊的配件圖src
                        var img2 = $(this).next().attr('src');

                        $('.fitting-room-roleplay-start-wear .fitting-room-roleplay-hand').html(`<img class="roleplay-content-item" src="${img2}"/>`);
                    }

                } else {
                    // 如果第二次點擊+ icon的src ，等於自己的src （和角色框內的配件圖src一樣）

                    $('.fitting-room-roleplay-start-wear .fitting-room-roleplay-hand').empty();

                    // $(this).parent().removeClass('active');
                }
            }




            // 下面是 object盒子----------------------------
            // 先判斷：在左手的div盒子有沒有東西
            if ($('.fitting-room-roleplay-start-wear .fitting-room-roleplay-object').children().length == 0) {

                // 沒有東西的話
                // $(this).next()配件縮圖 帶有item-hand的classsname
                if ($(this).next().hasClass('right')) {

                    // 宣告變數：配件縮圖的src
                    var img = $(this).next().attr('src');

                    // 在左手的div盒子append 此配件縮圖的src
                    // 
                    $('.fitting-room-roleplay-start-wear .fitting-room-roleplay-object').html(`<img class="roleplay-content-item" src="${img}"/>`);

                    // 同時此配件縮圖的邊框會變黃色
                    // $(this).parent().addClass('active');
                }


            } else {
                // console.log($('.fitting-room-roleplay-start-wear .fitting-room-roleplay-object img').attr('src'));
                // console.log($(this).next().attr('src'));

                // 有東西的話再判斷：這個東西是不是自己（點擊的+ icon）？
                // 如果第二次點擊+ icon的src ，不是自己的src （和角色框內的配件圖src不一樣）
                if ($(this).next().attr('src') !== $('.fitting-room-roleplay-start-wear .fitting-room-roleplay-object img').attr('src')) {

                    // 帶有item-hand的classsname才能配戴
                    if ($(this).next().hasClass('right')) {

                        // 第二次點擊的配件邊框變成黃色
                        // $(this).parent().addClass('active');
                        // 其他的配件邊框變成灰色
                        // $(this).parent().parent().siblings().children('.fitting-room-item-imgwrap').removeClass('active');

                        // 先清空原本左手div盒子的配件圖
                        // $('.fitting-room-roleplay-start-wear .fitting-room-roleplay-hand').empty();

                        // 再將左手的div盒子append 第二次點擊的配件圖src
                        var img2 = $(this).next().attr('src');

                        $('.fitting-room-roleplay-start-wear .fitting-room-roleplay-object').html(`<img class="roleplay-content-item" src="${img2}"/>`);
                    }

                } else {
                    // 如果第二次點擊+ icon的src ，等於自己的src （和角色框內的配件圖src一樣）

                    $('.fitting-room-roleplay-start-wear .fitting-room-roleplay-object').empty();

                    // $(this).parent().removeClass('active');
                }
            }





            // 下面是 head盒子----------------------------
            // 先判斷：在左手的div盒子有沒有東西
            if ($('.fitting-room-roleplay-start-wear .fitting-room-roleplay-head').children().length == 0) {

                // 沒有東西的話
                // $(this).next()配件縮圖 帶有item-hand的classsname
                if ($(this).next().hasClass('top')) {

                    // 宣告變數：配件縮圖的src
                    var img = $(this).next().attr('src');

                    // 在左手的div盒子append 此配件縮圖的src
                    // 
                    $('.fitting-room-roleplay-start-wear .fitting-room-roleplay-head').html(`<img class="roleplay-content-item" src="${img}"/>`);

                    // 同時此配件縮圖的邊框會變黃色
                    // $(this).parent().addClass('active');
                }


            } else {
                // console.log($('.fitting-room-roleplay-start-wear .fitting-room-roleplay-head img').attr('src'));
                // console.log($(this).next().attr('src'));

                // 有東西的話再判斷：這個東西是不是自己（點擊的+ icon）？
                // 如果第二次點擊+ icon的src ，不是自己的src （和角色框內的配件圖src不一樣）
                if ($(this).next().attr('src') !== $('.fitting-room-roleplay-start-wear .fitting-room-roleplay-head img').attr('src')) {

                    // 帶有item-hand的classsname才能配戴
                    if ($(this).next().hasClass('top')) {

                        // 第二次點擊的配件邊框變成黃色
                        // $(this).parent().addClass('active');
                        // 其他的配件邊框變成灰色
                        // $(this).parent().parent().siblings().children('.fitting-room-item-imgwrap').removeClass('active');

                        // 先清空原本左手div盒子的配件圖
                        // $('.fitting-room-roleplay-start-wear .fitting-room-roleplay-hand').empty();

                        // 再將左手的div盒子append 第二次點擊的配件圖src
                        var img2 = $(this).next().attr('src');

                        $('.fitting-room-roleplay-start-wear .fitting-room-roleplay-head').html(`<img class="roleplay-content-item" src="${img2}"/>`);
                    }

                } else {
                    // 如果第二次點擊+ icon的src ，等於自己的src （和角色框內的配件圖src一樣）

                    $('.fitting-room-roleplay-start-wear .fitting-room-roleplay-head').empty();

                    // $(this).parent().removeClass('active');
                }
            }


        }
    });


    // 點擊收藏愛心 填滿/取消顏色----------------------------
    $('.fitting-room-item-imgwrap-follow-heart svg').click(function() {
        console.log('hi');

        if ($(this).hasClass('follow-heart-show')) {
            $(this).removeClass('follow-heart-show');
        } else {
            $(this).addClass('follow-heart-show');
        }
    });



    // 點擊i icon，跳出配件詳細內容頁（光箱）------------------------

    $('.fitting-room-item-name svg').click(function() {
        $('.itemshop-itemdetails').addClass('show');

        var img3 = $(this).parent().siblings('.fitting-room-item-imgwrap').children('img').attr('src');
        // console.log(img3);

        $('.itemshop-itemdetailsm-item-imgwrap img').attr('src', img3);

    });

    $('.itemshop-itemdetails-close').click(function() {
        $('.itemshop-itemdetails').removeClass('show');
    });



    // 點擊前往購買，跳出選擇代幣購買頁（光箱）------------------------
    // 點擊角色框下方的購物車按鈕
    $('.fitting-room-buy-text').click(function() {
        // console.log('hello');
        $('.itemshop-choose-coin').addClass('itemshop-choose-coin-show');
    });

    // 點擊詳細內容光箱頁的購物車按鈕
    $('.itemshop-itemdetails-buy').click(function() {
        $('.itemshop-choose-coin').addClass('itemshop-choose-coin-show');
    });

    $('.itemshop-choose-coin-close').click(function() {
        $('.itemshop-choose-coin').removeClass('itemshop-choose-coin-show');
    });
</script>
<script>
    // 分類篩選的function （用AJAX方式）
    function selectItems(cate = 0, cate_hot = 0, cate_tag = 0, page = 1) {

        $.get('itemshop-api2.php', {
            cate,
            cate_hot,
            cate_tag,
            page,
        }, function(data) {
            // console.log(data);
            // 從itemshop-api2.php拿html塞回畫面做呈現（用text格式 不是json）
            $('.fitting-room-items-list-wrap').html(data);

        }, 'text');
    };
    selectItems();

    //啟用加購按鈕

    $('.itemshop-choose-coin-btn-gold').on('click', event => {
        const a = $(event.currentTarget);
        const sid = a.attr('data-sid');
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
        }, 'json');
    });

</script>


<?php include __DIR__ . '/parts/html-last.php' ?>