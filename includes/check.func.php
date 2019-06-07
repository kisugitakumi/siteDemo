<?php
if(!defined('IN_TG')){//防止恶意调用
	exit('Access Denied!');	
}

if(!(function_exists('_alert_back'))){
	exit('_alert_back()函数不存在');
}

if(!(function_exists('_mysql_string'))){
	exit('_mysql_string()函数不存在');
}

/**
 * 判断标识符是否一致
 * @param  [string] $_first_uniqid [description]
 * @param  [string] $_end_uniqid   [description]
 * @return [string]                [description]
 */

function _check_uniqid($_first_uniqid,$_end_uniqid){
	if ((strlen($_first_uniqid)!=40) || ($_first_uniqid!=$_end_uniqid)) {
		_alert_back('唯一标识符异常！');
	}
	return _mysql_string($_first_uniqid);
}

/**
 * _check_username()过滤用户名
 * @access public
 * @param  [string] $_string  [受污染的用户名]
 * @param  [int] $_min_num [最小位数]
 * @param  [int] $_max_num [最大位数]
 * @return [string] [过滤后的用户名]
 */
function _check_username($_string,$_min_num,$_max_num){
	global $_system;
	//去掉无意义的空格
	$_string=trim($_string);
	//长度小于两位或者大于20位 不予通过
	if(mb_strlen($_string,'utf-8')<$_min_num || mb_strlen($_string,'utf-8')>$_max_num){
		_alert_back('长度不得小于'.$_min_num.'位或大于'.$_max_num.'位！');
	}
	//限制敏感字符，利用正则表达式
	$_char_pattern='/[<>\'\"\ \]/';
	if(preg_match($_char_pattern, $_string)){
		_alert_back('用户名不得包含敏感字符！');
	}
	//限制敏感用户名
	$_mg=explode('|',$_system['string']);
	//告诉用户哪些不能注册
	foreach ($_mg as $value) {
		$_mg_string.='['.$value.']'.'\n';
	}
	//采用绝对匹配，bug
	if(in_array($_string,$_mg)){
		_alert_back('敏感用户名不得注册！');
	}
	//转义返回，防止SQL注入
	return _mysql_string($_string);
}

/**
 * 验证密码
 * @param  [string] $_first_pass
 * @param  [string] $_end_pass
 * @param  [int] $_min_num
 * @return [string] $_first_pass 加密后的密码
 */
function _check_password($_first_pass,$_end_pass,$_min_num){
	//判断密码
	if(strlen($_first_pass)<$_min_num){
		_alert_back('密码长度不得小于'.$_min_num.'位！');
	}
	//密码和密码确认必须一致
	if ($_first_pass != $_end_pass) {
		_alert_back('密码不一致！');
	}

	//将密码加密返回
	return _mysql_string(sha1($_first_pass));
}


/**
 * 用于修改密码后的密码检查
 * @param  [string] $_string  [description]
 * @param  [int] $_min_num [description]
 * @return [string]           [description]
 */
function _check_modify_password($_string,$_min_num){
	//判断密码
	if(!empty($_string)){
		if(strlen($_string)<$_min_num){
			_alert_back('密码长度不得小于'.$_min_num.'位！');
		}
	}else{
		return null;
	}
	return sha1($_string);
}

/**
 * 密码提示验证
 * @param  [string] $_string
 * @param  [int] $_min_num
 * @param  [int] $_max_num
 * @return [string] $_string
 */
function _check_question($_string,$_min_num,$_max_num){
	$_string=trim($_string);
	//长度小于4位或者大于20位 不予通过
	if(mb_strlen($_string,'utf-8')<$_min_num || mb_strlen($_string,'utf-8')>$_max_num){
	_alert_back('密码提示不得小于'.$_min_num.'位或大于'.$_max_num.'位！');
	}
	//返回密码提示
	return _mysql_string($_string);
}

/**
 * 验证密码回答
 * @param  [string] $_ques
 * @param  [string] $_answ
 * @param  [int] $_min_num
 * @param  [int] $_max_num
 * @return [string] $_answ
 */
function _check_answer($_ques,$_answ,$_min_num,$_max_num){
	$_answ=trim($_answ);
	//长度小于4位或者大于20位 不予通过
	if(mb_strlen($_answ,'utf-8')<$_min_num || mb_strlen($_answ,'utf-8')>$_max_num){
	_alert_back('密码回答不得小于'.$_min_num.'位或大于'.$_max_num.'位！');
	}
	//密码提示与回答不能一致
	if ($_ques == $_answ) {
		_alert_back('密码提示与回答不能一致');
	}
	//加密返回
	return _mysql_string(sha1($_answ));
}

/**
 * 性别
 * @param  [string] $_string [description]
 * @return [string]          [description]
 */
function _check_sex($_string){
	return _mysql_string($_string);
}

/**
 * 头像
 * @param  [string] $_string [description]
 * @return [string]          [description]
 */
