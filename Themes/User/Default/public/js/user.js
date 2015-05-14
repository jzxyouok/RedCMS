$(function() {
	var nav_length = $(".user_nav li").size();
	var text_length = $(".user_info_box").size();
	
	$(".user_info_box").hide();
	$(".user_nav li").click(function(){
				for(var i=0;i<=nav_length;i++){
					$(".user_info_box").eq(i).hide();
				}
				$(".user_info_box").eq($(this).index()).show();
				$(".user_nav li").removeClass("user_curr");
				$(this).addClass("user_curr");
	});
		
	$(".user_nav li").eq(0).addClass("user_curr");
	$(".user_info_box").eq(0).show();
});