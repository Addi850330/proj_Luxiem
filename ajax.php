<?php
$start = ($page-1) * $size;
$sql = "SELECT * FROM `items` limit $start,$size";
$data = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$result = array(
    'total' => $n,
    'max' => $max,
    'list' => array()
);
foreach($data as $v){
	$result['list'][] = array(
	 'id' => $v["id"],
	 'title' => $v["title"],
	 'pic' => $v["pic"]
	);
}
echo json_encode($result); 
?>