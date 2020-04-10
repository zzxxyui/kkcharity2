 $.fn.is_on_screen = function(){
    var win = $(window);
    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();
 
    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();
 
    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
};
 
if( $('.target').length > 0 ) { // if target element exists in DOM
	if( $('.target').is_on_screen() ) { // if target element is visible on screen after DOM loaded
        $('.log').html('<div class="alert alert-success">target element is visible on screen</div>'); // log info		
	} else {
        $('.log').html('<div class="alert">target element is not visible on screen</div>'); // log info
	}
}


jQuery.fn.AlertMsg = function(Msg) {


	var inccnt='<div class="modal fade" id="MsgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >  <div class="modal-dialog modal-md" style="border:0">   <div class="modal-content"   style="background:#d12f2f">';

        inccnt+='  <div class="modal-header" style="border:0">';
         inccnt+='   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
          inccnt+='  <h4 class="modal-title text-center text-white" id="myModalLabel">'+Msg+'</h4>';
         inccnt+=' </div>';
  
    inccnt+='</div> </div></div>';
	
	$("body").append( $(inccnt)	);
					
					
					
					$("#MsgModal").modal({	 }	);
						//setTimeout(function(){	$("#MsgModal").modal("hide");		}, 1500);
					
					$("#MsgModal").on("hidden.bs.modal", function () {
					 	   $(this).remove();
					})
					 
					 
					 
	
} 


	
	 
jQuery.fn.homeJbtnSetup = function(msg) {
$(this).click(function(){
var vk=$(this).data('tg');
var tgVal=0;
var plusVal=0;
var tagPos=$(vk);
if(tagPos.length>0){
var appH=($(window).width()<768)?-50:-90;	
var tgVal=parseInt(tagPos.offset().top)+appH;
 $("html, body").stop().animate({ scrollTop: tgVal }, 200+ parseInt(tgVal/3),'easeOutQuad');
 
var $myGroup = $('.navbar '); 
    $myGroup.find('.collapse.in').collapse('hide');
$('.navbar-toggle').addClass('collapsed');
}else{
	


}
})

}


jQuery.fn.ShowtMsg = function(Msg) {


	var inccnt='<div class="modal fade" id="MsgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >  <div class="modal-dialog modal-md" style="border:0">   <div class="modal-content"   style="background:#f15a24">';

        inccnt+='  <div class="modal-header" style="border:0">';
         inccnt+='   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
          inccnt+='  <h4 class="modal-title text-center text-white" id="myModalLabel">'+Msg+'</h4>';
         inccnt+=' </div>';
  
    inccnt+='</div> </div></div>';
	
	$("body").append( $(inccnt)	);
					
					 $("#MsgModal").on("shown.bs.modal", function () {
					 	   $('body').removeClass('modal-open');
						 //  $('.modal-backdrop ').css('visibility','hidden')
					})
					 
					 
					
					$("#MsgModal").modal({	/*'backdrop':false	*/ }	);
					 setTimeout(function(){	$("#MsgModal").modal("hide");		}, 2000);
					
					$("#MsgModal").on("hidden.bs.modal", function () {
					 	   $(this).remove();
					})
			
				
	
} 

jQuery.fn.ShowtMsg2 = function(Msg) {


	var inccnt='<div class="modal fade" id="MsgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >  <div class="modal-dialog modal-md" style="border:0">   <div class="modal-content"   style="background:#d70b2a">';

        inccnt+='  <div class="modal-header" style="border:0">';
         inccnt+='   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
          inccnt+='  <h4 class="modal-title text-center text-white" id="myModalLabel">'+Msg+'</h4>';
         inccnt+=' </div>';
  
    inccnt+='</div> </div></div>';
	
	$("body").append( $(inccnt)	);
					
					 $("#MsgModal").on("shown.bs.modal", function () {
					 	   $('body').removeClass('modal-open');
						 //  $('.modal-backdrop ').css('visibility','hidden')
					})
					 
					 
					
					$("#MsgModal").modal({	/*'backdrop':false	*/ }	);
					 setTimeout(function(){	$("#MsgModal").modal("hide");		}, 6000);
					
					$("#MsgModal").on("hidden.bs.modal", function () {
					 	   $(this).remove();
					})
			
				
	
} 



 

