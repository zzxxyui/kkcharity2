function CKupdate(){
    for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
}



jQuery.fn.tabSetup = function() {
var ggx=$(this);

var mytab=ggx.find(".tab-pane");
	
if( mytab.length>0){ 
mytab.each(function(){
	
var ali=$("<li/>");
var adda=$("<a/>").attr({
	"data-toggle":"tab",
	"role":"tab",
	"href":"#"+$(this).attr("id") }).html($(this).data("title"));
ali.append(adda);
ggx.find(".nav.nav-tabs").append(ali);

})
ggx.find(".nav.nav-tabs a").click(function (e) {
  e.preventDefault()
  $(this).tab("show")
})
ggx.find(".nav.nav-tabs a:first").tab("show") ;
}	
	
	
}
	jQuery.fn.updateURLRW = function() {
var ggx=$(this);
var sdf=ggx.val();
sdf=sdf.replace(/[^0-9a-zA-Z-_]/g, '-');
ggx.val(sdf);
}

jQuery.fn.loadThumbPreview = function() {
var ggx= $(this);
var pid=ggx.data('id');
ggx.addDxloader();
	$.ajax({
 	 url: admin_path+'/process',
    type : 'POST',
 	dataType :'json',
    data :{'fld':fld,'action':'load_thumbpreview','id':pid},
	success: function(jdata){
	//	var css=parseInt(jdata.success);
 		ggx.html(jdata.msg)
		
		$('.item-btn').click(function(){
			var tgid=$(this).data('tagid');
			$('#'+tgid).click();
		})
	}
	})																				 
						 
		 

}
	
$(document).ready( function() { 
	
$("#url_rewrite").live('input paste',function(e){
    if(e.target.id == 'url_rewrite') {
		 $(this).updateURLRW();
    	setTimeout($(this).paste, 250);
    }
});

/*--------------Thumbnail preview----------*/

if( $('#tb-preview-div').length>0 ){
$('#tb-preview-div').loadThumbPreview();
}


/*--------------Thumbnail preview----------*/


$("a#Clone2LiveBtn").live('click',function(){
 
 var thisid=$(this).data('id');
 var thistitle='<span class="text-red">The files of the orginal item will be removed.</span>';
 var thismsg='<div id="Rpmsg"><p> <br/>Are you sure replace the Orginal item? <br/><strong>"'+thistitle+'"</strong></p><a id="startReplace" class="btn btn-info">Confirm</a></div> ';
 
 			var aftmsg=' <div class="modal-content">      <div class="modal-header">';
      aftmsg+='  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
          aftmsg+='  <h4 class="modal-title text-center" id="RpmsgmyModalLabel">'+thismsg+'</h4>';
        aftmsg+='  </div>    </div>';
		$("body").append( $('<div class="modal fade" id="RpmsgmyModal" tabindex="-1" role="dialog" aria-labelledby="RpmsgmyModalLabel" aria-hidden="true">  <div class="modal-dialog"> '+aftmsg+'    </div></div>'));


$('#startReplace').click(function(){
 
	$('#Rpmsg').addDxloader('Loading');
	
	
		$.ajax({
		 url: admin_path+"/process",
		type : 'POST',
		dataType :'json',
		data :{'action':'replace_clone_item','fld': fld,'tagid':thisid },
		success: function(jdata){
				//Sygrid.trigger("reloadGrid")
				$('#Rpmsg').empty().html(jdata.msg); 
				
				var css=parseInt(jdata.success);
				if(css==1){
					setTimeout(function(){ window.location.href=jdata.go2path	}, 1000);
				 }
		 }
		 
		
	})


})

			$("#RpmsgmyModal").modal({	backdrop:false}	);
	 
		$("#RpmsgmyModal").on("hidden.bs.modal", function () {
		 
		   $(this).remove();
		})
	
	
})







/*-------------------SORT----------------*/
if( $('#upcateSort').length >0 ){
	 
$('#upcateSort').click(function(){
	
$("#vforms").addDxloader();
	$.ajax({
 	 url: admin_path+'/process',
    type : 'POST',
 	dataType :'json',
    data :{'tag':fld,'action':'save_sort','sort_node_id':$('#sort_node_id').val(),'sort_val':$('#sorting').val()},
	success: function(jdata){
		var css=parseInt(jdata.success);
		if(css==1){
			$(this).showMsg('Saved');
			
					setTimeout(function(){ window.location.reload();	}, 800);
		}else{
			$(this).AlertMsg('Error');
		}
		
		$("#vforms").reDxloader();
	}
	})																				 
						 
		
	})	
}	
/*-------------------SORT----------------*/


	
	$('a.mypopover').popover({
		placement:'right',
		width:300,
		html:true
	});
$("#vforms").validate({
	submitHandler: function(form) {
		

		
var body = $("html, body");
body.animate({scrollTop:0}, '500', 'swing', function() { });
$("#vforms").addDxloader("Loading");
		
if( $("textarea.withckeditor").length>0){		
 CKupdate();
}

$.ajax({
 	 url: admin_path+"/process",
    type : "POST",
    dataType :"json",
    data :$("#vforms").serialize() + "&action=todb&fld="+fld,
	error: function(jdata){
		alert("Error");
	},
	success: function(jdata){
		var chc=parseInt(jdata.success)
		
$("#vforms").reDxloader();

		if(chc==1){			
					$("body").append( $('<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">  <div class="modal-dialog">   '+jdata.msg+'  </div></div>'));
					

					if(jdata.isreload==1){
					setTimeout(function(){	window.location.reload()		}, 1000);
					
					}

					if(jdata.notouchclose==1){
					$("#myModal").modal( {backdrop:"static" });
					}else{
					$("#myModal").modal({	backdrop:false}	);
					setTimeout(function(){	$("#myModal").modal("hide");		}, 2000);
					}
					$("#myModal").on("hidden.bs.modal", function () {
					 
					   $(this).remove();
					})
		}else{
			alert(jdata.msg);
		}

	}
})
		}//	submitHandler:
	});

});