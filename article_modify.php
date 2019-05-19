<?php 
//会话控制，开启session
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'article_modify');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//登陆后才可以发表帖子
if (!isset($_COOKIE['username'])) {
	_location('登陆后才可以发表帖子','login.php');
}
//修改帖子数据
//将帖子写入数据库
if ($_GET['action']=='modify') {
	//判断验证码
	_check_code($_POST['code'],$_SESSION['code']);
	//首先判断数据库中是否有这个用户存在
	//为防止cookies伪造，还要比对一下唯一标识符uniqid()
	if (!!$_rows=_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")) {
		_uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
		//开始修改
		include ROOT_PATH.'includes/check.func.php';
		//接收帖子内容
		$_clean=array();
		$_clean['id']=$_POST['id'];
		$_clean['type']=$_POST['type'];
		$_clean['title']=_check_post_title($_POST['title'],2,40);
		$_clean['content']=_check_post_content($_POST['content'],10);
		$_clean=_mysql_string($_clean);
		//执行SQL
		_query("UPDATE tg_article 	SET
										tg_type='{$_clean['type']}',
										tg_title='{$_clean['title']}',
										tg_content='{$_clean['content']}',
										tg_last_modify_date=NOW()
									WHERE
										tg_id='{$_clean['id']}'

			;");
		if (_affected_rows()==1) {
			//关闭连接和session
			_close();
			_session_destroy();
			//成功注册则跳转
			_location('修改成功！','article.php?id='.$_clean['id']);
		}else{
			_close();
			_session_destroy();
			_alert_back('修改失败！');
		}
	}else{
		_alert_back('非法登录！');
	}
}
//读取数据
if (isset($_GET['id'])) {
	if(!!$_rows=_fetch_array("SELECT tg_username,tg_type,tg_content,tg_title FROM tg_article WHERE tg_reid=0 AND tg_id='{$_GET['id']}';")){
			$_html=array();
			$_html['id']=$_GET['id'];
			$_html['username']=$_rows['tg_username'];
			$_html['type']=$_rows['tg_type'];
			$_html['title']=$_rows['tg_title'];
			$_html['content']=$_rows['tg_content'];
			$_html=_html($_html);

			//判断权限
			if ($_COOKIE['username']!=$_html['username']) {
				_alert_back('你没有权限修改此帖子！');
			}
		}else{
			_alert_back('不存在此帖子！');
		}
}else{
	_alert_back('非法操作！');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>多用户留言系统--修改帖子</title>
<?php
	require ROOT_PATH.'includes/title.inc.php';
?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/post.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="post">
	<h2>修改帖子</h2>
	<form method="post" name='post' action="?action=modify">
		<input type="hidden" value="<?php echo $_html['id']?>" name="id">
		<dl>
			<dt>请认真修改下列内容</dt>
			<dd>
				类  型：
				<?php 
				foreach (range(1, 16) as $_num) {
					if ($_num==$_html['type']) {
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
			<dd>标  题：<input type="text" name="title" value="<?php echo $_html['title']?>" class="text">（*必填，2-40字）</dd>
			<dd id="q">贴  图：<a href="javascript:;">Q图系列[1]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;">Q图系列[2]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;">Q图系列[3]</a></dd>
			<dd>
				<?php include ROOT_PATH.'includes/ubb.inc.php'?>
				<textarea name="content" rows="14"><?php echo $_html['content']?></textarea>
			</dd>
			<dd>验 &nbsp;证 码：<input type="text" name="code" class="text yzm"><img src="code.php" id="code"><input type="submit" class="submit" value="修改帖子"></dd>
		</dl>
	</form>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>