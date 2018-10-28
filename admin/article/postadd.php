<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>

  <link href="/assets/vendors/ueditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
  <script type="text/javascript" src="/assets/vendors/ueditor/third-party/jquery.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="/assets/vendors/ueditor/umeditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="/assets/vendors/ueditor/umeditor.min.js"></script>
  <script type="text/javascript" src="/assets/vendors/ueditor/lang/zh-cn/zh-cn.js"></script>

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
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">内容</label>
            <textarea id="content" name="content"></textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            <p class="help-block">https://zce.me/post/<strong>slug</strong></p>
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
              
            </select>

          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="datetime-local">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <option value="drafted">草稿</option>
              <option value="published">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">保存</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script type="text/template" id="t">
  {{each list value}}
    <option value="{{value.cate_id}}">{{value.cate_name}}</option>
  {{/each}}
  </script>

  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript">
  var um = UM.getEditor('content', {
    initialFrameWidth:'100%', //初始化编辑器宽度
    initialFrameHeight:300,  //初始化编辑器高度
    initialContent: '请在此处编辑文章内容'
  });

  $.post('getCate.php', function (msg) {
    console.log(msg);
    var json = {"list": msg};
    var str = template('t', json);
    $('#category').html(str);
  }, 'json');


  //1. 在文件域上注册onchange事件
  $('#feature').change(function () {
    //2. 获取文件对象
    var file_obj = document.getElementById('feature').files[0];
    //实例化空FormData
    var fd = new FormData();
    fd.append('pic', file_obj);

    //3. 发送ajax请求并将文件对象一起发送给后端
    $.ajax({
      //使用上层目录已经实现好的文件
      url: '../upload.php',
      data: fd,
      type: 'post',
      dataType: 'text',
      contentType: false,
      processData: false,
      success: function (msg) {
        // console.log(msg);
        if (msg == 2) {
          alert('上传失败');
        } else {
          //上传成功，需要将图片显示到页面上
          // 将新上传的文件路径写入img标签的src属性中，并显示出来
          $('.thumbnail').show().attr('src', '/admin/upload/' + msg);
          alert('添加成功');
        }
      }
    });
  })
  </script>
  <script>NProgress.done()</script>
</body>
</html>
