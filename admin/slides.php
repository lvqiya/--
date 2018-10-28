<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Slides &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <?php include_once 'include/checksession.php'; ?>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <?php include_once 'include/nav.php'; ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>图片轮播</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form id="add_pic">
            <h2>添加新轮播内容</h2>
            <div class="form-group">
              <label for="image">图片</label>
              <!-- show when image chose -->
              <img class="help-block thumbnail" style="display: none">
              <input id="image" class="form-control" name="image" type="file">
            </div>
            <div class="form-group">
              <label for="text">文本</label>
              <input id="text" class="form-control" name="text" type="text" placeholder="文本">
            </div>
            <div class="form-group">
              <label for="link">链接</label>
              <input id="link" class="form-control" name="link" type="text" placeholder="链接">
            </div>
            <div class="form-group">
              <input type="button" value="添加" id="btn" />
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center">图片</th>
                <th>文本</th>
                <th>链接</th>
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
    <?php include_once 'include/aside.php'; ?>
  </div>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript" src="/assets/vendors/template-web.js"></script>
  <script type="text/template" id="t">
  {{each data value}}
  <tr>
    <td class="text-center"><input type="checkbox"></td>
    <td class="text-center"><img class="slide" src="{{value.pic_url}}"></td>
    <td>{{value.pic_text}}</td>
    <td>{{value.pic_link}}</td>
    <td class="text-center">
      <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
    </td>
  </tr>
  {{/each}}
  </script>


  <script type="text/template" id="tpl">
  <tr>
    <td class="text-center"><input type="checkbox"></td>
    <td class="text-center"><img class="slide" src="{{data.pic_url}}"></td>
    <td>{{data.pic_text}}</td>
    <td>{{data.pic_link}}</td>
    <td class="text-center">
      <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
    </td>
  </tr>
  </script>

  <script type="text/javascript">
  $.ajax({
    url: 'http://www.alishow.com/admin/api/pic/getPic.php',
    type: 'post',
    dataType: 'json',
    success:function (msg) {
      console.log(msg);

      var str = template('t', msg);
      $('tbody').html(str);
    }
  })


  //在添加按钮上注册点击事件，，
  $("#btn").click(function () {
    //获取表单填写的数据
    var fm = document.getElementById('add_pic');
    var fd = new FormData(fm);

    //发送ajax请求
    $.ajax({
      url: 'http://www.alishow.com/admin/api/pic/addPic.php',
      data: fd,
      type: 'post',
      dataType: 'json',
      contentType: false,
      processData: false,
      success: function (msg) {
        console.log(msg);
        if (msg.code == 306) {
          alert('添加新轮播图成功');
          //成功时，要将新的数据追加到表格的最后
          var str = template('tpl', msg);
          $('tbody').append(str);
        } else if (msg.code == 307) {
          alert('添加新轮播图信息失败');
        } else if (msg.code == 308) {
          alert('上传图片失败');
        }
      } 
    })
  })
  </script>
  <script>NProgress.done()</script>
</body>
</html>
        
