<?php 
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'article');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//必须是管理员才能登陆
_manage_login();
//读出数据
if (isset($_GET['id'])) {
	//提取出数据库中的帖子ID
	if(!!$_rows=_fetch_array("SELECT tg_id,tg_username,tg_type,tg_content,tg_title,tg_readcount,tg_commentcount,tg_date,tg_last_modify_date,tg_nice,tg_hot FROM tg_article WHERE tg_reid=0 AND tg_id='{$_GET['id']}';")){
		//累积阅读量
		$_html=array();
		$_html['reid']=$_rows['tg_id'];
		$_html['username_subject']=$_rows['tg_username'];
		$_html['type']=$_rows['tg_type'];
		$_html['title']=$_rows['tg_title'];
		$_html['content']=$_rows['tg_content'];
		$_html['readcount']=$_rows['tg_readcount'];
		$_html['commemtcount']=$_rows['tg_commentcount'];
		$_html['nice']=$_rows['tg_nice'];
		$_html['hot']=$_rows['tg_hot'];
		$_html['date']=$_rows['tg_date'];
		$_html['last_modify_date']=$_rows['tg_last_modify_date'];
		//拿出用户名查找发表帖子的用户信息
		if(!!$_rows=_fetch_array("SELECT tg_id,tg_sex,tg_face,tg_email,tg_url,tg_switch,tg_autograph FROM tg_user WHERE tg_username='{$_html['username_subject']}';")){
			$_html['userid']=$_rows['tg_id'];
			$_html['sex']=$_rows['tg_sex'];
			$_html['face']=$_rows['tg_face'];
			$_html['email']=$_rows['tg_email'];
			$_html['url']=$_rows['tg_url'];
			$_html['switch']=$_rows['tg_switch'];
			$_html['autograph']=$_rows['tg_autograph'];
			$_html=_html($_html);

			//个性签名
			if ($_html['switch']==1) {
				$_html['autograph_html']='<p class="autograph">'.$_html['autograph'].'</p>';
			}
			
			//读取回帖
			global $_pagenum,$_pagesize,$_page;
			_page("SELECT tg_id FROM tg_article WHERE tg_reid='{$_html['reid']}';",6);
			//从数据库提取数据获取结果集
			//每次从新取结果集，而不是从新执行SQL语句
			$_result=_query("SELECT tg_username,tg_type,tg_title,tg_content,tg_date FROM tg_article WHERE tg_reid='{$_html['reid']}' ORDER BY tg_date ASC LIMIT $_pagenum,$_pagesize");

		}
	}else{
		_alert_back('不存在这个主题！');
	}
}else{
	_alert_back('非法操作');
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php'; ?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/article.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="article">
	<h2>帖子详情</h2>
	
	<?php 
		if ($_page==1) {
	?>
	<div id="subject">
		<dl>
			<dd class="user"><a href="member_info.php?id=<?php echo $_html['userid']?>" name="info" class="info" target="_blank"><?php echo $_html['username_subject']?>(<?php echo $_html['sex']?>)[楼主]</a></dd>
			<dt><img src="<?php echo $_html['face']?>" alt="<?php echo $_html['username_subject']?>"></dt>
			<dd class="message"><a href="javascript:;" name="message" title="<?php echo $_html['userid']?>">发消息</a></dd>
			<dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $_html['userid']?>">加为好友</a></dd>
			<dd class="guest"><a href="javascript:;" name="guest" title="<?php echo $_html['userid']?>">写留言</a></dd>
			<dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $_html['userid']?>">给他送花</a></dd>
			<dd class="email">邮箱：<a href="mailto:<?php echo $_html['email']?>"><?php echo $_html['email']?></a></dd>
			<dd class="url">网址：<a href="<?php echo $_html['url']?>" target="_blank"><?php echo $_html['url']?></a></dd>
		</dl>
		<div class="content">
			<div class="user">
				<span><?php if(isset($_SESSION['admin'])){?>
					<?php }?><?php echo $_html['username_modify']?> 1#</span><?php echo $_html['username_subject']?> | 发表于<?php echo $_html['date']?>
			</div>
			<h3>主题：<?php echo $_html['title']?> <img src="images/icon<?php echo $_html['type']?>.gif" alt="icon"><?php echo $_html['re']?></h3>
			<div class="detail">
				<?php echo _ubb($_html['content']);?>
				<?php echo _ubb($_html['autograph_html']);?>
			</div>
			<div class="read">
				<p><?php echo $_html['last_modify_date_string']?></p>
				阅读量：(<?php echo $_html['readcount']?>) 评论量：(<?php echo $_html['commemtcount']?>)
			</div>
		</div>
	</div>
	<?php }?>
	<p class="line"></p>
	<?php
		$_i=2;
		while(!!$_rows=_fetch_array_list($_result)){
			$_html['username']=$_rows['tg_username'];
			$_html['retitle']=$_rows['tg_title'];
			$_html['type']=$_rows['tg_type'];
			$_html['content']=$_rows['tg_content'];
			$_html['date']=$_rows['tg_date'];
			$_html=_html($_html);
			
			if(!!$_rows=_fetch_array("SELECT tg_id,tg_sex,tg_face,tg_email,tg_url,tg_switch,tg_autograph FROM tg_user WHERE tg_username='{$_html['username']}';")){
				//提取用户信息
				$_html['userid']=$_rows['tg_id'];
				$_html['sex']=$_rows['tg_sex'];
				$_html['face']=$_rows['tg_face'];
				$_html['email']=$_rows['tg_email'];
				$_html['url']=$_rows['tg_url'];
				$_html['switch']=$_rows['tg_switch'];
				$_html['autograph']=$_rows['tg_autograph'];
				$_html=_html($_html);
				//楼层显示
				if ($_page==1 && $_i==2) {
					if ($_html['username']==$_html['username_subject']) {
						$_html['username_html']=$_html['username'].'[楼主]';
					}else{
						$_html['username_html']=$_html['username'].'[沙发]';
					}
				}else{
					$_html['username_html']=$_html['username'];
				}
				
			}else{
				//这个用户可能已被删除
			}
			//跟帖回复
			if ($_COOKIE['username']) {
				$_html['re']='<span>[<a href="#ree" name="re" title="回复'.($_i+(($_page-1)*$_pagesize)).'楼的'.$_html['username'].'">回复</a>]</span>';
			}
	?>
	<p class="line"></p>
	<?php 
		$_i++;
	}
		_free_result($_result);
		_paging(1);
	?>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>