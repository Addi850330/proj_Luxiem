<?php
require './parts/connect-db.php';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$cate = isset($_GET['cate']) ? intval($_GET['cate']) : 0; // 0表示 預設值為: 查看所有商品

// 熱門專區 和 #hashtags
$cate_hot = isset($_GET['cate_hot']) ? intval($_GET['cate_hot']) : 0;
$cate_tag = isset($_GET['cate_tag']) ? intval($_GET['cate_tag']) : 0;


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


$perPage = 6; // 每一頁有幾筆資料

$output = [
    'perPage' => $perPage,
    'totalRows' => 0,
    'totalPages' => 0,
    'page' => $page,
    'rows' => [],  // 分頁的資料
];

if ($page < 1) {
    header('Location: itemshop-api.php');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM items $where";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$output['totalRows'] = $totalRows;

$totalPages = ceil($totalRows / $perPage);
$output['totalPages'] = $totalPages;

if ($totalPages > 0) {
    if ($page > $totalPages) {
        header('Location: itemshop-api.php?page=' . $totalPages);
        exit;
    }

    // 讀取分頁的資料
    $sql = sprintf("SELECT `sid`, `item_categories_sid`, `item_name`, `item_img`, `item_img_position`, `item_price`, `item_created_at`, `item_introduction`, `item_author`, `item_story`, `item_type` FROM items $where ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

    $rows = $output['rows'] = $pdo->query($sql)->fetchAll(); // 設定$rows變數給下面使用
}

// *** 讀取分類選單的資料
$c_sql = "SELECT * FROM item_categories  ORDER BY sid";
$cates = $pdo->query($c_sql)->fetchAll();

// 讀取熱門專區的選單資料
$c_hot_sql = "SELECT * FROM hots";
$cates_hot = $pdo->query($c_hot_sql)->fetchAll();

// 讀取#hashtags的選單資料
$c_tag_sql = "SELECT * FROM tags";
$cates_tag = $pdo->query($c_tag_sql)->fetchAll();



// header('Content-Type: application/json');  // 伺服器告訴用戶端文件的格式為 JSON
// echo json_encode($output, JSON_UNESCAPED_UNICODE);

// http://localhost/proj_Luxiem/itemshop-api.php?cate=5&cate_tag=2
?>


<div class="fitting-room-items-list-row1 fitting-room-items-list-rowtop d-flex flex-wrap">
    <?php foreach ($rows as $r) : ?>
        <div class="fitting-room-item-unit col-4 mb-4 item-data" data-d='<?= json_encode($r, JSON_UNESCAPED_UNICODE) ?>'>
            <div class="fitting-room-item-imgwrap">
                <!-- 喜愛追蹤 飄入愛心 -->
                <div class="fitting-room-item-imgwrap-follow-heart">
                    <svg viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.4282 3.52466L7.75777 2.89015C6.27671 1.48843 3.93975 1.55276 2.53804 3.03382V3.03382C1.13632 4.51488 1.20064 6.85183 2.6817 8.25355L8.71552 13.9641L14.4261 7.93031C15.8278 6.44925 15.7635 4.11229 14.2824 2.71058V2.71058C12.8014 1.30886 10.4644 1.37318 9.06271 2.85424L8.4282 3.52466Z" stroke="#D3B572" stroke-width="2" />
                    </svg>
                </div>

                <!-- 加號icon 套用配件 -->
                <div class="fitting-room-item-imgwrap-add-wear">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 3.33331V12.6666" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M3.33325 8H12.6666" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>

                <img class="<?= $r['item_img_position'] ?>" data-position="<?= $r['item_img_position'] ?>" src="./imgs/Itemshop/Avatar_item/<?= $r['item_img'] ?>" alt="...">
            </div>
            <div class="fitting-room-item-name d-flex justify-content-between align-items-center">
                <p><?= $r['item_name'] ?></p>
                <svg viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.99984 12.8334C10.2215 12.8334 12.8332 10.2217 12.8332 7.00008C12.8332 3.77842 10.2215 1.16675 6.99984 1.16675C3.77818 1.16675 1.1665 3.77842 1.1665 7.00008C1.1665 10.2217 3.77818 12.8334 6.99984 12.8334Z" stroke="#FCFCFC" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M7 9.33333V7" stroke="#FCFCFC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M7 4.66675H7.00583" stroke="#FCFCFC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="d-flex fitting-room-item-name-price justify-content-between">
                <div class="d-flex fitting-room-item-name-price-gold align-items-center">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.25 9.33344V4.66677C12.2498 4.46218 12.1958 4.26125 12.0934 4.08412C11.991 3.90699 11.8438 3.7599 11.6667 3.65761L7.58333 1.32427C7.40598 1.22188 7.20479 1.16797 7 1.16797C6.79521 1.16797 6.59402 1.22188 6.41667 1.32427L2.33333 3.65761C2.15615 3.7599 2.00899 3.90699 1.9066 4.08412C1.80422 4.26125 1.75021 4.46218 1.75 4.66677V9.33344C1.75021 9.53803 1.80422 9.73897 1.9066 9.91609C2.00899 10.0932 2.15615 10.2403 2.33333 10.3426L6.41667 12.6759C6.59402 12.7783 6.79521 12.8322 7 12.8322C7.20479 12.8322 7.40598 12.7783 7.58333 12.6759L11.6667 10.3426C11.8438 10.2403 11.991 10.0932 12.0934 9.91609C12.1958 9.73897 12.2498 9.53803 12.25 9.33344Z" fill="#D3B572" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="fitting-room-item-name-price-gold-number"><?= $r['item_price'] / 10 ?></div>

                </div>
                <div class="d-flex fitting-room-item-name-price-free align-items-center">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.99984 12.8334C10.2215 12.8334 12.8332 10.2217 12.8332 7.00008C12.8332 3.77842 10.2215 1.16675 6.99984 1.16675C3.77818 1.16675 1.1665 3.77842 1.1665 7.00008C1.1665 10.2217 3.77818 12.8334 6.99984 12.8334Z" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8.75 5.25H5.25V8.75H8.75V5.25Z" stroke="#D3B572" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="fitting-room-item-name-price-free-number"><?= $r['item_price'] ?></div>

                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- 手機版 左右輪播箭頭 -->
<div class="mobile-items-list-arrow d-flex justify-content-between">
    <a href="javascript:selectItems(<?= $cate ?>, <?= $cate_hot ?>, <?= $cate_tag ?>, <?= $page - 1 ?>)" class="mobile-items-list-arrow-left">
        <i class="fa-solid fa-angle-left"></i>
    </a>
    <a href="javascript:selectItems(<?= $cate ?>, <?= $cate_hot ?>, <?= $cate_tag ?>, <?= $page + 1 ?>)" class="mobile-items-list-arrow-right">
        <i class="fa-solid fa-chevron-right"></i>
    </a>
</div>

<!-- 桌機版 頁尾分頁 -->
<div class="desktop-items-list-arrow d-flex align-items-center">
    <a href="javascript:selectItems(<?= $cate ?>, <?= $cate_hot ?>, <?= $cate_tag ?>, 1)">
        <i class="fa-solid fa-angles-left"></i>
    </a>
    <a href="javascript:selectItems(<?= $cate ?>, <?= $cate_hot ?>, <?= $cate_tag ?>, <?= $page - 1 ?>)">
        <i class="fa-solid fa-chevron-left"></i>
    </a>

    <?php for ($i = $page - 2; $i <= $page + 2; $i++) : ?>
        <?php if ($i >= 1 and $i <= $totalPages) :
            $params['page'] = $i;
        ?>
            <a href="javascript:selectItems(<?= $cate ?>, <?= $cate_hot ?>, <?= $cate_tag ?>, <?= $i ?>)"><?= $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <a href="javascript:selectItems(<?= $cate ?>, <?= $cate_hot ?>, <?= $cate_tag ?>, <?= $page + 1 ?>)">
        <i class="fa-solid fa-chevron-right"></i>
    </a>
    <a href="javascript:selectItems(<?= $cate ?>, <?= $cate_hot ?>, <?= $cate_tag ?>, <?= $totalPages ?>)">
        <i class="fa-solid fa-angles-right"></i>
    </a>

</div>



<script>
    window.cate = <?= $cate ?>;
    window.cate_hot = <?= $cate_hot ?>;
    window.cate_tag = <?= $cate_tag ?>;
    window.page = <?= $page ?>;

    $('.fitting-room-item-imgwrap-add-wear').click(function() {
        // console.log('hi');
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
        // console.log('hi');

        if ($(this).hasClass('follow-heart-show')) {
            $(this).removeClass('follow-heart-show');
        } else {
            $(this).addClass('follow-heart-show');
        }
    });


    // 點擊i icon，跳出配件詳細內容頁（光箱）------------------------

    $('.fitting-room-item-name svg').click(function() {
        $('.itemshop-itemdetails').addClass('show');

        let itemData = $(this).closest('.item-data').attr('data-d');

        // 下面是 轉換成原生物件
        itemData = JSON.parse(itemData);
        console.log(itemData);

        // var img3 = $(this).parent().siblings('.fitting-room-item-imgwrap').children('img').attr('src');
        // console.log(img3);

        $('.itemshop-itemdetails-name').text(itemData.item_name);

        $('.itemshop-itemdetailsm-item-imgwrap img').attr('src', './imgs/Itemshop/Avatar_item/' + itemData.item_img);

        $('.itemshop-itemdetails-item-price-gold-number').text(itemData.item_price / 10);
        $('.itemshop-itemdetails-item-price-free-number').text(itemData.item_price);

        $('.itemshop-itemdetails-conten1').text(itemData.item_introduction);
        $('.itemshop-itemdetails-conten2').text(itemData.item_story);
        $('.itemshop-itemdetails-type-name2').text(itemData.item_type);
        $('.itemshop-itemdetails-item-author-name').text(itemData.item_author);

    });

    $('.itemshop-itemdetails-close').click(function() {
        $('.itemshop-itemdetails').removeClass('show');
    });
</script>