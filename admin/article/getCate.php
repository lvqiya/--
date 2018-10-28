<?php 
//1. 拼接SQL语句
$sql = "select * from ali_cate where cate_state=1";

//2. 链接MySQL并执行SQL语句
include_once '../include/mysql.php';
$result_obj = mysqli_query($conn, $sql);

//3. 返回查询结果
// 结果对象 --->  二维数组 ---> json字符串 ---> 返回给前端
$arr = [];
while ($row = mysqli_fetch_assoc($result_obj)) {
    array_push($arr, $row);
}

echo json_encode($arr);
?>