function _check_face($_string){
	return _mysql_string($_string);
}

/**
 * 验证邮箱
 * @param  [string] $_string 邮箱地址
 * @return [string] $_string
 * @access public
 */
function _check_email($_string,$_min_num,$_max_num){
	//参考bnbbs@163.com
	//[a-zA-Z0-9_]=>\w
	if (!(preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/', $_string))) {
		_alert_back('邮件格式不正确！');
	}
	if(strlen($_string)<$_min_num || strlen($_string)>$_max_num){
		_alert_back('邮件长度不合法！');
	}
	return _mysql_string($_string);
}

/**
 * 验证QQ
 * @param  [string] $_string
 * @return [string] $_string
 */
function _check_qq($_string){
	if(empty($_string)){
		return null;
	} else {
		//123456
		if(!(preg_match('/^[1-9]{1}[0-9]{4,9}$/', $_string))){
			_alert_back('QQ号格式不正确！');
		}
		return _mysql_string($_string);
	}
}

/**
 * 验证网址格式
 * @param  [string] $_string
 * @return [string] $_string
 */
function _check_url($_string,$_max_num){
	if(empty($_string) || ($_string == 'http://')) {
		return null;
	} else {
		//?表示0次或者1次
		if(!(preg_match('/^https?:\/\/(\w+\.)?[\w\-\.]+(\.\w+)+$/', $_string))){
			_alert_back('网址格式不正确！');
		}
		if (strlen($_string)>$_max_num) {
			_alert_back('网址太长！');
		}
	}
	return _mysql_string($_string);
}

/**
 * 短信内容长度检查
 * @param  [string] $_string [description]
 * @return [string]          [description]
 */
function _check_content($_string){
	//长度小于10位或者大于200位 不予通过
	if(mb_strlen($_string,'utf-8')<10 || mb_strlen($_string,'utf-8')>200){
		_alert_back('短信不得小于10位或大于200位');
	}else{
		return $_string;
	}
}

/**
 * 检查留言长度
 * @param  [string] $_string [description]
 * @param  [int] $_min    [description]
 * @param  [int] $_max    [description]
 * @return [string]          [description]
 */
function _check_guest($_string,$_min,$_max){
	//长度小于2位或者大于40位 不予通过
	if(mb_strlen($_string,'utf-8')<$_min || mb_strlen($_string,'utf-8')>$_max){
		_alert_back('留言内容不得小于'.$_min.'位或大于'.$_max.'位');
	}else{
		return $_string;
	}
}

/**
 * 帖子标题长度检查
 * @param  [string] $_string [description]
 * @param  [int] $_min    [description]
 * @param  [int] $_max    [description]
 * @return [string]          [description]
 */
function _check_post_title($_string,$_min,$_max){
	//长度小于2位或者大于40位 不予通过
	if(mb_strlen($_string,'utf-8')<$_min || mb_strlen($_string,'utf-8')>$_max){
		_alert_back('帖子标题不得小于'.$_min.'位或大于'.$_max.'位');
	}else{
		return $_string;
	}
}

/**
 * 帖子长度检查
 * @param  [string] $_string [description]
 * @param  [int] $_num    [description]
 * @return [string]          [description]
 */
function _check_post_content($_string,$_num){
	if(mb_strlen($_string,'utf-8')<$_num){
		_alert_back('帖子内容不得小于'.$_num.'位！');
	}else{
		return $_string;
	}
}

/**
 * 签名长度检查
 * @param  [string] $_string [description]
 * @param  [int] $_num    [description]
 * @return [string]          [description]
 */
function _check_autograph($_string,$_num){
	if(mb_strlen($_string,'utf-8')>$_num){
		_alert_back('签名内容不得大于'.$_num.'位！');
	}else{
		return $_string;
	}
}

/**
 * 检查相册名和图片名长度
 * @param  [string] $_string [description]
 * @param  [int] $_min    [description]
 * @param  [int] $_max    [description]
 * @return [string]          [description]
 */
function _check_dir_name($_string,$_min,$_max){
	if(mb_strlen($_string,'utf-8')<$_min || mb_strlen($_string,'utf-8')>$_max){
		_alert_back('名称不得小于'.$_min.'位或大于'.$_max.'位！');
	}else{
		return $_string;
	}
}


/**
 * 检查相册密码
 * @param  [string] $_string  [description]
 * @param  [int] $_min_num [description]
 * @return [string]           [description]
 */
function _check_dir_password($_string,$_min_num){
	if(strlen($_string)<$_min_num){
		_alert_back('密码长度不得小于'.$_min_num.'位！');
	}
	return sha1($_string);
}

/**
 * 检查图片url
 * @param  [string] $_string [description]
 * @return [string]          [description]
 */
function _check_photo_url($_string){
	if (empty($_string)) {
		_alert_back('地址不能为空！');
	}
	return $_string;
}
?>