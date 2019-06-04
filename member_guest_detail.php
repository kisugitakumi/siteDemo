<?php
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'member_guest_detail');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//判断是否登录
if (!isset($_COOKIE['username'])) {
	_alert_back('请登录！');
}
//删除留言
if ($_GET['action']=='delete' && isset($_GET['id'])) {
	//验证留言是否存在
	if(!!$_rows=_fetch_array("SELECT tg_id FROM tg_guest WHERE tg_id='{$_GET['id']}' LIMIT 1;")){
		//删除是危险操作，要进一步验证用户的唯一标识符
		if (!!$_rows2=_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")) {
				_uniqid($_rows2['tg_uniqid'],$_COOKIE['uniqid']);
				//验证成功后，删除单个留言
				_query("DELETE FROM tg_guest WHERE tg_id='{$_GET['id']}' LIMIT 1;");
				if (_affected_rows()==1) {
					//关闭连接
					_close();
					//成功删除则跳转
					_location('删除成功！','member_guest.php');
				}else{
					_close();
					_alert_back('删除失败');
				}
		}else{
			_alert_back('非法登录');
		}
	}else{
		_alert_back('此留言不存在');
	}
}
//处理id
if (isset($_GET['id'])) {
	$_rows=_fetch_array("SELECT tg_id,tg_fromuser,tg_content,tg_date FROM tg_guest WHERE tg_id='{$_GET['id']}' LIMIT 1;");
	if($_rows){
		$_html=array();
		$_html['id']=$_rows['tg_id'];
		$_html['fromuser']=$_rows['tg_fromuser'];
		$_html['content']=$_rows['tg_content'];
		$_html['date']=$_rows['tg_date'];
		$_html=_html($_html);
	}else{
		_alert_back('此留言不存在');
	}
}else{
	_alert_back('非法登录');
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php';?>
<script type="text/javascript" src="js/member_message_detail.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>
<div id="member">
<?php require 'includes/member.inc.php'; ?>
	<div id="member_main">
		<h2>留言详情</h2>
		<dl>
			<dd>留 言 人：<?php echo $_html['fromuser']?></dd>
			<dd>内    容：<?php echo $_html['content']?></dd>
			<dd>留言时间：<?php echo $_html['date']?></dd>
			<dd class="button"><input type="button" value="返回列表" id="return"><input type="button" name="<?php echo $_html['id']?>" value="删除留言" id="delete"></dd>
		</dl>
	</div>
</div>
<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>