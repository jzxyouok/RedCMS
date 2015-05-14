// JavaScript Document
//图片滚动列表 mengjia 070816 
var Speed = 10; //速度(毫秒) 
var Space = 10; //每次移动(px) 
var PageWidth = 280; //翻页宽度 
var fill = 0; //整体移位 
var MoveLock = false; 
var MoveTimeObj; 
var Comp = 0; 
var AutoPlayObj = null; 
GetObj("Lista2").innerHTML = GetObj("Lista1").innerHTML; 
GetObj('ISLa_Cont').scrollLeft = fill; 
GetObj("ISLa_Cont").onmouseover = function(){clearInterval(AutoPlayObj);} 
GetObj("ISLa_Cont").onmouseout = function(){AutoPlay();} 
AutoPlay(); 
function GetObj(objName){if(document.getElementById){return eval('document.getElementById("'+objName+'")')}else{return eval('document.all.'+objName)}} 
function AutoPlay(){ //自动滚动 
 clearInterval(AutoPlayObj); 
 AutoPlayObj = setInterval('ISLa_GoDown();ISLa_StopDown();',3000); //间隔时间 
} 
function ISLa_GoUp(){ //上翻开始 
 if(MoveLock) return; 
 clearInterval(AutoPlayObj); 
 MoveLock = true; 
 MoveTimeObj = setInterval('ISLa_ScrUp();',Speed); 
} 
function ISLa_StopUp(){ //上翻停止 
 clearInterval(MoveTimeObj); 
 if(GetObj('ISLa_Cont').scrollLeft % PageWidth - fill != 0){ 
  Comp = fill - (GetObj('ISLa_Cont').scrollLeft % PageWidth); 
  CompScr(); 
 }else{ 
  MoveLock = false; 
 } 
 AutoPlay(); 
} 
function ISLa_ScrUp(){ //上翻动作 
 if(GetObj('ISLa_Cont').scrollLeft <= 0){GetObj('ISLa_Cont').scrollLeft = GetObj('ISLa_Cont').scrollLeft + GetObj('Lista1').offsetWidth} 
 GetObj('ISLa_Cont').scrollLeft -= Space ; 
} 
function ISLa_GoDown(){ //下翻 
 clearInterval(MoveTimeObj); 
 if(MoveLock) return; 
 clearInterval(AutoPlayObj); 
 MoveLock = true; 
 ISL_ScrDown(); 
 MoveTimeObj = setInterval('ISLa_ScrDown()',Speed); 
} 
function ISLa_StopDown(){ //下翻停止 
 clearInterval(MoveTimeObj); 
 if(GetObj('ISLa_Cont').scrollLeft % PageWidth - fill != 0 ){ 
  Comp = PageWidth - GetObj('ISLa_Cont').scrollLeft % PageWidth + fill; 
  CompScr(); 
 }else{ 
  MoveLock = false; 
 } 
 AutoPlay(); 
} 
function ISLa_ScrDown(){ //下翻动作 
 if(GetObj('ISLa_Cont').scrollLeft >= GetObj('Lista1').scrollWidth){GetObj('ISLa_Cont').scrollLeft = GetObj('ISLa_Cont').scrollLeft - GetObj('Lista1').scrollWidth;} 
 GetObj('ISLa_Cont').scrollLeft += Space ; 
} 
function CompScr(){ 
 var num; 
 if(Comp == 0){MoveLock = false;return;} 
 if(Comp < 0){ //上翻 
  if(Comp < -Space){ 
   Comp += Space; 
   num = Space; 
  }else{ 
   num = -Comp; 
   Comp = 0; 
  } 
  GetObj('ISLa_Cont').scrollLeft -= num; 
  setTimeout('CompScr()',Speed); 
 }else{ //下翻 
  if(Comp > Space){ 
   Comp -= Space; 
   num = Space; 
  }else{ 
   num = Comp; 
   Comp = 0; 
  } 
  GetObj('ISLa_Cont').scrollLeft += num; 
  setTimeout('CompScr()',Speed); 
 } 
} 