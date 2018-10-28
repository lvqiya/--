<?php 
//1. 接收数据  admin_id
$id = $_POST['id'];

//2. 拼接SQL语句 -- delete from ali_admin...
$sql = "delete from ali_admin where admin_id=$id";

//3. 链接MySQL并执行SQL语句
include_once '../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);

//4. 返回SQL执行的结果
if ($result_bool) {
    echo 1;
} else {
    echo 2;
}
?>