/*
 * jQuery File Upload Plugin JS Example 8.0
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global $, window, document */

$.fn.serializeObject = function() {
    var data = { };
    $.each( this.serializeArray(), function( key, obj ) {
        var a = obj.name.match(/(.*?)\[(.*?)\]/);
        if(a !== null)
        {
            var subName = new String(a[1]);
            var subKey = new String(a[2]);
            if( !data[subName] ) data[subName] = { };
            if( data[subName][subKey] ) {
                if( $.isArray( data[subName][subKey] ) ) {
                    data[subName][subKey].push( obj.value );
                } else {
                    data[subName][subKey] = { };
                    data[subName][subKey].push( obj.value );
                };
            } else {
                data[subName][subKey] = obj.value;
            };  
        } else {
            var keyName = new String(obj.name);
            if( data[keyName] ) {
                if( $.isArray( data[keyName] ) ) {
                    data[keyName].push( obj.value );
                } else {
                    data[keyName] = { };
                    data[keyName].push( obj.value );
                };
            } else {
                data[keyName] = obj.value;
            };
        };
    });
    return data;
};
 
jQuery.fn.addFormVal = function(Myarray) {
	var ggx=$(this);
	ggx.find('.tmp-input').remove();
$.each(Myarray,function(key,val){
	
	ggx.append( $('<input class="tmp-input" name="'+key+'" value="'+val+'" type="hidden"/>'));
	})



}
jQuery.fn.resizeThumb = function() {


	$(this).find('dl dd.dd-preview').each(function(){
		
	var th_w=$(this).width();		
	var th_h=$(this).height();	
	var tmg=$(this).find('img');
	//tmg.remove();
	var m_w=tmg.width();		
	var m_h=tmg.height();	
		if(m_w>th_w || m_w>m_h ){
				if(m_w>m_h){
					tmg.css({
						width:th_w,
						height:m_h*(th_w/m_w)
						}) ;
						
					tmg.attr('width',th_w);
					tmg.attr('height',m_h*(th_w/m_w));
				}else{
				}
		}
		
		
	});
 
		

}
 
 
 function startUpProcess( ){
var item_arr=''; 
	
	$('#fld_cont').empty();
	
	var ggx=$(this);
	var this_uptype=ggx.data('setuploadtype');
	
	item_arr={
	'postid':ggx.data('postid'),
	'setuploadtype':this_uptype,
	'upload_tb':ggx.data('upload_tb'),
	'tbval':ggx.data('tb_val'),
	'rename_val':ggx.data('rename'),
	'folder_val':ggx.data('folder'),
	'max_w':ggx.data('max_w'),
	'max_h':ggx.data('max_h'),
	'thumbnail':ggx.data('thumbnail'),
	'thumbnail_max_w':ggx.data('thumbnail_max_w'),
	'thumbnail_max_h':ggx.data('thumbnail_max_h'),
	'key_val':ggx.data('sp_field'),
	'file_mode':ggx.data('file_mode'),
	'sp_field':ggx.data('sp_field'),
   //'caption':ggx.data('caption')
	};
	var inputFtype=(ggx.data('setuploadtype')=='manyfile')?'multiple':'onefile';
	 $('#fileupload input[type=file]').attr(inputFtype,inputFtype);
	
	
	 $("#fileupload").addFormVal(item_arr);
	
	var tagImgBoxDiv=$(ggx.data('tagdiv'));
 	
	var tagImgBoxDiv_parm=[];
	tagImgBoxDiv_parm[0]=ggx.data('postid');
	tagImgBoxDiv_parm[1]=ggx.data('upload_tb');
	tagImgBoxDiv_parm[2]=ggx.data('tb_val');
	tagImgBoxDiv_parm[3]=ggx.data('sp_field');
	var post_cap=ggx.data('caption').replace(/\\/g, '');
	tagImgBoxDiv_parm[4]= post_cap;
	
	tagImgBoxDiv_parm[5]=ggx.data('setuploadtype');
	
	// alert(post_cap);
	/*
	var item_Json = JSON.stringify(item_arr);
	item_Json=item_Json.replace(']','');
	item_Json=item_Json.replace('[','');
	item_Json = item_Json.replace(/"/g, "'");
		alert(item_Json);			 */			
	 asdDD=	$( '#uploadBox').dialog({
																				title:$(this).attr('title'),
																	 		'z-index':30000,
																				//resizable:false,
																				draggable:true,
																				autoOpen: true,
																				modal: true, width:'820px',position:['center',150], 
																				open: function(){
																					 
		
																					$('a.close2res').click(function(){
																						asdDD.dialog('close');
																						loaditemTable();
																					})
																				 },
																				close: function(ev, ui) {
																					
																				tagImgBoxDiv.updateUIMG(tagImgBoxDiv_parm[0],tagImgBoxDiv_parm[1],tagImgBoxDiv_parm[2],tagImgBoxDiv_parm[3],tagImgBoxDiv_parm[4],tagImgBoxDiv_parm[5]);
																					
																			//	$(this).remove(); 
																				/*	$(this).close();*/
																					return false;
																				 }
	})
				
				
													
																			
 $("#fileupload").change(function (){
	 //$('#fld_cont').empty();
	 })
											
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
		autoUpload:true,
        url: '../userfile/'
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '../userfile/cors/result.html?%s'
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
			alert('asd')
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