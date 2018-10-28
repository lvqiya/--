<?php 
//1. 接收表单提交的数据
$id = $_POST['id'];
$email = $_POST['email'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];

//2. 拼接SQL语句
$sql = "update ali_admin set admin_email='$email',admin_slug='$slug',admin_nickname='$nickname' where admin_id=$id";

//3. 链接MySQL并执行SQL语句
include_once '../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);

//4. 返回SQL执行结果
if ($result_bool) {
    echo 1;
} else {
    echo 2;
}

?>