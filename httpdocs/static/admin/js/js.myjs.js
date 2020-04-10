 jQuery.fn.addDxloader = function(msg) {
	var asd=$('<div/>',{'class': 'lodingDiv'  });
	var msgcnt=$('<p/>',{'class': 'msg', html:msg  });
	asd.append(msgcnt)
	$(this).append(asd);
}
jQuery.fn.reDxloader = function() {
	$(this).find('.lodingDiv').remove();
}

jQuery.fn.mbtnSetup = function() {
		 $(".mbtn").hover(function(){
		$(this).css({ opacity: 0.7 });
	},function(){
		$(this).css({ opacity:'' });
	});
 
}


$(document).ready(function(){
 

	 
	 
	 
			$('.mbtn').mbtnSetup();

 $('a').click(function(){
	$a=$(this);
  var href = $a.attr('href');
  if($a.is('[rel*=external]')	||	$a.is('[rel*=translation]')	){
    window.open(href);
	return false;
	/*
  }else if($a.is('[rel*=translation]')){
    window.open('http://translate.google.com/translate?hl=zh-TW&sl=ja&tl=zh-TW&u='+href);
	return false;
	 */
	 }else {
	return true;
  }
});
 
 
});