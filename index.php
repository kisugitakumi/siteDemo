<?php
//防止外部网站恶意调用的常量
define('IN_TG', true);
//用来指定本页内容的常量
define('SCRIPT', 'index');
//引入公共文件,转换成硬路径，速度更快
require dirname(__FILE__).'/includes/common.inc.php';
//读取xml文件
$_html=_html(_get_xml('new.xml'));
?>
<!DOCTYPE html>
<html>
<head>
<title>多用户留言系统--首页</title>
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
		<li class="icon1"><em>阅读数(<strong>72</strong>)评论数(<strong>72</strong>)</em><a href="###">创意时代：解密QQ仙剑奇侠传美术创意</a></li>
		<li class="icon1"><em>阅读数(<strong>72</strong>)评论数(<strong>72</strong>)</em><a href="###">创意时代：解密QQ仙剑奇侠传美术创意</a></li>
		<li class="icon1"><em>阅读数(<strong>72</strong>)评论数(<strong>72</strong>)</em><a href="###">创意时代：解密QQ仙剑奇侠传美术创意</a></li>
		<li class="icon1"><em>阅读数(<strong>72</strong>)评论数(<strong>72</strong>)</em><a href="###">创意时代：解密QQ仙剑奇侠传美术创意</a></li>
		<li class="icon1"><em>阅读数(<strong>72</strong>)评论数(<strong>72</strong>)</em><a href="###">创意时代：解密QQ仙剑奇侠传美术创意</a></li>
		<li class="icon1"><em>阅读数(<strong>72</strong>)评论数(<strong>72</strong>)</em><a href="###">创意时代：解密QQ仙剑奇侠传美术创意</a></li>
		<li class="icon12"><em>阅读数(<strong>72</strong>)评论数(<strong>72</strong>)</em><a href="###">创意时代：解密QQ仙剑奇侠传美术创意</a></li>
		<li class="icon2"><em>阅读数(<strong>72</strong>)评论数(<strong>72</strong>)</em><a href="###">创意时代：解密QQ仙剑奇侠传美术创意</a></li>
		<li class="icon3"><em>阅读数(<strong>72</strong>)评论数(<strong>72</strong>)</em><a href="###">创意时代：解密QQ仙剑奇侠传美术创意</a></li>
	</ul>
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