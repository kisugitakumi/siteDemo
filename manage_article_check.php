<?php
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'manage_article');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//必须是管理员才能登陆
_manage_login();
//判断是否登录
if (!isset($_COOKIE['username'])) {
	_alert_back('请登录！');
}
//驳回文章
if ($_GET['action']=='nopass' && isset($_GET['id'])) {
	if (!!$_rows=_fetch_array("SELECT tg_id FROM tg_article WHERE tg_id='{$_GET['id']}' LIMIT 1;")) {
		//先验证用户唯一标识符
		if (!!$_rows=_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")) {
			_uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
			//通过文章
			_query("UPDATE tg_article SET tg_state=2 WHERE tg_id='{$_GET['id']}'");
			if (_affected_rows()>=1) {
				//关闭连接
				_close();
				//成功则跳转
				_location('驳回成功!','manage_article_check.php');
			}else{
				_close();
				_alert_back('驳回失败!');
			}
		}else{
			_alert_back('唯一标识符异常');
		}
	}else{
		_alert_back('不存在此文章');
	}
}
//通过文章
if ($_GET['action']=='pass' && isset($_GET['id'])) {
	if (!!$_rows=_fetch_array("SELECT tg_id FROM tg_article WHERE tg_id='{$_GET['id']}' LIMIT 1;")) {
		//先验证用户唯一标识符
		if (!!$_rows=_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")) {
			_uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
			//通过文章
			_query("UPDATE tg_article SET tg_state=1 WHERE tg_id='{$_GET['id']}'");
			if (_affected_rows()>=1) {
				//关闭连接
				_close();
				//成功则跳转
				_location('通过成功!','manage_article_check.php');
			}else{
				_close();
				_alert_back('通过失败!');
			}
		}else{
			_alert_back('唯一标识符异常');
		}
	}else{
		_alert_back('不存在此文章');
	}
}
//分页模块
global $_pagenum,$_pagesize;
_page("SELECT tg_id FROM tg_article WHERE tg_reid=0 AND tg_state=0;",8);
//从数据库提取数据获取结果集
//每次从新取结果集，而不是从新执行SQL语句
$_result=_query("SELECT tg_id,tg_reid,tg_title,tg_content,tg_date,tg_username FROM tg_article WHERE tg_reid=0 AND tg_state=0 ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize;");
?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php';?>
<script type="text/javascript" src="js/member_message.js"></script>
<script type="text/javascript" src="js/confirm.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>
<div id="member">
<?php require 'includes/manage.inc.php'; ?>
	<div id="member_main">
		<h2>文章管理中心</h2>
		<form method="post" action="?action=delete">
		<table cellspacing="1">
			<tr><th>文章标题</th><th>文章内容</th><th>博主</th><th>发表时间</th><th>操作</th></tr>
			<?php
				$_html=array();
				 while(!!$_rows=_fetch_array_list($_result)){
					$_html['id']=$_rows['tg_id'];
					$_html['title']=$_rows['tg_title'];
					$_html['date']=$_rows['tg_date'];
					$_html['reid']=$_rows['tg_reid'];
					$_html['content']=$_rows['tg_content'];
					$_html['username']=$_rows['tg_username'];
					$_html=_html($_html);
			?>
			<tr><td><a href="manage_article_check_detail.php?id=<?php echo $_html['id']?>" title="<?php echo $_html['title']?>"><?php echo _title($_html['title'],8)?></a></td><td><a href="manage_article_check_detail.php?id=<?php echo $_html['id']?>" title="<?php echo $_html['content']?>"><?php echo _title($_html['content'],14)?></a></td><td><?php echo $_html['username']?></td><td><?php echo $_html['date']?></td><td>[<a onclick="return check_ret();" href="manage_article_check.php?action=nopass&id=<?php echo $_html['id']?>">驳回</a>][<a href="manage_article_check.php?action=pass&id=<?php echo $_html['id']?>">通过</a>]</td></tr>
			<?php 
				}
				_free_result($_result);
			?>
		</table>
		</form>
		<?php
			//调用分页函数，1表示数字分页，2表示文本分页
			_paging(2);
		?>
	</div>
</div>
<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>