<?php
	//防止外部网站恶意调用的常量
	define('IN_TG', true);
	//用来指定本页内容的常量
	define('SCRIPT', 'index');
	//引入公共文件,转换成硬路径，速度更快
	require dirname(__FILE__).'/includes/common.inc.php';
	
?>
<!DOCTYPE html>
<html>
<head>
<title>多用户留言系统--首页</title>
<?php
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>

<?php
	require ROOT_PATH.'includes/header.inc.php';
?>

<div id="list">
	<h2>帖子列表</h2>
</div>

<div id="user">
	<h2>新会员</h2>
</div>

<div id="pics">
	<h2>最新图片</h2>
</div>

<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>

</body>
</html>