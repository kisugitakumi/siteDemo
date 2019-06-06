<!-- 公共函数文件 -->
<?php
/**
 * 删除非空目录
 * @param  [type] $dirName [description]
 * @return [type]          [description]
 */
function _remove_Dir($dirName)
{
    if(! is_dir($dirName))
    {
        return false;
    }
    $handle = @opendir($dirName);
    while(($file = @readdir($handle)) !== false)
    {
        if($file != '.' && $file != '..')
        {
            $dir = $dirName . '/' . $file;
            is_dir($dir) ? _remove_Dir($dir) : @unlink($dir);
        }
    }
    closedir($handle);
    return rmdir($dirName) ;
}

/**
 * 必须是管理员才能进入manage.php网页
 */
function _manage_login(){
	if (!(isset($_COOKIE['username'])) || !(isset($_SESSION['admin']))) {
		_alert_back('非法登录!');
	}
}

/**
 * 判断禁言状态函数
 * @return boolean [description]
 */
function _is_forbid(){
	$_rows=_fetch_array("SELECT tg_state FROM tg_user WHERE tg_username='{$_COOKIE['username']}';");
	$_html=array();
	$_html['state']=$_rows['tg_state'];
	return $_html['state'];
}

/**
 * 验证是否在规定的时间外发帖,防止恶意发帖
 * @param  [type] $_nowtime [description]
 * @param  [type] $_pretime [description]
 * @param  [type] $_second  [description]
 * @return [type]           [description]
 */
function _timed($_nowtime,$_pretime,$_second){
	if ($_nowtime-$_pretime<$_second) {
		_alert_back('请于'.($_second-$_nowtime+$_pretime).'s后再发帖');
	}
}

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
 * 生成图片缩略图
 * @param  [type] $_filename [description]
 * @param  [type] $_percent  [description]
 * @return [type]            [description]
 */
function _thumb($_filename,$_percent){
	//获取文件后缀
	$_n = explode('.',$_filename);
	//生成png标头文件
	//注意这里header()必须在任何实际输出之前调用！
	ob_end_clean();
	header('Content-type: image/png');
	//获取文件信息，长和高
	list($_width, $_height) = getimagesize($_filename);
	//生成缩微的长和高
	$_new_width = $_width * $_percent;
	$_new_height = $_height * $_percent;
	//创建一个以某个百分比新长度的画布
	$_new_image=imagecreatetruecolor($_new_width, $_new_height);
	//按照已有的图片创建一个画布
	switch ($_n[1]) {
		case 'jpg' : $_image = imagecreatefromjpeg($_filename);
			break;
		case 'gif' : $_image = imagecreatefromgif($_filename);
			break;
		case 'png' : $_image = imagecreatefrompng($_filename);
			break;
	}
	//将原图采集后重新复制到新图上，就缩略了
	imagecopyresampled($_new_image, $_image, 0, 0, 0, 0, $_new_width, $_new_height, $_width, $_height);
	//生成png
	imagepng($_new_image);
	//销毁
	imagedestroy($_new_image);
	imagedestroy($_image);
}

/**
 * 读取xml文件的函数
 * @param  [type] $_xmlfile [description]
 * @return [type]           [description]
 */
function _get_xml($_xmlfile){
	$_html=array();
	if (file_exists($_xmlfile)) {
		$_xml=file_get_contents($_xmlfile);	
		//全局匹配
		preg_match_all('/<vip>(.*)<\/vip>/s',$_xml,$_dom);
		foreach ($_dom[1] as $_value) {
			preg_match_all('/<id>(.*)<\/id>/s', $_value, $_id);
			preg_match_all('/<username>(.*)<\/username>/s', $_value, $_username);
			preg_match_all('/<sex>(.*)<\/sex>/s', $_value, $_sex);
			preg_match_all('/<face>(.*)<\/face>/s', $_value, $_face);
			preg_match_all('/<email>(.*)<\/email>/s', $_value, $_email);
			preg_match_all('/<url>(.*)<\/url>/s', $_value, $_url);
			$_html['id']=$_id[1][0];
			$_html['username']=$_username[1][0];
			$_html['sex']=$_sex[1][0];
			$_html['face']=$_face[1][0];
			$_html['email']=$_email[1][0];
			$_html['url']=$_url[1][0];
		}
	}else{
		echo "文件不存在";
	}
	return $_html;
}


