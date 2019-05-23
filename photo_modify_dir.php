<?php 
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'photo_add_dir');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//这张页面必须是管理员登录
_manage_login();
//修改
if ($_GET['action']=='modify') {
	if (!!$_rows=_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")) {
		include 'includes/check.func.php';
		//接收数据
		$_clean=array();
		$_clean['id']=$_POST['id'];
		$_clean['name']=_check_dir_name($_POST['name'],2,20);
		$_clean['type']=$_POST['type'];
		if (!empty($_clean['type'])) {//私密相册
			$_clean['password']=_check_dir_password($_POST['password'],6);
		}
		$_clean['face']=$_POST['face'];
		$_clean['content']=$_POST['content'];
		$_clean=_mysql_string($_clean);
		//修改目录
		if (empty($_clean['type'])) {//公开相册
			_query("UPDATE tg_dir SET
									tg_name='{$_clean['name']}',
									tg_type='{$_clean['type']}',
									tg_password=NULL,
									tg_face='{$_clean['face']}',
									tg_content='{$_clean['content']}'
								  WHERE
								  	tg_id='{$_clean['id']}'
								  LIMIT 1
			;");
		}else{//私密相册
			_query("UPDATE tg_dir SET
									tg_name='{$_clean['name']}',
									tg_type='{$_clean['type']}',
									tg_password='{$_clean['password']}',
									tg_face='{$_clean['face']}',
									tg_content='{$_clean['content']}'
								  WHERE
								  	tg_id='{$_clean['id']}'
								  LIMIT 1
			;");
		}
		if (_affected_rows()) {
			//关闭连接
			_close();
			//成功修改则跳转
			_location('目录修改成功！','photo.php');
		}else{
			_close();
			_alert_back('目录修改失败！');
		}
	}else{
		_alert_back('唯一标识符异常！');
	}
}
//读出数据
if (isset($_GET['id'])) {
	if (!!$_rows=_fetch_array("SELECT tg_id,tg_name,tg_type,tg_face,tg_content FROM tg_dir WHERE tg_id='{$_GET['id']}' LIMIT 1;")) {
		$_html=array();
		$_html['id']=$_rows['tg_id'];
		$_html['name']=$_rows['tg_name'];
		$_html['type']=$_rows['tg_type'];
		$_html['face']=$_rows['tg_face'];
		$_html['content']=$_rows['tg_content'];
		$_html=_html($_html);
	}else{
		_alert_back('不存在此相册');
	}
}else{
	_alert_back('非法操作');
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php'; ?>
<script type="text/javascript" src="js/photo_add_dir.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="photo">
	<h2>修改相册目录</h2>
	<form method="post" action="?action=modify">
	<dl>
		<dd>相册名称：<input type="text" name="name" class="text" value="<?php echo $_html['name']?>"></dd>
		<dd>相册类型：<input type="radio" name="type" value="0" <?php if($_html['type']==0) echo 'checked="checked"'?>>公开<input type="radio" name="type" value="1" <?php if ($_html['type']==1) echo 'checked="checked"'?>>私密</dd>
		<dd id="pass" <?php if($_html['type']==1) echo 'style="display:block;"'?>>相册密码：<input type="password" name="password" class="text"></dd>
		<dd>相册封面：<input name="face" value="<?php echo $_html['face']?>" class="text"></dd>
		<dd>相册描述：<textarea name="content" style="resize: none;"><?php echo $_html['content']?></textarea></dd>
		<dd><input type="submit" class="submit" value="修改目录"></dd>
	</dl>
	<input type="hidden" value="<?php echo $_html['id']?>" name="id">
	</form>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>