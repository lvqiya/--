<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>

  <?php include_once './include/checksession.php'; ?>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <?php include_once './include/nav.php'; ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>我的个人资料</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->

      <?php 
      //思路: 从session中获取当前登录用户的admin_id
      //      再根据admin_id的值查询数据，再将数据填写到表单中
      //      
      //1. 从session中获取admin_id
      $id = $_SESSION['id'];

      //2. 拼接SQL语句
      $sql = "select * from ali_admin where admin_id=$id";

      //3. 链接MySQL并执行SQL语句
      include_once './include/mysql.php';
      $result_obj = mysqli_query($conn, $sql);
      $admin_info = mysqli_fetch_assoc($result_obj);

      //4. 将查询出的结果填写到表单中
      
      ?>

      <form class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-3 control-label">头像</label>
          <div class="col-sm-6">
            <label class="form-image">
              <input id="avatar" type="file">
              <img id="avatar_pic" src="<?php echo $admin_info['admin_pic']; ?>">
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">邮箱</label>
          <div class="col-sm-6">
            <input id="email" class="form-control" name="email" type="type" value="<?php echo $admin_info['admin_email']; ?>"  readonly>
            <p class="help-block">登录邮箱不允许修改</p>
          </div>
        </div>
        <div class="form-group">
          <label for="slug" class="col-sm-3 control-label">别名</label>
          <div class="col-sm-6">
            <input id="slug" class="form-control" name="slug" type="type" value="<?php echo $admin_info['admin_slug']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="nickname" class="col-sm-3 control-label">昵称</label>
          <div class="col-sm-6">
            <input id="nickname" class="form-control" name="nickname" type="type" value="<?php echo $admin_info['admin_nickname']; ?>">
            <p class="help-block">限制在 2-16 个字符</p>
          </div>
        </div>
        <div class="form-group">
          <label for="bio" class="col-sm-3 control-label">简介</label>
          <div class="col-sm-6">
            <textarea id="bio" class="form-control" placeholder="Bio" cols="30" rows="6"><?php echo $admin_info['admin_sign']; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-primary">更新</button>
            <a class="btn btn-link" href="password-reset.html">修改密码</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once './include/aside.php'; ?>
  </div>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript">
  $('#avatar').change(function () {
    //1. 获取文件对象
    //打印文件域的DOM对象
    //文件域DOM对象中有一个files属性，该属性保存了选中的图片对象
    //  files中是伪数组结构，如果只能选择一张图片，那么下标一定是 0
    // console.dir(document.getElementById('avatar').files[0]);
    var file_obj = document.getElementById('avatar').files[0];

    //实例化一个空的FormData对象
    var fd = new FormData();
    //该append是FormData的一个方法
    //参数1: key
    //参数2: value
    fd.append('pic', file_obj);


    //2. 发送ajax请求
    $.ajax({
      url: 'upload.php',
      data: fd,
      type: 'post',
      dataType: 'text',
      contentType: false,
      processData: false,
      success: function (msg) {
        //console.log(msg);
        if (msg == 2) {
          alert('上传失败');
        } else {
          //上传成功，需要将新的文件路径写入img标签的src属性中
          alert('上传成功');
          $('#avatar_pic').attr('src', '/admin/upload/' + msg);
        }
      } 
    })
  })
  </script>
  <script>NProgress.done()</script>
</body>
</html>