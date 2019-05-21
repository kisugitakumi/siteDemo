<?php
	define('IN_TG', 'true');
	define('SCRIPT', 'face');
	//引入公共文件commom.inc.php
	require dirname(__FILE__).'/includes/common.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	require ROOT_PATH.'includes/title.inc.php';
	?>
	<script type="text/javascript" src="js/opener.js"></script>
</head>
<body>

<div id="face">
	<h3>选择头像</h3>
	<dl>
		<?php foreach (range(1,9) as $num) {?>
		<dd><img src="face/m0<?php echo $num ?>.gif" alt="face/m0<?php echo $num ?>.gif" title="头像<?php echo $num ?>"></dd>
		<?php } ?>

	</dl>
	<dl>
		<?php foreach (range(10,64) as $num) {?>
		<dd><img src="face/m<?php echo $num ?>.gif" alt="face/m<?php echo $num ?>.gif" title="头像<?php echo $num ?>"></dd>
		<?php } ?>
		
	</dl>
</div>


</body>
</html>