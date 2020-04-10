
jQuery.fn.loadProjectList = function() {

$(this).one('click',function(){
	var ggx=$(this);
var mypage=$(this).data('page');
var year=$(this).data('year');
var ptype=$(this).data('ptype');
ggx.parent().addDxloader();

var tggpid='#projectListCnt'+ptype;
	 $.ajax({
				  url: this_root+ "process",
				 type: "POST",
				  dataType: 'json',
				  data: { 'langcode':langcode, 
				  'action':'loadProjectList',
				  'year':year,
				  'page':mypage,
				  'ptype':ptype
				  },
				  success: function(jdata){ 
ggx.parent().reDxloader();
				  ggx.remove();
				  $(tggpid).append( $('<div class="col-xs-12 mb10">&nbsp;</div>'));
				  $(tggpid).append( $(jdata.msg));
  				 $(tggpid+' .lmBtn a').loadProjectList();
				  
				  
				  },error:function(jqXHR, status, error){
				  $('body').AlertMsg(error ); 
				  }
				  
	 })
})


}


$( document ).ready(function() { 


if($(window).width()<768){
$('#pj_tab_cnt li a').click(function(){
	if( $(this).parent().hasClass('active')){
		if( $(this).parent().parent().parent().hasClass('showmenu')){
			$('#pj_tab_cnt').removeClass('showmenu');	
		}else{
			$('#pj_tab_cnt').addClass('showmenu');	
		}
	}else{
	$('#pj_tab_cnt').removeClass('showmenu');	
	}
})

	
}

if(   $(".aw_ty_btn").length>0){
        jQuery("a.aw_ty_btn").YouTubePopUp();
}		
		
if(   $(".tyBtn").length>0){
  $(".tyBtn").click(function(){
var tg=$('#'+ $(this).data('tgdiv') );
	 tg.html( $(this).attr('title') );
	 })
}


if(   $("#pj_tab_cnt").length>0){
	 var url = document.location.toString();
	if (url.match('#')) {
		$('#pj_tab_cnt .nav-tabs a[href="#' + url.split('#')[1] + '_tab"]').tab('show');
	} 
	
	// Change hash for page-reload
	$('#pj_tab_cnt .nav-tabs a').on('shown.bs.tab', function (e) {
		//e.preventDefault() ;
	   // window.location.hash = e.target.hash;
	})
}


if(   $(".pimg").length>0){

    $("a[rel^='pimg']").prettyPhoto({
	social_tools:null	
	});
}



if(   $(".lmBtn").length>0){

   $('.lmBtn a').loadProjectList();
}




});