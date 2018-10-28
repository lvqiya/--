<?php 
// print_r($_FILES);
// 目标: 将上传文件从临时路径移动到目标路径
// 额外完成重命名的操作

//1. 截取文件后缀 --- abc.123.jpg
$pos = strrpos($_FILES['pic']['name'], '.');
$ext = substr($_FILES['pic']['name'], $pos);

//2. 随机产生一个新的文件名
$new_file = time() . rand(10000, 99999) . $ext;

//3. 移动
//参数1: 临时路径 --- $_FILES['pic']['tmp_name']
//参数2: 目标路径
if(move_uploaded_file($_FILES['pic']['tmp_name'], './upload/' . $new_file)) {
    //移动成功，将新的文件名返回给前端
    //因为前端要显示新上传好的头像
    echo $new_file;
} else {
    //移动失败，返回一个标志
    echo 2;
}
?>