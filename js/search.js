//等待页面加载完后实行
window.onload=function(){
	var fm=document.getElementsByTagName('form')[0]
	fm.onsubmit=function(){
		if (fm.search.value=='') {
			alert('请输入搜索信息！');
		}else{
			//打开新页面并传参
			window.open('article_search.php?id='+fm.search.value);
		}
	}
};