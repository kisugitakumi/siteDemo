<?php
if(!defined('IN_TG')){//防止恶意调用
	exit('Access Denied!');	
}

/**
 * 连接数据库函数
 * @return void
 */
function _connect(){
	//表示全局变量，用于资源句柄在函数外也能访问
	global $_conn;
	if ((!$_conn=@mysql_connect(DB_HOST,DB_USER,DB_PWD))){
		exit('数据库连接失败');
	}
}

/**
 * 选择数据库
 * @return void
 */
function _select_db(){
	if (!(mysql_select_db(DB_NAME))) {
		exit('找不到指定数据库');
	}
}

/**
 * 设置字符集
 */
function _set_names(){
	if (!(mysql_query('set names utf8'))) {
		exit('字符集错误');
	}
}

/**
 * 执行SQL语句
 * @param  [type] $_sql [description]
 * @return [type]       [description]
 */
function _query($_sql){
	if(!($_result=mysql_query($_sql))){
		exit('SQL语句错误'.mysql_error());;
	}
	return $_result;		
}

/**
 * 返回结果集的一条数据
 * @param  [type] $_sql [description]
 * @return [type]       [description]
 */
function _fetch_array($_sql){
	return mysql_fetch_array(_query($_sql),MYSQL_ASSOC);
}

/**
 * 返回指定数据集的所有数据
 * @param  [type] $_result [description]
 * @return [type]          [description]
 */
function _fetch_array_list($_result){
	return mysql_fetch_array($_result,MYSQL_ASSOC);
}

/**
 * 返回记录集的行数
 * @return [type] [description]
 */
function _num_rows($_result){
	return mysql_num_rows($_result);
}

/**
 * 返回影响的记录数
 * @return [type] [description]
 */
function _affected_rows(){
	return mysql_affected_rows();
}

/**
 * 销毁记录集
 * @param  [type] $_rsult [description]
 * @return [type]         [description]
 */
function _free_result($_result){
	mysql_free_result($_result);
}

/**
 * 是否存在数据
 * @param  [type]  $_sql  [description]
 * @param  [type]  $_info [description]
 * @return boolean        [description]
 */
function _is_repeat($_sql,$_info){
	if(_fetch_array($_sql)){
		_alert_back($_info);
	}
}

/**
 * 关闭数据库
 * @return [type] [description]
 */
function _close(){
	mysql_close();
}
?>