<?php 
//判断是否存在session
  session_start();

  if (empty($_SESSION['id'])) {
    //为空则说明没有登录
    echo "您尚未登录，请登陆后再访问";
    //绝对路径
    header('refresh:2;url=/admin/login.html');
    die();
  }
?>