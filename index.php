<?php
session_start();
//防止外部网站恶意调用的常量
define('IN_TG', true);
//用来指定本页内容的常量
define('SCRIPT', 'index');
//引入公共文件,转换成硬路径，速度更快
require dirname(__FILE__).'/includes/common.inc.php';
//读取xml文件
$_html=_html(_get_xml('new.xml'));
//读取帖子列表
global $_pagenum,$_pagesize,$_system;
_page("SELECT tg_id FROM tg_article WHERE tg_reid=0;",$_system['article']);
$_result=_query("SELECT tg_id,tg_title,tg_type,tg_readcount,tg_commentcount FROM tg_article WHERE tg_reid=0 ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize");
?>
<!DOCTYPE html>
<html>
<head>
<?php
	require ROOT_PATH.'includes/title.inc.php';
?>
<script type="text/javascript" src="js/blog.js"></script>
</head>
<body>

<?php
	require ROOT_PATH.'includes/header.inc.php';
?>

<div id="list">
	<h2>帖子列表</h2>
	<a href="post.php" class="post">发表文章</a>
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
	<?php _paging(2);?>
</div>

<div id="user">
	<h2>新会员</h2>
	<dl>
		<dd class="user"><?php echo $_html['username']?>(<?php echo $_html['sex']?>)</dd>
		<dt><img src="<?php echo $_html['face']?>" alt="<?php echo $_html['username']?>"></dt>
		<dd class="message"><a href="javascript:;" name="message" title="<?php echo $_html['id']?>">发消息</a></dd>
		<dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $_html['id']?>">加为好友</a></dd>
		<dd class="guest">写留言</dd>
		<dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $_html['id']?>">给他送花</a></dd>
		<dd class="email">邮箱：<a href="mailto:<?php echo $_html['email']?>"><?php echo $_html['email']?></a></dd>
		<dd class="url">网址：<a href="<?php echo $_html['url']?>" target="_blank"><?php echo $_html['url']?></a></dd>
	</dl>
</div>

<div id="pics">
	<h2>最新图片</h2>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>