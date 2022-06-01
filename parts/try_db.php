<?php

require './connect-db.php';

$sql = "SELECT * FROM items LIMIT 5 ";

$stmt = $pdo->query($sql);

$row = $stmt->fetchAll();



header('Content-Type: application/json');
echo json_encode($row);