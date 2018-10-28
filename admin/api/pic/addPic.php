<?php 
include_once '../file.func.php';

$path = uploadFile($_FILES['image'], '../../upload/', ['.jpg', '.png', 'gif']);

if($path === false){
    echo '{"code": 308, "data":null, "message": "上传图片失败"}';
    die;
}

$url  = $path;
$text = $_POST['text'];
$link = $_POST['link'];

$sql = "insert into ali_pic values(null, '$url', '$text', '$link')";
include_once '../../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);

if ($result_bool) {
    $pic_id = mysqli_insert_id($conn);
    $sql = "select * from ali_pic where pic_id=$pic_id";
    $result_obj = mysqli_query($conn, $sql);
    $pic_info = mysqli_fetch_assoc($result_obj);
    $result = [
        'code' => '306',
        'data' => $pic_info,
        'message'  => '添加新图片成功'
    ];
    echo json_encode($result);
} else {
    echo '{"code": 307, "data":null, "message": "删除图片失败"}';
}

?>