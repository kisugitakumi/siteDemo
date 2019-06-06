<?php 
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'member_info');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//取值
if(isset($_GET['id'])){
	//获取数据
	$_rows=_fetch_array("SELECT tg_id,tg_username,tg_sex,tg_face,tg_email,tg_url,tg_qq,tg_level,tg_reg_time,tg_autograph FROM tg_user WHERE tg_id='{$_GET['id']}' LIMIT 1;");
	if($_rows){
		$_html=array();
		$_html['id']=$_rows['tg_id'];
		$_html['username']=$_rows['tg_username'];
		$_html['sex']=$_rows['tg_sex'];
		$_html['face']=$_rows['tg_face'];
		$_html['email']=$_rows['tg_email'];
		$_html['url']=$_rows['tg_url'];
		$_html['qq']=$_rows['tg_qq'];
		$_html['reg_time']=$_rows['tg_reg_time'];
		$_html['autograph']=$_rows['tg_autograph'];
		switch ($_rows['tg_level']) {
			case 0:
				$_html['level']='普通会员';
				break;
			case 1:
				$_html['level']='管理员';
				break;
			default:
				$_html['level']='出错';
		}
		//信息过滤
		$_html=_html($_html);
	}else{
		_alert_back('此用户不存在');
	}
}else{
	_alert_back('非法进入！');
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php';?>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>
<div id="member">
	<div id="member_sidebar">
		<h2>中心导航</h2>
		<dl>
			<dt>个人信息</dt>
			<dd><a href='member_info.php?id=<?php echo $_html['id']?>'>博主信息</a></dd>
		</dl>
		<dl>
			<dt>其他查阅</dt>
			<dd><a href="member_info_article.php?id=<?php echo $_html['id']?>">文章查阅</a></dd>
			<dd><a href="member_info_guest.php?id=<?php echo $_html['id']?>">留言查阅</a></dd>
			<dd><a href="member_info_photo.php?id=<?php echo $_html['id']?>">博主图片</a></dd>
		</dl>
	</div>
	<div id="member_main">
		<h2>博主信息</h2>
		<dl>
			<dd>用户名：<?php echo $_html['username']?></dd>
			<dd>性  别：<?php echo $_html['sex']?></dd>
			<dd>头  像：<?php echo $_html['face']?></dd>
			<dd>电子邮件：<?php echo $_html['email']?></dd>
			<dd>主  页：<?php echo $_html['url']?></dd>
			<dd>Q    Q：<?php echo $_html['qq']?></dd>
			<dd>注册时间：<?php echo $_html['reg_time']?></dd>
			<dd>个人签名：<?php echo _ubb($_html['autograph'])?></dd>
			<dd>身  份：<?php echo $_html['level']?></dd>
		</dl>
	</div>
</div>
<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>