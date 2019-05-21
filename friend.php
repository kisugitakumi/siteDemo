<?php
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'friend');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//判断是否登录
if (!isset($_COOKIE['username'])) {
	_alert_close('请登录后再发送短信！');
}
//添加好友
if ($_GET['action']=='add') {
	//验证验证码
	_check_code($_POST['code'],$_SESSION['code']);
	//验证唯一标识符
	if (!!$_rows=_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")) {
		_uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
		include ROOT_PATH.'includes/check.func.php';
		$_clean=array();
		$_clean['tobro']=$_POST['touser'];
		$_clean['frombro']=$_COOKIE['username'];
		$_clean['content']=_check_content($_POST['content']);
		$_clean=_mysql_string($_clean);
		//不能添加自己
		if ($_clean['tobro']==$_clean['frombro']) {
			_alert_close('不能添加自己为好友,HAPE!');
		}
		//数据库查看好友是否已经添加，防止重复添加
		if (!!$_rows=_fetch_array("SELECT tg_id FROM tg_friend WHERE (tg_tobro='{$_clean['tobro']}' AND tg_frombro='{$_clean['frombro']}') OR (tg_tobro='{$_clean['frombro']}' AND tg_frombro='{$_clean['tobro']}') LIMIT 1;")) {
			_alert_close('你们已经是好友了！或者你已发出好友申请但未验证！');
		}else{
			//添加好友信息
			_query("INSERT INTO tg_friend(
											tg_tobro,
											tg_frombro,
											tg_content,
											tg_date
											)
									VALUES(
											'{$_clean['tobro']}',
											'{$_clean['frombro']}',
											'{$_clean['content']}',
											NOW()
											);

				");
			//新增成功
			if (_affected_rows()==1) {
				//关闭连接和session
				_close();
				//_session_destroy();
				_alert_close('好友添加成功！请等待验证！');
			}else{
				_close();
				//_session_destroy();
				_alert_back('好友添加失败！');
			}
		}
	}
}
//获取数据
if (isset($_GET['id'])) {
	if(!!$_rows=_fetch_array("SELECT tg_username FROM tg_user WHERE tg_id={$_GET['id']} LIMIT 1;")){
		$_html=array();
		$_html['touser']=$_rows['tg_username'];
		$_html=_html($_html);
	}else{
		_alert_close('不存在此用户');
	}
}else{
	_alert_close('非法操作');
}
?>

<!DOCTYPE html>
<html>
<head>
	<?php require ROOT_PATH.'includes/title.inc.php'; ?>
	<script type="text/javascript" src="js/code.js"></script>
	<script type="text/javascript" src="js/message.js"></script>
</head>
<body>
<div id="message">
	<h3>添加好友</h3>
	<form method="post" action="?action=add">
	<input type="hidden" name="touser" value="<?php echo $_html['touser']?>">
	<dl>
		<dd><input type="text" readonly="readonly" value="亲爱的<?php echo $_html['touser']?>：" class="text"></dd>
		<dd><textarea name="content">我非常想和你交朋友！</textarea></dd>
		<dd>验 &nbsp;证 码：<input type="text" name="code" class="text yzm"><img src="code.php" id="code"><input type="submit" class="submit" value="添加好友"></dd>
	</dl>
	</form>
</div>
</body>
</html>