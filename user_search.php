<?php
define('IN_TG', 'true');
define('SCRIPT', 'user_search');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//接收表单发来的查询数据
if (isset($_GET['id'])) {
	//利用查询数据对文章标题进行模糊查询
	global $_pagenum,$_pagesize,$_system,$_id;
	$_id='id='.$_GET['id'].'&';
	_page("SELECT tg_id FROM tg_user WHERE (tg_username LIKE CONCAT('%','{$_GET['id']}','%'))",5);
	$_result=_query("SELECT tg_id,tg_username,tg_sex,tg_face FROM tg_user WHERE (tg_username LIKE CONCAT('%','{$_GET['id']}','%')) LIMIT $_pagenum,$_pagesize");
}else{
	_alert_back('没有输入搜索内容！');
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php'; ?>
<script type="text/javascript" src="js/blog.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>
<div id="blog">
	<h2>博友查询结果</h2>
	<?php 
		$_html=array();
		while(!!$_rows=_fetch_array_list($_result)){
			$_html['id']=$_rows['tg_id'];
			$_html['username']=$_rows['tg_username'];
			$_html['face']=$_rows['tg_face'];
			$_html['sex']=$_rows['tg_sex'];
			$_html=_html($_html);
	?>
	<dl>
		<dd class="user"><a href="member_info.php?id=<?php echo $_html['id']?>" name="info" class="info"><?php echo $_html['username']?>(<?php echo $_html['sex']?>)</a></dd>
		<dt><img src="<?php echo $_html['face']?>" alt="<?php echo $_html['username']?>"></dt>
		<dd class="message"><a href="javascript:;" name="message" title="<?php echo $_html['id']?>">发消息</a></dd>
		<dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $_html['id']?>">加为好友</a></dd>
		<dd class="guest"><a href="javascript:;" name="guest" title="<?php echo $_html['id']?>">写留言</a></dd>
		<dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $_html['id']?>">给他送花</a></dd>
	</dl>
	<?php } 
		
		//去除warning提示
		error_reporting(E_ALL^E_NOTICE^E_WARNING);
		_free_result($_result);
		
		?>
		<?php if(empty($_html)){?>
			<h4 style="font-size:20px;text-align: center;padding:60px 0 0 0;">没有查询到符合条件的用户！</h4>
		<?php }
		//调用分页函数，1表示数字分页，2表示文本分页
		_paging(2);
	?>
</div>
<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>