<?php
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'member_info_article');
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
_page("SELECT tg_id FROM tg_article WHERE tg_username='{$_html['username']}' AND tg_reid=0;",8);
//从数据库提取数据获取结果集
//每次从新取结果集，而不是从新执行SQL语句
$_result=_query("SELECT tg_id,tg_reid,tg_title,tg_content,tg_date,tg_readcount,tg_commentcount FROM tg_article WHERE tg_username='{$_html['username']}' AND tg_reid=0 ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize;");
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
		<h2>博主发表文章</h2>
		<form method="post" action="?action=delete">
		<table cellspacing="1">
			<tr><th>文章标题</th><th>文章内容</th><th>评论<th>阅读</th></th><th>发表时间</th></tr>
			<?php
				$_htmllist=array();
				 while(!!$_rows=_fetch_array_list($_result)){
					$_htmllist['id']=$_rows['tg_id'];
					$_htmllist['title']=$_rows['tg_title'];
					$_htmllist['date']=$_rows['tg_date'];
					$_htmllist['reid']=$_rows['tg_reid'];
					$_htmllist['content']=$_rows['tg_content'];
					$_htmllist['readcount']=$_rows['tg_readcount'];
					$_htmllist['commentcount']=$_rows['tg_commentcount'];
					$_htmllist=_html($_htmllist);
			?>
			<tr><td><a href="article.php?id=<?php echo $_htmllist['id']?>" title="<?php echo $_htmllist['title']?>"><?php echo _title($_htmllist['title'],8)?></a></td><td><a href="article.php?id=<?php echo $_htmllist['id']?>" title="<?php echo $_htmllist['content']?>"><?php echo _title($_htmllist['content'],14)?></a></td><td><?php echo $_htmllist['commentcount']?></td><td><?php echo $_htmllist['readcount']?></td><td><?php echo $_htmllist['date']?></td>
			<?php 
				}
				_free_result($_result);
			?>
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