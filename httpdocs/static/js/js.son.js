

$( document ).ready(function() { 

 $("#infoform").validate({

 submitHandler: function(form) {
	 
$("#error_ct").html('<img src="'+this_root+'/static/images/loading.gif" height="16" alt=""/>');
		
$('#infoform input.btn-success').addClass('hide');
 var options = {
 			 url: this_root+"process",
 			 type: "POST",
            //	async: false,     
  			 dataType: "json",
             success: function(data) {
	var check_stt=parseInt(data.success); 
			   if(check_stt==1){
				 
				  $('#sap_form_cnt').html(data.msg) ;
			   }else{
			
$('#infoform input.btn-success').removeClass('hide');
			$("#error_ct").html(data.msg);
			 
					 
		 }
	 
    }
 }
            // bind 'myForm' and provide a simple callback function 
         $(form).ajaxSubmit(options); 

		}
	});
	 



})