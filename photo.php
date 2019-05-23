<?php 
session_start();
define('IN_TG', 'true');
define('SCRIPT', 'photo');
//引入公共文件commom.inc.php
require dirname(__FILE__).'/includes/common.inc.php';
//读取相册数据
//分页模块
//第一个参数获取总用户数，第二个参数指定每页的用户数量
global $_pagenum,$_pagesize,$_system;
_page("SELECT tg_id FROM tg_dir;",$_system['photo']);
//从数据库提取数据获取结果集
//每次从新取结果集，而不是从新执行SQL语句
$_result=_query("SELECT tg_id,tg_name,tg_type,tg_face FROM tg_dir ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize");
?>
<!DOCTYPE html>
<html>
<head>
<?php require ROOT_PATH.'includes/title.inc.php'; ?>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="photo">
	<h2>相册列表</h2>
	<?php 
		$_html=array();
		while(!!$_rows=_fetch_array_list($_result)){
			$_html['id']=$_rows['tg_id'];
			$_html['name']=$_rows['tg_name'];
			$_html['type']=$_rows['tg_type'];
			$_html['face']=$_rows['tg_face'];
			$_html=_html($_html);
			if (empty($_html['type'])) {
				$_html['type_html']='(公开)';
			}else{
				$_html['type_html']='(私密)';
			}
			if (empty($_html['face'])) {
				$_html['face_html']='';
			}else{
				$_html['face_html']='<img src="'.$_html['face'].'" alt="'.$_html['name'].'">';
			}
	?>
	<dl>
		<dt><a href="photo_show?id=<?php echo $_html['id']?>"><?php echo $_html['face_html']?></a></dt>
		<dd><a href="photo_show.php?id=<?php echo $_html['id']?>"><?php echo $_html['name']?></a> <?php echo $_html['type_html']?></dd>
		<?php if(isset($_SESSION['admin']) && isset($_COOKIE['username'])){?>
		<dd>[<a href="photo_modify_dir.php?id=<?php echo $_html['id']?>">修改</a>] [删除]</dd>
		<?php }?>
	</dl>
	<?php }?>
	<?php if(isset($_SESSION['admin']) && isset($_COOKIE['username'])){?>
	<p><a href="photo_add_dir.php">添加目录</a></p>
	<?php }?>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>