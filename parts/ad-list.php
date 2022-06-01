<?php

require './connect-db.php';


$page =isset($_GET['page']) ? intval($_GET['page']):1;//
$perPage = 5;
// 每頁5筆資料
//修改筆數

$output = [
    'perPage'=>$perPage,
    'totalRows' =>0,
    'totalPages'=>0,
    'page'=>$page,
    'row'=>[],
];


//設定不可小於1頁數 
if($page<1){
    header('Location: ad-list.php');//header轉向
    exit;
}

$t_sql ="SELECT COUNT(1) FROM items";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$output['totalRows'] = $totalRows;


$totalPages = ceil($totalRows/$perPage);
$output['totalPages'] =$totalPages;


//設定不可大於總頁數
if($totalPages > 0){
    if($page > $totalPages){
        header('Location: ad-list.php?page='.$totalPages);
        exit;
    }
}

//讀取分業資料
$sql = sprintf("SELECT * FROM item_categories LIMIT %s, %s", ($page - 1)*$perPage, $perPage);

$output['row'] = $pdo->query($sql)->fetchAll();

// header('Content-Type: application/json');
// echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>