<?php
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'article_view_history');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//分页模块
//第一个参数获取总用户数，第二个参数指定每页的用户数量
global $_pagenum,$_pagesize,$_id;
$_id='id='.$_GET['id'].'&';
_page("SELECT tg_id FROM tg_photo_history WHERE tg_dir_id='{$_GET['id']}';",9);
//从数据库提取数据获取结果集
//每次从新取结果集，而不是从新执行SQL语句
$_result=_query("SELECT tg_id,tg_username,tg_date,tg_dir_id FROM tg_photo_history WHERE tg_dir_id='{$_GET['id']}' ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize;");
?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php';?>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>
<div id="member">
	<h2>相册浏览历史</h2>
	<table cellspacing="1">
		<tr><th>浏览者</th><th>浏览时间</th></tr>
		<?php
			$_html=array();
			 while(!!$_rows=_fetch_array_list($_result)){
				$_html['id']=$_rows['tg_id'];
				$_html['username']=$_rows['tg_username'];
				$_html['date']=$_rows['tg_date'];
				$_html['dir_id']=$_rows['tg_dir_id'];
				$_html=_html($_html);
		?>
		<tr><td><?php echo $_html['username']?></td><td><?php echo $_html['date']?></td></tr>
		<?php 
			}
			_free_result($_result);
		?>
	</table>
	<?php
		//调用分页函数，1表示数字分页，2表示文本分页
		_paging(2);
	?>
</div>
<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>