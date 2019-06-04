window.onload=function(){
	var up=document.getElementById('up');
	up.onclick=function(){
		centerWindow('upimg.php?dir='+this.title,'up','200','500');
	};

	var fm=document.getElementsByTagName('form')[0];
	fm.onsubmit=function(){
		if (fm.url.value=='') {
			alert('图片地址不得为空！');
			fm.url.focus();
			return false;
		}
		//检查图片名
		if (fm.name.value.length<2||fm.name.value.length>20) {
			alert('图片名不得小于2位或者大于20位');
			fm.name.focus();
			return false;
		}
		return true;
	};
};


//使信息框出现在屏幕的中间位置
function centerWindow(url,name,height,width){
	var left=(screen.width-width)/2;
	var top=(screen.height-height)/2;
	window.open(url,name,'height='+height+',width='+width+',top='+top+',left='+left);
};