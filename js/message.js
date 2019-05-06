window.onload=function(){
	code();
	var fm=document.getElementsByTagName('form')[0];
	fm.onsubmit=function{
		//验证码
		if (fm.code.value.length != 4) {
			alert('验证码不正确');
			fm.code.focus();
			return false;
		}
		//验证内容
		if (fm.content.value.length<10||fm.content.value.length>200) {
			alert('短信内容长度错误！');
			fm.password.focus();
			return false;
		}
	}
}