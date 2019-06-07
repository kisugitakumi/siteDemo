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
 * 生成登录cookies
 * @param  [string] $_username [description]
 * @param  [string] $_uniqid   [description]
 * @return [string]            [description]
 */
function _setcookies($_username,$_uniqid,$_time){
	switch ($_time) {
		case '0'://浏览器进程
			setcookie('username',$_username);
			setcookie('uniqid',$_uniqid);
			break;
		case '1'://一天
			setcookie('username',$_username,time()+86400);
			setcookie('uniqid',$_uniqid,time()+86400);
			break;
		case '2'://一周
			setcookie('username',$_username,time()+604800);
			setcookie('uniqid',$_uniqid,time()+604800);
			break;
		case '3'://一月
			setcookie('username',$_username,time()+2592300);
			setcookie('uniqid',$_uniqid,time()+2592300);
			break;
	}
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
	//去掉无意义的空格
	$_string=trim($_string);
	//长度小于两位或者大于20位 不予通过
	if(mb_strlen($_string,'utf-8')<$_min_num || mb_strlen($_string,'utf-8')>$_max_num){
		_alert_back('长度不得小于'.$_min_num.'位或大于'.$_max_num.'位！');
	}
	//限制敏感字符，利用正则表达式
	$_char_pattern='/[<>\'\"\ \ ]/';
	if(preg_match($_char_pattern, $_string)){
		_alert_back('用户名不得包含敏感字符！');
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
function _check_password($_string,$_min_num){
	//判断密码
	if(strlen($_string)<$_min_num){
		_alert_back('密码长度不得小于'.$_min_num.'位！');
	}
	//将密码加密返回
	return sha1($_string);
}

/**
 * 验证时间
 * @param  [string] $_string [description]
 * @return [string]          [description]
 */
function _check_time($_string){
	$_time=array('0','1','2','3');
	if (!in_array($_string, $_time)) {
		_alert_back('保留方式错误！');
	}
	return _mysql_string($_string);
}
?>