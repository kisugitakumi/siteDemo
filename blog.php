<?php 
define('IN_TG', 'true');
define('SCRIPT', 'blog');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//分页模块
//第一个参数获取总用户数，第二个参数指定每页的用户数量
global $_pagenum,$_pagesize;
_page("SELECT tg_id FROM tg_user;",6);
//从数据库提取数据获取结果集
//每次从新取结果集，而不是从新执行SQL语句
$_result=_query("SELECT tg_username,tg_sex,tg_face FROM tg_user ORDER BY tg_reg_time DESC LIMIT $_pagenum,$_pagesize");
?>
<!DOCTYPE html>
<html>
<head>
<title>多用户留言系统--博友界面</title>
<?php require ROOT_PATH.'includes/title.inc.php'; ?>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="blog">
	<h2>博友列表</h2>
	<?php while(!!$_rows=_fetch_array_list($_result)){?>
	<dl>
		<dd class="user"><?php echo $_rows['tg_username']?>(<?php echo $_rows['tg_sex']?>)</dd>
		<dt><img src="<?php echo $_rows['tg_face']?>" alt="炎日"></dt>
		<dd class="message">发消息</dd>
		<dd class="friend">加为好友</dd>
		<dd class="guest">写留言</dd>
		<dd class="flower">给他送花</dd>
	</dl>
	<?php } 
		//调用分页函数，1表示数字分页，2表示文本分页
		_paging(1);
		_paging(2);
	?>
	
	
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>