<?php
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'member_info_guest');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//取值
if(isset($_GET['id'])){
	//获取数据
	$_rows=_fetch_array("SELECT tg_id,tg_username FROM tg_user WHERE tg_id='{$_GET['id']}' LIMIT 1;");
	if($_rows){
		$_html=array();
		$_html['id']=$_rows['tg_id'];
		$_html['username']=$_rows['tg_username'];
		//信息过滤
		$_html=_html($_html);
	}else{
		_alert_back('此用户不存在');
	}
}else{
	_alert_back('非法进入！');
}
//分页模块
//第一个参数获取总用户数，第二个参数指定每页的用户数量
global $_pagenum,$_pagesize,$_id;
$_id='id='.$_html['id'].'&';
_page("SELECT tg_id FROM tg_guest WHERE tg_touser='{$_html['username']}';",8);
//从数据库提取数据获取结果集
//每次从新取结果集，而不是从新执行SQL语句
$_result=_query("SELECT tg_id,tg_fromuser,tg_content,tg_date FROM tg_guest WHERE tg_touser='{$_html['username']}' ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize;");
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
	<div id="member_sidebar">
		<h2>中心导航</h2>
		<dl>
			<dt>个人信息</dt>
			<dd><a href='member_info.php?id=<?php echo $_html['id']?>'>博主信息</a></dd>
		</dl>
		<dl>
			<dt>其他查阅</dt>
			<dd><a href="member_info_article.php?id=<?php echo $_html['id']?>">文章查阅</a></dd>
			<dd><a href="member_info_guest.php?id=<?php echo $_html['id']?>">留言查阅</a></dd>
			<dd><a href="member_info_photo.php?id=<?php echo $_html['id']?>">博主图片</a></dd>
		</dl>
	</div>

	<div id="member_main">
		<h2>留言墙</h2>
		<table cellspacing="1">
			<tr><th>留言人</th><th>留言内容</th><th>时间</th></tr>
			<?php
				$_htmllist=array();
				while(!!$_rows=_fetch_array_list($_result)){
					$_htmllist['id']=$_rows['tg_id'];
				 	$_htmllist['fromuser']=$_rows['tg_fromuser'];
					$_htmllist['content']=$_rows['tg_content'];
					$_htmllist['date']=$_rows['tg_date'];
					$_htmllist=_html($_htmllist);
			?>
			<tr><td><?php echo $_rows['tg_fromuser']?></td><td><a title="<?php echo $_htmllist['content']?>"><?php echo _title($_htmllist['content'],20)?></a></td><td><?php echo $_htmllist['date']?></td></tr>
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
</div>
<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>