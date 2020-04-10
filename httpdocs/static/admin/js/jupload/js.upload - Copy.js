
    function startUpProcess(){
	
	
	
	
				
													
																			
 $("#fileupload").change(function (){
	 //$('#fld_cont').empty();
	 })
											
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
		autoUpload:true,
   
        url: '../../userfile/myfileupload'
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '../../userfile/cors/result.html?%s'
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
 
	if(this_uptype=='onefile'){
		if($('.template-download').length>0){
			$('.template-download:first').remove();
		}

	}

	
 //alert(data.loaded);
	
	})
    .bind('fileuploadprogressall', function (e, data) {		  })
    .bind('fileuploadstart', function (e) {/* console.log('subbb all');	 */			/*$('#submitDiv').addDxloader();*/})
    .bind('fileuploadstop', function (e) {/* console.log('ok all'); */				/*$('#submitDiv').reDxloader(); */
	

		
	 })
    .bind('processdone', function (e, data) {/* ... */	
	
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
        $.ajax({
		//	data:{'postid':$('#postid').val()},
			//data:{'postid':pid , 'pageno':pageNo},
			data:	item_arr,
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
				 
				$('#fld_cont').resizeThumb();
        });
		
	/*	
    }
	*/
 

 //}
 
 
 
 
 
	}
  jQuery.fn.dtboxsSetup = function() {
	 // uploadbox
	  	var asd=Math.ceil(Math.random() * 110) ;
 $.blockUI({ 
 title:"asd",
    theme:     true, 
 message: '<div><div id="upload-dp"><img src="../../images/loading.gif" /></div><a id="closebtn">close</a></div>' ,
  //onOverlayClick: $.unblockUI ,
  onBlock: function() { 
               $.ajax({
 	 url: "../../gmap",
    type : 'POST', 
	dataType:'json',
	success: function(jdata){
		  $('.blockUI ').css( 'cursor', 'default' );
		
	 
	$.ajax({
 	 url: "../../userfile/uploadbox",
    type : 'POST', 
//	dataType:'json',
	success: function(jdata){
		
		 
		$("div#upload-dp").html(jdata);
		
		   startUpProcess();
		
	} 
	})

		 
	
	}
			   })
		
		
            } 
			
			
			
 });
	
        $('#closebtn').click(function() { 
            $.unblockUI(); 
            return false; 
        }); 
	
 
sdf+='<p>   <input id="zbasicm" type="checkbox">   <label for="zbasicm">multi-file</label></p>';
sdf+='</form>';
sdf+='<p class="legend">Drop a file inside...</p>';
sdf+='</div>';

var fascx=$(sdf);

		$('#upload-dp').empty().append(fascx);
}
  jQuery.fn.dtboxsSetup4 = function(passdata) {
	var asd=Math.ceil(Math.random() * 110) ;
 $.blockUI({ message: '<div><div id="upload-dp"><img src="../../images/loading.gif" /></div><a id="closebtn">close</a></div>' ,
  //onOverlayClick: $.unblockUI ,
  onBlock: function() { 
            
			
		  $('.blockUI ').css( 'cursor', 'default' );
		
		//var fascx=$('<div id="zbasic"><p style="position: relative; z-index: 1">    <input name="tbval" value="asd" type="text"/>     </p>  <input id="zbasicm" type="checkbox">     </p></div>');
	
var sdf='<div id="zbasic">';
sdf+='<iframe name="wrapFrame" src="javascript:false"  id="wrapFrame" style="display: none"></iframe>';
sdf+='<form enctype="multipart/form-data" method="post" target="wrapFrame">';
sdf+='<input type="hidden" name="fd-callback">';
sdf+='<input type="file" name="fd-file" class="fd-file">';

	
	 var psd='?uid='+passdata['uid'];
		 psd+='&tbval='+passdata['tbval'];
	 var options = {iframe: {url: '../../userfile/myfileupload'}};
var zone = new FileDrop('zbasic', options)
	 
	 if( fd.byID('zbasicm').checked){
		
zone.multiple(true)
		}else{
		
zone.multiple(false)
		}
	
zone.event('send', function (files) {
  files.each(function (file) {
    file.event('done', function (xhr) {
      alert(xhr.responseText)
    })

    file.sendTo('../../userfile/myfileupload'+psd);
  })
})
	 /*
  var options = {iframe: {url: '../../userfile/myfileupload'}};
var zone = new FileDrop('zbasic', options);

zone.event('send', function (files) {
  files.each(function (file) {
    file.event('done', function (xhr) {
      alert('Done uploading ' + this.name + ',' +
            ' response:\n\n' + xhr.responseText);
    });

    file.event('error', function (e, xhr) {
      alert('Error uploading ' + this.name + ': ' +
            xhr.status + ', ' + xhr.statusText);
    });

    file.sendTo('../../userfile/myfileupload'+psd);
  });
  
});
*/

// <iframe> uploads are special - handle them.
zone.event('iframeDone', function (xhr) {
  alert('Done uploading via <iframe>, response:\n\n' + xhr.responseText);
});

// Toggle multiple file selection in the File Open dialog.
fd.addEvent(fd.byID('zbasicm'), 'change', function (e) {
  zone.multiple((e.currentTarget || e.srcElement).checked);
});






		
            } 
			
			
			
 });
	
        $('#closebtn').click(function() { 
            $.unblockUI(); 
            return false; 
        }); 
	
 
}

 

jQuery.fn.dtboxsSetup2 = function() {
	var asd=Math.ceil(Math.random() * 110) ;
 $.blockUI({ message: '<div><div id="upload-dp"><img src="../../images/loading.gif" /></div><a id="closebtn">close</a></div>' ,
  //onOverlayClick: $.unblockUI ,
  onBlock: function() { 
               $.ajax({
 	 url: "../../gmap",
    type : 'POST', 
	dataType:'json',
	success: function(jdata){
		  $('.blockUI ').css( 'cursor', 'default' );
		
		var fascx=$('<div id="upload-cnt'+asd+'" class="dropzone">asdsd</div>');
		$('#upload-dp').empty().append(fascx);
	 
		 $("div#upload-cnt"+asd).dropzone({ url: "../../userfile/myfileupload" });
	 
	
	}
			   })
		
		
            } 
			
			
			
 });
	
        $('#closebtn').click(function() { 
            $.unblockUI(); 
            return false; 
        }); 
	
 
}





	/*
$.ajax({
 	 url: "../../gmap",
    type : 'POST', 
	dataType:'json',
	success: function(jdata){
		
		
		var fascx=$('<div id="upload-dp" class="dropzone"/>');
		$('#upload-ajax-cnt').append(fascx);
		$("div#upload-dp").dropzone({ url: "../../userfile/myfileupload" });
		
		
		
	}*/



$(window).load(function(){
 
if( $('.sttbtn.loaded').length>0){
	
	 $('.sttbtn.loaded').on('click',function(){ 
			var uid=$(this).attr('rel');
			var tbval=$(this).data('tbval');
			var jsc={
			'uid':uid,
			'tbval':tbval
			};
			if(uid==0){
				alert(' please create item first');
			}else{
			$(this).dtboxsSetup(jsc);
			}
	
})
	
}
	
	



	})
