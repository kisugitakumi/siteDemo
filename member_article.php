<?php
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'member_article');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//判断是否登录
if (!isset($_COOKIE['username'])) {
	_alert_back('请登录！');
}
//删除文章
if ($_GET['action']=='del' && isset($_GET['id'])) {
	if (!!$_rows=_fetch_array("SELECT tg_id FROM tg_article WHERE tg_id='{$_GET['id']}' LIMIT 1;")) {
		if (!!$_rows=_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")) {
			_uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
			//先删除回复这篇文章的评论
			_query("DELETE FROM tg_article WHERE tg_reid='{$_GET['id']}';");
			//再删除这篇文章
			_query("DELETE FROM tg_article WHERE tg_id='{$_GET['id']}';");
			if (_affected_rows()>=1) {
				//关闭连接
				_close();
				//成功删除则跳转
				_location('删除成功!','member_article.php');
			}else{
				_close();
				_alert_back('删除失败!');
			}
		}else{
			_alert_back('唯一标识符异常');
		}
	}else{
		_alert_back('不存在此文章');
	}
}
//分页模块
//第一个参数获取总用户数，第二个参数指定每页的用户数量
global $_pagenum,$_pagesize;
_page("SELECT tg_id FROM tg_article WHERE tg_username='{$_COOKIE['username']}' AND tg_reid=0;",5);
//从数据库提取数据获取结果集
//每次从新取结果集，而不是从新执行SQL语句
$_result=_query("SELECT tg_id,tg_reid,tg_state,tg_title,tg_content,tg_date,tg_readcount,tg_commentcount FROM tg_article WHERE tg_username='{$_COOKIE['username']}' AND tg_reid=0 ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize;");
?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php';?>
<script type="text/javascript" src="js/confirm.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>
<div id="member">
<?php require 'includes/member.inc.php'; ?>
	<div id="member_main">
		<h2>文章管理中心</h2>
		<form method="post" action="?action=delete">
		<table cellspacing="1">
			<tr><th>文章标题</th><th>文章内容</th><th>评论<th>阅读</th><th>发表时间</th><th>操作</th><th>状态</th></tr>
			<?php
				$_html=array();
				 while(!!$_rows=_fetch_array_list($_result)){
					$_html['id']=$_rows['tg_id'];
					$_html['title']=$_rows['tg_title'];
					$_html['date']=$_rows['tg_date'];
					$_html['reid']=$_rows['tg_reid'];
					$_html['content']=$_rows['tg_content'];
					$_html['readcount']=$_rows['tg_readcount'];
					$_html['commentcount']=$_rows['tg_commentcount'];
					$_html['state']=$_rows['tg_state'];
					$_html=_html($_html);
					if (empty($_html['state'])) {
						$_html['state_html']='<span style="color:blue;">审核中</span>';
						$_html['title_html']=_title($_html['title'],8);
						$_html['content_html']=_title($_html['content'],14);
						$_html['do_html']='无法操作';
						$_html['commentcount_html']='无';
						$_html['readcount_html']='无';
					}elseif($_html['state']==1){
						$_html['state_html']='<span style="color:green;">审核通过</span>';
						$_html['title_html']='<a href="article.php?id='.$_html['id'].'" title="'.$_html['title'].'">'._title($_html['title'],8).'</a>';
						$_html['content_html']='<a href="article.php?id='.$_html['id'].'" title="'.$_html['content'].'">'._title($_html['content'],14).'</a>';
						$_html['do_html']='[<a onclick="return check_del();" href="member_article.php?action=del&id='.$_html['id'].'">删</a>] [<a href="article.php?id='.$_html['id'].'">改</a>]';
						$_html['commentcount_html']=$_html['commentcount'];
						$_html['readcount_html']=$_html['readcount'];
					}elseif($_html['state']==2){
						$_html['state_html']='<span style="color:red;">被驳回</span>';
						$_html['title_html']=_title($_html['title'],8);
						$_html['content_html']=_title($_html['content'],14);
						$_html['do_html']='无法操作';
						$_html['commentcount_html']='无';
						$_html['readcount_html']='无';
					}
			?>
			<tr><td><?php echo $_html['title_html']?></td><td><?php echo $_html['content_html']?></td><td><?php echo $_html['commentcount_html']?></td><td><?php echo $_html['readcount_html']?></td><td><?php echo $_html['date']?></td><td><?php echo $_html['do_html']?></td><td><?php echo $_html['state_html']?></td></tr>
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