


jQuery.fn.GOreOrderAction = function(actType,spval,spval2,spval3) {
	$('#descdiv').addDxloader();
		$.ajax({
						  url:  admin_path+"/process/admin_OL_action",
						 type: "POST",
						  dataType: 'json',
						  data: {  'action':actType,  'spval':spval,'spval2':spval2,'spval3':spval3},
						  success: function(jdata){ 
		if( parseInt(jdata.success)==3){
			$('body').AlertMsg(jdata.msg)
		}else{
 $('#descdiv').html(jdata.msg);
		}
 $('#descdiv').reDxloader();
 
 

 
  
switch(actType){	



case 'admin_Item_chgDate':
  $( '.itemChgInp').datepicker({dateFormat:'yy-mm-dd'	, yearRange: "-1:+5",  }); 
  
  $('.itemDateChgBtn').click(function(){

var spval=$(this).data('id');

var spval2=$('#idchg_val1').val();

var spval3=$('#idchg_val2').val();
if(spval2!='' && spval3!=''){
$(this).GOreOrderAction('admin_Item_chgDate_act',spval,spval2,spval3);
}
})
break;	

case 'admin_add_Itemlist':
 var tbc=$('#descdiv').find('table').eq(0);
 tbc.find('tr').each(function(){
	$(this).find('th').last().remove();
	$(this).find('td').last().remove();
	$(this).find('td').css({'vertical-align':'middle'})
	})
 tbc.addClass('table');
 
 
 
  
 $('.add2listBtn').click(function(){
var spval=oid;
var spval2=[$(this).data('fm'),$(this).data('ft')];
var spval3=$(this).data('pid');
	$(this).GOreOrderAction('admin_add_ItemNow',spval,spval2,spval3);
 
 })
break;	


}
						  }
					})
	
}
jQuery.fn.reOrderAction = function(Msg,actType,spval,spval2,spval3) {
	var spval=spval;
	var spval2=spval2;
	var spval3=spval3;
 
 
 var ggx=$(this);
 var mdtype='modal-md';
 
switch(actType){	
case 'admin_add_Itemlist':
case 'admin_Item_chgDate':
mdtype='modal-lg';
break;	
}
	var inccnt='<div class="modal fade" id="descrModal" tabindex="-1" role="dialog" aria-labelledby="descrModal" aria-hidden="true" style="z-index:20000">  <div class="modal-dialog '+mdtype+'">   <div class="modal-content">';
        inccnt+='  <div class="modal-header">';
         inccnt+='   <button type="button" class="close" id="closeBtn" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
          inccnt+='  <h5 class="modal-title text-left" id="myModalLabel">'+Msg+'</h5>';
         inccnt+=' </div>';
          inccnt+='  <div class="modal-body"><div id="descdiv"><p>&nbsp;</p><p class="text-center"><img class="text-center" style="margin:0 auto;" src="./static/images/loading.gif"/></p><p>&nbsp;</p></div></div>';
    inccnt+='</div> </div></div>';
	var ggx=$(this);
	$("body").append( $(inccnt)	);
					$("#descrModal").modal({	backdrop:'static' }	); 
					$("#descrModal").on("hidden.bs.modal", function () {	   $(this).remove();					})
					$("#descrModal").on("shown.bs.modal", function () {
				$(this).GOreOrderAction(actType,spval,spval2,spval3);
					})
				
				
				
 

}


$(document).ready( function() { 
 	
	$("#rasItemDiv").addDxloader(); 
	var tgid=	$("#rasItemDiv").data('id');
			$.ajax({
						  url: admin_path+"/process/admin_ItemInOrder",
						 type: "POST",
						  dataType: "json",
						  data: {  "id":tgid },
							  success: function(jdata){
							  $("#rasItemDiv").html(jdata.msg);
							  $('.OLchgBtn').click(function(){
var spval=$(this).data('id');
$(this).reOrderAction('Change Date Range','admin_Item_chgDate',spval,'','');
 })
 
$(".additemInp ").keypress(function(e){ 
    var code = e.which; // recommended to use e.which, it's normalized across browsers
    if(code==13)e.preventDefault();
 });
$( '.additemInp').datepicker({dateFormat:'yy-mm-dd',     changeMonth: true,        changeYear: true  , yearRange: "-1:+5"	  }); 
  
   $( "#addinp_val1" ).change(function(){
	 
	var ddval=$(this).val();	 
	var to = new Date(ddval); 
	to.setDate(to.getDate() + 3); 
	to.setDate(to.getDate() + 3); 


	var g_d= ("0" + to.getDate()).slice(-2) ;
	var g_m=("0" + (to.getMonth() + 1)).slice(-2);
	var g_y=to.getFullYear();
	var retu=g_y+'-'+g_m+'-'+g_d;
 
  $( "#addinp_val2" ).val(retu); 
})
 
 
 
 $('.additemInpBtn').click(function(){
var spval=oid;
var spval2=[$('#addinp_val1').val(),$('#addinp_val2').val()];
var spval3=$('#additemCat').val();
if( parseInt(spval3)==0){
			$('body').AlertMsg('Please select a Category first.')
}else{
		if( (spval2[0])=='' || (spval2[1])==''){
					$('body').AlertMsg('Please select a date first.')
		}else{
			$(this).reOrderAction('Item List','admin_add_Itemlist',spval,spval2,spval3);
		}
}
//
 })						  
							  
 							  }
			})



});
$(window).load( function() { 




$('.OLDelBtn').live('click',function(){
 
if( confirm("Confirm delete?") ){
var spval=$(this).data('id');
$(this).reOrderAction('Delete Item','admin_delItem',spval,'','');

}

})

$('.dvChgBtn').live('click',function(){
var spval=oid;
var spval2=$(this).data('val');
$(this).reOrderAction('Change Delivery Method','admin_DVM_list',spval,spval2,'');
})
$('.cpChgBtn').live('click',function(){
var spval=oid;

var spval2=$('#cpcpval').val();
if(spval2!=''){
$(this).reOrderAction('Change Coupon','admin_CP_list',spval,spval2,'');
}
})

$('.DVMBtn').live('click',function(){
 
var spval=oid;
var spval2=$(this).data('val');
var spval3=$(this).data('val2');
$(this).GOreOrderAction('admin_DVM_setup',spval,spval2,spval3);
})


$('.cpOKBtn').live('click',function(){
 
var spval=oid;
var spval2=$(this).data('val'); 
$(this).GOreOrderAction('admin_CP_setup',spval,spval2,'');
})

$("#cpcpval").keypress(function(e){ 
    var code = e.which; // recommended to use e.which, it's normalized across browsers
    if(code==13)e.preventDefault();
    if(code==32||code==13||code==188||code==186){
        $(".cpChgBtn").click();
    } // missing closing if brace
});

 



$('.reloadBtn').live('click',function(){

window.location.reload();
})

})