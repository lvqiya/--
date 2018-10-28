<?php 
$sql = "select * from ali_pic";

include_once '../../include/mysql.php';
$result_obj = mysqli_query($conn, $sql);

$arr = [];
while ($row = mysqli_fetch_assoc($result_obj)) {
    $arr[] = $row;
}

if (!empty($arr)) {
    $result = [
        'code' => '300',
        'data' => $arr,
        'message' => null
    ];
} else {
    $result = [
        'code' => '301',
        'data' => null,
        'message'  => '没有图片数据'
    ];
}

echo json_encode($result);
?>