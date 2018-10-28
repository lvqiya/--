<?php 
header('content-type:text/html;charset=utf-8');
//1. 接收表单提交的数据
$name = $_POST['name'];
$slug = $_POST['slug'];
$icon = $_POST['icon'];
$state = $_POST['state'];
$show = $_POST['show'];
//参数1: 日期格式
//参数2: 时间戳
$time = date('Y-m-d', time());

//2. 拼接SQL语句 --- insert into ...
$sql = "insert into ali_cate values(null, '$name', '$slug', '$time', '$icon', $state, $show)";

//3. 链接MySQL并执行SQL语句
include_once '../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);

//4. 判断执行结果，提示添加成功、失败，再跳转页面
if ($result_bool) {
    echo "添加新栏目成功";
    header('refresh:2;url=categories.php');
} else {
    echo "添加新栏目失败";
    header('refresh:2;url=addcate.php');
}
?>