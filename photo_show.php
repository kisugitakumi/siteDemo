<?php 
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'photo_show');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
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
			if ($_rows['tg_username']==$_COOKIE['username'] || isset($_SESSION['admin'])) {
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
					_location('图片删除成功！','photo_show.php?id='.$_html['sid']);
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
//取值
if (isset($_GET['id'])) {
	//增加浏览历史
	if (isset($_COOKIE['username'])) {
		_query("INSERT INTO tg_photo_history(
									tg_username,
									tg_dir_id,
									tg_date
									)
									VAlUES(
									'{$_COOKIE['username']}',
									'{$_GET['id']}',
									NOW()
									)");
	}else{//游客
		_query("INSERT INTO tg_photo_history(
									tg_username,
									tg_dir_id,
									tg_date
									)
									VAlUES(
									'游客',
									'{$_GET['id']}',
									NOW()
									)");
	}
	if(!!$_rows=_fetch_array("SELECT tg_id,tg_name,tg_type FROM tg_dir WHERE tg_id='{$_GET['id']}' LIMIT 1;")){
		$_dirhtml=array();
		$_dirhtml['id']=$_rows['tg_id'];
		$_dirhtml['name']=$_rows['tg_name'];
		$_dirhtml['type']=$_rows['tg_type'];
		//对比加密相册的验证信息(密码)
		if ($_POST['password']) {
			if(!!$_rows=_fetch_array("SELECT tg_id FROM tg_dir WHERE tg_password='".sha1($_POST['password'])."' LIMIT 1;")){
				//验证通过,生成cookies
				setcookie('photo'.$_dirhtml['id'],$_dirhtml['name']);
				//重定向
				_location(null,'photo_show.php?id='.$_dirhtml['id']);
			}else{
				_alert_back('相册密码不正确！');
			}
		}
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
$_result=_query("SELECT tg_id,tg_username,tg_name,tg_url,tg_readcount,tg_commentcount FROM tg_photo WHERE tg_sid='{$_dirhtml['id']}' ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize");
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
		//如果相册类型是私密的，或者COOKIE验证通过，或者是管理员进入，则判断
		if (empty($_dirhtml['type']) || $_COOKIE['photo'.$_dirhtml['id']]==$_dirhtml['name'] || isset($_SESSION['admin'])) {
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
		<dd>阅(<strong><?php echo $_html['readcount']?></strong>) 评(<strong><?php echo $_html['commentcount']?></strong>) 上传者：<?php echo $_html['username']?></dd>
		<?php
			if ($_html['username']==$_COOKIE['username'] || isset($_SESSION['admin'])) {
		?>
		<dd>[<a href="photo_show.php?action=delete&id=<?php echo $_html['id']?>">删除</a>]</dd>
		<?php }?>
	</dl>
	<?php }
		_free_result($_result);
		_paging(1);
	?>
	<p><a href="photo_add_img.php?id=<?php echo $_dirhtml['id']?>">上传图片</a></p>
	<?php 
		}else{
			echo '<form method="post" action="photo_show.php?id='.$_dirhtml['id'].'">';
			echo '<p>请输入密码:<input type="password" name="password"><input type="submit" value="提交密码"></p>';
			echo '</form>';
		}
	?>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>