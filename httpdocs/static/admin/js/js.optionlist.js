var sbclicked=false;
  
 jQuery.fn.btnSetup = function(pid,tag,tb_val,sp_field) {
	 var ggx=$(this); 
	 

	 ggx.find('a.editbtn').each(function(){
		$(this).load_opl_box();
	})

 
	 ggx.find('a.del').each(function(){
		$(this).del_opl_box(pid,tag,tb_val,sp_field);
	})
	 ggx.find('a.savebtn').click(function(){
		var pastVal= $(this).parent().find('.sorting_id').val();
		
		$("#optionlist_"+sp_field).addDxloader('');
			 
				 $.ajax({
					 url: admin_path+"/process",
					dataType :'json',
					type : "POST", 
						 data :{
						"action":"db_optionlist_savesort",
						"tag": tag,
						"pid": pid,
						"sortdata": pastVal,
						"sp_field": sp_field
						 },
					
					success: function(jdata){
						
						
													$("#optionlist_"+sp_field).setOptionAjax(pid,tag,tb_val,sp_field ); 
						
					}
				 })
})

 }
 jQuery.fn.setJson2Row = function(jsjs,	pid,tag,tb_val,sp_field	) {
	 var sty='';
	 var cc=0;
	 
	 if(jsjs.rows){
	 $.each(jsjs.rows,function(index,value){
 
			sty+='<li id="'+value['id']+'" class="clearfix col-xs-12 nav m0 p0 pb5 pt5" style="border-bottom:1px solid #ccc">';
			sty+='<div class="clearfix"  >';
			sty+='<div class="col-xs-1 m0 p0" ><span class="sort mt5">&nbsp;<i class="fa fa-sort"></i>&nbsp;Sort</span></div>';
			sty+='<div class="col-xs-1 m0 p0" ><a title="'+value['ptitle']+'"  class="btn btn-warning btn-sm editbtn" data-thisid="'+value['id']+'"		data-pid="'+pid+'" data-tag="'+tag+'" data-tb_val="'+tb_val+'" data-sp_field="'+sp_field+'">Edit</a></div>';
			sty+='<div class="col-xs-9 m0 p0 mt5">'+value['mydata']+'</div>';
			sty+='<div class="col-xs-1 m0  p0"><a class="btn btn-danger btn-sm  del" data-thisid="'+value['id']+'">Del</a></div>';
			sty+='</div></li>';
 			cc++;
	})
	if(cc==0) return '<p class="alert alert-warning m0 m5 p5">No record</p>';
	var retb='<div class="opt-ajax-div"><a class="btn btn-primary minbutton savebtn mb10">Save Sort sequence</a><input class="sorting_id" type="hidden" value=""/>'+jsjs.head+'<ul class="sorting_ul nav">'+sty+'</ul></div>';
 
	 }else{
		return '<p class="p_left">No record</p>';
	}

	return retb;
 }
 jQuery.fn.setOptionAjax = function(pid,tag,tb_val,sp_field) {
	 var ggx=$(this);
	 
	 
		$("#optionlist_"+sp_field).addDxloader('');
 $.ajax({
	 url: admin_path+"/process",
    dataType :'json',
    type : "POST", 
	     data :{
		"action":"db_optionlist_ajax",
		"tag": tag,
		"pid": pid,
		"tb_val": tb_val,
		"sp_field": sp_field
		 },
	
	success: function(jdata){
		var strrr='';
 			strrr=ggx.setJson2Row(jdata	,pid,tag,tb_val,sp_field);
	 
 	ggx.empty().html(strrr);
 
 	ggx.btnSetup(pid,tag,tb_val,sp_field);
 
 
 	var tagUl=ggx.find(".sorting_ul");
				if(tagUl.length>0){
				var tagInput=ggx.find(".sorting_id");
				tagUl.sortable({
					create:function ()
					{
					serial = tagUl.sortable("toArray");
					tagInput.attr("value",serial);	 
					},
					update : function ()
					{
					serial = tagUl.sortable("toArray");
					tagInput.attr("value",serial);
					}
				}); 
	}
 
 
 
 
 
	}
	})
	 
 }
 
 