/**
 * 用于生成xml文件
 * @param [type] $_xmlfile [description]
 * @param [type] $_clean   [description]
 */
function _set_xml($_xmlfile,$_clean){
	$_fp=@fopen('new.xml', 'w');
	if (!$_fp) {
		exit('文件不存在');
	}
	//防止资源死锁
	flock($_fp, LOCK_EX);

	$_string="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string="<vip>\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string="\t<id>{$_clean['id']}</id>\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string="\t<username>{$_clean['username']}</username>\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string="\t<sex>{$_clean['sex']}</sex>\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string="\t<face>{$_clean['face']}</face>\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string="\t<email>{$_clean['email']}</email>\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string="\t<url>{$_clean['url']}</url>\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string="</vip>";
	fwrite($_fp, $_string,strlen($_string));

	flock($_fp, LOCK_UN);
	fclose($_fp);
}

/**
 * ubb解析函数
 * @param  [type] $_string [description]
 * @return [type]          [description]
 */
function _ubb($_string){
	//将输入的回车键转换为换行符
	$_string=nl2br($_string);
	$_string=preg_replace('/\[size=(.*)\](.*)\[\/size\]/U','<span style="font-size:\1px">\2</span>',$_string);
	$_string=preg_replace('/\[b\](.*)\[\/b\]/U','<strong>\1</strong>',$_string);
	$_string=preg_replace('/\[i\](.*)\[\/i\]/U','<em>\1</em>',$_string);
	$_string=preg_replace('/\[u\](.*)\[\/u\]/U','<span style="text-decoration:underline">\1</span>',$_string);
	$_string=preg_replace('/\[s\](.*)\[\/s\]/U','<span style="text-decoration:line-through">\1</span>',$_string);
	$_string=preg_replace('/\[color=(.*)\](.*)\[\/color\]/U','<span style="color:\1">\2</span>',$_string);
	$_string=preg_replace('/\[url\](.*)\[\/url\]/U','<a href="\1" target="_blank">\1</a>',$_string);
	$_string=preg_replace('/\[email\](.*)\[\/email\]/U','<a href="mailto:\1">\1</a>',$_string);
	$_string=preg_replace('/\[img\](.*)\[\/img\]/U','<img src="\1" alt="图片">',$_string);
	$_string=preg_replace('/\[flash\](.*)\[\/flash\]/U','<embed style="width:480px;height:400px;" src="\1">',$_string);
	return $_string;
}




/**
 * 短信内容长度截取函数
 * @param  [type] $_string [description]
 * @return [type]          [description]
 */
function _title($_string,$_strlen){
	if (mb_strlen($_string,'utf-8')>$_strlen) {
		$_string=mb_substr($_string,0,$_strlen,'utf-8').'...';
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
	if (empty($_page) || $_page<=0 || !is_numeric($_page)) {
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
	global $_page,$_pageabsolute,$_num,$_id;
	if ($_type==1) {
		echo '<div id="page_num">';
		echo '<ul>';
		for ($i=0; $i < $_pageabsolute; $i++) {
		if ($_page==($i+1)) {
			echo '<li><a href="'.SCRIPT.'.php?'.$_id.'page='.($i+1).'" class="selected">'.($i+1).'</a></li>';
		}else{
			echo '<li><a href="'.SCRIPT.'.php?'.$_id.'page='.($i+1).'">'.($i+1).'</a></li>';
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
			echo '<li><a href="'.SCRIPT.'.php?'.$_id.'page='.(1).'">首页</a> | </li>';
			echo '<li><a href="'.SCRIPT.'.php?'.$_id.'page='.($_page-1).'">上一页</a> | </li>';
		}
		if ($_page==$_pageabsolute) {
			echo '<li>下一页 | </li>';
			echo '<li>尾页</li>';
		}else{
			echo '<li><a href="'.SCRIPT.'.php?'.$_id.'page='.($_page+1).'">下一页</a> | </li>';
			echo '<li><a href="'.SCRIPT.'.php?'.$_id.'page='.($_pageabsolute).'">尾页</a> | </li>';
		}
		echo '</ul>';
	echo '</div>';
	}else{
		_paging(2);
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