<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="http://www.alishow.com/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <?php include_once '../include/checksession.php'; ?>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <?php include_once '../include/nav.php'; ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
        <input type="button" value="添加新栏目" onclick="location.href='addcate.php'">
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">

        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>名称</th>
                <th>Slug</th>
                <th>添加时间</th>
                <th>图标</th>
                <th>栏目状态</th>
                <th>是否显示</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
<?php 
//1. 定义SQL语句
$sql = "select * from ali_cate";

//2. 链接MySQL服务器并执行SQL语句 -- 引入文件
include_once '../include/mysql.php';

$result_obj = mysqli_query($conn, $sql);

//3. 将结果对象循环显示到表格中
?>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($result_obj)) { ?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td><?php echo $row['cate_name']; ?></td>
                <td><?php echo $row['cate_slug']; ?></td>
                <td><?php echo $row['cate_addtime']; ?></td>
                <td><?php echo $row['cate_icon']; ?></td>
                <td><?php echo $row['cate_state'] == 1 ? '启用' : '禁用'; ?></td>
                <td><?php echo $row['cate_show'] == 1 ? '显示' : '不显示'; ?></td>
                <td class="text-center">
                  <a href="editcate.php?id=<?php echo $row['cate_id']; ?>" class="btn btn-info btn-xs">编辑</a>
                  <a href="delcate_deal.php?id=<?php echo $row['cate_id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('您确定删除该栏目吗?')">删除</a>
                  <a href="javascript:;" data="<?php echo $row['cate_id']; ?>" class="btn edit btn-info btn-xs">edit</a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript" src="/assets/vendors/layer/layer.js"></script>
  <script type="text/javascript">
  $('.edit').click(function () {
    var id = $(this).attr('data');

    layer.ready(function () {
      layer.open({
        title: '修改栏目信息',
        area: ['800px', '500px'],
        type: 2,
        content: 'editcate.php?id=' + id
      });
    })
  })
  </script>
  <script>NProgress.done()</script>
</body>
</html>
