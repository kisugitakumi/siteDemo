<!-- 公共函数文件 -->
<?php
/**
 * 用来获取执行耗时
 * @return float
 * @access public
 */
function _runtime(){
	$_mtime=explode(' ', microtime());
	return $_mtime[1]+$_mtime[0];
}
/**
 *js警告弹窗函数并停留在该网页
 * @access public
 * @return void 弹窗
 * @param $_info
 */
function _alert_back($_info){
	echo "<script type='text/javascript'>alert('".$_info."');history.back();</script>";
	exit();
}

/**
 * js关闭窗口
 * @param  [type] $_info [description]
 * @return [type]        [description]
 */
function _alert_close($_info){
	echo "<script type='text/javascript'>alert('".$_info."');window.close();</script>";
	exit();
}



/**
 * 注册后跳转至某个页面
 * @param  [type] $_info [description]
 * @param  [type] $_url  [description]
 * @return [type]        [description]
 */
function _location($_info,$_url){
	if (!empty($_info)) {
		echo "<script type='text/javascript'>alert('".$_info."');location.href='$_url';</script>";
		exit();
	}else{
		header('Location:'.$_url);
	}
}

/**
 * 生成随机标识符
 * @return [type] [description]
 */
function _sha1_uniqid(){
	return _mysql_string(sha1(uniqid(rand(),true)));
}


/**
 * 验证码验证函数
 * @param  [type] $_first_code [description]
 * @param  [type] $_end_code   [description]
 * @return [type]              [description]
 */
function _check_code($_first_code,$_end_code){
	if ($_first_code!=$_end_code) {
		_alert_back('验证码不正确！');
	}
}

/**
 * 验证码生成函数
 * @return void 产生一个验证码
 * @access public
 * 注：这个地方有bug，code.php require global.func.php后无法显示图片
 */
function _code(){

}

/**
 * 登录状态的判定，防止登录用户从url进入登录或注册界面
 * @return [type] [description]
 */
function _login_state(){
	if (isset($_COOKIE['username'])) {
		_alert_back('登录状态无法进行本操作');
	}
}

/**
 * 判断唯一标识符是否异常
 * @param  [type] $_mysql_uniqid  [description]
 * @param  [type] $_cookie_uniqid [description]
 * @return [type]                 [description]
 */
function _uniqid($_mysql_uniqid,$_cookie_uniqid){
	if ($_mysql_uniqid!=$_cookie_uniqid) {
			_alert_back('唯一标识符异常');
		}
}


/**
 * 短信内容长度截取函数
 * @param  [type] $_string [description]
 * @return [type]          [description]
 */
function _title($_string){
	if (mb_strlen($_string,'utf-8')>14) {
		$_string=mb_substr($_string,0,14,'utf-8').'...';
	}
	return $_string;
}


/**
 * 防止非法字符，对其转义处理，如果是数组，也可过滤
 * @param  [type] $_string [description]
 * @return [type]          [description]
 */
function _html($_string){
	if(is_array($_string)){
		foreach ($_string as $_key => $_value) {
			//递归循环
			$_string[$_key]=_html($_value);
		}
	}else{
		$_string=htmlspecialchars($_string);
	}
	return $_string;
}


/**
 * 判断是否需要开启转义，对字符串数组和字符串
 * @param  [type] $_string [description]
 * @return [type]          [description]
 */
function _mysql_string($_string){
	//如果是开启状态，则不需要转义，否则需要转义
	if(!GPC){
		if(is_array($_string)){
			foreach ($_string as $_key => $_value) {
				//递归循环
				$_string[$_key]=_mysql_string($_value);
			}
		}else{
			$_string=mysql_escape_string($_string);
		}
	}
	return $_string;
}

/**
 * 设置分页参数
 * @param  [type] $_sql  获取总用户数
 * @param  [type] $_size 指定每页的用户数量
 */
function _page($_sql,$_size){
	//将里面的所有变量取出来，外部可以访问
	global $_page,$_pagesize,$_pagenum,$_pageabsolute,$_num;
	if (isset($_GET['page'])) {
	$_page=$_GET['page'];
	if (empty($_page) || $_page<0 || !is_numeric($_page)) {
		$_page=1;
	} else{
		$_page=intval($_page);
	}
	}else{
		$_page=1;
	}
	$_pagesize=$_size;
	$_num=_num_rows(_query($_sql));
	//首先要得到所有数据的总和，和绝对页数
	if ($_num==0) {
		$_pageabsolute=1;
	}else{
		$_pageabsolute=ceil($_num/$_pagesize);
	}
	if ($_page>$_pageabsolute) {
		$_page=$_pageabsolute;
	}
	//每页开始的用户下标
	$_pagenum=($_page-1)*$_pagesize;
}


/**
 * 分页函数
 * @param  [type] $_type [description]
 * @return [type]        [description]
 */
function _paging($_type){
	//定义全局变量
	global $_page,$_pageabsolute,$_num;
	if ($_type==1) {
		echo '<div id="page_num">';
		echo '<ul>';
		for ($i=0; $i < $_pageabsolute; $i++) {
		if ($_page==($i+1)) {
			echo '<li><a href="'.SCRIPT.'.php?page='.($i+1).'" class="selected">'.($i+1).'</a></li>';
		}else{
			echo '<li><a href="'.SCRIPT.'.php?page='.($i+1).'">'.($i+1).'</a></li>';
			}
		}
		echo '</ul>';
		echo '</div>';
	}elseif($_type==2){
		echo '<div id="page_text">';
		echo '<ul>';
		echo '<li>'.$_page.'/'.$_pageabsolute.'页 | </li>';
		echo '<li>共有<strong>'.$_num.'</strong>条数据 | </li>';
		if ($_page==1) {
			echo '<li>首页 | </li>';
			echo '<li>上一页 | </li>';
		}else{
			echo '<li><a href="'.SCRIPT.'.php">首页</a> | </li>';
			echo '<li><a href="'.SCRIPT.'.php?page='.($_page-1).'">上一页</a> | </li>';
		}
		if ($_page==$_pageabsolute) {
			echo '<li>下一页 | </li>';
			echo '<li>尾页</li>';
		}else{
			echo '<li><a href="'.SCRIPT.'.php?page='.($_page+1).'">下一页</a> | </li>';
			echo '<li><a href="'.SCRIPT.'.php?page='.($_pageabsolute).'">尾页</a> | </li>';
		}
		echo '</ul>';
	echo '</div>';
	}
}

/**
 * 关闭session
 * @return [type] [description]
 */
function _session_destroy(){
	if(session_start()){
		session_destroy();
	}
}

/**
 * 删除cookies
 * @return [type] [description]
 */
function _unsetcookies(){
	setcookie('username','',time()-1);
	setcookie('uniqid','',time()-1);
	_session_destroy();
	_location(null,'index.php');
}
?>