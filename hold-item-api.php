<?php
require './parts/connect-db.php';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$cate = isset($_GET['cate']) ? intval($_GET['cate']) : 0; 





$cate_hot = isset($_GET['cate_hot']) ? intval($_GET['cate_hot']) : 0;
$cate_tag = isset($_GET['cate_tag']) ? intval($_GET['cate_tag']) : 0;


$params = []; //先設定一個空陣列








$perPage = 9; 

$output = [
    'perPage' => $perPage,
    'totalRows' => 0,
    'totalPages' => 0,
    'page' => $page,
    'rows' => [],  // 分頁的資料
];



if ($page < 1) {
    header('Location: hold-item-api.php');
    exit;
}

$t_sql ="SELECT COUNT(1) FROM items";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$output['totalRows'] = $totalRows;

$totalPages = ceil($totalRows/$perPage);
$output['totalPages'] =$totalPages;


if ($totalPages > 0) {
    if ($page > $totalPages) {
        header('Location: hold-item-api.php?page=' . $totalPages);
        exit;
    }

    // 讀取分頁的資料
    $sql = sprintf("SELECT * FROM items LIMIT %s, %s", ($page - 1)*$perPage, $perPage);


    $rows = $output['rows'] = $pdo->query($sql)->fetchAll(); // 設定$rows變數給下面使用
}

?>


    <div class="hold-item-info d-flex flex-wrap">
                <?php foreach($rows as $r): ?>
                    <div id="hold-item-section" class="hold-item-section col-4 col-lg-3 <?= $r['item_author'] ?>">
                        <div class="hold-item-img">
                            <img src="./imgs/Itemshop/Avatar_item/<?= $r['item_img'] ?>" alt="...">
                        </div>
                        <div class="hold-item-name d-flex">
                            <p><?= $r['item_name'] ?></p>
                            <i class="fa-regular fa-circle-question"></i>
                        </div>
                    </div>
                <?php endforeach; ?>
    </div>
<!-- 桌機版 頁尾分頁 -->
    <div class="hold-item-page d-flex">
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
    window.page = <?= $page ?>;








    </script>