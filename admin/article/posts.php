<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  
  <script src="/assets/vendors/jquery.1.11.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/assets/vendors/twbs-pagination/jquery.twbsPagination.js" type="text/javascript"></script>

  <script type="text/javascript" src="/assets/vendors/template-web.js"></script>
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
        <h1>所有文章</h1>
        <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline">
          <select name="" class="form-control input-sm">
            <option value="">所有分类</option>
            <option value="">未分类</option>
          </select>
          <select name="" class="form-control input-sm">
            <option value="">所有状态</option>
            <option value="">草稿</option>
            <option value="">已发布</option>
          </select>
          <button class="btn btn-default btn-sm">筛选</button>
        </form>
        <ul class="pagination pagination-sm pull-right">

        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <?php 
  //目标: 计算分页导航条的长度
  // 长度 = ceil(数据总条数 / 每页显示数量);
  
  //链接MySQL查询数据总条数
  $sql = "select count(*) as num from ali_article";
  include_once '../include/mysql.php';
  $result_obj = mysqli_query($conn, $sql);
  //$arr['num'] 就是数据总条数
  $arr = mysqli_fetch_assoc($result_obj);

  //定义每页显示条数
  $pagesize = 3;

  //总页数
  $totalPages = ceil($arr['num'] / $pagesize);
  ?>

  <script type="text/template" id="t">
  {{each list value}}
  <tr>
    <td class="text-center"><input type="checkbox"></td>
    <td>{{value.article_title}}</td>
    <td>{{value.admin_nickname}}</td>
    <td>{{value.cate_name}}</td>
    <td class="text-center">{{value.article_addtime}}</td>
    <td class="text-center">{{value.article_state}}</td>
    <td class="text-center">
      <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
      <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
    </td>
  </tr>
  {{/each}}
  </script>

  <script type="text/javascript">
  window.pagObj = $('.pagination').twbsPagination({
            // 分页导航条的总页数（长度）
            totalPages: <?php echo $totalPages; ?>,
            // 分页导航条可见页数（长度）
            visiblePages: 5,
            //按钮文字
            first: '第一页',
            prev: '上一页',
            next: '下一页',
            last: '末页',
            // 点击页号时触发的回调函数
            // 参数page就是当前点击的页号
            onPageClick: function (event, page) {
                //console.info('当前点击的页号是:' + page);
                //发送ajax请求并将选中的页号一起发送给后端的getpost.php页面
                $.post('getPost.php', {p: page}, function (msg) {
                  console.log(msg);
                  //包装成json对象
                  var json = {"list": msg};
                  
                  var str = template('t', json);
                  
                  $('tbody').html(str);

                }, 'json');
            }
        })
  </script>
  
  <script>NProgress.done()</script>
</body>
</html>

                  

                  