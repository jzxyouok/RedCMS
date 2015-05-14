// JavaScript Document
// 主导航
$(function(){
    vNav();
})
function vNav(){
    var speed = 300;
    $('.nav > li').hover(function(){
        $(this).children('a').addClass('active').next().stop().slideDown(speed);
    },function(){
        $(this).children('a').removeClass('active').next().stop().slideUp(speed);
    })
}