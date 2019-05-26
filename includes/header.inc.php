<!-- 头部框架 -->
<?php
if(!defined('IN_TG')){
	exit('Access Denied!');	
}
?>
<div id="header">
	<h1><a href='index.php'>用户留言系统</a></h1>
	<ul>
		<li><a href="index.php">首页</a></li>
		
		<?php
			if(isset($_COOKIE['username'])){
				echo "<li><a href='member.php'>".$_COOKIE['username'].'の个人中心</a>'.$_message_html.'</li>';
				echo "\n";
			}else {
				echo '<li><a href="register.php">注册</a></li>';
				echo "\n";
				echo "\t\t";
				echo '<li><a href="login.php"> 登录</a></li>';
				echo "\n";
			}
		?>
		<li><a href="blog.php">博友</a></li>
		<li><a href="photo.php">相册</a></li>
		<li>风格</li>
		<?php
			if (isset($_COOKIE['username']) && isset($_SESSION['admin'])) {
				echo '<li><a href="manage.php" class="manage">管理</a> </li>';
			}
			if(isset($_COOKIE['username'])){
				echo "<li><a href='logout.php'>退出</a></li>";
			}
		?>
	</ul>
</div>