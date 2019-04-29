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
?>