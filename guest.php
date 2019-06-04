<?php
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'guest');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//判断是否登录
if (!isset($_COOKIE['username'])) {
	_alert_close('请登录后再留言！');
}

//写留言
if ($_GET['action']=='write' && isset($_GET['id'])) {
	_check_code($_POST['code'],$_SESSION['code']);
	if (!!$_rows=_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")) {
		_uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
		include ROOT_PATH.'includes/check.func.php';
		$_clean=array();
		$_clean['touser']=$_POST['touser'];
		$_clean['fromuser']=$_COOKIE['username'];
		$_clean['content']=_check_content($_POST['content']);
		$_clean=_mysql_string($_clean);
		//写入数据库
		_query("INSERT INTO tg_guest (
							tg_touser,
							tg_fromuser,
							tg_content,
							tg_date
						)
						VALUES(
							'{$_clean['touser']}',
							'{$_clean['fromuser']}',
							'{$_clean['content']}',
							NOW()
						);
		");
		//新增成功
		if (_affected_rows()==1) {
			//关闭连接
			_close();
			_location('留言发送成功！','guest.php?id='.$_GET['id']);
		}else{
			_close();
			_alert_back('留言发送失败！');
		}
	}else{
		_alert_close('非法操作！');
	}
}
//获取用户数据
if (isset($_GET['id'])) {
	if(!!$_rows=_fetch_array("SELECT tg_username FROM tg_user WHERE tg_id={$_GET['id']} LIMIT 1;")){
		$_html=array();
		$_html['id']=$_GET['id'];
		$_html['touser']=$_rows['tg_username'];
	}else{
		_alert_close('不存在此用户');
	}
}else{
	_alert_close('非法操作');
}
//读取留言
global $_pagenum,$_pagesize;
global $_id;
$_id='id='.$_GET['id'].'&';
_page("SELECT tg_id FROM tg_guest WHERE tg_touser='{$_html['touser']}';",5);
$_result=_query("SELECT tg_id,tg_touser,tg_fromuser,tg_content FROM tg_guest WHERE tg_touser='{$_html['touser']}' ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize");
?>

<!DOCTYPE html>
<html>
<head>
	<?php require ROOT_PATH.'includes/title.inc.php'; ?>
	<script type="text/javascript" src="js/code.js"></script>
	<script type="text/javascript" src="js/message.js"></script>
</head>
<body>
<div id="message">
	<h3>写留言</h3>
	<div id="content">
		<dl>
			<?php
			while(!!$_rows=_fetch_array_list($_result)){
				$_htmllist=array();
				$_htmllist['fromuser']=$_rows['tg_fromuser'];
				$_htmllist['content']=$_rows['tg_content'];
				$_htmllist=_html($_htmllist);
				echo '<dd>'.$_htmllist['fromuser'].'留言：'.$_htmllist['content'].'</dd>';
			}
			_free_result($_result);
			?>
		</dl>
		<?php _paging(2);?>
	</div>
	<p class="line"></p>
	<div id="write">
		<form method="post" action="?action=write&id=<?php echo $_html['id']?>">
		<input type="hidden" name="touser" value="<?php echo $_html['touser']?>">
		<dl>
			<dd><input type="text" readonly="readonly" value="给<?php echo $_html['touser']?>留言：" class="text"></dd>
			<dd><textarea name="content" style="resize: none;"></textarea></dd>
			<dd>验 &nbsp;证 码：<input type="text" name="code" class="text yzm"><img src="code.php" id="code"><input type="submit" class="submit" value="发送留言"></dd>
		</dl>
		</form>
	</div>
</div>
</body>
</html>