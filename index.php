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
$_result=_query("SELECT tg_id,tg_title,tg_type,tg_readcount,tg_commentcount,tg_nice FROM tg_article WHERE tg_reid=0 ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize");
//取得最新图片：找到时间最后的图片，并且是公开的，注意这个sql语句使用了嵌套
$_photo=_fetch_array("SELECT tg_id AS id,tg_name AS name,tg_url AS url FROM tg_photo WHERE tg_sid IN (SELECT tg_id FROM tg_dir WHERE tg_type=0) ORDER BY tg_date DESC LIMIT 1;");
?>
<!DOCTYPE html>
<html>
<head>
<?php
	require ROOT_PATH.'includes/title.inc.php';
?>
<script type="text/javascript" src="js/blog.js"></script>
<script type="text/javascript" src="js/sidebar.js"></script>
<script type="text/javascript" src="js/search.js"></script>
</head>
<body>

<?php
	require ROOT_PATH.'includes/header.inc.php';
?>

<div id="list">
	<h2>文章列表</h2>
	<form method="post">
		<dl>
			<dd>文章搜索：<input type="text" name="search"><input type="submit" value="搜索" class="submit"></dd>
		</dl>
	</form>
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
				$_htmllist['nice']=$_rows['tg_nice'];
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
		<dd class="user"><a href="member_info.php?id=<?php echo $_html['id']?>" class="info"><?php echo $_html['username']?>(<?php echo $_html['sex']?>)</a></dd>
		<dt><img src="<?php echo $_html['face']?>" alt="<?php echo $_html['username']?>"></dt>
		<dd class="message"><a href="javascript:;" name="message" title="<?php echo $_html['id']?>">发消息</a></dd>
		<dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $_html['id']?>">加为好友</a></dd>
		<dd class="guest"><a href="javascript:;" name="guest" title="<?php echo $_html['id']?>">写留言</dd>
		<dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $_html['id']?>">给他送花</a></dd>
		<dd class="email">邮箱：<a href="mailto:<?php echo $_html['email']?>"><?php echo $_html['email']?></a></dd>
		<dd class="url">网址：<a href="<?php echo $_html['url']?>" target="_blank"><?php echo $_html['url']?></a></dd>
	</dl>
</div>

<div id="pics">
	<h2>最新图片--<?php echo $_photo['name']?></h2>
	<a href="photo_detail.php?id=<?php echo $_photo['id']?>"><img src="thumb.php?filename=<?php echo $_photo['url']?>&percent=<?php echo 0.15?>" alt="<?php echo $_photo['name']?>"></a>
</div>
<div id="hot">
	<h2>热门文章和精华文章</h2>
	<a name="here"></a>
	<ul class="article">
		<?php 
			global $_pagenum,$_pagesize;
			_page("SELECT tg_id FROM tg_article WHERE tg_hot=1 OR tg_nice=1;",8);
			$_result=_query("SELECT tg_id,tg_title,tg_type,tg_readcount,tg_commentcount,tg_nice,tg_hot,tg_username FROM tg_article WHERE tg_hot=1 OR tg_nice=1 ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize");
			$_htmllist=array();
			while(!!$_rows=_fetch_array_list($_result)){
				$_htmllist['id']=$_rows['tg_id'];
				$_htmllist['username']=$_rows['tg_username'];
				$_htmllist['type']=$_rows['tg_type'];
				$_htmllist['readcount']=$_rows['tg_readcount'];
				$_htmllist['commentcount']=$_rows['tg_commentcount'];
				$_htmllist['title']=$_rows['tg_title'];
				$_htmllist=_html($_htmllist);
				echo '<li class="icon'.$_htmllist['type'].'"><em>文章作者：'.$_htmllist['username'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;阅读数(<strong>'.$_htmllist['readcount'].'</strong>)评论数(<strong>'.$_htmllist['commentcount'].'</strong>)</em><a href="article.php?id='.$_htmllist['id'].'">'._title($_htmllist['title']=$_rows['tg_title'],40).'</a></li>';
			}
			_free_result($_result);
		?>
	</ul>
	<?php _paging(2);?>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>