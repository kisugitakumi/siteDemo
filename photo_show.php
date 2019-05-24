<?php 
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'photo_show');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//取值
if (isset($_GET['id'])) {
	if(!!$_rows=_fetch_array("SELECT tg_id,tg_name FROM tg_dir WHERE tg_id='{$_GET['id']}' LIMIT 1;")){
		$_dirhtml=array();
		$_dirhtml['id']=$_rows['tg_id'];
		$_dirhtml['name']=$_rows['tg_name'];
		$_dirhtml=_html($_dirhtml);
	}else{
		_alert_back('不存在此相册目录！');
	}
}else{
	_alert_back('非法操作！');
}
$_percent=0.15;
//分页模块
global $_pagenum,$_pagesize,$_system,$_id;
$_id='id='.$_dirhtml['id'].'&';
_page("SELECT tg_id FROM tg_photo WHERE tg_sid='{$_dirhtml['id']}';",$_system['photo']);
$_result=_query("SELECT tg_id,tg_username,tg_name,tg_url FROM tg_photo WHERE tg_sid='{$_dirhtml['id']}' ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize");
?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php'; ?>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="photo">
	<h2><?php echo $_dirhtml['name']?></h2>
	<?php 
		$_html=array();
		while(!!$_rows=_fetch_array_list($_result)){
			$_html['id']=$_rows['tg_id'];
			$_html['username']=$_rows['tg_username'];
			$_html['name']=$_rows['tg_name'];
			$_html['url']=$_rows['tg_url'];
			$_html=_html($_html);
	?>
	<dl>
		<dt><a href="photo_detail.php?id=<?php echo $_html['id']?>"><img src="thumb.php?filename=<?php echo $_html['url']?>&percent=<?php echo $_percent?>"></a></dt>
		<dd><a href="photo_detail.php?id=<?php echo $_html['id']?>"><?php echo $_html['name']?></a></dd>
		<dd>阅(<strong>0</strong>) 评(<strong>0</strong>) 上传者：<?php echo $_html['username']?></dd>
	</dl>
	<?php }
		_free_result($_result);
		_paging(1);
	?>
	<p><a href="photo_add_img.php?id=<?php echo $_dirhtml['id']?>">上传图片</a></p>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>