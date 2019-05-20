<?php
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'flower');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//判断是否登录
if (!isset($_COOKIE['username'])) {
	_alert_close('请登录后再送花！');
}
//送花
if ($_GET['action']=='send') {
	_check_code($_POST['code'],$_SESSION['code']);
	if (!!$_rows=_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")) {
		_uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
		include ROOT_PATH.'includes/check.func.php';
		$_clean=array();
		$_clean['touser']=$_POST['touser'];
		$_clean['fromuser']=$_COOKIE['username'];
		$_clean['flower']=$_POST['flower'];
		$_clean['content']=_check_content($_POST['content']);
		$_clean=_mysql_string($_clean);
		//写入数据库
		_query("INSERT INTO tg_flower (
							tg_touser,
							tg_fromuser,
							tg_flower,
							tg_content,
							tg_date
						)
						VALUES(
							'{$_clean['touser']}',
							'{$_clean['fromuser']}',
							'{$_clean['flower']}',
							'{$_clean['content']}',
							NOW()
						);
		");
		//新增成功
		if (_affected_rows()==1) {
			//关闭连接和session
			_close();
			//_session_destroy();
			_alert_close('送花成功');
		}else{
			_close();
			//_session_destroy();
			_alert_back('送花失败！');
		}
	}else{
		_alert_close('非法操作！');
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
	<title>多用户留言系统--送花</title>
	<?php require ROOT_PATH.'includes/title.inc.php'; ?>
	<script type="text/javascript" src="js/code.js"></script>
	<script type="text/javascript" src="js/message.js"></script>
</head>
<body>
<div id="message">
	<h3>送花</h3>
	<form method="post" action="?action=send">
	<input type="hidden" name="touser" value="<?php echo $_html['touser']?>">
	<dl>
		<dd>
			<input type="text" readonly="readonly" value="亲爱的<?php echo $_html['touser']?>：" class="text">
			<select name="flower">
				<?php 
					foreach (range(1, 100) as $_num) {
						echo '<option value="'.$_num.'">送'.$_num.'朵</option>';
					}
				?>
			</select>
		</dd>
		<dd><textarea name="content">非常欣赏你，送你花朵~~~</textarea></dd>
		<dd>验 &nbsp;证 码：<input type="text" name="code" class="text yzm"><img src="code.php" id="code"><input type="submit" class="submit" value="送花"></dd>
	</dl>
	</form>
</div>
</body>
</html>