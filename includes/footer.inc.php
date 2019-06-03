<!-- 底部框架 -->
<?php
if(!defined('IN_TG')){//防止恶意调用
	exit('Access Denied!');	
}
_close();
?>

<div id="footer">
	<p>本程序执行耗时为：<?php echo round((_runtime()-START_TIME),4)?>秒</p>
	<!-- 有问题，首页显示不居中，已解决，是窗口比例问题。。。 -->
	<p>本程序由ZYM&DFY提供，源代码开放可任意修改</p>
</div>