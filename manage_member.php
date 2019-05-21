<?php
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'manage_member');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//必须是管理员才能登陆
_manage_login();
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
			?>
			<tr><td><?php echo $_html['id']?></td><td><?php echo $_html['username']?></td><td><?php echo $_html['email']?></td><td><?php echo $_html['reg_time']?></td><td>[删] [修]</td></tr>
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