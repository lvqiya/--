<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
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
        <h1>用户</h1>
        <input type="button" value="添加新管理员" id="btn">
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
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php';?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>

  <script type="text/javascript" src="/assets/vendors/template-web.js"></script>

  <script type="text/javascript" src="/assets/vendors/layer/layer.js"></script>

  <script type="text/template" id="t">
  {{each list value}}
  <tr>
    <td class="text-center"><input type="checkbox"></td>
    <td class="text-center"><img class="avatar" src="{{value.admin_pic}}"></td>
    <td>{{value.admin_email}}</td>
    <td>{{value.admin_slug}}</td>
    <td>{{value.admin_nickname}}</td>
    <td>{{value.admin_state}}</td>
    <td class="text-center">
      <a href="javascript:;" data="{{value.admin_id}}" class="btn edit btn-default btn-xs">编辑</a>
      <a href="javascript:;" data="{{value.admin_id}}" class="btn del btn-danger btn-xs">删除</a>
    </td>
  </tr>
  {{/each}}
  </script>

  <script type="text/javascript">
  $.post('getAdminList.php', function (msg) {
    //console.log(msg); //msg是数组，内部是json对象
    //把msg包装成json对象
    var json = {"list": msg};

    var str = template('t', json);
    $('tbody').html(str);
  }, 'json');

  //1. 在“添加新管理员”按钮上绑定点击事件
  $('#btn').click(function () {
    //2. 弹出层 --- 添加新管理员的弹出层
    layer.ready(function(){ 
      layer.open({
        type: 2,
        title: '欢迎页',
        maxmin: true,
        area: ['800px', '500px'],
        content: 'addusers.html',
      });
    });
  })

  //必须使用事件委托来绑定事件
  $('tbody').on('click', '.del', function () {
    //1. 获取当前行的admin_id
    var admin_id = $(this).attr('data');
    //alert(admin_id);
    
    //转存$(this)
    _this = $(this);

    layer.confirm('您确定删除该用户吗?', function () {
      //2. 发送ajax请求
      $.post('delusers.php', {id: admin_id}, function (msg) {
        console.log(msg);
        if (msg == 1) {
          layer.alert('删除管理员成功', function (index) {
            _this.parent().parent().remove();
            layer.close(index);
          });
          
        } else {
          layer.alert('删除管理员失败');
        }
      })
    })

  });

  //1. 为每个编辑按钮注册点击事件
  $('tbody').on('click', '.edit', function () {
    //2. 获取当前行的admin_id
    var admin_id = $(this).attr('data');

    //3. 弹出修改管理员的表单对话框
    layer.ready(function(){ 
      layer.open({
        type: 2,
        title: '欢迎页',
        maxmin: true,
        area: ['800px', '500px'],
        content: 'editusers.php?id=' + admin_id,
      });
    });
  })
  </script>
  <script>NProgress.done()</script>
</body>
</html>
