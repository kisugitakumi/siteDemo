<?php
define('IN_TG', 'true');
define('SCRIPT', 'q');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//初始化
if(isset($_GET['num']) && isset($_GET['path'])){
	if(!is_dir(ROOT_PATH.$_GET['path'])){
		_alert_back('非法操作');
	}

}else{
	_alert_back('非法操作');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>多用户留言系统--贴图选择</title>
	<?php
	require ROOT_PATH.'includes/title.inc.php';
	?>
	<script type="text/javascript" src="js/qopener.js"></script>
</head>
<body>

<div id="q">
	<h3>选择贴图</h3>
	<dl>
		<?php foreach (range(1,$_GET['num']) as $_num) {?>
		<dd><img src="<?php echo $_GET['path'].$_num?>.gif" alt="<?php echo $_GET['path'].$_num?>.gif" title="贴图<?php echo $_num ?>"></dd>
		<?php } ?>
	</dl>
</div>


</body>
</html>