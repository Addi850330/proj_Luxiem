<?php
require './parts/connect-db.php';
$pageName = 'coinshop';
$title = '喜愛收藏頁';


$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //
$perPage = 9;
// 每頁5筆資料
//修改筆數

$output = [
    'perPage' => $perPage,
    'totalRows' => 0,
    'totalPages' => 0,
    'page' => $page,
    'row' => [],
];


//設定不可小於1頁數 
if ($page < 1) {
    header('Location: hold-item.php'); //header轉向
    exit;
}

$t_sql = "SELECT COUNT(1) FROM followed_list";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$output['totalRows'] = $totalRows;


$totalPages = ceil($totalRows / $perPage);
$output['totalPages'] = $totalPages;


//設定不可大於總頁數
if ($totalPages > 0) {
    if ($page > $totalPages) {
        header('Location: hold-item.php?page=' . $totalPages);
        exit;
    }
}

//讀取分業資料
$sql = sprintf("SELECT * FROM items LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

$output['rows'] = $pdo->query($sql)->fetchAll();

// header('Content-Type: application/json');
// echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>

<?php include __DIR__ . '/parts/html-head.php' ?>
<!-- 各個網頁所使用的css會放在這 -->
<!-- <link rel="stylesheet" href="./bootstrap-4.2.1-dist/css/bootstrap.min.css"> -->
<!-- bootstrap4 -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<!-- font-awesome6.0.0 CDN-->
<!-- <link rel="stylesheet" href="./fontawesome/css/all.min.css"> -->
<!-- font-awesome6.0.0 -->
<!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Kaisei+Opti:wght@400;500;700&family=Noto+Sans+TC:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> -->
<!-- google fonts  -->
<link rel="stylesheet" href="./css/item_follow.css">
<?php include __DIR__ . '/parts/html-navbar.php' ?>

<!-- html會塞在這邊 -->
<!-- 是否刪除勾選的配件?（光箱頁） -->
<div class="addfollow-sure-delete-item">
    <div class="addfollow-sure-delete-item-wrap">
        <div class="addfollow-sure-delete-item-name d-flex justify-content-center align-items-center">
            <svg width="47" height="47" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.3928 3.91666H31.6078L43.0837 15.3925V31.6075L31.6078 43.0833H15.3928L3.91699 31.6075V15.3925L15.3928 3.91666Z" stroke="#D3B572" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M23.5 15.6667V23.5" stroke="#D3B572" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M23.5 31.3333H23.5196" stroke="#D3B572" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <p>提示訊息</p>
        </div>

        <div class="addfollow-sure-delete-item-text">
            是否刪除勾選的配件?
        </div>

        <div class="addfollow-sure-delete-item-main">
            <!-- 按鈕 -->
            <div class="addfollow-sure-delete-item-btn">
                <div class="checkout">
                    <button class="cancle-btn">取消</button>
                    <button class="check-btn">確定</button>
                </div>
            </div>

        </div>



        <!-- 關閉叉叉按鈕 -->
        <div class="addfollow-sure-delete-item-close">
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M25.5 8.5L8.5 25.5" stroke="#667080" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8.5 8.5L25.5 25.5" stroke="#667080" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
    </div>
</div>







<section class="mc-bg">
    <div class="side_nav_wrap">
        <div class="side_nav_wrap_upper">
            <div class="vertical_line">
                <svg width="3.1" height="440" viewBox="0 0 3 350" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.50001 0.5L1.49749 380.5" stroke="#D3B572" stroke-width="2" />
                </svg>
            </div>
            <div class="side_nav">
                <div class="side_nav_ticket">
                    <div class="hex_icon">
                        <svg width="20" height="20" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.5 0L18.5933 5.25V15.75L9.5 21L0.406734 15.75V5.25L9.5 0Z" fill="#D3B572" />
                        </svg>
                    </div>
                    <a href="./merber-center.php">
                        <span class="side_nav_text h1">會員中心首頁</span>
                    </a>
                </div>
                <div class="side_nav_ticket">
                    <div class="hex_icon_wrap">
                        <div class="hex_icon">
                            <svg width="20" height="20" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.5 0L18.5933 5.25V15.75L9.5 21L0.406734 15.75V5.25L9.5 0Z" fill="#D3B572" />
                            </svg>
                        </div>
                    </div>
                    <a href="./merber-info-revise.php"><span class="side_nav_text h1">會員資料修改</span></a>
                </div>
                <div class="side_nav_ticket">
                    <div class="hex_icon_wrap">
                        <div class="hex_icon">
                            <svg width="20" height="20" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.5 0L18.5933 5.25V15.75L9.5 21L0.406734 15.75V5.25L9.5 0Z" fill="#D3B572" />
                            </svg>
                        </div>
                    </div>
                    <a href="./7.order_check.php"><span class="side_nav_text h1">訂單查詢</span></a>
                </div>
                <div class="side_nav_ticket">
                    <div class="hex_icon_wrap">
                        <div class="hex_icon">
                            <svg width="20" height="20" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.5 0L18.5933 5.25V15.75L9.5 21L0.406734 15.75V5.25L9.5 0Z" fill="#D3B572" />
                            </svg>
                        </div>
                    </div>
                    <a href="./3.item_follow_v2.php"><span class="side_nav_text h1">喜好收藏</span></a>
                </div>
                <div class="side_nav_ticket">
                    <div class="hex_icon_wrap">
                        <div class="hex_icon">
                            <svg width="20" height="20" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.5 0L18.5933 5.25V15.75L9.5 21L0.406734 15.75V5.25L9.5 0Z" fill="#D3B572" />
                            </svg>
                        </div>
                    </div>
                    <a href="./hold-item.php"><span class="side_nav_text h1">持有配件</span></a>
                </div>
            </div>
        </div>
        <div class="side_nav_wrap_down">
            <div class="news_wrap">
                <div class="news_wrap_left_deco">
                    <svg width="37" height="122" viewBox="0 0 37 122" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.536 85.7451C2.144 85.7451 2.448 86.0491 2.448 86.6571C2.448 86.9131 2.432 87.1691 2.4 87.4251C2.368 87.6811 2.352 87.9371 2.352 88.1931C2.352 88.3211 2.368 88.4651 2.4 88.6251C2.4 88.7851 2.4 88.9451 2.4 89.1051C2.4 89.4251 2.608 89.6331 3.024 89.7291C3.408 89.8251 3.84 89.8731 4.32 89.8731C4.768 89.8731 5.088 89.8731 5.28 89.8731L35.184 89.8731C35.408 89.8731 35.6 89.9051 35.76 89.9691C35.92 90.0011 36.016 90.1611 36.048 90.4491C36.112 90.8971 36.128 91.3771 36.096 91.8891C36.096 92.4011 36.112 92.8811 36.144 93.3291C35.312 93.5851 34.512 93.9531 33.744 94.4331C32.976 94.8811 32.24 95.3611 31.536 95.8731C27.248 98.8171 23.104 101.937 19.104 105.233C15.104 108.497 10.992 111.633 6.768 114.641C11.088 114.641 15.408 114.657 19.728 114.689C24.016 114.689 28.32 114.689 32.64 114.689C32.928 114.689 33.296 114.657 33.744 114.593C34.16 114.497 34.368 114.257 34.368 113.873C34.368 113.425 34.352 112.977 34.32 112.529C34.288 112.049 34.272 111.601 34.272 111.185C34.272 110.929 34.4 110.769 34.656 110.705C34.88 110.609 35.072 110.561 35.232 110.561C35.456 110.561 35.664 110.625 35.856 110.753C36.048 110.849 36.144 111.025 36.144 111.281C36.144 111.825 36.112 112.369 36.048 112.913C35.984 113.457 35.952 114.001 35.952 114.545C35.952 115.281 35.968 116.033 36 116.801C36 117.569 36.032 118.321 36.096 119.057C36.128 119.345 36.144 119.633 36.144 119.921C36.176 120.177 36.192 120.433 36.192 120.689C36.192 121.329 35.856 121.649 35.184 121.649C34.928 121.649 34.72 121.553 34.56 121.361C34.368 121.169 34.272 120.961 34.272 120.737C34.272 120.417 34.304 120.113 34.368 119.825C34.4 119.537 34.416 119.233 34.416 118.913C34.416 118.433 34.352 118.081 34.224 117.857C34.064 117.601 33.696 117.473 33.12 117.473C28.704 117.473 24.288 117.441 19.872 117.377C15.456 117.281 11.04 117.233 6.624 117.233C6.208 117.233 5.808 117.233 5.424 117.233C5.04 117.233 4.64 117.233 4.224 117.233C3.808 117.233 3.392 117.313 2.976 117.473C2.56 117.601 2.352 117.921 2.352 118.433C2.352 118.817 2.368 119.217 2.4 119.633C2.432 120.017 2.448 120.417 2.448 120.833C2.448 121.377 2.144 121.649 1.536 121.649C0.959997 121.649 0.671997 121.361 0.671997 120.785C0.671997 119.953 0.687998 119.121 0.719999 118.289C0.751999 117.457 0.767998 116.641 0.767998 115.841C0.767998 115.105 0.767998 114.369 0.767998 113.633C0.735999 112.865 0.719999 112.113 0.719999 111.377C3.28 109.489 5.76 107.505 8.16 105.425C10.528 103.313 12.976 101.297 15.504 99.3771C17.008 98.2571 18.512 97.1211 20.016 95.9691C21.52 94.8171 23.008 93.6491 24.48 92.4651C21.088 92.4651 17.696 92.4651 14.304 92.4651C10.912 92.4331 7.52 92.4171 4.128 92.4171C3.84 92.4171 3.488 92.4651 3.072 92.5611C2.624 92.6251 2.4 92.8651 2.4 93.2811L2.4 94.5771C2.4 94.7691 2.432 94.9611 2.496 95.1531C2.528 95.3451 2.544 95.5371 2.544 95.7291C2.544 96.3371 2.208 96.6411 1.536 96.6411C1.152 96.6411 0.927997 96.5291 0.863996 96.3051C0.767998 96.0811 0.719998 95.8091 0.719998 95.4891C0.719998 94.8491 0.735998 94.2251 0.767997 93.6171C0.799997 92.9771 0.815997 92.3531 0.815997 91.7451C0.815997 90.9131 0.783997 90.0811 0.719998 89.2491C0.655997 88.3851 0.623996 87.5371 0.623996 86.7051C0.623996 86.4491 0.719997 86.2251 0.911998 86.0331C1.072 85.8411 1.28 85.7451 1.536 85.7451ZM19.152 67.876C18.512 67.876 17.744 67.908 16.848 67.972C15.952 68.036 15.088 68.196 14.256 68.452C13.392 68.676 12.672 69.044 12.096 69.556C11.52 70.068 11.232 70.772 11.232 71.668C11.232 72.532 11.52 73.3 12.096 73.972C12.64 74.612 13.344 75.156 14.208 75.604C15.04 76.052 15.92 76.404 16.848 76.66C17.744 76.916 18.544 77.108 19.248 77.236C19.248 76.692 19.264 76.164 19.296 75.652C19.296 75.108 19.296 74.58 19.296 74.068C19.296 71.988 19.248 69.924 19.152 67.876ZM29.76 60.964C29.856 60.964 30 60.996 30.192 61.06C30.352 61.092 30.48 61.14 30.576 61.204C31.088 61.428 31.68 61.844 32.352 62.452C32.992 63.06 33.488 63.604 33.84 64.084C35.472 66.228 36.288 68.708 36.288 71.524C36.288 74.052 35.76 76.244 34.704 78.1C33.616 79.956 32.112 81.38 30.192 82.372C28.272 83.364 26.064 83.86 23.568 83.86C21.072 83.86 18.816 83.38 16.8 82.42C14.752 81.428 13.136 80.02 11.952 78.196C10.736 76.34 10.128 74.116 10.128 71.524C10.128 68.548 10.944 66.164 12.576 64.372C14.208 62.58 16.544 61.684 19.584 61.684C20.416 61.684 20.832 62.068 20.832 62.836C20.832 64.244 20.816 65.652 20.784 67.06C20.752 68.468 20.736 69.876 20.736 71.284C20.736 72.308 20.736 73.332 20.736 74.356C20.736 75.38 20.752 76.404 20.784 77.428C21.744 77.524 22.72 77.572 23.712 77.572C24.608 77.572 25.664 77.46 26.88 77.236C28.096 76.98 29.28 76.612 30.432 76.132C31.584 75.62 32.544 74.964 33.312 74.164C34.048 73.364 34.416 72.388 34.416 71.236C34.416 69.796 34.208 68.596 33.792 67.636C33.376 66.644 32.784 65.764 32.016 64.996C31.248 64.228 30.336 63.444 29.28 62.644C29.152 62.548 29.056 62.452 28.992 62.356C28.896 62.228 28.848 62.084 28.848 61.924C28.848 61.7 28.944 61.492 29.136 61.3C29.296 61.076 29.504 60.964 29.76 60.964ZM10.848 20.0717C11.232 20.0717 11.456 20.1837 11.52 20.4077C11.552 20.5997 11.568 20.8237 11.568 21.0797C11.568 21.4957 11.616 21.9277 11.712 22.3757C11.776 22.7917 12.048 23.1117 12.528 23.3357C12.848 23.4637 13.2 23.5757 13.584 23.6717C13.936 23.7677 14.288 23.8637 14.64 23.9597C18.224 24.9517 21.808 25.9757 25.392 27.0317C28.944 28.0877 32.496 29.1597 36.048 30.2477L36.24 35.5277C33.264 36.3277 30.32 37.2077 27.408 38.1677C24.464 39.1277 21.504 40.0397 18.528 40.9037C21.472 41.8317 24.4 42.8397 27.312 43.9277C30.192 44.9837 33.104 45.9757 36.048 46.9037L36.24 51.4637C33.744 52.1037 31.248 52.7597 28.752 53.4317C26.256 54.0717 23.744 54.7277 21.216 55.3997C19.936 55.7197 18.656 56.0397 17.376 56.3597C16.096 56.6797 14.816 57.0317 13.536 57.4157C13.088 57.5437 12.768 57.7197 12.576 57.9437C12.352 58.1677 12.24 58.5037 12.24 58.9517C12.24 59.1757 12.256 59.3997 12.288 59.6237C12.32 59.8157 12.336 60.0237 12.336 60.2477C12.336 60.6637 12.128 60.8717 11.712 60.8717C11.296 60.8717 11.04 60.6637 10.944 60.2477C10.944 60.2157 10.912 59.9437 10.848 59.4317C10.784 58.9197 10.72 58.2957 10.656 57.5597C10.56 56.8237 10.464 56.0877 10.368 55.3517C10.272 54.5837 10.208 53.9277 10.176 53.3837C10.112 52.8397 10.08 52.5357 10.08 52.4717C10.08 52.2157 10.144 52.0557 10.272 51.9917C10.4 51.8957 10.56 51.8317 10.752 51.7997C11.84 51.5117 12.944 51.2557 14.064 51.0317C15.152 50.7757 16.256 50.5357 17.376 50.3117C19.616 49.7997 21.856 49.3037 24.096 48.8237C26.336 48.3437 28.592 47.8637 30.864 47.3837C27.632 46.4557 24.4 45.4797 21.168 44.4557C17.936 43.3997 14.72 42.3757 11.52 41.3837C11.072 41.2237 10.752 41.0797 10.56 40.9517C10.336 40.8237 10.208 40.5037 10.176 39.9917C10.144 39.7677 10.128 39.5437 10.128 39.3197C10.096 39.0637 10.08 38.8237 10.08 38.5997C10.08 37.8957 10.368 37.4157 10.944 37.1597C11.296 36.9997 11.68 36.8877 12.096 36.8237C12.48 36.7597 12.848 36.6797 13.2 36.5837C13.936 36.3597 14.688 36.1517 15.456 35.9597C16.192 35.7357 16.928 35.5117 17.664 35.2877C19.968 34.6157 22.272 33.9437 24.576 33.2717C26.848 32.5677 29.136 31.8637 31.44 31.1597C28.592 30.3597 25.76 29.5917 22.944 28.8557C20.096 28.0877 17.248 27.3837 14.4 26.7437C13.984 26.6797 13.584 26.5997 13.2 26.5037C12.784 26.3757 12.368 26.3117 11.952 26.3117C11.728 26.3117 11.584 26.5037 11.52 26.8877C11.456 27.2397 11.44 27.6397 11.472 28.0877C11.472 28.5037 11.472 28.7917 11.472 28.9517C11.472 29.4637 11.264 29.7197 10.848 29.7197C10.4 29.7197 10.176 29.4957 10.176 29.0477L10.176 20.7437C10.176 20.2957 10.4 20.0717 10.848 20.0717ZM28.944 0.65275C30.448 0.65275 31.68 0.97275 32.64 1.61275C33.568 2.25275 34.288 3.10075 34.8 4.15675C35.312 5.21275 35.664 6.36475 35.856 7.61275C36.048 8.82875 36.144 10.0448 36.144 11.2608C36.144 12.0608 36.064 12.8448 35.904 13.6128C35.744 14.3808 35.568 15.1488 35.376 15.9168C35.312 16.2368 35.248 16.5728 35.184 16.9248C35.088 17.2768 35.04 17.6288 35.04 17.9808C34.592 18.1088 33.936 18.3008 33.072 18.5568C32.176 18.7808 31.312 19.0048 30.48 19.2288C29.616 19.4208 29.008 19.5168 28.656 19.5168C28.304 19.5168 28.08 19.4048 27.984 19.1808C27.888 18.9568 27.84 18.7168 27.84 18.4608C27.84 18.0768 27.984 17.7888 28.272 17.5968C28.944 17.1168 29.648 16.7328 30.384 16.4448C31.12 16.1568 31.808 15.7088 32.448 15.1008C32.928 14.6528 33.424 14.0128 33.936 13.1808C34.416 12.3168 34.656 11.5488 34.656 10.8768C34.656 9.43675 34.32 8.36475 33.648 7.66075C32.976 6.92475 31.904 6.55675 30.432 6.55675C29.44 6.55675 28.608 6.86075 27.936 7.46875C27.264 8.07675 26.656 8.86075 26.112 9.82075C25.568 10.7488 25.04 11.7408 24.528 12.7968C23.984 13.8528 23.392 14.8608 22.752 15.8208C22.112 16.7488 21.344 17.5168 20.448 18.1248C19.52 18.7328 18.4 19.0368 17.088 19.0368C15.456 19.0368 14.128 18.5888 13.104 17.6928C12.08 16.7968 11.328 15.6608 10.848 14.2848C10.368 12.8768 10.128 11.4688 10.128 10.0608C10.128 9.42075 10.176 8.79675 10.272 8.18875C10.368 7.58075 10.544 6.97275 10.8 6.36475C10.896 6.07675 11.024 5.69275 11.184 5.21275C11.312 4.70075 11.376 4.30075 11.376 4.01275C11.376 3.59675 11.328 3.19675 11.232 2.81275C12.128 2.74875 13.024 2.65275 13.92 2.52475C14.816 2.36475 15.712 2.26875 16.608 2.23675L16.752 2.23675C17.072 2.20475 17.344 2.30075 17.568 2.52475C17.76 2.71675 17.856 2.95675 17.856 3.24475C17.856 3.56475 17.792 3.80475 17.664 3.96475C17.536 4.09275 17.344 4.22075 17.088 4.34875C16.16 4.76475 15.28 5.18075 14.448 5.59675C13.584 5.98075 12.88 6.50875 12.336 7.18075C11.792 7.82075 11.52 8.74875 11.52 9.96475C11.52 11.2448 12.016 12.1888 13.008 12.7968C14 13.4048 15.056 13.7088 16.176 13.7088C17.072 13.7088 17.84 13.3728 18.48 12.7008C19.12 12.0288 19.632 11.3408 20.016 10.6368C20.464 9.77275 20.96 8.78075 21.504 7.66075C22.048 6.50875 22.672 5.40475 23.376 4.34875C24.08 3.29275 24.896 2.41275 25.824 1.70875C26.72 1.00475 27.76 0.65275 28.944 0.65275Z" fill="#D3B572" />
                    </svg>
                </div>
                <div class="news_img_wrap">
                    <img src="./imgs/member-center/news-img.png" alt="">
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="try-design">
            <!-- 下拉式篩選器 -->
            <div class="item-follow-select-wrap">
                <div class="dropdown item-follow-select">
                    <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        篩選條件
                    </a>
                    <div class="dropdown-menu item-follow-select-list" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">價錢 由低到高</a>
                        <a class="dropdown-item" href="#">價錢 由高到低</a>
                        <a class="dropdown-item" href="#">時間 由新到舊</a>
                        <a class="dropdown-item" href="#">時間 由舊到新</a>
                    </div>
                </div>
            </div>

            <div class="design-self">
                <div class="design-hold-item">
                    <!-- Hashtags -->
                    <div class="item-follow-tag d-flex">
                        <button class="tag-btn-all"># 全部</button>
                        <button class="tag-btn-object"># 物品</button>
                        <button class="tag-btn-hand"># 手部</button>
                        <button class="tag-btn-head"># 頭部</button>
                        <button class="tag-btn-body"># 身體</button>
                    </div>

                    <!-- 喜好收藏 配件清單列表 -->
                    <div class="fitem-follow-items-list-row1 item-follow-items-list-rowtop d-flex flex-wrap">
                        <div class="item-follow-item-unit item-followed-1 col-4 col-xl-3 mb-4">
                            <div class="item-follow-item-imgwrap">
                                <img src="./imgs/Itemshop/Avatar_item/Vox/head/vox_head_top_ChefHat1.png" alt="">
                            </div>
                            <!-- Checkbox -->
                            <div class="item-follow-item-name-and-check">
                                <label class="control control--checkbox">黑廚師帽
                                    <input type="checkbox" />
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                            <!-- 配件類型和info icon -->
                            <div class="item-follow-item-type-and-info d-flex align-items-center justify-content-between">
                                <a href="#">
                                    <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.99967 14.6663C11.6816 14.6663 14.6663 11.6816 14.6663 7.99967C14.6663 4.31778 11.6816 1.33301 7.99967 1.33301C4.31778 1.33301 1.33301 4.31778 1.33301 7.99967C1.33301 11.6816 4.31778 14.6663 7.99967 14.6663Z" stroke="#D3B572" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 10.6667V8" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 5.33301H8.00667" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <div class="item-follow-item-type">頭部</div>
                            </div>
                        </div>

                        <div class="item-follow-item-unit item-followed-2 col-4 col-xl-3 mb-4">
                            <div class="item-follow-item-imgwrap">
                                <img src="./imgs/Itemshop/Avatar_item/Shu/hand/shu_hand_left_TaiYaki.png" alt="">
                            </div>
                            <!-- Checkbox -->
                            <div class="item-follow-item-name-and-check">
                                <label class="control control--checkbox">鯛魚燒
                                    <input type="checkbox" />
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                            <!-- 配件類型和info icon -->
                            <div class="item-follow-item-type-and-info d-flex align-items-center justify-content-between">
                                <a href="#">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.99967 14.6663C11.6816 14.6663 14.6663 11.6816 14.6663 7.99967C14.6663 4.31778 11.6816 1.33301 7.99967 1.33301C4.31778 1.33301 1.33301 4.31778 1.33301 7.99967C1.33301 11.6816 4.31778 14.6663 7.99967 14.6663Z" stroke="#D3B572" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 10.6667V8" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 5.33301H8.00667" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <div class="item-follow-item-type">手部</div>
                            </div>
                        </div>

                        <div class="item-follow-item-unit item-followed-3 col-4 col-xl-3 mb-4">
                            <div class="item-follow-item-imgwrap">
                                <img src="./imgs/Itemshop/Avatar_item/Luca/object/luca_object_FriedChicken.png" alt="">
                            </div>
                            <!-- Checkbox -->
                            <div class="item-follow-item-name-and-check">
                                <label class="control control--checkbox">桶裝炸雞
                                    <input type="checkbox" />
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                            <!-- 配件類型和info icon -->
                            <div class="item-follow-item-type-and-info d-flex align-items-center justify-content-between">
                                <a href="#">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.99967 14.6663C11.6816 14.6663 14.6663 11.6816 14.6663 7.99967C14.6663 4.31778 11.6816 1.33301 7.99967 1.33301C4.31778 1.33301 1.33301 4.31778 1.33301 7.99967C1.33301 11.6816 4.31778 14.6663 7.99967 14.6663Z" stroke="#D3B572" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 10.6667V8" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 5.33301H8.00667" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <div class="item-follow-item-type">物品</div>
                            </div>
                        </div>

                        <div class="item-follow-item-unit item-followed-4 col-4 col-xl-3 mb-4">
                            <div class="item-follow-item-imgwrap">
                                <img src="./imgs/Itemshop/Avatar_item/Ike/hand/ike_hand_right_Toast2.png" alt="">
                            </div>
                            <!-- Checkbox -->
                            <div class="item-follow-item-name-and-check">
                                <label class="control control--checkbox">貓貓吐司
                                    <input type="checkbox" />
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                            <!-- 配件類型和info icon -->
                            <div class="item-follow-item-type-and-info d-flex align-items-center justify-content-between">
                                <a href="#">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.99967 14.6663C11.6816 14.6663 14.6663 11.6816 14.6663 7.99967C14.6663 4.31778 11.6816 1.33301 7.99967 1.33301C4.31778 1.33301 1.33301 4.31778 1.33301 7.99967C1.33301 11.6816 4.31778 14.6663 7.99967 14.6663Z" stroke="#D3B572" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 10.6667V8" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 5.33301H8.00667" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <div class="item-follow-item-type">手部</div>
                            </div>
                        </div>

                        <div class="item-follow-item-unit item-followed-5 col-4 col-xl-3 mb-4">
                            <div class="item-follow-item-imgwrap">
                                <img src="./imgs/Itemshop/Avatar_item/Vox/object/vox_object_right_OniGiri3.png" alt="">
                            </div>
                            <!-- Checkbox -->
                            <div class="item-follow-item-name-and-check">
                                <label class="control control--checkbox">OniGiri
                                    <input type="checkbox" />
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                            <!-- 配件類型和info icon -->
                            <div class="item-follow-item-type-and-info d-flex align-items-center justify-content-between">
                                <a href="#">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.99967 14.6663C11.6816 14.6663 14.6663 11.6816 14.6663 7.99967C14.6663 4.31778 11.6816 1.33301 7.99967 1.33301C4.31778 1.33301 1.33301 4.31778 1.33301 7.99967C1.33301 11.6816 4.31778 14.6663 7.99967 14.6663Z" stroke="#D3B572" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 10.6667V8" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 5.33301H8.00667" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <div class="item-follow-item-type">物品</div>
                            </div>
                        </div>

                        <div class="item-follow-item-unit item-followed-6 col-4 col-xl-3 mb-4">
                            <div class="item-follow-item-imgwrap">
                                <img src="./imgs/Itemshop/Avatar_item/Mysta/head/myats_head_top_Earphone.png" alt="">
                            </div>
                            <!-- Checkbox -->
                            <div class="item-follow-item-name-and-check">
                                <label class="control control--checkbox">全罩耳機
                                    <input type="checkbox" />
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                            <!-- 配件類型和info icon -->
                            <div class="item-follow-item-type-and-info d-flex align-items-center justify-content-between">
                                <a href="#">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.99967 14.6663C11.6816 14.6663 14.6663 11.6816 14.6663 7.99967C14.6663 4.31778 11.6816 1.33301 7.99967 1.33301C4.31778 1.33301 1.33301 4.31778 1.33301 7.99967C1.33301 11.6816 4.31778 14.6663 7.99967 14.6663Z" stroke="#D3B572" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 10.6667V8" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 5.33301H8.00667" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <div class="item-follow-item-type">頭部</div>
                            </div>
                        </div>

                        <div class="item-follow-item-unit item-followed-7 col-4 col-xl-3 mb-4">
                            <div class="item-follow-item-imgwrap">
                                <img src="./imgs/Itemshop/Avatar_item/Ike/hand/ike_hand_right_Camera.png" alt="">
                            </div>
                            <!-- Checkbox -->
                            <div class="item-follow-item-name-and-check">
                                <label class="control control--checkbox">手持相機
                                    <input type="checkbox" />
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                            <!-- 配件類型和info icon -->
                            <div class="item-follow-item-type-and-info d-flex align-items-center justify-content-between">
                                <a href="#">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.99967 14.6663C11.6816 14.6663 14.6663 11.6816 14.6663 7.99967C14.6663 4.31778 11.6816 1.33301 7.99967 1.33301C4.31778 1.33301 1.33301 4.31778 1.33301 7.99967C1.33301 11.6816 4.31778 14.6663 7.99967 14.6663Z" stroke="#D3B572" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 10.6667V8" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 5.33301H8.00667" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <div class="item-follow-item-type">手部</div>
                            </div>
                        </div>

                        <div class="item-follow-item-unit item-followed-8 col-4 col-xl-3 mb-4">
                            <div class="item-follow-item-imgwrap">
                                <img src="./imgs/Itemshop/Avatar_item/Luca/hand/luca_hand_center_GameHold.png" alt="">
                            </div>
                            <!-- Checkbox -->
                            <div class="item-follow-item-name-and-check">
                                <label class="control control--checkbox">遊戲手把
                                    <input type="checkbox" />
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                            <!-- 配件類型和info icon -->
                            <div class="item-follow-item-type-and-info d-flex align-items-center justify-content-between">
                                <a href="#">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.99967 14.6663C11.6816 14.6663 14.6663 11.6816 14.6663 7.99967C14.6663 4.31778 11.6816 1.33301 7.99967 1.33301C4.31778 1.33301 1.33301 4.31778 1.33301 7.99967C1.33301 11.6816 4.31778 14.6663 7.99967 14.6663Z" stroke="#D3B572" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 10.6667V8" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 5.33301H8.00667" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <div class="item-follow-item-type">手部</div>
                            </div>
                        </div>

                        <div class="item-follow-item-unit item-followed-9 col-4 col-xl-3 mb-4">
                            <div class="item-follow-item-imgwrap">
                                <img src="./imgs/Itemshop/Avatar_item/Ike/object/ike_object_Book.png" alt="">
                            </div>
                            <!-- Checkbox -->
                            <div class="item-follow-item-name-and-check">
                                <label class="control control--checkbox">古典書籍
                                    <input type="checkbox" />
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                            <!-- 配件類型和info icon -->
                            <div class="item-follow-item-type-and-info d-flex align-items-center justify-content-between">
                                <a href="#">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.99967 14.6663C11.6816 14.6663 14.6663 11.6816 14.6663 7.99967C14.6663 4.31778 11.6816 1.33301 7.99967 1.33301C4.31778 1.33301 1.33301 4.31778 1.33301 7.99967C1.33301 11.6816 4.31778 14.6663 7.99967 14.6663Z" stroke="#D3B572" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 10.6667V8" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 5.33301H8.00667" stroke="#D3B572" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <div class="item-follow-item-type">物品</div>
                            </div>
                        </div>

                    </div>



                        <!-- 桌機版 頁尾分頁 -->
                        <div class="item-follow-page d-flex align-items-center justify-content-center">
                            <a href="?page=1">
                                <i class="fa-solid fa-angles-left"></i>
                            </a>
                            <a href="?page=<?= $page - 1 ?>">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>

                            <?php for ($i = $page - 2; $i <= $page + 2; $i++) : ?>
                                <?php if ($i >= 1 and $i <= $totalPages) :
                                    $params['page'] = $i;
                                ?>
                                    <a href="?<?= http_build_query($params) ?>"><?= $i ?></a>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <a href="?page=<?= $page + 1 ?>">
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                            <a href="?page=<?= $totalPages ?>">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>

                        </div>

                    <!-- 購買或刪除按鈕 -->
                    <div class="item-follow-btn-group d-flex align-items-center">
                        <a class="item-follow-btn delete-btn" href="#">
                            <span>刪除此配件</span>
                        </a>
                        <a class="item-follow-btn" href="#">
                            <span>購買此配件</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>


        <!-- <div class="sign-in-footer">
                <p class="long-line"></p>
                <p><a href="">About us</a> | <a href="">Contect us</a></p>
                <p class="long-line"></p>
            </div> -->
    </div>
</section>


<?php include __DIR__ . '/parts/html-script.php' ?>
<script>
    $('.delete-btn').click(function() {

        if ($('.addfollow-sure-delete-item').hasClass('addfollow-sure-delete-item-show')) {
            $('.addfollow-sure-delete-item').removeClass('addfollow-sure-delete-item-show');
        } else {
            $('.addfollow-sure-delete-item').addClass('addfollow-sure-delete-item-show');
        }
    });

    $('.addfollow-sure-delete-item-close, .cancle-btn, .check-btn').click(function() {
        $('.addfollow-sure-delete-item').removeClass('addfollow-sure-delete-item-show');
    });


    // 點擊確定刪除按鈕時，刪除配件
    $('.control__indicator').click(function() {
        $(this).toggleClass('check-label');
    });

    $('.check-btn').click(function() {
        console.log($('.check-label').parent().parent().parent('.item-follow-item-unit'));

        if ($('.control__indicator').hasClass('check-label')) {
            $('.check-label').parent().parent().parent('.item-follow-item-unit').addClass('item-follow-item-unit-hide');
        }

    });


    // Hashtags篩選

    $('.tag-btn-object').click(function() {
        $('.item-followed-1, .item-followed-2, .item-followed-4, .item-followed-6, .item-followed-7, .item-followed-8').addClass('item-follow-item-unit-hide');

        $('.item-followed-3, .item-followed-5, .item-followed-9').removeClass('item-follow-item-unit-hide');
    });

    $('.tag-btn-hand').click(function() {
        $('.item-followed-1, .item-followed-3, .item-followed-5, .item-followed-6, .item-followed-9').addClass('item-follow-item-unit-hide');

        $('.item-followed-2, .item-followed-4, .item-followed-7, .item-followed-8').removeClass('item-follow-item-unit-hide');
    });

    $('.tag-btn-head').click(function() {
        $('.item-followed-2, .item-followed-3, .item-followed-4, .item-followed-5, .item-followed-7, .item-followed-8, .item-followed-9').addClass('item-follow-item-unit-hide');

        $('.item-followed-1, .item-followed-6').removeClass('item-follow-item-unit-hide');
    });


    $('.tag-btn-all').click(function() {

        $('.item-followed-1, .item-followed-2, .item-followed-3, .item-followed-4, .item-followed-5, .item-followed-6, .item-followed-7').addClass('item-follow-item-unit-show');
        $('.item-followed-8').addClass('item-follow-item-unit-show');
        $('.item-followed-9').addClass('item-follow-item-unit-show');
    });
</script>

<?php include __DIR__ . '/parts/html-last.php' ?>