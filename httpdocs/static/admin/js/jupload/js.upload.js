
jQuery.fn.addDxloader = function(msg) {
	var asd=$('<div/>',{'class': 'lodingDiv'  });
	var msgcnt=$('<p/>',{'class': 'msg', html:msg  });
	asd.append(msgcnt)
	$(this).append(asd);
}
jQuery.fn.reDxloader = function() {
	$(this).find('.lodingDiv').remove();
}


jQuery.fn.setsort = function(uid,opt) { 

	$("#setsort").sortable({
					create:function ()
					{
					serial = $("#setsort").sortable("toArray");
					$("#setsort_input").attr("value",serial);	 
					},
					update : function ()
					{
					serial = $("#setsort").sortable("toArray");
					$("#setsort_input").attr("value",serial);
					}
	}); 
}


jQuery.fn.cboxDetail = function(detailval,fid,opt) {
var ggx=$(this);
ggx.html(detailval);

	ggx.find('a.save_cap_btn').click(function(event){ 
						ggx.addDxloader('');
							 $.ajax({
								 url: "./userfile/myfileupload_caption_save",
								type : 'POST', 
								dataType:'json',
								 data:  ggx.find('form.cp').serialize()+'&cid='+fid+'&up_type='+opt,
								success: function(jdata){
									ggx.reDxloader('');
								}  
				})
		
	 event.stopPropagation();
		})
		
}
jQuery.fn.cboxSetting = function(uid,opt) {
var uid=uid;
var opt=opt;
var ggx=$(this);	

var cbtn=$('#qfc_all');
cbtn.on('click',function() {
   if(cbtn.prop("checked")){
	  	ggx.find('.del_item').attr('checked', true);
	}else{
	  	ggx.find('.del_item').attr('checked', false);
	
	}
})


var delbtn=ggx.find('.delbtn');
delbtn.on('click',function(event){
	if(!confirm("Confirm?")) return false
	var del_id=$(this).data('fid');
	var tgdiv=$(this).data('tgid');
//	var opt=$(this).data('opt');
	ggx.addDxloader('');
	 $.ajax({
			type: 'POST',
			data:	{'del_id':del_id,"up_type":opt},
            url: './userfile/myfileupload_delone',
			dataType:'json',
			success: function(jdata){
				$(tgdiv).remove();	
				ggx.reDxloader();
				 //$('#myfile-list-cnt').loadUploadedFile(uid,opt);
			}
					
        });
		
	 event.stopPropagation();
})

var delallbtn=ggx.find('#delall');
delallbtn.on('click',function(event){
	if(!confirm("Confirm?")) return false
	var arr=[];
$("input.del_item:checked").each(function()
{
    arr.push($(this).val());
});
	var idlist = arr.join(",");
 
 	if(idlist!=''){
	ggx.addDxloader('');
	 $.ajax({
			type: 'POST',
			data:	{'del_list':idlist,"up_type":opt},
            url: './userfile/myfileupload_delmany',
			dataType:'json',
			success: function(jdata){ 
				ggx.reDxloader();
				 $('#myfile-list-cnt').loadUploadedFile(uid,opt);
			}
					
        });
	}
	 event.stopPropagation();
})


		  



var sortall=ggx.find('#sortall');
sortall.on('click',function(event){
 	var slist=$('#setsort_input').val();
	ggx.addDxloader('');
	 $.ajax({
			type: 'POST',
			data:	{'sort_list':slist,"up_type":opt},
            url: './userfile/myfileupload_sort',
			dataType:'json',
			success: function(jdata){ 
				ggx.reDxloader();
				 $('#myfile-list-cnt').loadUploadedFile(uid,opt);
			}
					
        }); 
		
	 event.stopPropagation();
})


	
var ggxIns=ggx;
//var infobtn=ggx.find('.infobtn');
//var showon=$(this).position().top;

ggx.find('.infobtn').each(function(){

$(this).click(function(event){
//var showon=$(this).offset().top-120;
var showon=Math.ceil($('window').height()*0.2);
var fid=$(this).data('fid'); 

/*
var mddiv='<div class="modal fade" id="myModal_inner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">  ';
mddiv+='<div class="modal-dialog" style="width:760px;"> <div class="modal-content">    <div class="modal-header">         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>  <h4 class="modal-title" id="myModalLabel">File Information: </h4>  </div><div class="modal-body">';
mddiv+='  <div style="width:720px;" id="cap-cnt"><div style="width:720px;" id="cap-cnt-detail"><p style="text-align:center"><img src="./static/admin/images/loading.gif" /></p></div></div></div>';
mddiv+='  </div></div></div>';
$("body").append( $(mddiv));
 
$("#myModal_inner").modal( {backdrop:"static" });

$("#myModal_inner .modal-dialog").css({'margin-top':'70px'});	

$("#myModal").css('opacity',0.5);
 	$.ajax({
 	 url: "./userfile/myfileupload_caption",
    type : 'POST', 
//	dataType:'json',
		 data:	{'id':fid,"up_type":opt},
	success: function(jdata){
		
		 
		 
		$("div#cap-cnt-detail").cboxDetail(jdata,fid,opt); 

 
		
	}  
		
		})
	$("#myModal_inner").on("hidden.bs.modal", function () {
	   $(this).remove();
	$("#myModal").css('opacity','');
	})
	*/


 ggxIns.block({ 
 themedCSS: { 
        width:  '740px', 
        top:    '10px', 
        left:   '50px' ,
    },
width:'720px', 
title:"File Information:",
theme:     true, 
 
 message: '<div style="width:720px;" id="cap-cnt"><div style="width:720px;" id="cap-cnt-detail"><p style="text-align:center"><img src="./static/admin/images/loading.gif" /></p></div></div><a class="btn" id="inline_closebtn">X</a></div>' ,

  onBlock: function() { 
  var uidiv=	$('#myfile-list-cnt .blockUI.blockMsg.ui-dialog');
		uidiv.css({top:showon});	
 		 
		 var addto= uidiv.find('.ui-widget-header');
		addto.append($('#inline_closebtn'));
	$.ajax({
 	 url: "./userfile/myfileupload_caption",
    type : 'POST', 
//	dataType:'json',
		 data:	{'id':fid,"up_type":opt},
	success: function(jdata){
		
		 
		$("div#cap-cnt-detail").html(jdata); 
		
		
		$('a.save_cap_btn').click(function(){ 
		
		$("div#cap-cnt-detail").addDxloader('');
		 $.ajax({
 	 url: "./userfile/myfileupload_caption_save",
    type : 'POST', 
	dataType:'json',
		 data:  $("div#cap-cnt-detail").find('form').serialize()+'&cid='+fid+'&up_type='+opt,
	success: function(jdata){
		
		$("div#cap-cnt-detail").reDxloader('');
		
	}  
		
		})
		
		})
	
	} 
	})


        $('#inline_closebtn').click(function() { 
            ggxIns.unblock(); 
            return false; 
        }); 
	

		
            } 
 });
	
 
	 event.stopPropagation();
	

})
})

	
	
	
	
	
}


    function startUpProcess(uid,opt){
	
	
	
	$('.clearbtn').on('click',function(){
	
	$('#fld_cont').empty();
	})
		  /*
	  var up_id=jscval.uid;
	  var up_type=jscval.opt;
	
			alert(up_type);	
			*/										
																			
 $("#fileupload").change(function (){
	 //$('#fld_cont').empty();
	 })
											
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
		autoUpload:true,
   
        url: './userfile/myfileupload'
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            './userfile/cors/result.html?%s'
        )
    );
	$('#fileupload').fileupload(
    'option',
    {
        sequentialUploads: true
    }
);

	$('#fileupload')
 .bind('fileuploadadd', function (e, data) {		 })
    .bind('fileuploadsubmit', function (e, data) {/* ... */			})
    .bind('fileuploadsend', function (e, data) {/* ... */	})
    .bind('fileuploaddone', function (e, data) {/* ... */	 		
	
	
			if(	$('.template-download').find('.label-important').length==0	){
	//cbox_deg();
//	asdDD.dialog('close');									 		 
	 
	}
			  	 })
    .bind('fileuploadfail', function (e, data) {/* ... */ })
    .bind('fileuploadalways', function (e, data) {/* ... */	})
    .bind('fileuploadprogress', function (e, data) {/* ... */		
	
	/*
	if($('.template-download').length>0){
		$('.template-download:first').remove();
	}
	*/
 /*
	if(this_uptype=='onefile'){
		if($('.template-download').length>0){
			$('.template-download:first').remove();
		}

	}
*/
	
 //alert(data.loaded);
	
	})
    .bind('fileuploadprogressall', function (e, data) {		  })
    .bind('fileuploadstart', function (e) {/* console.log('subbb all');	 */			/*$('#submitDiv').addDxloader();*/})
    .bind('fileuploadstop', function (e) {/* console.log('ok all'); */				/*$('#submitDiv').reDxloader(); */
	
console.log('uploaded')
$('#myfile-list-cnt').loadUploadedFile(uid,opt);

	 })
    .bind('processdone', function (e, data) {/* ... */	
	console.log('subbb 1')
		})
    .bind('fileuploadchange', function (e, data) {/* ... */})
    .bind('fileuploadpaste', function (e, data) {/* ... */})
    .bind('fileuploaddrop', function (e, data) {/* ... */})
    .bind('fileuploaddragover', function (e) {/* ... */})
    .bind('fileuploadchunksend', function (e, data) {/* ... */})
    .bind('fileuploadchunkdone', function (e, data) {/* ... */})
    .bind('fileuploadchunkfail', function (e, data) {/* ... */})
    .bind('fileuploadchunkalways', function (e, data) {/* ... */});
	
 		