jQuery.fn.oplForm = function() {
	
var ggx=$(this);	



ggx.validate({
	submitHandler: function(form) {
		ggx.addDxloader('');

$.ajax({
	 url: admin_path+"/process",
    type : 'POST',
    dataType :'json',
    data :ggx.serialize(),
	success: function(jdata){
		var chc=parseInt(jdata.success)
		var btncnt=$('#cap_error');
			if(chc==1){
				ggx.empty().append( $('<p class="p_center blue" style="font-size:16pt"><br/><br/><strong>'+jdata.msg +'<br/><br/></strong></p>') );
				sbclicked=true;
			}else{
			btncnt.html(jdata.msg);
			}
			ggx.reDxloader();
	
	 }
})
		}//	submitHandler:
	});
	
}

 jQuery.fn.del_opl_box = function(pid,tag,tb_val,sp_field) {
	var ggx=$(this);
	var thisid= ggx.data('thisid');
	ggx.click(function(){
		if( confirm('Delete?')){
				$("#optionlist_"+sp_field).addDxloader('');
								$.ajax({
								 url: admin_path+"/process",
								type : 'POST', 
								dataType :'json',
								data :{
									'action':'del_optlist_val',
									'tag': tag, 
									'sp_field': sp_field, 
									'thisid':thisid
									 },
								
								success: function(jdata){
								var chc=parseInt(jdata.success);
												if(chc==1){
													$("#optionlist_"+sp_field).setOptionAjax(pid,tag,tb_val,sp_field ); 
												}else{
													alert(jdata.msg);
												}
								}
								})
		}else{
			return false;
		}
	})
 }
 jQuery.fn.load_opl_box = function() {
	
	$(this).each(function(){ 	
	 	var ggx=$(this);
		
		var a_thisid=ggx.data('thisid');
		
		
		var a_pid=ggx.data('pid');
		var a_tag=ggx.data('tag');
		var a_tb_val=ggx.data('tb_val');
		var a_sp_field=ggx.data('sp_field');
		
			
		ggx.click(function(){
		sbclicked=false;	
		
		
	var inccnt='<div class="modal fade" id="MsgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >  <div class="modal-dialog modal-md" style="border:0">   <div class="modal-content"   style="background:#fff">';

        inccnt+='  <div class="modal-header" style="border:0">';
         inccnt+='   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
          inccnt+='  <h4 class="modal-title text-center text-black" id="myModalLabel">'+ggx.attr('title')+'</h4>';
		  
		  
		  
         inccnt+=' </div>';
        inccnt+='  <div class="modal-body p0" >';
	  inccnt+='  <div id="opl_form" class="p20 text-center pos-rel clearfix" style="min-height:160px;"><p>&nbsp;</p>	<img src="static/images/loading.gif"/> <p>&nbsp;</p></div></div>';
		  
		   
    inccnt+='</div> </div></div>';
	
	$("body").append( $(inccnt)	);
					
					 $("#MsgModal").on("shown.bs.modal", function () {
					 	   $('body').removeClass('modal-open');
						 //  $('.modal-backdrop ').css('visibility','hidden')
						 
var pid=ggx.data('id');		
	$.ajax({
	 url: admin_path+"/process",
    type : 'POST', 
	//dataType :'json',
    data :{
		'action':'load_optlist_val',
		'pid': a_pid, 
		'tag': a_tag, 
		'sp_field': a_sp_field, 
		'thisid':a_thisid
		 },
	
	success: function(jdata){
		
		$('#opl_form').html(jdata); 
		$('#optform').oplForm();
	}
	})
	
						 
					})
					 
					 
					
					$("#MsgModal").modal({	/*'backdrop':false	*/ }	);
					
					
					
					$("#MsgModal").on("hidden.bs.modal", function () {
						
		if(sbclicked)	$("#optionlist_"+a_sp_field).setOptionAjax(a_pid,a_tag,a_tb_val,a_sp_field ); 
		
					 	   $(this).remove();
					})
					
		})				
	
	//$("#optionlist_"+a_sp_field).setOptionAjax(a_pid,a_tag,a_tb_val,a_sp_field );

	
 			 
	})

 }
 
 
 $(window).load(function(){
	

	 $('.opt_addbox a.opl_addbtn').load_opl_box();
	 
	 
})