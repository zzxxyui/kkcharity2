

$(window).load( function() {
	 

 
 




	function check_login_form(){
	 
	 
$("#infoform").validate({
 
	submitHandler: function(form) {
	$("#error_ct").html('<img src="'+this_root+'/static/images/loading.gif" height="16" alt=""/>');
 
// var getformPw=
 $.ajax({
 			 url: this_root+admin_path+"/login",
 			 type: "POST",  
  			 dataType: "json",
			 data:{
				 'log_username':$('#inputEmail3').val(), 
		 		 'log_pwd':MD5($('#inputPassword3').val())
		 		// 'log_pwd':($('#inputPassword3').val())
				 
				 
				 },
             success: function(jdata) {
	var check_stt=parseInt(jdata.success); 
			   if(check_stt==1){
				   var rh=jdata.url; 
				  var gh='<h4 class="cmp_regist text-primary   text-center" >'+jdata.msg+'</h4>';
			 
				   gh+='<p class="cmp_regist text-primary   text-center" style="padding-top:20px"><a  href="'+rh+'" class="btn btn-primary">轉跳</a></p>';
				 
				   $('#infoform_cnt').empty().html(gh);
				   
	setTimeout(function(){ 	
	//	window.location.href=rh;
		window.location.reload(true);
		
		},500 );
		
			   }else{
				$('#inputPassword3').val('');
				$("#security_code").val( '');   
					 
						  
				 }
	 
			$('#sb_div input').removeAttr("disabled"); 
			$("#error_ct").html(jdata.msg);
    }
 })
		}//	submitHandler:
	})
	
	}
 
	
	
	   check_login_form();
 
 
	
	});