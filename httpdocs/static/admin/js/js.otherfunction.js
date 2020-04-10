
$(document).ready( function() { 



jQuery.fn.seo_checkForm = function(title,tag,type,pid) {
	
$("#vforms_seo").tabSetup();
$("#vforms_seo").validate({
	submitHandler: function(form) {
		

$("#vforms_seo").addDxloader("Loading");

$.ajax({
 	 url:admin_path+"/process",
    type : "POST",
    dataType :"json",
    data :$("#vforms_seo").serialize() + "&action=save_seo_setting&fld="+tag+"&id="+pid,
	error: function(jdata){
		alert("Error");
	},
	success: function(jdata){
		var chc=parseInt(jdata.success)
		
$("#vforms_seo").reDxloader();

		if(chc==1){			
 
			$(this).showMsg(jdata.msg);
			
		}else{
			alert(jdata.msg);
		}

	}
})
		}//	submitHandler:
	});



}



jQuery.fn.loadSeoSetting = function(title,tag,type,pid) {

var ggx=$(this);

$.ajax({
 	 url:admin_path+"/process",
    type : "POST",
    dataType :"json",
    data : {'action':'load_seo_setting','tag':tag,'type':type,'pid':pid},
	error: function(jdata){
		alert("Error");
	},
	success: function(jdata){
		
		var ccs=parseInt(jdata.success);
		var Msg=jdata.msg;
		
					 
		if(ccs==1){
			ggx.html(Msg);
			ggx.seo_checkForm(title,tag,type,pid);
		}else{
			ggx.html('<p class="p10em text-center"> '+Msg+'</p>');
		
		}
	}
	
});
		
}

var tgbtn=$('#editSeoBtn');
if( tgbtn.length>0){

tgbtn.on('click',function(){
var ggx=$(this);
var tt=ggx.attr('title');
var pid=ggx.data('pid');
var tg=fld;
var type=ggx.data('type');


var imgval='<p class="p10em text-center"> <img src="'+file_base+'/images/loading.gif"/></p>';

			var inccnt='<div class="modal fade" id="seoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">  <div class="modal-dialog modal-lg">   <div class="modal-content">';

        inccnt+='  <div class="modal-header">';
         inccnt+='   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
          inccnt+='  <h4 class="modal-title text-left" id="myModalLabel">'+tt+'</h4>';
         inccnt+=' </div>';
  
        inccnt+='  <div class="modal-body"><div id="msg_res">'+imgval+' </div></div>';
    inccnt+='</div> </div></div>';
	
	$("body").append( $(inccnt)	);
					
					
					
					$("#seoModal").modal({	backdrop:'static'}	); 
					
					$("#seoModal").on("hidden.bs.modal", function () {
					 	   $(this).remove();
					})
					$('#seoModal').on('shown.bs.modal', function () {
			
							$('#msg_res').loadSeoSetting(tt,tg,type,pid);
			  		})
					
		
		
		
})
}

});