<?php 
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'photo');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';

?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php'; ?>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="photo">
	<h2>相册列表</h2>
	<?php if(isset($_SESSION['admin']) && isset($_COOKIE['username'])){?>
	<p><a href="photo_add_dir.php">添加目录</a></p>
	<?php }?>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>