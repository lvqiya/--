<?php 
header('content-type:text/html;charset=utf-8');
//1. 接收表单提交数据
$id = $_POST['id'];
$name = $_POST['name'];
$slug = $_POST['slug'];
$icon = $_POST['icon'];
$state = $_POST['state'];
$show = $_POST['show'];

//2. 拼接SQL语句 --- update ali_cate set ...
$sql = "update ali_cate set  cate_name='$name',cate_slug='$slug',cate_icon='$icon',cate_state=$state,cate_show=$show  where cate_id=$id";

//3. 链接MySQL并执行SQL语句
include_once '../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);

//4. 判断结果，提示成功/失败，页面跳转
if ($result_bool) {
    echo "修改栏目信息成功";
    header('refresh:2;url=categories.php');
} else {
    echo "修改栏目信息失败";
    header('refresh:2;url=editcate.php?id=' . $id);
}
?>