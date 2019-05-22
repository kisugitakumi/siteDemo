<?php
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'manage_member');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//必须是管理员才能登陆
_manage_login();
//删除会员
if ($_GET['action']='del' && isset($_GET['id'])) {
	//验证删除会员是否存在
	if(!!$_rows=_fetch_array("SELECT tg_id FROM tg_user WHERE tg_id='{$_GET['id']}' LIMIT 1;")){
		//删除是危险操作，要进一步验证操作用户的唯一标识符
		if (!!$_rows2=_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")) {
				_uniqid($_rows2['tg_uniqid'],$_COOKIE['uniqid']);
				//验证成功后，删除单个会员
				_query("DELETE FROM tg_user WHERE tg_id='{$_GET['id']}' LIMIT 1;");
				if (_affected_rows()==1) {
					//关闭连接
					_close();
					//成功删除则跳转
					_location('删除成功！','manage_member.php');
				}else{
					_close();
					_alert_back('删除失败');
				}
		}else{
			_alert_back('非法登录');
		}
	}else{
		_alert_back('此用户不存在');
	}
}
//读取系统表
global $_pagenum,$_pagesize,$_system;
_page("SELECT tg_id FROM tg_user;",8);
$_result=_query("SELECT tg_id,tg_username,tg_reg_time,tg_email FROM tg_user ORDER BY tg_reg_time DESC LIMIT $_pagenum,$_pagesize");
?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php';?>
<script type="text/javascript" src="js/member_message.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>
<div id="member">
<?php require 'includes/manage.inc.php'; ?>
	<div id="member_main">
		<h2>会员列表中心</h2>
		<form method="post" action="?action=delete">
		<table cellspacing="1">
			<tr><th>ID号</th><th>会员名</th><th>邮箱</th><th>注册时间</th><th>操作</th></tr>
			<?php 
			$_html=array();
			while(!!$_rows=_fetch_array_list($_result)){
				$_html['id']=$_rows['tg_id'];
				$_html['username']=$_rows['tg_username'];
				$_html['email']=$_rows['tg_email'];
				$_html['reg_time']=$_rows['tg_reg_time'];
				$_html=_html($_html);
				if ($_COOKIE['username']==$_html['username']) {
					$_html['manage_member_html']='不能删除自己';
				}else{
					$_html['manage_member_html']='<a href="manage_member.php?action=del&id='.$_html['id'].'">删除会员</a>';
				}
			?>
			<tr><td><?php echo $_html['id']?></td><td><?php echo $_html['username']?></td><td><?php echo $_html['email']?></td><td><?php echo $_html['reg_time']?></td><td><?php echo $_html['manage_member_html']?></td></tr>
			<?php }?>
		</table>
		</form>
		<?php 
			_free_result($_result);
			_paging(2);
		?>
	</div>
</div>
<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>