// JavaScript Document
$(function(){
/*-----------banner--------------------*/
	$('.slide_ol li').click(function(){
		var num=$(this).index()
		$( this).addClass('current').siblings().removeClass('current');
		$('.slide_ul li').eq(num).hide().stop().fadeIn(500).siblings().hide();
		num02=num+1
		if(num02>4){
			num02=0
		}
	});
	
	var time=setInterval(play,5000) 
	var num02=1
	function play(){
		$('.slide_ol li').eq(num02).addClass('current').siblings().removeClass('current');
		$('.slide_ul li').eq(num02).hide().stop().fadeIn(800).siblings().hide();
		num02++
		if(num02>4){
			num02=0
		}
	};
	$('.slide_ol').hover(function(){
		clearInterval(time)
	},function(){
		clearInterval(time)
		time=setInterval(play,5000) 
	})
});
