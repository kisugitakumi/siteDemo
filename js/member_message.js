window.onload=function(){
	var all=document.getElementById('all');
	var fm=document.getElementsByTagName('form')[0];
	all.onclick=function(){
		//fm.elements获取所有表单
		//chekced表示已选
		for(var i=0;i<fm.elements.length;i++){
			if (fm.elements[i].name!='chkall') {
				fm.elements[i].checked=fm.chkall.checked;
			}
		}
	};
	fm.onsubmit=function(){
		if(confirm('确定删除此批数据吗？')){
			return true
		}
		return false;
	};
};