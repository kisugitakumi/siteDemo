window.onload=function(){
	var message=document.getElementsByName('message');
	var friend=document.getElementsByName('friend');
	var flower=document.getElementsByName('flower');
	for (var i=0;i<message.length;i++){
		message[i].onclick=function(){
			//打开发送短信界面
			centerWindow('message.php?id='+this.title,'message',340,500);
		}
	};
	for (var i=0;i<friend.length;i++){
		friend[i].onclick=function(){
			//打开添加好友界面
			centerWindow('friend.php?id='+this.title,'friend',340,500);
		}
	};
	for (var i=0;i<flower.length;i++){
		flower[i].onclick=function(){
			//打开送花界面
			centerWindow('flower.php?id='+this.title,'flower',340,500);
		}
	};
};

//使信息框出现在屏幕的中间位置
function centerWindow(url,name,height,width){
	var left=(screen.width-width)/2;
	var top=(screen.height-height)/2;
	window.open(url,name,'height='+height+',width='+width+',top='+top+',left='+left);
};