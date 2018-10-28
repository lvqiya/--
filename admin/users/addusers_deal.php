<?php 
//1. 接收表单数据
$email = $_POST['email'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];
$password = md5($_POST['password']);

//2. 拼接SQL语句
$sql = "insert into ali_admin(admin_id,admin_email,admin_slug,admin_nickname,admin_pwd) values(null, '$email', '$slug', '$nickname', '$password')";

//3. 链接MySQL服务器并执行SQL语句
include_once '../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);

//4. 将SQL执行结果返回给前端
if ($result_bool) {
    echo 1;
} else {
    echo 2;
}

?>