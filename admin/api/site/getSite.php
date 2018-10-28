<?php 
$sql = "select * from ali_site";
include_once '../../include/mysql.php';
$result_obj = mysqli_query($conn, $sql);

$arr = mysqli_fetch_assoc($result_obj);

$result = [
    'code' => 400,
    'data' => $arr,
    'message' => '获取网站信息成功'
];

echo json_encode($result);
?>