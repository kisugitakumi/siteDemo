<?php 
define('IN_TG', 'true');
define('SCRIPT', 'article');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
$_skinurl=$_SERVER["HTTP_REFERER"];
//必须从上一页点击过来
if (empty($_skinurl) || !isset($_GET['id'])) {
	_alert_back('非法操作');
}else{
	if ($_GET['id']==1 || $_GET['id']==2 || $_GET['id']==3) {
		//最好判断一下id为1、2、3中的一个
		//生成cookie，用来保存皮肤的种类
		setcookie('skin',$_GET['id']);
		_location(null,$_skinurl);
	}else{
		_alert_back('不存在此号皮肤');
	}
}
?>