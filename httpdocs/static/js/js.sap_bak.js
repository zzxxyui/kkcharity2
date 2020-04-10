
 jQuery.fn.oneUpload   = function(upcnt, card_cnt) {

 	// Variable to store your files
	var files;

	// Add events
	$('#file_upload').on('change', prepareUpload);
	$('#oneForm').on('submit', uploadFiles);

	// Grab the files and set them to our variable
	function prepareUpload(event)
	{
		files = event.target.files;
	}

	// Catch the form submit and upload the files
	function uploadFiles(event)
	{
		event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening

        // START A LOADING SPINNER HERE

        // Create a formdata object and add the files
		var data = new FormData();
		$.each(files, function(key, value)
		{
			data.append(key, value);
		});
         
			
        
			data.append('langcode', langcode);
			
			$(upcnt).addDxloader(); 
        $.ajax({
 			 url: this_root+"oimgUpload",
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(data, textStatus, jqXHR)
            {
				
			$(upcnt).reDxloader(); 
	var check_stt=parseInt(data.success); 
	if(check_stt==1){
		$(upcnt).html(data.msg);
		$(card_cnt).html(data.img);
		 
	}else{

		$("body").AlertMsg(data.msg);
	
	}
 
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            	// Handle errors here
            	//console.log('ERRORS: ' + textStatus);
				alert('ERRORS');
            	// STOP LOADING SPINNER
            }
        });
    }
	
	
 }
 
 jQuery.fn.oneUploadForm   = function() {  
 var ggx=$(this); 
 var uptxt=(langcode==1)?'Upload<br/>PROPOSAL':'上傳計劃書';
	 	var inccnt='  <div id="upimgCnt" class="clearfix  text-center mb20">	<form action="#" class="form-inline clearfix" enctype="multipart/form-data" id="oneForm" method="post">';
 
 
	  inccnt+='   <div class="col-xs-12 form-group">';
 	  inccnt+='   <div class="input-group">'; 
	  inccnt+='<input type="file" class="form-control inp-sm" style="font-size:11px;" name="file_upload" id="file_upload">';
 	  inccnt+='   </div>';
	  inccnt+=' <div class="col-xs-12 mt10"><button type="submit" class="btn btn-primary radBtn" style="padding:10px 30px 10px 30px; text-transform:uppercase; line-height:20px">'+uptxt+'</button> </div>';
 	  inccnt+='  </div>';
	  inccnt+='  </form>  </div>';
	
ggx.append( $(inccnt)	);
					 
	
	$('#upimgCnt').oneUpload( '#upimgCnt',ggx );
 		
			
		 
 }
 

$(document).ready(function(){ 
$('#sapUpForm').oneUploadForm();
})