jQuery.fn.addDxloader = function(msg) {
	var asd=$('<div/>',{'class': 'lodingDiv'  });
	var msgcnt=$('<p/>',{'class': 'msg', html:msg  });
	asd.append(msgcnt)
	$(this).append(asd);
}
jQuery.fn.reDxloader = function() {
	$(this).find('.lodingDiv').remove();
}

 
jQuery.fn.setImgVs = function(msg) {
var ggx=$(this);
ggx.find('img').each(function(){
 var ww=$(this).width();
 var hh=$(this).height();
  $(this).width('auto');
 $(this).height('auto');
 
  $(this).css({
	 'border':'1px solid #ccc;',
	 'max-width':'100%',
	 'max-height':hh+'px'
	 }) 
  $(this).addClass('img-responsive');
})
}

 function getInternetExplorerVersion() {
    var rv = -1;  
    if (navigator.appName == "Microsoft Internet Explorer") {
        var ua = navigator.userAgent;
        var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
        if (re.exec(ua) != null)
            rv = parseFloat(RegExp.$1);
    }
    return rv;
} 
 

$( window ).load(function() { 

 //alert(  $(window).width() );
});
 

$( window ).resize(function() {
	 
});

$(window).scroll(function() {
 
});
 
 

$( document ).ready(function() { 

 if( $('.pjlist_item ').length>0 ){
	  
$('.pjlist_item').each(function(){
	var getA=$(this).find('a').eq(0);
		$(this).find('.pc_txt').css('cursor','pointer');
		$(this).find('.pc_txt').click(function(){
			window.location.href= getA.attr('href');
		})

 })
 }
 
 if( $('.dotdotdot').length>0 ){
$('.dotdotdot').dotdotdot({
      watch: true,
	  wrap :(langcode==1)?'word':'letter'
  });

 }
 
 if( $('.oc_detail').length>0 ){
$('.oc_detail').setImgVs();
 }
 /*
    $(document).on("contextmenu",function(e){
        if(e.target.nodeName != "INPUT" && e.target.nodeName != "TEXTAREA")
             e.preventDefault();
     });*/
	 
 if( $('.home_mnbtn').length>0 ){
	$('.home_mnbtn').homeJbtnSetup();
}

 if( $('.hhcmbtn').length>0 ){
$('#cmbtn').click(function(){
var ggx=$(this);
var wwx=$( $(this).data('tg') );
	if(ggx.hasClass('off')){
	
			ggx.removeClass('off');
			wwx.addClass('hide');
			
			if(			$('#pp_content').css('display')=='block')	$('#ppbtn').addClass('off'); 
			
	}else{
			ggx.addClass('off'); 
			wwx.removeClass('hide');
			
				if(			$('#pp_content').css('display')=='block')	$('#ppbtn').removeClass('off'); 
			
			if(			$('#pp_content').css('display')=='block')	$('#pp_content').addClass('hide');
	}	

})

$('#ppbtn').click(function(){
var ggx=$(this);
var wwx=$( $(this).data('tg') );
	if(ggx.hasClass('off')){
	
			ggx.removeClass('off');
			wwx.addClass('hide');
			
		if(			$('#cm_content').css('display')=='block')	$('#cmbtn').addClass('off'); 
			
	}else{
			ggx.addClass('off'); 
			wwx.removeClass('hide');
			
			if(			$('#cm_content').css('display')=='block')	$('#cmbtn').removeClass('off'); 			
			if(			$('#cm_content').css('display')=='block')	$('#cm_content').addClass('hide');
	}	

})
}


if(   $(".owl-carousel").length>0){
  $(".owl-carousel").owlCarousel({
	  
		navContainerClass: 'hide',
 	navContainer:false,
    lazyLoad:true,
    autoplay:true,
    autoplayTimeout:4000,
    autoplayHoverPause:true,
	 
      singleItem:true,
	  
	  loop:true,
    margin:0,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
     
    }
	
	});
}
 
	 	
 $(".mbtn").hover(function(){
    $(this).css({ opacity: 0.7 });
},function(){
    $(this).css({ opacity:'' });
});
 
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
 
// Added disable click function by MingFONG@2018/05/15
$(function(){

	$('#projectListCnt1 .first_item a').css({'text-decoration':'unset', 'cursor':'unset'}).attr('href', 'javascript: void(0)');
	$('#projectListCnt1 .dotdotdot').css({'cursor':'unset'});
	$('#pp_content a').css({'text-decoration':'unset', 'cursor':'unset'}).attr('href', 'javascript: void(0)');

});
// End of by MingFONG@2018/05/15