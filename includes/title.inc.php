<?php
//防止恶意调用
if(!defined('IN_TG')){
	exit('Access Denied!');	
}
//防止非HTML代用
if(!defined('SCRIPT')){
	exit('SCRIPT ERROR!');
}
global $_system;
?>
<title><?php echo $_system['webname'];?></title>
<link rel="shortcut icon" href="icon.ico">
<link rel="stylesheet" type="text/css" href="style/<?php echo $_system['skin']?>/basic.css">
<!-- 根据页面定义的SCRIPT常量来选择相应的CSS文件 -->
<link rel="stylesheet" type="text/css" href="style/<?php echo $_system['skin']?>/<?php echo SCRIPT ?>.css">
