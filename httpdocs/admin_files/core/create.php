<?php

//print_r($this->MyConfig);
/*
if($this->user_lv>ceil($this->MyConfig['menuList']['create']['lv'])	||	$this->user_lv>$this->MyConfig['menuList']['edit']['lv']){
exit;
}
 */
  
 
foreach($this->MyConfig['menuList'] as	$mkey=>$ml){
	
	if( $data['action']==$mkey){
		if($this->user_lv>$ml['lv']) exit();
	}

}
 /*
$this->edit_page_type
$this->submitBtnName=($this->submitBtnName!='')?$this->submitBtnName:'Create';
*/

/*
if(!$IS_EDIT){
	if($this->user_lv>ceil($this->MyConfig['menuList']['create']['lv'])	){
	exit;
	}else{
		
		 include('core/inc.seo_val.php');
		$create_seo_array=$this->seo_array_create;

	}
}else{
	if(	$this->user_lv>$this->MyConfig['menuList']['edit']['lv']){
	exit;
	}
}
*/
/*
	if($this->itemid>0){
		include_once('upload_inc.php');
	}else{
		//$upinc_content='<p>Please create an item first.</p>';
		$upinc_content='<p>'.$this->MyConfig['uploadImage']['upload_opt']['create_msg'].'</p>';
	}
	
print_r( Session::all());
*/

// include('core/upload_inc_onEDIT.php');

// include('core/optionlist_inc_onEDIT.php');
$bkbtn=($this->MyConfig['tag']!='one_page')?'<input type="button" value="Back" class="btn btn-default" onclick="window.history.go(-1); return false;"/>':'';
$Clone2liveBtn='';
$this->is_clone=false;
$cps_title='';
if( isset($this->MyConfig['clone'])	&& $this->MyConfig['clone']['onoff']==true &&	$this->edit_page_type=='edit'){
$is_clone = DB::table($this->MyConfig['tableName'])->select('clone_by')->where('id', $this->itemid)->first();
	if($is_clone->clone_by>0){
			$this->is_clone=true;
			 $cps_title='&nbsp;<small class="fs14">(CLONE)</small>';
			$Clone2liveBtn='&nbsp;<a id="Clone2LiveBtn" class="btn btn-success" data-id="'.$this->itemid.'">Relace Original Item</a>';
			
			
$this->pageJsAndCss.='<script type="text/javascript">
$(document).ready(function(){ $(".navbar-header").addClass("clone"); })
</script>
';


	}
}



//$form_val='<p>&nbsp;</p>'.$this->Layout_edit_form_val();
$form_val=$this->Layout_edit_form_val();

switch($this->edit_page_type){
	case 'edit':
	$sbtn='	<button   type="submit"  class="btn btn-primary btn-lg btn-block"><i class="fa fa-save fa-lg"></i>&nbsp;&nbsp; Save</button>	';
	break;
	case 'create':
	$sbtn='	<button   type="submit"  class="btn btn-success btn-lg btn-block"><i class="fa fa-save fa-lg"></i>&nbsp;&nbsp; Create</button>	';
	
	break;
}




$get_save_right= (isset($this->MyConfig['userright']['save']['lv']))?$this->MyConfig['userright']['save']['lv']:1;
$canSave= ( 	$get_save_right>=$this->user_lv)?true:false  ;
if(!$canSave){
	$sbtn='';
}		
			
$save_area='

<div class="row">
  <div class="col-md-4">&nbsp;
  </div>
  <div class="col-md-4">
  <p class="text-center">'.$sbtn.'</p>
  </div>
  <div class="col-md-4">
  <p class="pull-right">'.$bkbtn.'</p>
  </div>
</div>
  
								
								
';
 	
								
								
								
								
