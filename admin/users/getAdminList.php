<?php 
//1. 拼接SQL语句
$sql = "select * from ali_admin";

//2. 链接MySQL服务器并执行SQL语句
include_once '../include/mysql.php';
$result_obj = mysqli_query($conn, $sql);

//3. 结果对象 ---> 二维数组 ---> json字符串 ---> 返回给前端
$arr = [];
while ($row = mysqli_fetch_assoc($result_obj)) {
    array_push($arr, $row);
}

echo json_encode($arr);
?>