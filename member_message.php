<?php
define('IN_TG', 'true');
define('SCRIPT', 'member_message');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//判断是否登录
if (!isset($_COOKIE['username'])) {
	_alert_back('请登录！');
}
//分页模块
//第一个参数获取总用户数，第二个参数指定每页的用户数量
global $_pagenum,$_pagesize;
_page("SELECT tg_id FROM tg_message WHERE tg_touser='{$_COOKIE['username']}';",5);
//从数据库提取数据获取结果集
//每次从新取结果集，而不是从新执行SQL语句
$_result=_query("SELECT tg_id,tg_fromuser,tg_content,tg_date FROM tg_message WHERE tg_touser='{$_COOKIE['username']}' ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize;");
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
		<h2>短信管理中心</h2>
		<table cellspacing="1">
			<tr><th>发信人</th><th>短信内容</th><th>时间</th><th>操作</th></tr>
			<?php
				 while(!!$_rows=_fetch_array_list($_result)){
				 	$_html=array();
					$_html['id']=$_rows['tg_id'];
					//下面这句话有bug，因此在显示发信人的时候，直接使用$_rows数组
				 	//$_hmtl['fromuser']=$_rows['tg_fromuser'];
					$_html['content']=$_rows['tg_content'];
					$_html['date']=$_rows['tg_date'];
			?>
			<tr><td><?php echo $_rows['tg_fromuser']?></td><td><a href="member_message_detail.php?id=<?php echo $_html['id']?>" title="<?php echo $_html['content']?>"><?php echo _title($_html['content'])?></a></td><td><?php echo $_html['date']?></td><td><input type="checkbox" name=""></td></tr>
			<?php 
				}
				_free_result($_result);
			?>
		</table>
		<?php
			//调用分页函数，1表示数字分页，2表示文本分页
			_paging(1);
		?>
	</div>
</div>
<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>