<!-- 公共文件，包含初始化数据 -->
<?php
if(!defined('IN_TG')){//防止恶意调用
	exit('Access Denied!');	
}
//设置字符集
header('Content-Type:text/html;charset=utf-8');
//转换成硬路径常量
define('ROOT_PATH', substr(dirname(__FILE__), 0, -8));
//创建一个自动转义状态的常量
define('GPC', get_magic_quotes_gpc());
//拒绝PHP低版本
if (PHP_VERSION<'4.1.0') {
	exit('Version is low!');
}
//引用核心函数库
require ROOT_PATH.'includes/global.func.php';
require ROOT_PATH.'includes/mysql.func.php';
//执行开始时间
define('START_TIME', _runtime());
//或者写成超级全局变量$global['start_time']=_runtime();
//数据库连接所需常量
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', 6821663);
define('DB_NAME', 'guest');
_connect();//连接数据库
_select_db();//选择数据库
_set_names();//设置字符集
//短信提醒
$_message=_fetch_array("SELECT COUNT(tg_id) AS count FROM tg_message WHERE tg_state=0 AND tg_touser='{$_COOKIE['username']}';");
if (empty($_message['count'])) {
	$_message_html='<strong class="noread"><a href="member_message.php">(0)</a></strong>';
}else{
	$_message_html='<strong class="read"><a href="member_message.php">('.$_message['count'].')</a></strong>';
}
//网站系统设置初始化
if (!!$_rows=_fetch_array("SELECT tg_webname,tg_article,tg_blog,tg_photo,tg_skin,tg_string,tg_post,tg_re,tg_code,tg_register FROM tg_system WHERE tg_id=1 LIMIT 1;")) {
	$_system=array();
	$_system['webname']=$_rows['tg_webname'];
	$_system['article']=$_rows['tg_article'];
	$_system['blog']=$_rows['tg_blog'];
	$_system['photo']=$_rows['tg_photo'];
	$_system['skin']=$_rows['tg_skin'];
	$_system['post']=$_rows['tg_post'];
	$_system['re']=$_rows['tg_re'];
	$_system['code']=$_rows['tg_code'];
	$_system['register']=$_rows['tg_register'];
	$_system['string']=$_rows['tg_string'];
	$_system=_html($_system);
}else{
	exit('系统表异常，请管理员检查！');
}
?>