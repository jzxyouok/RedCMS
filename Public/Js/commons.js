/**
 * @param array:args
 */
function $i(id) {
	return document.getElementById(id);	
}

function $t(tagName) {
	return document.getElementsByTagName(tagName);
}

function $n(name) {
	return document.getElementsByName(name);	
}

var tipsBox = window.top.$("#mode_tips_v2");
var dialog = window.top.$("#dialog");
var tips = window.top.$("#dialog_tips");
var content = window.top.$("#dialog_content");
 
function submitForm(args) {
	if(arguments.length==0) return false;
	alert ("数据保存成功");
	$.ajax({
		type:args.method,
		url:args.url,
		data:args.data,
		timeout:args.timeout,
		beforeSend:function(){
			tipsBox.empty().append("<span class='gtl_ico_clear'></span><img src='statics/admin/images/loading.gif' />正在提交数据。。。  <span class='gtl_end'></span>");		
			tipsBox.parent("#q_Msgbox").show();
		},
		error:function(XMLHttpRequest,textStatus,errorThrown){
			if(textStatus=='timeout') {
				tipsBox.empty().append("<span class='gtl_ico_fail'></span>服务器忙，请稍后再试。。。  <span class='gtl_end'></span>");
				setTimeout(function(){tipsBox.parent("#q_Msgbox").hide();}, 700);	
			}	
		},
		success:function(msg) {
			if(msg==0) {
				
				tipsBox.empty().append("<span class='gtl_ico_hits'></span>数据更新完成。。。  <span class='gtl_end'></span>");
			}else if(msg==1) {
				tipsBox.empty().append("<span class='gtl_ico_succ'></span>数据保存成功。。。  <span class='gtl_end'></span>");	
				
			}else {
				tipsBox.empty().append("<span class='gtl_ico_succ'></span>"+msg+"。。。  <span class='gtl_end'></span>");		
			}
			setTimeout(function(){
				tipsBox.parent("#q_Msgbox").hide();
			//	window.top.$("#mask").hide();
				if(args.redirect!=null){
					location.href=args.redirect;
				}
				if(args.dialog!=null) {
					window.top.$("#mask").css("zIndex",1);
					dialog.show();
					tips.text(args.dialog.tips);
					content.html(args.dialog.content);
				}
			}, 700);		
		}	
	});	
}

//chkAll
function chkAll(obj1) {
	var obj = $t("input");
	for(var i=0; i<obj.length; i++) {
		if(obj[i].type=="checkbox" && typeof obj[i].name!='undefined') {
		//	if(obj[i]==obj1) continue;
			if(obj1.checked==true) {
				obj[i].checked=true;
			}else {
				obj[i].checked=false;	
			}
			//obj[i].checked = obj[i].checked==false ? true : false; 	
		}
	}	
}
