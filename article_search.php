<?php
define('IN_TG', 'true');
define('SCRIPT', 'article_search');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//接收表单发来的查询数据
if (isset($_GET['id'])) {
	//利用查询数据对文章标题进行模糊查询
	global $_pagenum,$_pagesize,$_system,$_id;
	$_id='id='.$_GET['id'].'&';
	_page("SELECT tg_id FROM tg_article WHERE (tg_title LIKE CONCAT('%','{$_GET['id']}','%') OR tg_content LIKE CONCAT('%','{$_GET['id']}','%')) AND tg_reid=0;",$_system['article']);
	$_result=_query("SELECT tg_id,tg_title,tg_type,tg_readcount,tg_commentcount FROM tg_article WHERE (tg_title LIKE CONCAT('%','{$_GET['id']}','%') OR tg_content LIKE CONCAT('%','{$_GET['id']}','%')) AND tg_reid=0 ORDER BY tg_readcount DESC,tg_commentcount DESC LIMIT $_pagenum,$_pagesize");
}else{
	_alert_back('没有输入搜索内容！');
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php'; ?>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>
<div id="search">
	<h2>文章搜索结果</h2>
	<ul class="article">
		<?php 
			$_htmllist=array();
			while(!!$_rows=_fetch_array_list($_result)){
				$_htmllist['id']=$_rows['tg_id'];
				$_htmllist['type']=$_rows['tg_type'];
				$_htmllist['readcount']=$_rows['tg_readcount'];
				$_htmllist['commentcount']=$_rows['tg_commentcount'];
				$_htmllist['title']=$_rows['tg_title'];
				$_htmllist=_html($_htmllist);
				echo '<li class="icon'.$_htmllist['type'].'"><em>阅读数(<strong>'.$_htmllist['readcount'].'</strong>)评论数(<strong>'.$_htmllist['commentcount'].'</strong>)</em><a href="article.php?id='.$_htmllist['id'].'">'._title($_htmllist['title']=$_rows['tg_title'],20).'</a></li>';
			}
			_free_result($_result);
		?>
	</ul>
	<?php if(empty($_htmllist)){?>
		<h4>没有查询到符合条件的文章！</h4>
	<?php }?>
	<?php _paging(2);?>

</div>
<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>