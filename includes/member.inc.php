<?php
if(!defined('IN_TG')){//防止恶意调用
	exit('Access Denied!');	
}

?>
<div id="member_sidebar">
	<h2>中心导航</h2>
	<dl>
		<dt>账号管理</dt>
		<dd><a href='member.php'>个人信息</a></dd>
		<dd><a href='member_modify.php'>修改资料</a></dd>
	</dl>
	<dl>
		<dt>其他管理</dt>
		<dd><a href="member_message.php">短信查阅</a></dd>
		<dd><a href="member_friend.php">好友设置</a></dd>
		<dd><a href="member_flower.php">花朵查阅</a></dd>
		<dd><a href="member_article.php">文章查阅</a></dd>
		<dd><a href="member_photo.php">个人图片</a></dd>
	</dl>
</div>