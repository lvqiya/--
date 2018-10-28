<?php 
header('content-type:text/html;charset=utf-8');

//1. 接收cate_id
$id = $_GET['id'];

//2. 拼接SQL语句 --- delete from ...
$sql = "delete from ali_cate where cate_id=$id";

//3. 链接MySQL并执行SQL语句
include_once '../include/mysql.php';

$result_bool = mysqli_query($conn, $sql);

//4. 判断执行结果，提示删除成功/删除失败，跳转页面
if ($result_bool) {
    echo "删除栏目成功";
} else {
    echo "删除栏目失败";
}
header('refresh:2;url=categories.php');

?>