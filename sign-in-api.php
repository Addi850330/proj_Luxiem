<?php
require './parts/connect-db.php';

//echo $_SERVER['HTTP_REFERER'];
//exit;

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
];

$email = isset($_POST['user_email']) ? trim($_POST['user_email']) : '';  //判斷有無填寫信箱 沒有的話給空字串
$password = isset($_POST['user_password']) ? trim($_POST['user_password']) : '';

if (empty($email)) {
    $output['error'] = '帳密錯誤'; //'沒有 Email';
    $output['code'] = 410; //410是用戶端錯誤
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
if (empty($password)) {
    $output['error'] = '帳密錯誤'; //'沒有給密碼';
    $output['code'] = 420;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "SELECT `user_id`, `user_email`,  `user_password`, `user_name` FROM members WHERE `user_email`= ? AND `user_password`= SHA1 (?)";
// 上面是 只需要搜尋這些欄位`id`, `email`,  `password`, `nickname`

$stmt = $pdo->prepare($sql);
$stmt->execute([$email,$_POST ['user_password']]);

$row = $stmt->fetch(); //讀取資料

if (!empty($row)) { //如果$row不是空的 而且 密碼驗證正確
    $output['success'] = true;
    $output['code'] = 200;
    $_SESSION['admin'] = [ //把資料塞進$_SESSIO
        'user_id' => $row['user_id'],
        'user_email' => $row['user_email'],
        'user_name' => $row['user_name'],
    ];
} else {
    $output['error'] = '帳密錯誤';
    $output['code'] = 430;
    $output['row'] = $row;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);