<?php 
//会话控制，开启session
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'register');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//判断登录状态
_login_state();
//判断是否提交了
if ($_GET['action']=='register') {
	//防止恶意注册和跨站攻击
	_check_code($_POST['code'],$_SESSION['code']);
	//引入验证文件
	include ROOT_PATH.'includes/check.func.php';
	//创建一个空数组，用来存放用户提交的合法数据
	$_clean=array();
	//可以通过唯一标识符来防止恶意注册，即是伪装表单跨站攻击
	//这个存放入数据库的唯一标识符还有第二个用途，就是登陆的cookies验证
	$_clean['uniqid']=_check_uniqid($_POST['uniqid'],$_SESSION['uniqid']);
	//也是一个唯一标识符，用来刚注册的用户进行激活处理，方可登录
	$_clean['active']=_sha1_uniqid();
	$_clean['username']=_check_username($_POST['username'],2,20);
	$_clean['password']=_check_password($_POST['password'],$_POST['notpassword'],6);
	$_clean['question']=_check_question($_POST['question'],4,20);
	$_clean['answer']=_check_answer($_POST['question'],$_POST['answer'],2,20);
	$_clean['sex']=_check_sex($_POST['sex']);
	$_clean['face']=_check_face($_POST['face']);
	$_clean['email']=_check_email($_POST['email'],6,40);
	$_clean['qq']=_check_qq($_POST['qq']);
	$_clean['url']=_check_url($_POST['url'],40);
	//新增用户
	//新增之前要判断用户名是否重复
	_is_repeat(
		"SELECT tg_username FROM tg_user WHERE tg_username='{$_clean['username']}' LIMIT 1",
		'此用户名已被注册'
	);
	//在双引号里直接放变量是允许的，比如$_username，但如果是数组则必须加上花括号{$clean['username']}
	_query(
		"INSERT INTO tg_user(
					tg_uniqid,
					tg_active,
					tg_username,
					tg_password,
					tg_question,
					tg_answer,
					tg_sex,
					tg_face,
					tg_email,
					tg_qq,
					tg_url,
					tg_reg_time,
					tg_last_time,
					tg_last_ip
					)
					VALUES(
					'{$_clean['uniqid']}',
					'{$_clean['active']}',
					'{$_clean['username']}',
					'{$_clean['password']}',
					'{$_clean['question']}',
					'{$_clean['answer']}',
					'{$_clean['sex']}',
					'{$_clean['face']}',
					'{$_clean['email']}',
					'{$_clean['qq']}',
					'{$_clean['url']}',
					NOW(),
					NOW(),
					'{$_SERVER['REMOTE_ADDR']}'
					);"
	);
	if (_affected_rows()==1) {
		//关闭连接和session
		_close();
		_session_destroy();
		//成功注册则跳转至首页
		_location('注册成功！','active.php?active='.$_clean['active']);
	}else{
		_close();
		_session_destroy();
		_location('注册失败！','register.php');
	}
	
}else{
	//这个只能放在下面
	$_SESSION['uniqid']=$_uniqid=_sha1_uniqid();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>多用户留言系统--注册</title>
<?php
	require ROOT_PATH.'includes/title.inc.php';
?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/register.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="register">
	<h2>会员注册</h2>
	<form method="post" name='register' action="register.php?action=register">
		<input type="hidden" name="uniqid" value="<?php echo ($_uniqid) ?>">
		<!-- 隐藏字段的方法 -->
		<!-- <input type="hidden" name="action" value="register"> -->
		<dl>
			<dt>请认真填写下列内容</dt>
			<dd>用&nbsp;&nbsp;户&nbsp;名：<input type="text" name="username" class="text">（*必填，至少两位）</dd>
			<dd>密&nbsp; &nbsp; &nbsp; &nbsp;码：<input type="password" name="password" class="text">（*必填，至少六位）</dd>
			<dd>确认密码：<input type="password" name="notpassword" class="text"></dd>
			<dd>密码提示：<input type="text" name="question" class="text"></dd>
			<dd>密码回答：<input type="text" name="answer" class="text"></dd>
			<dd>性&nbsp; &nbsp; &nbsp; &nbsp;别：<input type="radio" name="sex" value="男" checked="checked">男<input type="radio" name="sex" value="女">女</dd>
			<!-- 头像选择JavaScript实现 -->
			<!-- 弹出窗口，打开新的php文件，定义宽度和高度，以及出现的位置 -->
			<dd class="face"><input type="hidden" name="face" value="face/m01.gif"><img src="face/m01.gif" alt="图像选择" id="faceimg"></dd>

			<dd>电子邮件：<input type="text" name="email" class="text">（*必填，用于激活）</dd>
			<dd>企鹅号码：<input type="text" name="qq" class="text"></dd>
			<dd>主页地址：<input type="text" name="url" class="text" value="http://"></dd>
			<!-- javascript实现验证码重新加载 -->
			<dd>验 &nbsp;证 码：<input type="text" name="code" class="text yzm"><img src="code.php" id="code"></dd>
			<dd><input type="submit" class="submit" value="注册"></dd>
		</dl>
	</form>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>