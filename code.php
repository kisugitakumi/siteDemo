<?php
//打开连接
session_start();
define('IN_TG', 'true');
//运行验证码函数
//可以通过数据库的方法来设置验证码的各种属性，这个地方有问题
//require dirname(__FILE__).'/includes/common.inc.php';
//_code();
$_nmsg='';
//随机码的个数
$_rnd_number=4;
//创建随机码
for ($i=0; $i < $_rnd_number; $i++) { 
	$_nmsg.=dechex(mt_rand(0,15));
}
// 将验证码保存在服务器上，跨页面持久
$_SESSION['code']=$_nmsg;
//长和高
$_width=75;
$_height=25;
//创建一张图像，该函数创建一张真彩色图像
$_img=imagecreatetruecolor($_width,$_height);
//白色
$_white=imagecolorallocate($_img, 255, 255, 255);
//填充
imagefill($_img, 0, 0, $_white);
$_flag=false;
//黑色边框
$_black=imagecolorallocate($_img, 0, 0, 0);
if($_flag){
imagerectangle($_img, 0, 0, $_width-1, $_height-1, $_black);
}
//随机画出六个线条
for ($i=0; $i < 6; $i++) { 
	$_rnd_color=imagecolorallocate($_img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));//颜色随机
	imageline($_img, mt_rand(0,$_width), mt_rand(0,$_height), mt_rand(0,$_width), mt_rand(0,$_height), $_rnd_color);
}
//随机雪花
for ($i=0; $i < 100; $i++) { 
	$_rnd_color=imagecolorallocate($_img, mt_rand(200,255), mt_rand(200,255), mt_rand(200,255));//淡颜色随机
	imagestring($_img, 1, mt_rand(1,$_width), mt_rand(1,$_height), '*', $_rnd_color);
}
//输出验证码
for ($i=0; $i < strlen($_SESSION['code']); $i++) {
	$_rnd_color=imagecolorallocate($_img, mt_rand(0,100), mt_rand(0,150), mt_rand(0,200));//深颜色随机 
	imagestring($_img, 5, $i*$_width/$_rnd_number+mt_rand(1,10), mt_rand(1,$_height/2), $_SESSION['code'][$i], $_rnd_color);
}

//输出图像
header('Content-Type:image/png');
imagepng($_img);

//销毁图像
imagedestroy($_img);
?>