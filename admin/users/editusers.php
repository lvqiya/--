<link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
<link rel="stylesheet" href="/assets/css/admin.css">
<script type="text/javascript" src="/assets/vendors/jquery.1.11.js"></script>
<div class="col-md-4">
<?php 
//1. 获取数据
$id = $_GET['id'];

//2. 拼接SQL语句 --- select ...
$sql = "select * from ali_admin where admin_id=$id";


//3. 链接MySQL并执行SQL语句
include_once '../include/mysql.php';
$result_obj = mysqli_query($conn, $sql);
$admin_info = mysqli_fetch_assoc($result_obj);

//4. 处理SQL结果 --- 将结果显示到表单中

?>
<form>
  <h2>修改用户信息</h2>
  <div class="form-group">
    <label for="email">id</label>
    <input id="email" class="form-control" name="id" type="text" readonly value="<?php echo $admin_info['admin_id']; ?>">
  </div>
  <div class="form-group">
    <label for="email">邮箱</label>
    <input id="email" class="form-control" name="email" type="email" value="<?php echo $admin_info['admin_email']; ?>">
  </div>
  <div class="form-group">
    <label for="slug">别名</label>
    <input id="slug" class="form-control" name="slug" type="text" value="<?php echo $admin_info['admin_slug']; ?>">
  </div>
  <div class="form-group">
    <label for="nickname">昵称</label>
    <input id="nickname" class="form-control" name="nickname" type="text" value="<?php echo $admin_info['admin_nickname']; ?>">
  </div>
  <div class="form-group">
    <input type="button" value="修改" id="btn" />
  </div>
</form>
</div>

<script type="text/javascript">
//1. 修改按钮上注册点击事件
$('#btn').click(function () {
  //2. 获取表单数据  ---  FormData
  var fm = $('form')[0];
  var fd = new FormData(fm);
  
  //3. 发送ajax请求
  $.ajax({
    url: 'editusers_deal.php',
    data: fd,
    type: 'post',
    dataType: 'text',
    contentType: false,
    processData: false,
    success: function (msg) {
      alert(msg);
      if (msg == 1) {
        parent.layer.alert('修改管理员信息成功', function (i) {
          var index = parent.layer.getFrameIndex(window.name);
          parent.layer.close(index);
          parent.layer.close(i);
          parent.location.reload();
        });
      } else {
        parent.layer.alert('修改管理员信息失败');
      }
    });
})
</script>
