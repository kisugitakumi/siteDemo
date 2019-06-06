<?php 
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'member_info_photo');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//取值
if(isset($_GET['id'])){
	//获取数据
	$_rows=_fetch_array("SELECT tg_id,tg_username FROM tg_user WHERE tg_id='{$_GET['id']}' LIMIT 1;");
	if($_rows){
		$_html=array();
		$_html['id']=$_rows['tg_id'];
		$_html['username']=$_rows['tg_username'];
		//信息过滤
		$_html=_html($_html);
	}else{
		_alert_back('此用户不存在');
	}
}else{
	_alert_back('非法进入！');
}
$_percent=0.15;
//分页模块,取出公开相册的图片
global $_pagenum,$_pagesize,$_system,$_id;
$_id='id='.$_html['id'].'&';
_page("SELECT tg_id FROM tg_photo WHERE tg_username='{$_html['username']}' AND tg_sid IN (SELECT tg_id FROM tg_dir WHERE tg_type=0);",$_system['photo']);
$_result=_query("SELECT tg_id,tg_name,tg_url,tg_readcount,tg_commentcount,tg_username FROM tg_photo WHERE tg_username='{$_html['username']}' AND tg_sid IN (SELECT tg_id FROM tg_dir WHERE tg_type=0) ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize");
?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php'; ?>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="photo">
	<h2><?php echo $_html['username']?>的个人图片</h2>
	<?php 
		//游客及会员可以查看博主上传的位于公开相册的图片
		$_htmllist=array();
		while(!!$_rows=_fetch_array_list($_result)){
			$_htmllist['id']=$_rows['tg_id'];
			$_htmllist['username']=$_rows['tg_username'];
			$_htmllist['name']=$_rows['tg_name'];
			$_htmllist['url']=$_rows['tg_url'];
			$_htmllist['readcount']=$_rows['tg_readcount'];
			$_htmllist['commentcount']=$_rows['tg_commentcount'];
			$_htmllist=_html($_htmllist);
	?>
	<dl>
		<dt><a href="photo_detail.php?id=<?php echo $_htmllist['id']?>"><img src="thumb.php?filename=<?php echo $_htmllist['url']?>&percent=<?php echo $_percent?>"></a></dt>
		<dd><a href="photo_detail.php?id=<?php echo $_htmllist['id']?>"><?php echo $_htmllist['name']?></a></dd>
		<dd>阅(<strong><?php echo $_htmllist['readcount']?></strong>) 评(<strong><?php echo $_htmllist['commentcount']?></strong>)</dd>
	</dl>
	<?php }
		_free_result($_result);
		_paging(1);
	?>
	<p><a href="member_info.php?id=<?php echo $_html['id']?>">返回博主信息</a></p>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>