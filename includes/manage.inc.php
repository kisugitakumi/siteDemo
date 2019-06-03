<?php
if(!defined('IN_TG')){//防止恶意调用
	exit('Access Denied!');	
}

?>
<div id="member_sidebar">
	<h2>管理导航</h2>
	<dl>
		<dt>系统管理</dt>
		<dd><a href='manage.php'>后台首页</a></dd>
		<dd><a href='manage_set.php'>系统设置</a></dd>
	</dl>
	<dl>
		<dt>会员管理</dt>
		<dd><a href='manage_member.php'>会员列表</a></dd>
		<dd><a href='manage_job.php'>职务设置</a></dd>
	</dl>
	<dl>
		<dt>文章管理</dt>
		<dd><a href="manage_article.php">文章查阅</a></dd>
	</dl>
</div>