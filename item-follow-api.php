 <?php
// session_start();
// require './parts/connect-db.php';

// if (!isset($_SESSION['cart'])) {
//     $_SESSION['cart'] = [];
// }

// $sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
// $quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 0;

// $output = [];

// if ($sid > 0) {

//     if ($quantity > 0) {
//         // 加入項目: sid, quantity (cmd: add)
//         // 修改項目: sid, quantity (cmd: update)
//         // TODO: 檢查有沒有這項商品 （要是沒有商品會在購物車內顯示notice）

//         $_SESSION['cart'][$sid] = $quantity;
//     } else {
//         // 移除項目: sid (cmd: remove)
//         unset($_SESSION['cart'][$sid]);
//     }
// }


// 讀取所有項目: (cmd: read)
// $output['follow'] = $_SESSION['cart'];
// echo json_encode($output);
