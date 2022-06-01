<?php
require './parts/connect-db.php';



$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST,  // 確認資料

];
header('Content-Type: application/json');


if (empty($_POST['user_name'])) {
    $output['error'] = '沒有姓名資料';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
$sql = "INSERT INTO `members`( `user_name`, `user_email`, `user_password`, `user_mobile`, `create_at`) VALUES ( ?, ?, ?, ?, NOW())";


$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['user_name'],
    $_POST['user_email'],
    $_POST['user_password'],
    $_POST['user_mobile'],
]);


$output['rowCount'] = $stmt->rowCount();
if ($stmt->rowCount() == 1) {
    $output['success'] = true;
} else {
    $output['error'] = '新增失敗';
};

echo json_encode($output);