<?php 
$pic_id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
$sql = "delete from ali_pic where pic_id=$pic_id";

include_once '../../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);

if ($result_bool) {
    echo '{"code": 302, "message": "删除图片成功"}';
} else {
    echo '{"code": 303, "message": "删除图片失败"}';
}
?>