/*
var pid= $(this).data('id');
$('#postid').val(pid);
*/
        $('#fileupload').addClass('fileupload-processing');
		
		/*
        $.ajax({
		//	data:{'postid':$('#postid').val()},
			//data:{'postid':pid , 'pageno':pageNo},
			  type: 'POST',
			data:	{'up_id':up_id,"up_type":up_type},
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0] 
			
        }).always(function (result) {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) { 
            $(this).fileupload('option', 'done')
                .call(this, null, {result: result}); 
				 
			//	$('#fld_cont').resizeThumb();
        });
		
		*/
		
	/*	
    }
	*/
 

 //}
 
 
 
 
 
	}
	
	
  jQuery.fn.loadUploadedFile = function(uid,opt) {
	var ggx=$(this); 
	ggx.addDxloader('');
	 $.ajax({
		//	data:{'postid':$('#postid').val()},
			//data:{'postid':pid , 'pageno':pageNo},
			  type: 'POST',
			 data:	{'up_id':uid,"up_type":opt},
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: './userfile/myfileupload_list',
					
			success: function(jdata){
				var crmh=  $('#myModal .modal-dialog').height() ;
				ggx.empty().append($(jdata));
				ggx.cboxSetting(uid,opt);
				ggx.setsort(); 
				//alert(ggx.height() + ' ' +$(window).height());
				if(	parseInt(ggx.height()) > 	  parseInt($(window).height() ) ){		
					$('#myModal').css({
						//'position':'absolute',
					//	'height': 	crmh+ggx.height()+700
						})		
					}
					$('body').removeClass('modal-open');
				
			}
					
        });

  }
  jQuery.fn.dtboxsSetup = function(uid,opt,title) {
var uid=uid;
var opt=opt;

var mddiv='<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style=" position:absolute; height:auto; overflow:auto">  ';
mddiv+='<div class="modal-dialog" style="width:860px;"> <div class="modal-content">    <div class="modal-header">         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>  <h4 class="modal-title" id="myModalLabel">'+title+' </h4>  </div><div class="modal-body">';
mddiv+='  <div style="width:830px;"><div id="upload-dp"  ><p  style="text-align:center"><img src="./static/admin/images/loading.gif" /></p></div><div id="myfile-list-cnt" class="loading" style="width:100%;padding:0"></div> </div>';
mddiv+='  </div></div></div>';
$("body").append( $(mddiv));
 
$("#myModal").modal( {backdrop:"static" });

 $('#myfile-list-cnt').loadUploadedFile(uid,opt);
 
 $.ajax({
 	 url: "./userfile/uploadbox",
    type : 'POST', 
//	dataType:'json',
		 data:	{'up_id':uid,"up_type":opt},
	success: function(jdata){
		
		 
		$("div#upload-dp").html(jdata);
 
		
		   startUpProcess(uid,opt);
	} 
})
	
$("#myModal").on("hidden.bs.modal", function () {
   $(this).remove();
	   
	   if( $('#tb-preview-div').length>0 ){
	$('#tb-preview-div').loadThumbPreview();
	}


})
	 // uploadbox
	 
	 /*
	  	var asd=Math.ceil(Math.random() * 110) ;
 $.blockUI({ 
     themedCSS: { 
        width:  '820px', 
        top:    '5%', 
        left:   '50%' ,
        'margin-left':   '-410px' 
    }, 
width:'820px;', 
 title:"asd",
    theme:     true, 
 
 message: '<div style="width:820px;"><div id="upload-dp"  ><p  style="text-align:center"><img src="../../images/loading.gif" /></p></div><div id="myfile-list-cnt" class="loading"></div><a id="closebtn">X</a></div>' ,
  //onOverlayClick: $.unblockUI ,
  onBlock: function() { 


		
		  $('.blockUI ').css( 'cursor', 'default' ); 
		  $('.blockUI.blockMsg.blockPage').css( 'position', 'absolute' ); 
		
		   $('#myfile-list-cnt').loadUploadedFile(uid,opt);

	$.ajax({
 	 url: "./userfile/uploadbox",
    type : 'POST', 
//	dataType:'json',
		 data:	{'up_id':uid,"up_type":opt},
	success: function(jdata){
		
		 
		$("div#upload-dp").html(jdata);
		
		   startUpProcess(uid,opt);
	} 
	})

		
            } 
			
			
			
 });
	
        $('#closebtn').click(function() { 
            $.unblockUI(); 
            return false; 
        }); 
		 */
	
 /*
sdf+='<p>   <input id="zbasicm" type="checkbox">   <label for="zbasicm">multi-file</label></p>';
sdf+='</form>';
sdf+='<p class="legend">Drop a file inside...</p>';
sdf+='</div>';

var fascx=$(sdf);

		$('#upload-dp').empty().append(fascx);*/
}

$(window).load(function(){ 
	
		 $('.btnOneFile, .btnManyFile').on('click',function(){ 
			var uid=$(this).attr('rel');
			var opt=$(this).data('opt');
			 var title=$(this).attr('title');
			if(uid>0){	
				$(this).dtboxsSetup(uid,opt,title);
			}
	
})


	})
