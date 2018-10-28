<?php 
header('content-type:text/html;charset=utf-8');
//1. 清除session
session_start();
session_destroy();

//2. 跳转到login.html
echo "退出成功";
header('refresh:2;url=/admin/login.html');
?>