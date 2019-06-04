<?php 
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'photo_show');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//判断是否登录
if (!isset($_COOKIE['username'])) {
	_alert_back('请登录！');
}
//删除图片
if ($_GET['action']=='delete' && isset($_GET['id'])) {
	if (!!$_rows=_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")) {
		_uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
		//取得图片的发布者
		if (!!$_rows=_fetch_array("SELECT tg_username,tg_url,tg_id,tg_sid FROM tg_photo WHERE tg_id='{$_GET['id']}' LIMIT 1;")) {
			$_html=array();
			$_html['id']=$_rows['tg_id'];
			$_html['sid']=$_rows['tg_sid'];
			$_html['username']=$_rows['tg_username'];
			$_html['url']=$_rows['tg_url'];
			$_html=_html($_html);

			//判断删除图片的用户是否合法
			if ($_rows['tg_username']==$_COOKIE['username']) {
				//首先删除图片的数据库信息
				_query("DELETE FROM tg_photo WHERE tg_id='{$_html['id']}';");
				if (_affected_rows()==1) {
					//再删除图片物理地址
					if (file_exists($_html['url'])) {
						unlink($_html['url']);
					}else{
						_alert_back('磁盘里已不存在此图片');
					}
					_close();
					_location('图片删除成功！','member_photo.php');
				}else{
					_close();
					_alert_back('图片删除失败！');
				}
			}else{
				_alert_back('非法操作');
			}
		}else{
			_alert_back('不存在此图片');
		}
	}else{
		_alert_back('非法登录');
	}
}
$_percent=0.15;
//分页模块
global $_pagenum,$_pagesize,$_system,$_id;
_page("SELECT tg_id FROM tg_photo WHERE tg_username='{$_COOKIE['username']}';",$_system['photo']);
$_result=_query("SELECT tg_id,tg_name,tg_url,tg_readcount,tg_commentcount,tg_username FROM tg_photo WHERE tg_username='{$_COOKIE['username']}' ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize");
?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php'; ?>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="photo">
	<h2><?php echo $_COOKIE['username']?>的个人图片</h2>
	<?php 
		//会员可以查看自己上传的图片
		$_html=array();
		while(!!$_rows=_fetch_array_list($_result)){
			$_html['id']=$_rows['tg_id'];
			$_html['username']=$_rows['tg_username'];
			$_html['name']=$_rows['tg_name'];
			$_html['url']=$_rows['tg_url'];
			$_html['readcount']=$_rows['tg_readcount'];
			$_html['commentcount']=$_rows['tg_commentcount'];
			$_html=_html($_html);
	?>
	<dl>
		<dt><a href="photo_detail.php?id=<?php echo $_html['id']?>"><img src="thumb.php?filename=<?php echo $_html['url']?>&percent=<?php echo $_percent?>"></a></dt>
		<dd><a href="photo_detail.php?id=<?php echo $_html['id']?>"><?php echo $_html['name']?></a></dd>
		<dd>阅(<strong><?php echo $_html['readcount']?></strong>) 评(<strong><?php echo $_html['commentcount']?></strong>)</dd>
		<?php
			if ($_html['username']==$_COOKIE['username']) {
		?>
		<dd>[<a href="member_photo.php?action=delete&id=<?php echo $_html['id']?>">删除</a>]</dd>
		<?php }?>
	</dl>
	<?php }
		_free_result($_result);
		_paging(1);
	?>
	<p><a href="member.php">返回个人中心</a></p>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>