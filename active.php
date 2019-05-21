<?php
define('IN_TG', 'true');
define('SCRIPT', 'active');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//开始激活处理
if(!isset($_GET['active'])){
	_alert_back('非法操作');
}
if (isset($_GET['action']) && isset($_GET['active']) && $_GET['action'] == 'ok') {
	$_active=_mysql_string($_GET['active']);
	if (_fetch_array("SELECT tg_active FROM tg_user WHERE tg_active='$_active' LIMIT 1;")) {
		//将tg_active设置为空
		_query("UPDATE tg_user SET tg_active='' WHERE tg_active='$_active' LIMIT 1;");
		if (_affected_rows()==1) {
			_close();
			_location('账户激活成功','login.php');
		}else{
			_close();
			_location('账户激活失败','register.php');
		}
	}else{
		_alert_back('非法操作');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<?php
	require ROOT_PATH.'includes/title.inc.php';
?>
<script type="text/javascript" src="js/register.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id='active'>
	<h2>激活账户</h2>
	<p>本页面模拟邮件的功能，点击一下超链接以激活您的账户</p>
	<p><a href="active.php?action=ok&amp;active=<?php echo $_GET['active']?>">
		<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']?>active.php?action=ok&amp;active=<?php echo $_GET['active']?>
		</a></p>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>