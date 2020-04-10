
	
	jQuery.fn.check_reg_form = function(Msg) {
	
	//$.metadata.setType("attr", "validate");
//$("input[type='radio'], input[type='checkbox']").uniform({resetSelector: 'input[type="reset"]'});
$("#infoform").validate({
 
	submitHandler: function(form) {
	$("#error_ct").html('<img src="'+this_root+'/static/images/loading.gif" height="16" alt=""/>');
//	$('#sb_div input').attr('disabled',true);
	 
	 

   
 

 
 
		
 var options = {
 			 url: this_root+"/process/contactus",
 			 type: "POST",
            //	async: false,     
  			 dataType: "json",
             success: function(data) {
	var check_stt=parseInt(data.success); 
			   if(check_stt==1){
				   var rh=data.url; 
				   $('#infoform .form-control, #infoform textarea').each(function(){
					  $(this).val('');
					  }) 
				$("#security_code").attr("value", '');  
				$('#siimage').attr('src',this_root+'/process/captchaImg?sid=' + Math.random());
				   
			   }else{
						 
				$("#security_code").attr("value", '');  
				$("#security_code").focus();
				$('#siimage').attr('src',this_root+'/process/captchaImg?sid=' + Math.random());
					 
		 }
	 
			$('#sb_div input').removeAttr("disabled"); 
			$("#error_ct").html(data.msg);
    }
 }
            // bind 'myForm' and provide a simple callback function 
         $(form).ajaxSubmit(options);
		}//	submitHandler:
	});
	
	}
	$(document).ready(function(){ 

	$("#infoform").check_reg_form();
 
});