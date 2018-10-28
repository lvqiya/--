<?php 
//开始要设置固定值来模拟
$pageno = $_POST['p'];
$pagesize = 3;

$start = ($pageno - 1) * $pagesize;
$sql = "select * from ali_article
          join ali_admin on  ali_article.article_adminid=ali_admin.admin_id
          join ali_cate on ali_article.article_cateid=ali_cate.cate_id
        limit $start, $pagesize";
//echo $sql;

include_once '../include/mysql.php';
$result_obj = mysqli_query($conn, $sql);

//将对象转二维数组，再转json字符串
$arr = [];
while ($row = mysqli_fetch_assoc($result_obj)) {
    $arr[] = $row;
}

echo json_encode($arr);

?>