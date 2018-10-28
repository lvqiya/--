<?php 
include_once '../file.func.php';

$path = uploadFile($_FILES['site_logo'], '../../upload/', ['.jpg', '.png', 'gif']);

if($path === false){
    echo '{"code": 402, "data":null, "message": "上传网站logo失败"}';
    die;
}

$logo = $path;
$name = $_POST['site_name'];
$desc = $_POST['site_description'];
$keys = $_POST['site_keywords'];
$status = isset($_POST['comment_status']) ? 1 : 2;
$review = isset($_POST['comment_reviewed']) ? 1 : 2;

$sql = "update ali_site set site_logo='$logo',site_name='$name',site_desc='$desc',site_keys='$keys',site_status=$status,site_review=$review where id=1";
include_once '../../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);

if ($result_bool) {
    $result = mysqli_query($conn, "select * from ali_site");
    $arr = mysqli_fetch_assoc($result);
    $result = [
        'code' => 401,
        'data' => $arr,
        'message' => '修改网站设置成功'
    ];
    echo json_encode($result);
} else {
    echo '{"code":403, "data":null, "message":"修改网站设置失败"}';
}

?>