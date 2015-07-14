var pagesize = 30;
$(document).ready(function(){
	
	getCategory();
	getPagesCount();
	getPagePic(1);
	
}); 

function getCategory()
{
	if(''!=CATE) return false;
	$.getJSON('',{ajax:1,type:'getCategory'},function(json){
		var data='';
		if(0==json.status){
			var jd=json.data;
			for(var i=0; i<jd.length; i++){
				data += '<a href="?c='+jd[i]+'">'+jd[i]+'</a>';
			}
		}else{
			data = "No data.";
		}
		$("#indexcontent").html(data);
	});
}

function getPagesCount()
{
	if(''==CATE) return false;
	$.getJSON('',{c:CATE,ajax:1,type:'getPagesCount',size:pagesize},function(json){
		var data='';
		if(0==json.status){
			var jd=json.data;
			var page = jd.page;
			for(var i=1; i<=page; i++){
				data += '<li><a href="javascript:getPagePic('+i+')">'+i+'</a></li>';
			}
			data += '<li><a href="##">All '+jd.count+'</a></li>';
		}else{
			data = '<li><a href="javascript:getPagePic(1)">1</a></li>';
		}
		$("#paged ul").html(data);
	});
}

function getPagePic(page)
{
	if(''==CATE) return false;
	$.getJSON('',{c:CATE,ajax:1,type:'getPagePic',page:page,size:pagesize},function(json){
		var data='';
		if(0==json.status){
			var jd=json.data;
			for(var i=0; i<jd.length; i++){
				data += '<div class="imgbox"><img src="/image/?c='+CATE+'&p='+jd[i]+'" /><p>'+jd[i]+'</p></div>';
			}
		}else{
			data = 'No data.';
		}
		$("#content").html(data);
	});
}

