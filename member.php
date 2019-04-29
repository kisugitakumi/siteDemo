<?php 
define('IN_TG', 'true');
define('SCRIPT', 'member');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';







?>
<!DOCTYPE html>
<html>
<head>
	<title>多用户留言系统--个人中心</title>
<?php require ROOT_PATH.'includes/title.inc.php';?>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>
<div id="member">
<?php require 'includes/member.inc.php'; ?>
		
	<div id="member_main">
		<h2>会员管理中心</h2>
		<dl>
			<dd>用户名：炎日</dd>
			<dd>性  别：男</dd>
			<dd>头  像：face/m01.gif</dd>
			<dd>电子邮件：277382367@qq.com</dd>
			<dd>主  页：www.zenghongyi.com</dd>
			<dd>Q    Q：277382367</dd>
			<dd>注册时间：2019-9-1 10:10:10</dd>
			<dd>身  份：管理员</dd>
		</dl>
	</div>

</div>



<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>