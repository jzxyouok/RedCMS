function selectall(name) {
  if ($("#check_box").prop("checked")) {
    $("input[name='"+name+"']").each(function() {
      this.checked=true;
    });
  } else {
    $("input[name='"+name+"']").each(function() {
      this.checked=false;
    });
  }
}


function openwin(id,url,title,width,height,lock,yesdo,topurl){ 
  art.dialog.open(url, {
  id:id,
  title: title,
  lock:  lock,
  width: width,
  height: height,
  cancel: true,
  ok: function(){
    var iframeWin = this.iframe.contentWindow;
    var topWin = art.dialog.top;
      if(yesdo || topurl){
        if(yesdo){
            yesdo.call(this,iframeWin, topWin); 
        }else{
          art.dialog.close();
            topWin.location.href=topurl;
        }
      }else{
        var form = iframeWin.document.getElementById('dosubmit');form.click();
      }
      return false;
    }
  });
}

function showpicbox(url){
  art.dialog({
    padding: 2,
    title: 'Image',
    content: '<img src="'+url+'" />',
    lock: true
  });
}