/*	'.(($this->MyConfig['tag']!='one_page')?'<div class="grid_6"><p class="p_left"><input type="button" value="'.$this->txt['back'].'" class="minbutton mid backbtn" /></p></div>':'<div class="grid_6">&nbsp;</div>').'*/
/*

$base_tab=1;
$seo_tab='';
//$this_page_content.='</div>';	
if($this->MyConfig['seo_val']['seo']&& $this->itemid==0){
$this->seotype='url_only';
}

include_once('seo_part.php'); 
if($this->MyConfig['seo_val']['seo'] && $this->itemid>0 ){  
if($this->MyConfig['seo_val']['seotype']!='')	$this->seotype=$this->MyConfig['seo_val']['seotype'];

$this->pageJsAndCss.='<script type="text/javascript" src="'.ADMIN_PATH.'js/js.seo_form.js"></script>';
$base_tab=$base_tab+5;
 
}


if($sub_page_content!=''){
$base_tab=$base_tab+11;
} 


$this_page_content='

<div class="box">
					<h2>
						<a href="#" id="toggle-forms" class="edpage_title">'.$this->MyConfig['pageName'].' -> '.$this->title.'</a>
					</h2>
					<div class="block" id="forms">
						<form id="vforms">
								'.$form_val.'
								'.$seo_create_content.'
								<div class="clear"></div>	
								<div class="grid_12"><p class="p_left pt10"><input type="submit" value="'.$this->submitBtnName.'" class="'.$this->submitBtnName.' mbtn minbutton mid" /></p></div>
						</form>
					</div>
</div>'; 

switch($base_tab){
case '17':
		$this_page_content='
	
	<div id="sp_tab"><div id="sp_tab_menu">
			<a class="tb1"  data-tid="#sp_tab_1">Item Information</a>
			<a class="tb2"   data-tid="#sp_tab_2">Upload File / Image</a>
			<a class="tb3"   data-tid="#sp_tab_3">SEO setting</a>
	</div>
			<div id="sp_tab_1" class="sp_tab_content">'.$this_page_content.'</div>
			<div id="sp_tab_2"  class="sp_tab_content">'.$sub_page_content.'</div>
			<div id="sp_tab_3"  class="sp_tab_content">'.$seo_tab.'</div>
	</div>
	';
			
break; 
case '12':
		$this_page_content='
	
	<div id="sp_tab"><div id="sp_tab_menu">
			<a class="tb1"  data-tid="#sp_tab_1">Item Information</a>
			<a class="tb2"   data-tid="#sp_tab_2">Upload File / Image</a>
	</div>
			<div id="sp_tab_1" class="sp_tab_content">'.$this_page_content.'</div>
			<div id="sp_tab_2"  class="sp_tab_content">'.$sub_page_content.'</div>
	</div>
	';
		
break;	
case '6':
 
	$this_page_content='
	
	<div id="sp_tab"><div id="sp_tab_menu">
			<a class="tb1"  data-tid="#sp_tab_1">Item Information</a>
			<a class="tb2"   data-tid="#sp_tab_2">SEO setting</a>
	</div>
			<div id="sp_tab_1" class="sp_tab_content">'.$this_page_content.'</div>
			<div id="sp_tab_2"  class="sp_tab_content">'.$seo_tab.'</div>
	</div>
	';
			
break;
default:
$this_page_content='
	<div id="sp_tab"><div id="sp_tab_menu">
			<a class="tb1"  data-tid="#sp_tab_1">Item Information</a>
	</div>
			<div id="sp_tab_1" class="sp_tab_content">'.$this_page_content.'</div>
	</div>
';

}*/
 $previewmode_div='';
if( isset($this->MyConfig['preview_mode']['onoff']) && $this->MyConfig['preview_mode']['onoff']==true	&&	$this->edit_page_type=='edit'){
	$pmkey=$this->MyConfig['preview_mode']['link_key'];
$pm_val = DB::table($this->MyConfig['tableName'])->select('id','status',$pmkey)->where('id', $this->itemid)->first();	
$pm_msg=($pm_val ->status==0)?'Preview Page':'View Page';
$pm_btn=($pm_val ->status==0)?'btn btn-warning ':' btn-success';
 $previewmode_div='&nbsp;&nbsp;<a class="btn '.$pm_btn.'" href="'.$this->MyConfig['preview_mode']['base_link'].'/'.$pm_val->$pmkey.'" target="_blank" >'.$pm_msg.'</a>';
}
// <small>('.$this->title.')</small>
$inn_page_title=($this->MyConfig['tag']=='one_page')?$this->title:$this->MyConfig['pageName'].'';		
	
	
$ofn=( isset($this->MyConfig['other_function']) ?$this->MyConfig['other_function']:false);	



$this_page_title='

<div class="p1010em row m0 p0 clearfix">

 
<div class="col-xs-12  col-sm-12 col-md-3 col-lg-3  m0 p0">
  
			<h2 class="m0 pull-left" >'.$inn_page_title.$cps_title.'</h2><div class="m0 pull-left"></div>
</div>


  <div class="col-xs-12  col-sm-12 col-md-9 col-lg-9   m0 p0">
  
			<div class="btn-group   pull-right " style="display:inline-block; width:auto; margin-left:10px">
			'.$this->load_OtherFunctionBtn ($ofn,$this->edit_page_type).'
			 
			</div>
			 
			
			<div class="btn-group  pull-right "> '.$previewmode_div.''.$Clone2liveBtn.'</div>
			
			</div>
</div>
'; 

$thumbPreview=($this->have_fileupload==true && $this->edit_page_type=='edit')?'<div class="tb-preview-div clearfix"  id="tb-preview-div" data-id="'.$this->itemid.'"></div>':'';
	
	$sub_page_content='';
include_once('admin_files/core/optionlist_inc_onEDIT.php');
	
