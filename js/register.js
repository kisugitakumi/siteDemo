//等待网页加载完毕再执行
window.onload=function(){
	code();
	var faceimg=document.getElementById('faceimg');
	faceimg.onclick=function(){
		window.open('face.php','face','width=400,height=400,top=0,left=0,scrollbars=1');
	}
	//表单验证，保证用户数据
	var fm=document.getElementsByTagName('form')[0];
	fm.onsubmit=function(){
		//能用客户端验证的，尽量用客户端
		//用户名验证
		if (fm.username.value.length<2||fm.username.value.length>20) {
			alert('用户名不得小于2位或者大于20位');
			fm.username.value='';//清空
			fm.username.focus();
			return false;
		}
		if (/[<>\'\"\ ]/.test(fm.username.value)) {
			alert('用户名不得包含非法字符');
			fm.username.value='';//清空
			fm.username.focus();
			return false;
		}
		//验证密码
		if (fm.password.value.length<6) {
			alert('密码不得小于6位');
			fm.password.value='';//清空
			fm.password.focus();
			return false;
		}
		if (fm.password.value != fm.notpassword.value) {
			alert('密码不一致');
			fm.notpassword.value='';//清空
			fm.notpassword.focus();
			return false;
		}
		//密码提示与回答
		if (fm.question.value.length<2||fm.question.value.length>20) {
			alert('密码提示不得小于2位或者大于20位');
			fm.question.value='';//清空
			fm.question.focus();
			return false;
		}
		if (fm.answer.value.length<2||fm.answer.value.length>20) {
			alert('密码提示不得小于2位或者大于20位');
			fm.answer.value='';//清空
			fm.answer.focus();
			return false;
		}
		if (fm.question.value == fm.answer.value) {
			alert('密码提示和回答不能相同');
			fm.answer.value='';//清空
			fm.answer.focus();
			return false;
		}
		//邮箱验证
		if(!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)){
			alert('邮件格式不正确');
			fm.email.value='';//清空
			fm.email.focus();
			return false;

		}
		//qq号码
		if (fm.qq.value!='') {
			if (!/^[1-9]{1}[0-9]{4,9}$/.test(fm.qq.value)) {
				alert('QQ号码格式不正确');
				fm.qq.value='';//清空
				fm.qq.focus();
				return false;
			}
		}
		//网址
		if (fm.url.value !='') {
			if (!/^https?:\/\/(\w+\.)?[\w\-\.]+(\.\w+)+$/.test(fm.url.value)) {
				alert('网址格式不正确');
				fm.url.value='';//清空
				fm.url.focus();
				return false;
			}
		}
		//验证码
		if (fm.code.value.length != 4) {
			alert('验证码不正确');
			fm.code.value='';//清空
			fm.code.focus();
			return false;
		}
		return true;
	}
};