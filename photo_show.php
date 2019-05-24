<?php 
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'photo_show');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//取值
if (isset($_GET['id'])) {
	if(!!$_rows=_fetch_array("SELECT tg_id FROM tg_dir WHERE tg_id='{$_GET['id']}' LIMIT 1;")){
		$_html=array();
		$_html['id']=$_rows['tg_id'];
		$_html=_html($_html);
	}else{
		_alert_back('不存在此相册目录！');
	}
}else{
	_alert_back('非法操作！');
}
$_filename='photo/1558523056/1558661937.jpg';
$_percent=0.3;
?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php'; ?>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="photo">
	<h2>图片展示</h2>
	<img src="thumb.php?filename=<?php echo $_filename?>&percent=<?php echo $_percent?>">
	<p><a href="photo_add_img.php?id=<?php echo $_html['id']?>">上传图片</a></p>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>