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

$(function () {
   // 'use strict';

$('.sttupp').live('click',function(){
	
	
		$( '#fileupload').dialog({
																				title:$(this).data('name'),
																			//	'z-index':30000,
																				//resizable:false,
																				draggable:true,
																				autoOpen: true,
																				modal: true, width:'820px',position:['center',150], 
																				open: function(){
																					 
		
																					
																				 },
																				close: function(ev, ui) {
																					
																			//	$(this).remove(); 
																				/*	$(this).close();*/
																					return false;
																				 }
	})
																			
																			
																			
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
		autoUpload:true,
        url: 'userfile/'
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
	$('#fileupload')
 .bind('fileuploadadd', function (e, data) {			$('#fld_cont').empty();})
    .bind('fileuploadsubmit', function (e, data) {/* ... */})
    .bind('fileuploadsend', function (e, data) {/* ... */		})
    .bind('fileuploaddone', function (e, data) {/* ... */		loaditemTable();	})
    .bind('fileuploadfail', function (e, data) {/* ... */ })
    .bind('fileuploadalways', function (e, data) {/* ... */	})
    .bind('fileuploadprogress', function (e, data) {/* ... */		})
    .bind('fileuploadprogressall', function (e, data) {/* ... */	  })
    .bind('fileuploadstart', function (e) {/* console.log('subbb all');	 */			$('#submitDiv').addDxloader();})
    .bind('fileuploadstop', function (e) {/* console.log('ok all'); */				$('#submitDiv').reDxloader(); 
	
															loaditemTable();
	
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

    if (window.location.hostname === 'blueimp.github.com' ||
            window.location.hostname === 'blueimp.github.io') {
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: '//jquery-file-upload.appspot.com/',
            disableImageResize: false,
            maxFileSize: 5000000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '//jquery-file-upload.appspot.com/',
                type: 'HEAD'
            }).fail(function () {
                $('<span class="alert alert-error"/>')
                    .text('Upload server currently unavailable - ' +
                            new Date())
                    .appendTo('#fileupload');
            });
        }
    } else {
        // Load existing files:
		
*/		
var pid= $(this).data('id');
$('#postid').val(pid);
        $('#fileupload').addClass('fileupload-processing');
        $.ajax({
		//	data:{'postid':$('#postid').val()},
			data:{'postid':pid},
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function (result) {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
			$('#fld_cont').empty();
            $(this).fileupload('option', 'done')
                .call(this, null, {result: result});
				
				
        });
		
	/*	
    }
	*/

})



});
