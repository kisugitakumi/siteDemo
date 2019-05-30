<?php 
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'article');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//处理精华帖
if ($_GET['action']=='nice' && isset($_GET['id']) && isset($_GET['on'])) {
	if (!!$_rows=_fetch_array("SELECT tg_uniqid,tg_article_time FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")) {
		_uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
		//设置精华帖,或者取消精华帖
		_query("UPDATE tg_article SET tg_nice='{$_GET['on']}' WHERE tg_id='{$_GET['id']}';");
		if (_affected_rows()==1) {
			_close();
			_location('精华帖操作成功！','article.php?id='.$_GET['id']);
		}else{
			_close();
			_alert_back('精华帖操作失败！');
		}
	}else{
		_alert_back('非法登录');
	}
}
//接收回帖
if ($_GET['action']=='rearticle') {
	global $_system;
	//判断验证码
	if(!empty($_system['code'])){
		_check_code($_POST['code'],$_SESSION['code']);
	}
	//首先判断数据库中是否有这个用户存在
	//为防止cookies伪造，还要比对一下唯一标识符uniqid()
	if (!!$_rows=_fetch_array("SELECT tg_uniqid,tg_article_time FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")) {
		_uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
		_timed(time(),$_rows['tg_article_time'],$_system['re']);
		//接收数据
		$_clean=array();
		$_clean['reid']=$_POST['reid'];
		$_clean['type']=$_POST['type'];
		$_clean['title']=$_POST['title'];
		$_clean['content']=$_POST['content'];
		$_clean['username']=$_COOKIE['username'];
		$_clean=_mysql_string($_clean);
		//写入数据库
		_query("INSERT INTO tg_article(
										tg_reid,
										tg_username,
										tg_title,
										tg_type,
										tg_content,
										tg_date
									) 
									VAlUES(
										'{$_clean['reid']}',
										'{$_clean['username']}',
										'{$_clean['title']}',
										'{$_clean['type']}',
										'{$_clean['content']}',
										NOW()
		);");
		if (_affected_rows()==1) {
			//setcookie('article_time',time());
			$_clean['time']=time();
			_query("UPDATE tg_user SET tg_article_time='{$_clean['time']}' WHERE tg_username ='{$_COOKIE['username']}';");
			//每增加一条回帖，回复数就加一
			_query("UPDATE tg_article SET tg_commentcount=tg_commentcount+1 WHERE tg_reid=0 AND tg_id='{$_clean['reid']}';");
			//关闭连接和session
			_close();
			//_session_destroy();
			//成功注册则跳转
			_location('回帖成功！','article.php?id='.$_clean['reid']);
		}else{
			_close();
			//_session_destroy();
			_alert_back('回帖失败！');
		}
	}else{
		_alert_back('唯一标识符异常！');
	}
}
//读出数据
if (isset($_GET['id'])) {
	//提取出数据库中的帖子ID
	if(!!$_rows=_fetch_array("SELECT tg_id,tg_username,tg_type,tg_content,tg_title,tg_readcount,tg_commentcount,tg_date,tg_last_modify_date,tg_nice FROM tg_article WHERE tg_reid=0 AND tg_id='{$_GET['id']}';")){
		//累积阅读量
		_query("UPDATE tg_article SET tg_readcount=tg_readcount+1 WHERE tg_id='{$_GET['id']}';");
		$_html=array();
		$_html['reid']=$_rows['tg_id'];
		$_html['username_subject']=$_rows['tg_username'];
		$_html['type']=$_rows['tg_type'];
		$_html['title']=$_rows['tg_title'];
		$_html['content']=$_rows['tg_content'];
		$_html['readcount']=$_rows['tg_readcount'];
		$_html['commemtcount']=$_rows['tg_commentcount'];
		$_html['nice']=$_rows['tg_nice'];
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
			
			//创建一个全局变量，做带参数的分页
			global $_id;
			$_id='id='.$_html['reid'].'&';

			//主题帖子修改
			if ($_html['username_subject']==$_COOKIE['username'] || isset($_SESSION['admin'])) {
				$_html['username_modify']='[<a href="article_modify.php?id='.$_html['reid'].'">修改</a>]';
			}

			//读取最后修改时间,没有修改的不用显示
			if ($_html['last_modify_date']!='0000-00-00 00:00:00') {
				$_html['last_modify_date_string']='本帖已由['.$_html['username_subject'].']于'.$_html['last_modify_date'].'最后修改';
			}

			//给楼主回复
			if ($_COOKIE['username']) {
				$_html['re']='<span>[<a href="#ree" name="re" title="回复1楼的'.$_html['username_subject'].'">回复</a>]</span>';
			}

			//个性签名
			if ($_html['switch']==1) {
				$_html['autograph_html']='<p class="autograph">'.$_html['autograph'].'</p>';
			}
			//读取回帖
			global $_pagenum,$_pagesize,$_page;
			_page("SELECT tg_id FROM tg_article WHERE tg_reid='{$_html['reid']}';",2);
			//从数据库提取数据获取结果集
			//每次从新取结果集，而不是从新执行SQL语句
			$_result=_query("SELECT tg_username,tg_type,tg_title,tg_content,tg_date FROM tg_article WHERE tg_reid='{$_html['reid']}' ORDER BY tg_date ASC LIMIT $_pagenum,$_pagesize");

		}else{
			//这个用户已被删除（未完善）
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

	<?php if(!empty($_html['nice'])){?>
	<img src="images/nice.gif" alt="精华帖" class="nice">
	<?php }?>

	<?php
		//浏览量到达200，评论量达到10即可为热帖 
		if($_html['readcount']>=200 && $_html['commemtcount']>=10){?>
		<img src="images/hot.gif" alt="热帖" class="hot">
	<?php }?>
	
	<?php 
		if ($_page==1) {
	?>
	<div id="subject">
		<dl>
			<dd class="user"><?php echo $_html['username_subject']?>(<?php echo $_html['sex']?>)[楼主]</dd>
			<dt><img src="<?php echo $_html['face']?>" alt="<?php echo $_html['username_subject']?>"></dt>
			<dd class="message"><a href="javascript:;" name="message" title="<?php echo $_html['userid']?>">发消息</a></dd>
			<dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $_html['userid']?>">加为好友</a></dd>
			<dd class="guest">写留言</dd>
			<dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $_html['userid']?>">给他送花</a></dd>
			<dd class="email">邮箱：<a href="mailto:<?php echo $_html['email']?>"><?php echo $_html['email']?></a></dd>
			<dd class="url">网址：<a href="<?php echo $_html['url']?>" target="_blank"><?php echo $_html['url']?></a></dd>
		</dl>
		<div class="content">
			<div class="user">
				<span><?php if(isset($_SESSION['admin'])){?>
					<?php if(empty($_html['nice'])){?>[<a href="article.php?action=nice&on=1&id=<?php echo $_html['reid']?>">设置精华帖</a>]<?php }else{?>
					[<a href="article.php?action=nice&on=0&id=<?php echo $_html['reid']?>">取消精华帖</a>]
				<?php }?><?php }?><?php echo $_html['username_modify']?> 1#</span><?php echo $_html['username_subject']?> | 发表于<?php echo $_html['date']?>
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
	<div class="re">
		<dl>
			<dd class="user"><?php echo $_html['username_html']?>(<?php echo $_html['sex']?>)</dd>
			<dt><img src="<?php echo $_html['face']?>" alt="<?php echo $_html['username']?>"></dt>
			<dd class="message"><a href="javascript:;" name="message" title="<?php echo $_html['userid']?>">发消息</a></dd>
			<dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $_html['userid']?>">加为好友</a></dd>
			<dd class="guest">写留言</dd>
			<dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $_html['userid']?>">给他送花</a></dd>
			<dd class="email">邮箱：<a href="mailto:<?php echo $_html['email']?>"><?php echo $_html['email']?></a></dd>
			<dd class="url">网址：<a href="<?php echo $_html['url']?>" target="_blank"><?php echo $_html['url']?></a></dd>
		</dl>
		<div class="content">
			<div class="user">
				<span><?php echo $_i+(($_page-1)*$_pagesize);?>#</span><?php echo $_html['username']?> | 发表于<?php echo $_html['date']?>
			</div>
			<h3>主题：<?php echo $_html['retitle']?> <img src="images/icon<?php echo $_html['type']?>.gif" alt="icon"><?php echo $_html['re']?></h3>
			<div class="detail">
				<?php echo _ubb($_html['content'])?>
				<?php 
					//回帖中的个性签名
					if ($_html['switch']==1) {
						echo '<p class="autograph">'._ubb($_html['autograph']).'</p>';
					}
				?>
			</div>
			<div class="read">
				阅读量：(<?php echo $_html['readcount']?>) 评论量：(<?php echo $_html['commemtcount']?>)
			</div>
		</div>
	</div>
	<p class="line"></p>
	<?php 
		$_i++;
	}
		_free_result($_result);
		_paging(1);
	?>
	<?php 
		if (isset($_COOKIE['username'])) {
	?>
	<a name="ree"></a>
	<form method="post" action="?action=rearticle">
		<input type="hidden" name="reid" value="<?php echo $_html['reid']?>">
		<input type="hidden" name="type" value="<?php echo $_html['type']?>">
		<dl>
			<dd>标  题：<input type="text" name="title" class="text" value="RE:<?php echo $_html['title']?>" readonly="readonly">（*必填，2-40字）</dd>
			<dd id="q">贴  图：<a href="javascript:;">Q图系列[1]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;">Q图系列[2]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;">Q图系列[3]</a></dd>
			<dd>
				<?php include ROOT_PATH.'includes/ubb.inc.php'?>
				<textarea name="content" rows="14"></textarea>
			</dd>
			
			<dd><?php if(!empty($_system['code'])){?>验 &nbsp;证 码：
			<input type="text" name="code" class="text yzm"><img src="code.php" id="code"><?php }?><input type="submit" class="submit" value="发表帖子"></dd>
			
		</dl>
	</form>
	<?php } ?>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>