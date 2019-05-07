<?php
define('IN_TG', 'true');
define('SCRIPT', 'member_message_detail');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//判断是否登录
if (!isset($_COOKIE['username'])) {
	_alert_back('请登录！');
}
if (isset($_GET['id'])) {
	$_rows=_fetch_array("SELECT tg_fromuser,tg_content,tg_date FROM tg_message WHERE tg_id='{$_GET['id']}' LIMIT 1;");
	if($_rows){
		$_html=array();
		$_html['fromuser']=$_rows['tg_fromuser'];
		$_html['content']=$_rows['tg_content'];
		$_html['date']=$_rows['tg_date'];
		$_html=_html($_html);
	}else{
		_alert_back('此短信不存在');
	}
}else{
	_alert_back('非法登录');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>多用户留言系统--短信列表</title>
<?php require ROOT_PATH.'includes/title.inc.php';?>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>
<div id="member">
<?php require 'includes/member.inc.php'; ?>
	<div id="member_main">
		<h2>短信详情</h2>
		<dl>
			<dd>发 信 人：<?php echo $_html['fromuser']?></dd>
			<dd>内    容：<?php echo $_html['content']?></dd>
			<dd>发信时间：<?php echo $_html['date']?></dd>
			<dd class="button"><input type="button" value="返回列表" onclick="javascript:history.back()"><input type="button" value="删除短信"></dd>
		</dl>
	</div>
</div>
<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>