$this_page_content='


<div class="row">
  <div class="col-xs-12  col-sm-10 col-md-10 col-lg-10  ">

		
'.$this_page_title.'

	<form id="vforms" 	class="form-horizontal" role="form">
								'.$form_val.'
								'.$sub_page_content.'
								'.$save_area.'
	</form>
		
	<p>&nbsp;</p>
	<p>&nbsp;</p>
  </div>
  
		  <div class="col-xs-12  col-sm-2 col-md-2 col-lg-2  ">
		
		  
		'.$thumbPreview.'
		
		  </div>

  </div>
</div>';

 
 
 
	/*
if($this->form_nav!=''){

 
<nav class="navbar navbar-default navbar-fixed-top " style="margin-bottom: 0;" role="navigation">
<h2>'.$this->MyConfig['pageName'].'</h2>
</nav>

 
$this_page_content='


<div class="row">
  <div class="col-xs-10 ">

		
'.$this_page_title.'

	<form id="vforms" 	class="form-horizontal" role="form">
								'.$form_val.'
								'.$save_area.'
	</form>
		
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
  </div>
  
  <div class=" col-xs-2  ">

  
'.$thumbPreview.'


  </div>
</div>';

 
			  <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix" role="complementary">
					<ul class="nav bs-docs-sidenav">
					'.$this->form_nav.'
					</ul>
				</div>
 
}else{





$this_page_content='
'.$this_page_title.'
'.$thumbPreview.'
	<form id="vforms" 	class="form-horizontal" role="form">
								'.$form_val.'
								'.$save_area.'
	</form>
	
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
</div>';

	
}
*/














/*<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/jupload/plus/bootstrap.min.js').'	"></script> */ 
$this->pageJsAndCss.='

<script type="text/javascript">var file_base="'.$this->myurl($this->admin_file).'"</script>
<link rel="stylesheet" type="text/css" href="'.$this->myurl($this->admin_file.'js/ui/jquery-ui-1.10.3.custom.css').'" />   
<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/ui/jquery-ui-1.10.3.custom.min.js').'	"></script>
<link rel="stylesheet" type="text/css" media="screen" href="'.$this->myurl($this->admin_file.'css/css.override.css').'" /> 
';
if($this->have_seosetting) $this->pageJsAndCss.=  '<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/js.otherfunction.js').'	"></script> ';
if($this->have_fileupload){

$this->pageJsAndCss.='
 
<link rel="stylesheet" type="text/css" href="'.$this->myurl($this->admin_file.'js/jupload/bootstrap.custom.css').'" />
<!-- Bootstrap Image Gallery styles -->
<link rel="stylesheet" type="text/css" href="'.$this->myurl($this->admin_file.'js/jupload/plus/bootstrap-image-gallery.min.css').'" />  
<link rel="stylesheet" type="text/css" href="'.$this->myurl($this->admin_file.'js/jupload/css/jquery.fileupload-ui.css').'" />  
<link rel="stylesheet" type="text/css" href="'.$this->myurl($this->admin_file.'js/jupload/css/csupload.css').'" />  
<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/jupload/vendor/jquery.ui.widget.js').'	"></script>  
<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/jupload/plus/tmpl.min.js').'	"></script>  
<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/jupload/plus/load-image.min.js').'	"></script>  
<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/jupload/plus/canvas-to-blob.min.js').'	"></script>  

<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/jupload/plus/bootstrap-image-gallery.min.js').'	"></script>  
 
<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/jupload/jquery.iframe-transport.js').'	"></script> 
<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/jupload/jquery.fileupload.js').'	"></script>  
<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/jupload/jquery.fileupload-process.js').'	"></script>  
<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/jupload/jquery.fileupload-resize.js').'	"></script>  
<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/jupload/jquery.fileupload-validate.js').'	"></script>   
<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/jupload/jquery.fileupload-ui.js').'	"></script>   

<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/jquery.blockUI.js').'	"></script> 
<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/jupload/js.upload.js').'	"></script> ';
}



/*
$this->pageJsAndCss.=($this->MyConfig['tag']=='one_page')?'<script type="text/javascript">
$(document).ready(function(){ 
var haveCr=$(".menu a.hover");
if(haveCr.length>0){
$(".edpage_title").html( haveCr.text())
}

})

</script>':'';*/
	

$this->pageJsAndCss.=$this->AJAX_valideform($this->MyConfig['tag']);
//$this->page_mainMenu= $this->Layout_SideMenu($this->inc_list);
$this->page_mainContent=$this_page_content;
//require_once('page/inc_baseFrame.php');
//$this->this_page_body=$this_page_body;
//require_once('page/inc_admin_home.php');

//$this->pageJsAndCss.=$this->last_pageJsAndCss;
?>