<?php
session_start();
define('IN_TG', 'true');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//退出
_unsetcookies();
?>