<?php 
//会话控制，开启session
// session_start();
define('IN_TG', 'true');
define('SCRIPT', 'post');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>多用户留言系统--发表帖子</title>
<?php
	require ROOT_PATH.'includes/title.inc.php';
?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/post.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="post">
	<h2>发表帖子</h2>
	<form method="post" name='post' action="?action=post">
		<dl>
			<dt>请认真填写下列内容</dt>
			<dd>
				类  型：
				<?php 
				foreach (range(1, 16) as $_num) {
					if ($_num==1) {
						echo '<label for="type'.$_num.'"><input type="radio" id="type'.$_num.'" name="type" value="'.$_num.'" checked="checked"> ';
						echo ' <img src="images/icon'.$_num.'.gif" alt="类型"></label> ';
					}else{
						echo '<label for="type'.$_num.'"><input type="radio" id="type'.$_num.'" name="type" value="'.$_num.'"> ';
						echo ' <img src="images/icon'.$_num.'.gif" alt="类型"></label> ';
						if ($_num==8) {
							echo '<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
					}
				}
				?>
			</dd>
			<dd>标  题：<input type="text" name="username" class="text">（*必填，2-40字）</dd>
			<dd>
				<div id="ubb">
					<img src="images/fontsize.gif" title="字体大小" alt="字体大小">
					<img src="images/space.gif" title="线条" alt="线条">
					<img src="images/bold.gif" title="粗体" />
					<img src="images/italic.gif" title="斜体" />
					<img src="images/underline.gif" title="下划线" />
					<img src="images/strikethrough.gif" title="删除线" />
					<img src="images/space.gif" />	
					<img src="images/color.gif" title="颜色" />	
					<img src="images/url.gif" title="超链接" />	
					<img src="images/email.gif" title="邮件" />	
					<img src="images/image.gif" title="图片" />	
					<img src="images/swf.gif" title="flash" />	
					<img src="images/movie.gif" title="影片" />
					<img src="images/space.gif" />
					<img src="images/left.gif" title="左区域" />
					<img src="images/center.gif" title="中区域" />
					<img src="images/right.gif" title="右区域" />		
					<img src="images/space.gif" />
					<img src="images/increase.gif" title="扩大输入区" />	
					<img src="images/decrease.gif" title="缩小输入区" />	
					<img src="images/help.gif" />
				</div>
				<textarea name="content" rows="14"></textarea>
			</dd>
			<dd>验 &nbsp;证 码：<input type="text" name="code" class="text yzm"><img src="code.php" id="code"><input type="submit" class="submit" value="发表帖子"></dd>
		</dl>
	</form>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>