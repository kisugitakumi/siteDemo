<?php 
//会话控制，开启session
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'post');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//登陆后才可以发表帖子
if (!isset($_COOKIE['username'])) {
	_location('登陆后才可以发表帖子','login.php');
}
//判断是否禁言
if(!(_is_forbid())){
	_alert_back("你已被管理员禁言，暂时不能发表文章！");
}
//将帖子写入数据库
if ($_GET['action']=='post') {
	//判断验证码
	_check_code($_POST['code'],$_SESSION['code']);
	//首先判断数据库中是否有这个用户存在
	//为防止cookies伪造，还要比对一下唯一标识符uniqid()
	if (!!$_rows=_fetch_array("SELECT tg_uniqid,tg_post_time FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")) {
		global $_system;
		_uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
		//验证是否在规定的时间外发帖,防止恶意发帖
		_timed(time(),$_rows['tg_post_time'],$_system['post']);
		include ROOT_PATH.'includes/check.func.php';
		//接收帖子内容
		$_clean=array();
		$_clean['username']=$_COOKIE['username'];
		$_clean['type']=$_POST['type'];
		$_clean['title']=_check_post_title($_POST['title'],2,40);
		$_clean['content']=_check_post_content($_POST['content'],0);
		$_clean=_mysql_string($_clean);
		//写入数据库
		_query("INSERT INTO tg_article(
										tg_username,
										tg_title,
										tg_type,
										tg_content,
										tg_date
									)
								VALUES(
										'{$_clean['username']}',
										'{$_clean['title']}',
										'{$_clean['type']}',
										'{$_clean['content']}',
										NOW()
									)	
		;");
		if (_affected_rows()==1) {
			//获取刚刚新增的ID
			$_clean['id']=_insert_id();
			$_clean['time']=time();
			_query("UPDATE tg_user SET tg_post_time='{$_clean['time']}' WHERE tg_username ='{$_COOKIE['username']}';");
			//关闭连接和session
			_close();
			//_session_destroy();
			//成功发表则跳转
			_location('发表成功！','article.php?id='.$_clean['id']);
		}else{
			_close();
			//_session_destroy();
			_alert_back('发表失败！');
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
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
			<dd>标  题：<input type="text" name="title" class="text">（*必填，2-40字）</dd>
			<dd id="q">贴  图：<a href="javascript:;">Q图系列[1]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;">Q图系列[2]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;">Q图系列[3]</a></dd>
			<dd>
				<?php include ROOT_PATH.'includes/ubb.inc.php'?>
				<textarea name="content" rows="14"></textarea>
			</dd>
			<dd>验 &nbsp;证 码：<input type="text" name="code" class="text yzm"><img src="code.php" id="code"><input type="submit" class="submit" value="发表帖子"></dd>
		</dl>
	</form>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>