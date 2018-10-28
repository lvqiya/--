<?php 
//1. 接收用户和密码
$email = $_POST['email'];
$pwd   = $_POST['pwd'];

//2. 验证用户是否正确
$sql = "select * from ali_admin where admin_email='$email'";
include_once 'include/mysql.php';
//该结果对象只可能是 1条数据 或者 0条数据
$result_obj = mysqli_query($conn, $sql);
//$admin_info 有可能是空 有可能是一维关联数组
$admin_info = mysqli_fetch_assoc($result_obj);

if (empty($admin_info)) {
    //为空，说明用户名错误
    echo 1;
} else {
    //不为空，说明用户名正确，继续验证密码
    //3. 验证密码是否正确  --- $admin_info['admin_pwd'] 和 $pwd 比较
    if ($admin_info['admin_pwd'] == md5($pwd)) {
        //密码正确 --- 注册session
        session_start();
        $_SESSION['id'] = $admin_info['admin_id'];
        $_SESSION['email'] = $admin_info['admin_email'];
        $_SESSION['nickname'] = $admin_info['admin_nickname'];
        $_SESSION['pic'] = $admin_info['admin_pic'];

        echo 3;
    } else {
        //密码错误
        echo 2;
    }
}

?>