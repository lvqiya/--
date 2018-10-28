<?php 
$id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];

$sql = "delete from ali_comment where cmt_id=$id";

include_once '../../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);

if ($result_bool) {
    echo '{"code": 202, "message": "删除评论成功"}';
} else {
    echo '{"code": 203, "message": "删除评论失败"}';
}
?>