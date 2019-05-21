<?php
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'member_flower');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//判断是否登录
if (!isset($_COOKIE['username'])) {
	_alert_back('请登录！');
}
//批量删除花朵
if ($_GET['action']=='delete' && isset($_POST['ids'])) {
	$_clean=array();
	$_clean['ids']=_mysql_string(implode(',', $_POST['ids']));
	print_r($_clean['ids']);
	if (!!$_rows=_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")) {
		_uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
		_query("DELETE FROM tg_flower WHERE tg_id IN ({$_clean['ids']})");
		if (_affected_rows()) {
			//关闭连接
			_close();
			//成功删除则跳转
			_location('删除成功！','member_flower.php');
		}else{
			_close();
			_alert_back('删除失败');
		}
	}else{
		_alert_back('非法登录');
	}
}
//分页模块
//第一个参数获取总用户数，第二个参数指定每页的用户数量
global $_pagenum,$_pagesize;
_page("SELECT tg_id FROM tg_flower WHERE tg_touser='{$_COOKIE['username']}';",3);
//从数据库提取数据获取结果集
//每次从新取结果集，而不是从新执行SQL语句
$_result=_query("SELECT tg_id,tg_fromuser,tg_content,tg_date,tg_flower FROM tg_flower WHERE tg_touser='{$_COOKIE['username']}' ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize;");
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
<?php require 'includes/member.inc.php'; ?>
	<div id="member_main">
		<h2>花朵管理中心</h2>
		<form method="post" action="?action=delete">
		<table cellspacing="1">
			<tr><th>送花人</th><th>花朵数目</th><th>感言</th><th>时间</th><th>操作</th></tr>
			<?php
				$_html=array();
				 while(!!$_rows=_fetch_array_list($_result)){
					$_html['id']=$_rows['tg_id'];
					//下面这句话有bug，因此在显示发信人的时候，直接使用$_rows数组
				 	//$_hmtl['fromuser']=$_rows['tg_fromuser'];
					$_html['content']=$_rows['tg_content'];
					$_html['date']=$_rows['tg_date'];
					$_html['flower']=$_rows['tg_flower'];
					$_html=_html($_html);
					$_html['count']+=$_html['flower'];
			?>
			<tr><td><?php echo $_rows['tg_fromuser']?></td><td><img src="images/x4.gif" alt="花朵"> x<?php echo $_html['flower']?>朵</td><td><?php echo _title($_html['content'],14)?></td><td><?php echo $_html['date']?></td><td><input name="ids[]" value="<?php echo $_html['id']?>" type="checkbox"></td></tr>
			<?php 
				}
				_free_result($_result);
			?>
			<tr><td colspan="5">共<strong><?php echo $_html['count']?></strong>朵花</td></tr>
			<tr><td colspan="5"><label for="all">全选<input type="checkbox" name="chkall" id="all"></label><input type="submit" value="批删除"></td></tr>
		</table>
		</form>
		<?php
			//调用分页函数，1表示数字分页，2表示文本分页
			_paging(2);
		?>
	</div>
</div>
<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>