jQuery.fn.addDxloader = function(msg) {
	var asd=$('<div/>',{'class': 'lodingDiv'  });
	var msgcnt=$('<p/>',{'class': 'msg', html:msg  });
	asd.append(msgcnt)
	$(this).append(asd);
}
jQuery.fn.reDxloader = function() {
	$(this).find('.lodingDiv').remove();
}

jQuery.fn.AlertMsg = function(Msg) {


	var inccnt='<div class="modal fade" id="MsgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:40000" >  <div class="modal-dialog modal-md" style="border:0">   <div class="modal-content"   style="background:#d12f2f">';

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




jQuery.fn.showMsg = function(Msg) {


	var inccnt='<div class="modal fade" id="MsgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:40000">  <div class="modal-dialog modal-md">   <div class="modal-content">';

        inccnt+='  <div class="modal-header">';
         inccnt+='   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
          inccnt+='  <h4 class="modal-title text-center" id="myModalLabel">'+Msg+'</h4>';
         inccnt+=' </div>';
  
    inccnt+='</div> </div></div>';
	
	$("body").append( $(inccnt)	);
					
					
					
					$("#MsgModal").modal({	backdrop:false}	);
					setTimeout(function(){	$("#MsgModal").modal("hide");		}, 1500);
					
					$("#MsgModal").on("hidden.bs.modal", function () {
					 	   $(this).remove();
					})
					 
					 
					 
	
} 






function GetURLParameter(sParam){
	    var sPageURL = window.location.search.substring(1);
	    var sURLVariables = sPageURL.split('&');
	    for (var i = 0; i < sURLVariables.length; i++)
	    {
	        var sParameterName = sURLVariables[i].split('=');
	        if (sParameterName[0] == sParam)
	        {
	            return sParameterName[1];
	        }
		}}
$(function() {
 
	
$.when(  $('#side-menu').metisMenu()  ).done(function(  ) {

    

	var queryString = window.location.search;
 $('#side-menu > li').each(function(){
	var ggx=$(this);
			ggx.find('a').each(function(){
			var ggz=$(this);
			var this_a  =$(this).attr('href');
			
				if(this_a.length>3){
					var isEdit=GetURLParameter('action');
						if(isEdit=='edit'){
							queryString= queryString.replace("action=edit&id="+GetURLParameter('id'), 'action=list');
						}
						if(isEdit=='sort'){
							queryString= queryString.replace("action=sort&id="+GetURLParameter('id'), 'action=list');
						}
						if(isEdit=='list'){
							queryString= "?q="+GetURLParameter('q')+"&action="+isEdit;
						}
					 
						//alert(queryString);
						if(this_a == queryString){  	
					$(this).addClass('active');
					ggx.addClass('active')
					ggx.find('ul').addClass('collapse').addClass('in');
					
						}
						if(ggz.hasClass('active')){
					ggx.addClass('active')
					ggx.find('ul').addClass('collapse').addClass('in');
						}
				 }
			})
	})
});
   
 $('.navbar-default.sidebar').css({'display':'block'})
});


    $(window).load(function() {
	var asd=	$('.navbar-default');
asd.trigger('cssClassChanged');
$('#side-mask').bind('cssClassChanged', '', function(){
	alert('asd');

 });
		if( $('#side-mask').length>0){
		$('#side-mask').remove();
		}
	});


//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {


    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse')
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse')
        }

        height = (this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    })
})
