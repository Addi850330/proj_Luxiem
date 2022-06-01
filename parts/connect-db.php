<?php

$db_host = 'localhost'; //主機名稱
$db_name = '0518luxiem'; //資料庫名稱
$db_user = 'team3';
$db_pass = 'admin';


$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8";

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // 以關聯式陣列的格式取出資料
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options); //把變數放進來

if (!isset($_SESSION)) {  //如果 $_SESSION沒有啟動 ，執行下面的起動
    session_start();
}