
jQuery.fn.actPartner = function(action_name,spval) {
	 
$(this).live('click',function(){
	 var ggx=$(this);
	 var tid=(action_name=='paction_add')?'c_inv1':'c_inv2';
	 
	 var itemid=ggx.data('itemid');
	 var pid=ggx.data('pid');
	 
	 $('#'+tid+'_cnt').addDxloader();
		$.ajax({
						  url: admin_path+ "/process/admin_OL_action",
						 type: "POST",
						  dataType: 'json',
						  data: {  'action':action_name,'pid':pid,  'spval':itemid },
						  success: function(jdata){ 
	 $('#'+tid+'_cnt').reDxloader();
						  
						  $('body').showMsg(jdata.msg);
						   
var tgspval=$('#additemCat').val();
$('#c_inv1').innjqG(act_nm1,tgspval); 
 $('#c_inv2').innjqG(act_nm2);
  
						
						  
						  }
						  
		});
		
 	
})		  
	
}
jQuery.fn.innjqG = function(action_name,spval) {
	
	 var ggx=$(this);
	 var tid=ggx.attr('id');
	 
	 $('#'+tid+'_cnt').addDxloader();
		$.ajax({
						  url: admin_path+ "/process/admin_OL_action",
						 type: "POST",
						  dataType: 'json',
						  data: {  'action':action_name,'pid':cnt_id,  'spval':spval },
						  success: function(jdata){ 

	 $('#'+tid+'_cnt').reDxloader();
	 $('#'+tid).html(jdata.msg);
	 


						  }
						  
		});
		
			
			
			
			
}
 
$(window).load( function() {
	 $('a.add2listBtn').actPartner('paction_add');
	 $('a.del2listBtn').actPartner('paction_remove');
 
if($('#c_inv1').length>0){
 
 $('.additemInpBtn').click(function(){
 
var spval=$('#additemCat').val();
if( parseInt(spval)==0){
			$('body').AlertMsg('Please select a Category first.')
}else{
	 
			$('#c_inv1').innjqG(act_nm1,spval); 
}
//
 })	
 
 
}



if($('#c_inv2').length>0){
 $('#c_inv2').innjqG(act_nm2);
} 
 
   
 
 
})


