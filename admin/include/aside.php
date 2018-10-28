<?php //print_r($_SERVER);
$url = $_SERVER['PHP_SELF'];
$arr = explode('/', $url);
//print_r($arr);
?>

<div class="profile">
      <img class="avatar" src="<?php echo $_SESSION['pic']; ?>">
      <h3 class="name"><?php echo $_SESSION['nickname']; ?></h3>
    </div>
    <ul class="nav">
      <li <?php if ($arr[2] == 'index.php') echo 'class="active"'; ?>>
        <a href="/admin/index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li>
        <a href="#menu-posts" class="collapsed" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse <?php if ($arr[2] == 'cate' || $arr[2] == 'article') echo 'in'; ?>">
          <li><a href="/admin/article/posts.php">所有文章</a></li>
          <li><a href="/admin/article/postadd.php">写文章</a></li>
          <li><a href="/admin/cate/categories.php">栏目列表</a></li>
          <li><a href="/admin/cate/addcate.php">添加栏目</a></li>
        </ul>
      </li>
      <li <?php if ($arr[2] == 'comments.php') echo 'class="active"'; ?>>
        <a href="/admin/comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li>
        <a href="/admin/users/users.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
        <a href="#menu-settings" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse">
          <li><a href="nav-menus.html">导航菜单</a></li>
          <li><a href="slides.html">图片轮播</a></li>
          <li><a href="settings.html">网站设置</a></li>
        </ul>
      </li>
    </ul>