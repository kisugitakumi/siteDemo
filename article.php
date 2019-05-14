<?php 
define('IN_TG', 'true');
define('SCRIPT', 'article');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//读出数据
if (isset($_GET['id'])) {
	//提取出数据库中的帖子ID
	if(!!$_rows=_fetch_array("SELECT tg_id,tg_username,tg_type,tg_content,tg_title,tg_readcount,tg_commentcount,tg_date FROM tg_article WHERE tg_id='{$_GET['id']}';")){
		//累积阅读量
		_query("UPDATE tg_article SET tg_readcount=tg_readcount+1 WHERE tg_id='{$_GET['id']}';");
		$_html=array();
		$_html['username']=$_rows['tg_username'];
		$_html['type']=$_rows['tg_type'];
		$_html['title']=$_rows['tg_title'];
		$_html['content']=$_rows['tg_content'];
		$_html['readcount']=$_rows['tg_readcount'];
		$_html['commemtcount']=$_rows['tg_commentcount'];
		$_html['date']=$_rows['tg_date'];
		//拿出用户名查找发表帖子的用户信息
		if(!!$_rows=_fetch_array("SELECT tg_id,tg_sex,tg_face,tg_email,tg_url FROM tg_user WHERE tg_username='{$_html['username']}';")){
			$_html['userid']=$_rows['tg_id'];
			$_html['sex']=$_rows['tg_sex'];
			$_html['face']=$_rows['tg_face'];
			$_html['email']=$_rows['tg_email'];
			$_html['url']=$_rows['tg_url'];
			$_html=_html($_html);
		}else{
			//这个用户已被删除（未完善）
		}
	}else{
		_alert_back('不存在这个主题！');
	}
}else{
	_alert_back('非法操作');
}
?>
<!DOCTYPE html>
<html>
<head>
<title>多用户留言系统--帖子详情</title>
<?php require ROOT_PATH.'includes/title.inc.php'; ?>
<script type="text/javascript" src="js/blog.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="article">
	<h2>帖子详情</h2>
	<div id="subject">
		<dl>
			<dd class="user"><?php echo $_html['username']?>(<?php echo $_html['sex']?>)</dd>
			<dt><img src="<?php echo $_html['face']?>" alt="<?php echo $_html['username']?>"></dt>
			<dd class="message"><a href="javascript:;" name="message" title="<?php echo $_html['userid']?>">发消息</a></dd>
			<dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $_html['userid']?>">加为好友</a></dd>
			<dd class="guest">写留言</dd>
			<dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $_html['userid']?>">给他送花</a></dd>
			<dd class="email">邮箱：<a href="mailto:<?php echo $_html['email']?>"><?php echo $_html['email']?></a></dd>
			<dd class="url">网址：<a href="<?php echo $_html['url']?>" target="_blank"><?php echo $_html['url']?></a></dd>
		</dl>
		<div class="content">
			<div class="user">
				<span>1#</span><?php echo $_html['username']?> | 发表于<?php echo $_html['date']?>
			</div>
			<h3>主题：<?php echo $_html['title']?> <img src="images/icon<?php echo $_html['type']?>.gif" alt="icon"></h3>
			<div class="detail">
				<?php echo _ubb($_html['content']);?>
			</div>
			<div class="read">
				阅读量：(<?php echo $_html['readcount']?>) 评论量：(<?php echo $_html['commemtcount']?>)
			</div>
		</div>
	</div>
	<p class="line"></p>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>