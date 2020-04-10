<?php


class frontEndController extends frontEndFuncController {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	 
    protected  $layout = 'inner_view'; 
    protected $psetting = '';
		 
	var $filepath_ur;
	var $filepath_dir;
	var $linkbase;

	var $sysval;
 
var $Cat_subLv=array();
var $Cat_cnfLV=array();
var $Cat_crid='';

var $form_setting;

var $lang_name;
var $lang;
var $h1_value;
var $site_url='#';
var $footer_arr=array();
var $footer_pd_arr=array();
 
var $pd_cat_arr=array();
var $pd_cat_onoff=false;
 

var $vc_val=0;
var $ishome=0;
var $pjs_loaded=0; 
	 
	 	public function clearfixide($pid,$tt='' ){
	
			$cng_arr=Config::get('gbkey.project_slide_manyfile');
		 $thumb='';
		 $nav='';
		$results=	 DB::table( $cng_arr['table']  )->
		where('tb_val',$cng_arr['tb_val']  ) ->
		where('sp_field',$cng_arr['sp_field'] 	 ) ->
		where('parent_id',$pid 	 ) ->
		orderBy('rank', 'asc')->get();		 
 
		if (count($results )>0){
					$thumb='';
					$vv=0;
			foreach ($results as $ms) { 

 


				  	$thumb_path=$ms->full_path;
					 
					if( file_exists($this->filepath_dir.$thumb_path)  ){
 
$activ=($vv==0)?' active" ':'';
 // $nav.='  <li data-target="#carousel-wd-generic" data-slide-to="'.$vv.'" class="'.$activ.'" ></li>';
 

 $this_link=( str_is('*http*',$ms->caption1)    )? ' class="aw_ty_btn " href="'.$ms->caption1.'" ':' href="'.$this->filepath_url.$thumb_path.'" class="  wdlist  pimg"  rel="pimg[slideshow]" '; 
  $this_link_plus=( str_is('*http*',$ms->caption1)    )?'<span class="playicon">&nbsp;</span>':'';
					$thumb.='<div class="item  "><a  '. $this_link.' title="'.$tt.'"><img  class="img-responsive  "  style="  margin:0 auto" src="'.$this->filepath_url.$thumb_path.'"   alt="'.$tt.'"/>'.  $this_link_plus.'
							</a>
			
						</div>';
				
					$vv++;
					}
			}}
			 
					return $thumb;
	}
	
	public function load_banner(){

 
 	switch($this->lang){
	case 1:
	$tlang='title'.$this->lang;
	$fdKey='ff_thumb'.$this->lang;
	$key_cng='banner1_onefile';
	$LinkKey='linkto'.$this->lang;
	$fdKey_other='ff_thumb2';
	
	$mb_fdKey='ff_thumb_mb'.$this->lang;
	$mb_key_cng='banner_mb1_onefile'; 
	
	
	break;
	case 2:
	$tlang='title'.$this->lang;
	$fdKey='ff_thumb'.$this->lang;
	$key_cng='banner2_onefile';
	$LinkKey='linkto'.$this->lang;
	$fdKey_other='ff_thumb1';
	
	
	$mb_fdKey='ff_thumb_mb'.$this->lang;
	$mb_key_cng='banner_mb2_onefile';
	break;
	}
	
	
	$results=	 DB::table(	'banner')->where('status',1	 ) ->orderBy('rank', 'asc')->get();		 
 
 	 $str='';
		  
		$cng_arr=Config::get('gbkey.'.$key_cng);

			$str_arr=array();
		if (count($results )>0){
		 $i=0;
			foreach ($results as $ms) { 

					$thumb=''; 
					 
					$this_Kry=($ms->$fdKey!='')?$ms->$fdKey:$ms->$fdKey_other;
					
					
					if($this_Kry!=''){
				 	$thumb_val=explode(',',$this_Kry); 						
				 	$thumb_total=ceil($thumb_val[0]);
				  	$thumb_path= $cng_arr['folder_val'].'/'.$thumb_val[1]; 
		
		
					$thumb='';
					
					if( file_exists($this->filepath_dir.$thumb_path) && $thumb_total>0){
						 
							
 
 					$thislink=($ms->$LinkKey!='')?' href="'.$ms->$LinkKey.'" ':'';
		/*							
 		$str.=' <div class="item">
            <a  '.$thislink.' title="'.$ms->$tlang.'"><img alt="'.$ms->$tlang.'" class=" img-responsive" src="'.url($this->filepath_url.$thumb_path).'"/></a>
         </div>';
	 */			
	 $msgLong='detail'.$this->lang;
	 $inner_msg=nl2br($ms->$msgLong);
	 $val_ag=' text-left';
	 switch($ms->val_ag){
		case 2: 	 $val_ag=' text-right';		break;
		case 1: 	 $val_ag=' text-center';		break;
	}
	/*
 		$str.=' <div class="item">
            <a  '.$thislink.' title="'.$ms->$tlang.'" style="background-image:url('.url($this->filepath_url.$thumb_path).')">
			
			<div class="item_ovmsg">
			
			<div class="inner_msg_cnt  ">
				<div class="inner_msg col-xs-11  col-sm-9  col-md-10  col-lg-12 '. $val_ag.'">
				'.	 $inner_msg.'
				</div>
			</div>
			</div>
			<img alt="'.$ms->$tlang.'" class=" img-responsive" src="'.url($this->filepath_url.$thumb_path).'"/>
			
			</a>
         </div>';
	 
	 */
	 
		  
		$cng_arr_mb=Config::get('gbkey.'.$mb_key_cng);
		
		$mb_img='<img alt="'.$ms->$tlang.'" class="visible-xs img-responsive" src="'.url($this->filepath_url.$thumb_path).'"/>';	
		
		$thumb_mb='';
		if($ms->$mb_fdKey!=''){
		$mb_thumb_val=explode(',',$ms->$mb_fdKey); 						
		$mb_thumb_total=ceil($mb_thumb_val[0]);
		$mb_thumb_path= $cng_arr_mb['folder_val'].'/'.$mb_thumb_val[1]; 
 
		if( file_exists($this->filepath_dir.$mb_thumb_path) && $mb_thumb_total>0){
			
		$mb_img='<img alt="'.$ms->$tlang.'" class="visible-xs img-responsive" src="'.url($this->filepath_url.$mb_thumb_path).'"/>';	
			
		}
						 
		}
			
 		$str.=' <div class="item">
            <a  '.$thislink.' title="'.$ms->$tlang.'"  >
			
			<div class="item_ovmsg">
			
			<div class="inner_msg_cnt  ">
				<div class="inner_msg col-xs-11  col-sm-9  col-md-10  col-lg-12 '. $val_ag.'">
				'.	 $inner_msg.'
				</div>
			</div>
			</div>
			<img alt="'.$ms->$tlang.'" class="hidden-xs img-responsive" src="'.url($this->filepath_url.$thumb_path).'"/>
			'.$mb_img.'
			</a>
         </div>';
		 
		 
						$i++;
					}
					}
			
			}



		return $str;
	} // id coutn >0
}

 
function getLang(){

 if(
		Session::has('lang_val')){
		
		
switch( Session::get('lang_val') ){
		case '1':
		$this->lang_name='en/';
		$this->lang=1;
		Session::put('lang_val', 1);
		App::setLocale('en');
		break;
		
		case '2':
		$this->lang_name='zh/';
		$this->lang=2;
		Session::put('lang_val', 2);
		App::setLocale('zh');
		break;
}
		 
		
		}else{
			
		$this->lang_name='en/';
		$this->lang=1;
		Session::put('lang_val', 1);
		App::setLocale('en');
}


  
	}
 
 
 
public	function getSystem(){
		
		$this->site_url=url($this->lang_name);
		
		$results=	 DB::table( 'admin_setting'  )->get();		 
		if (count($results )>0){
			foreach ($results as $ms) { 
			$this->sysval[$ms->opt_key]=$ms->opt_value;
			}
		}
		
		$this->psetting=new stdClass();
		$this->psetting->page_title=(isset($this->sysval['opt_basic_webtitle'.$this->lang]))?$this->sysval['opt_basic_webtitle'.$this->lang]:'';
		$this->psetting->site_title=	$this->psetting->page_title;
		$this->meta_key=(isset($this->sysval['opt_basic_keyword'.$this->lang]))?$this->sysval['opt_basic_keyword'.$this->lang]:'';
		$this->meta_desc=(isset($this->sysval['opt_basic_desc'.$this->lang]))?$this->sysval['opt_basic_desc'.$this->lang]:'';
		
		//$this->psetting->meta_data=
		$this->meta_setup();
	
 
		$this->psetting->head_css_js='<script>		var this_root="'.ROOT_PATH.'";		var this_lang='.$this->lang.';		var langcode='.$this->lang.';		</script>';
		
		$this->psetting->content='';
        $this->psetting->plus_css_js='';
		
 
  
$this->psetting->head_css_js.=' '; 
$this->psetting->plus_css_js.='<script src="'.url('static/js/jquery.dotdotdot.min.js').'"></script>';
 

		$this->psetting->footer='';
		$this->linkbase=ROOT_PATH;
		 $this->filepath_url=DOMAIN.'userfile/';
		 $this->filepath_dir=$_SERVER['DOCUMENT_ROOT'].ROOT_PATH.'userfile/';
		
	}
 
public	function __construct(){
 
//DB::statement(' alter table kkc_banner add column ff_thumb_mb1 TEXT after val_ag');
//DB::statement(' alter table kkc_banner add column ff_thumb_mb2 TEXT after val_ag');
 
switch(App::getLocale()){
		case 'zh':
		$this->lang_name='zh/';
		$this->lang=2;
		Session::put('lang_val', 2);
		break;
		default:
		
		case 'en':
		$this->lang_name='en/';
		$this->lang=1;
		Session::put('lang_val', 1);
		break;
} 
 $this->getSystem();
 
 
		switch(	$this->lang){
			
			case 2:
 $this->psetting->head_css_js.='<link rel="stylesheet" charset="utf-8"  href="'.url('static/css/font2.css').'">';
 break;
 
			default:
			case 1:
 $this->psetting->head_css_js.='<link rel="stylesheet" href="'.url('static/css/font1.css').'">';
		 
		}
		
		
	}
	public function meta_setup(){
		
		$this->psetting->meta_data='<meta charset="utf-8" />
	<meta name="keywords" content="'.$this->meta_key.'" />
	<meta name="description" content="'.$this->meta_desc.'" />
	<meta name="robots" content="index, follow"/>  
	<meta name="author" content="'.DOMAIN.'" />';
	//	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	}
	public function seo_replace($json){
	 
	 if($json!=''){
	 $json=json_decode($json,true);
	  
	 foreach($json as $jkey=> $jvcal){
	
			switch($jkey){
			
			case 'web_title'.$this->lang:
			if($jvcal!='') $this->psetting->page_title=$jvcal;
			break;
	
			case 'keyword'.$this->lang:
			if($jvcal!='') $this->meta_key=$jvcal;
			break;
			case 'description'.$this->lang:
			if($jvcal!='') $this->meta_desc=$jvcal;
			break;
			case 'h1_value'.$this->lang:
			if($jvcal!='') $this->h1_value=$jvcal;
			break;
			}
	
	}
	
  
	 }
	
	
	}
	 
 
  
function nav_func($p1=null,$p2=null,$p3=null){


$lang1_name=
$lang1_href=
$this_url1=
'';


$this->site_url=($this->site_url==url($this->lang_name))?$this->site_url.'/':$this->site_url;

switch($this->lang){

case 1:
$lang1_name=$this->mytxt('lang_tc');
$lang1_href='zh/';
$this_url1= str_replace($this->lang_name,$lang1_href,$this->site_url);
break;

case 2:
$lang1_name=$this->mytxt('lang_en');
$lang1_href='en/';
$this_url1= str_replace($this->lang_name,$lang1_href,$this->site_url);
break;
 
}

$strlang=' <li class="lang_li"><a href="'.$this_url1.'" class="  lang_btn">'.$lang1_name.'</a> </li>	';
$strlang_mb=' <a href="'.$this_url1.'" class="  lang_btn_mb visible-xs">'.$lang1_name.'</a>  	';


$arr=array(
'about',
'on_going',
'project_hg',
'sap',
'contact',
);
$li='';

foreach($arr as $mVal){
$link=url($this->lang_name.''.$this->mytxt($mVal,'href'));
$hnc=($mVal=='contact')?' visible-xs ':'';
$linkTp=($this->ishome==1 && $mVal!='contact')?' class="home_mnbtn '.$hnc.'" data-tg="#'.$this->mytxt($mVal,'href').'_mk" ':'  class="'.$hnc.'" href="'.$link.'" ';
$tt=$this->mytxt($mVal,'tt');
$li.='<li><a '.$linkTp.'title="'.$this->mytxt($mVal,'tt').'">'.$this->mytxt($mVal,'tt').'</a></li>';
$lv1_cr='';

//$li.='<li class="lv1 '.$lv1_cr.'  "><a class="lv1a" '.$linkTp.' title="'.$tt.'"> '.	 $tt.'  </a> ';	 

}

 /*
$menu='  
<div id="header">
<div class=" clearfix col-xs-12">
	<div class="col-xs-4 col-sm-2 m0 p0">
		<a id="logo_btn" href="'.url($this->lang_name).'">'.$this->psetting->site_title.'</a>
	</div>
	<div class="col-xs-8 col-sm-10 m0 p0">
		<ul id="menu">'.$li.''.$strlang.'</ul>
	</div>
</div>
</div>
';
 
 
 $str='
'.$menu.' 
 '; 
 */
 
 
 
 $str='<div id="header"> <nav class="navbar navbar-default navbar-fixed-top clearfix"> 
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll col-xs-12 col-sm-2 col-md-3 m0 p0">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<div class="icon aa">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
					</div>
				<div class="icon bb">
                    <span class="glyphicon glyphicon-remove"></span>
				
				</div>
                </button>
			'.$strlang_mb.'
                <a class="navbar-brand img-responsive" id="logo_btn" href="'.url($this->lang_name).'">
				<img class="img-responsive  " src="'.url('static/images/logo.jpg').'" alt="'.$this->psetting->site_title.'"/>
				</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-right col-xs-12 col-sm-10 col-md-9" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right" id="menu">
                   '.$li.''.$strlang.'
                </ul>
            </div>
            <!-- /.navbar-collapse --> 
    </nav>
</div>
 
 ';
 
  
return myfunc::removebreak($str);
}
 
 function footer_func(){
	 
$arr=array(
	 
'son',
'line',
'contact',
'br',
'privacy',
'line',
'disc',
'line',
'follow',	 
);

$fval='';
foreach($arr as $aval){


switch($aval){
case 'follow':
$fval.='<li class="hidden-xs"><span class="link">'.$this->mytxt('follow').' &nbsp;&nbsp;</span> </li>';
$fval.='<li  class="hidden-xs"><a  class="link fs fb mbtn" href="https://www.facebook.com/kkcharity" title=""  rel="external">&nbsp;</a></li>'; 
$fval.='<li  class="hidden-xs"><a  class="link fs sa  mbtn" href="https://www.instagram.com/kkcharity/" title="" rel="external">&nbsp;</a></li>';

$fval.='<li class="hidden-sm hidden-md hidden-lg"><span class="link">'.$this->mytxt('follow').'</span> ';
$fval.='<a  class="link fs fb mbtn" href="https://www.facebook.com/kkcharity"   rel="external"  >&nbsp;</a>'; 
$fval.='<a  class="link fs sa  mbtn"  href="https://www.instagram.com/kkcharity/"  rel="external"  >&nbsp;</a></li>';

break;
case 'line':
$fval.='<li class="line">|</li>';
break;
case 'br':
$fval.='<li class="br">&nbsp;</li>';
break;
default:
$fval.='<li><a  class="link" href="'.url($this->lang_name.$this->mytxt($aval,'href')).'" title="'.$this->mytxt($aval,'tt').'">'.$this->mytxt($aval,'tt').'</a></li>';
}
	
}

/*	 
 <p class="m0 p0 pull-left mt20 fz12 bold"><i>'.$this->mytxt('footer_txt').'&nbsp;</i></p> <a class="m0 p0 mbtn pull-left" rel="external"><img src="'.url('static/images/footer_logo.jpg').'" class="img-responsive" alt=""/></a>*/
 $str='
 <div id="footer">
 <div class="col-xs-12 cnt ">
 <div    id="footer_cnt" class=" clearfix">
 <div class="col-xs-12 col-sm-5 clearfix">
  <img src="'.url('static/images/caring_organization.jpg').'" class="img-responsive" alt="" style="margin-top:20px;"/>
 </div>
 <div class="col-xs-12 col-sm-7 m0 p0">
 
 <ul id="footer_ul">
 '.$fval.'
 </ul>
 
 </div>
 </div>
 
 </div>
 </div>
 ';
		return myfunc::removebreak($str);
 
 }
 
		
public function defaultLang(){
return  Redirect::to('/en', 301);
}

	
public function mytxt($name,$key=''){
		$vt1=Lang::get('txt.'.$name);
			if($key!=''){
				$vt1=(isset($vt1[$key]))?$vt1[$key]:false;
			}
		return $vt1;
}
   
  
  
  
 
public function uis(){
	
		$this->layout = View::make('uis');
}


  
  
  
  
public function switchPage($p1=null,$p2=null,$p3=null)
{



	$vt1=Lang::get('txt.home');
	
	switch($p1){ 
		
	case 'placeOrder':
	
 		return $this->placeOrder();
	break; 
	case 'cancel':
	
 		return $this->cancel_payment();
	break; 
 
 
 
 
	case $this->mytxt('donation','href'):
	
 		return $this->showDonationDetail($p1,$p2,$p3);
	break; 
		
 
 
 
 
	case $this->mytxt('privacy','href'):	
 		return $this->showOnepage(1);
	break; 
	case $this->mytxt('disc','href'):	
 		return $this->showOnepage(2);
	break; 
	
	case $this->mytxt('contact','href'):	
 		return $this->showContact($p1,$p2,$p3);
	break; 
	
	
	case $this->mytxt('son','href'):
	
 		return $this->showSON($p1,$p2,$p3);
	break; 
		
	case $this->mytxt('sap','href'):
	
 		return $this->showSAP($p1,$p2,$p3);
	break; 
		
 
	case $this->mytxt('projects','href'):
	
 		return $this->showProjectDetail($p1,$p2,$p3);
	break; 
		
	case $this->mytxt('project_hg','href'):
	
 		return $this->showProject(2,$p1,$p2,$p3);
	break; 
	case $this->mytxt('on_going','href'):
	
 		return $this->showProject(1,$p1,$p2,$p3);
	break; 
 
	default:
	case $this->mytxt('about','href'):
 		return $this->showHome($p1);
 
	 
	}
}
  
 
 
 
 /*
public function checkProject(){
		$results=	 DB::table( 'project'  )->select('project_type','id','date_count','setdate')->get();		 
		if (count($results )>0){
			foreach ($results as $ms) { 
				if($ms->project_type==1){
							$dd1= $ms->setdate;
							$dd2=date('Y-m-d', strtotime($ms->setdate. ' + '.$ms->date_count.' days'));
							 if(time() > strtotime($ms->setdate. ' + '.$ms->date_count.' days') ){
												DB::table('project') ->where('id',$ms->id )->update(
												 array(
												 'project_type'=>2
												 ));
									}
				}
			}}
}*/


public function pj_pr_mi($key,$id){
$results=	 DB::table( 'project_' .$key )->where('node_id',$id)->where('status',1)->orderBy('rank','asc')->get();		
$td='';

$tlang='title'.$this->lang; 

$fileBtn='';
$link_att='';
$expCv='';		
$yy_array=array();
$cng_arr=Config::get('gbkey.project_'.$key .'_onefile');

$vi=0;	

$link_att=' class="text-grey" '	;	
if (count($results )>0){
			foreach ($results as $ms) { 
	$yy_val=date('Y',strtotime($ms->setdate));	
	$thisDate= ($this->lang==1)?date('d M, Y',strtotime($ms->setdate)):date('Y.m.d',strtotime($ms->setdate));	
	$vcK=$key.'hdvCnt'.$vi;	
	
	$fileBtn='';

$link_att=' style="color:#666" '	;	
$expCv='';		

 
		 	if($ms->ff_file!=''){
				 	$thumb_val=explode(',',$ms->ff_file); 						
				 	$thumb_total=ceil($thumb_val[0]);
				  	$thumb_path=$cng_arr['folder_val'].'/'.$thumb_val[1]; 
 
					if( file_exists($this->filepath_dir.$thumb_path) && $thumb_total>0){
 
						$fileBtn='  href="'. $this->filepath_url.$thumb_path .'" class="pull-left col-xs-7 col-sm-9 m0 p0"  rel="external" ';
					}
		}

if(	$fileBtn!=''){
	
	
$link_att=$fileBtn;
	
}else if( $ms->linkto!=''){
$link_att='  href="'.  $ms->linkto .'" class="pull-left col-xs-9 m0 p0"  rel="external"    ';	

}else if( $ms->video_link!=''){
	 
parse_str( parse_url( $ms->video_link, PHP_URL_QUERY ), $my_array_of_vars );
 $vva=(isset( $my_array_of_vars['v']))? $my_array_of_vars['v']: $ms->video_link;    
 

$thisVlink='https://www.youtube.com/embed/'.$vva;
 
$have_ytvideo='<iframe  style="z-index:10" width="100%" height="270" src="'.$thisVlink.'" frameborder="0" allowfullscreen></iframe>' ;


$link_att='  class="pull-left col-xs-7 col-sm-9 m0 p0  "  style="display:inline-block"  data-toggle="collapse" href="#'.$vcK.'" aria-expanded="false" aria-controls="'.$vcK.'"  ';	
$expCv=' 
		<div   class="col-xs-12 clearfix m0 p0 collapse" id="'.$vcK.'">
			  <div class="card card-block">
			  '.$have_ytvideo.'
			  </div>   
		 </div>
 ';
 
}else{
	
}

if( !isset($yy_array['y'.	$yy_val])) $yy_array['y'.	$yy_val]=array();
if( !isset($yy_array['y'.	$yy_val]['val'])) $yy_array['y'.	$yy_val]['val']='';
 $yy_array['y'.	$yy_val]['year']=$yy_val;
 $yy_array['y'.	$yy_val]['key']='y'.$yy_val;

$yy_array['y'.	$yy_val]['val'].='
 <div class="col-xs-12 clearfix prmi_row"  >
 
		 <div class="col-xs-1 clearfix m0 p0 cball"> &bull; </div>
		 <div class="col-xs-11 clearfix m0 p0">
		 
		<div   class="col-xs-12  m0 p0   clearfix"  >
		  <a '.$link_att.'>'.$ms->$tlang.'</a>
		 
		<p class="pull-right m0 col-xs-5 col-sm-3 m0 p0 text-right" style="display:inline-block"> '.	$thisDate.'</p>
		 </div>
		 
		'.$expCv.'
		 
		 
		 </div>
		
		 
 
 
 </div>
';

	$vi++;
			}
		}

$li_val='';
$tbc_val='';
$g=0;
$fyear='';
foreach( $yy_array as $yKey=>$yVal){

$act=($g==0)?' active ':'';

$fyear=($g==0)?$yVal['year']:$fyear ;
$li_val.='<li class="'.$act.'">
<a id="'.$yKey.$key.'-tab" aria-expanded="true" aria-controls="'.$yKey.$key.'" data-toggle="tab" role="tab" href="#'.$yKey.$key.'" class="tyBtn" data-tgdiv="cr_'.$key.'_year" title="'.$yVal['year'].'">'.$yVal['year'].'</a>
</li>';


$tbc_val.='
    <div role="tabpanel" aria-labelledby="'.$yKey.$key.'-tab" class="tab-pane '.$act.'" id="'.$yKey.$key.'">
'.$yVal['val'].'
	</div>
';

$g++;
}
 
$str=($tbc_val!='')?'
 <div class="col-xs-12 m0 p0 p20 pb10 " style="padding-bottom:0">
 
 <div class="col-xs-6 m0 p0" >
<h3 class="m0 mb10 fs15  m0 p0 mt10 oneline mipr_tt" style="letter-spacing:0">'.$this->mytxt($key,'tt').'</h3>
</div>


 <div class="col-xs-6 m0 p0" >
<ul id="yearTabs" class="nav nav-tabs col-xs-12  m0 p0 clearfix" role="tablist">
<li class="dropdown active  " role="presentation">
	<a id="myTabDrop1" class="dropdown-toggle" aria-controls="myTabDrop1-contents" data-toggle="dropdown" href="#" aria-expanded="false">
	<span id="cr_'.$key.'_year">'.$fyear.'</span>&nbsp;
			<i class="f2 fa fa-angle-down"></i>
	</a>
	<ul id="myTabDrop1-contents" class="dropdown-menu" aria-labelledby="myTabDrop1">
	'.$li_val.'
	</ul>
</li>
</ul>
  </div>
  
 </div>
  
  
 <div class="col-xs-12 m0 p0 p10 p20 pt10" >
  <div class="tab-content">
'.$tbc_val.'
  </div>
  <p class="col-xs-12">&nbsp;</p>
 </div>
  
  
':'

 <div class="col-xs-12 m0 p0 p20 pb10 " >
<h3 class="m0 mb10 fs15  m0 p0 mt10 oneline mipr_tt" style="letter-spacing:0">'.$this->mytxt($key,'tt').'</h3>
<p class="clearfix col-xs-12 mt20">'.$this->mytxt('noitem').'</p>
 </div>
';
 
/*


 <div class="col-xs-12 m0 p0 p20 " >
<h3 class="m0 mb10 fz16">'.$this->mytxt($key,'tt').'</h3>

'.$td.'
 </div>*/
return   $str;

}
public function pj_news($id){


$results=	 DB::table( 'project_news' )->where('node_id',$id)->where('status',1)->orderBy('rank','desc')->get();		
$td='';

$key='news';

$tlang='title'.$this->lang;
$dlang='detail'.$this->lang;
	$vi=0;
if (count($results )>0){ 
			foreach ($results as $ms) { 
	$thisDate= ($this->lang==1)?date('d M, Y',strtotime($ms->setdate)):date('Y.m.d',strtotime($ms->setdate));	
	$vcK=$key.'hdvCnt'.$vi;	
$td.='
 <div class="col-xs-12 clearfix mb10" style="border-bottom:1px solid #000">
 
 <h3 class="  m0 fs15 mt20 notf" > '.	$thisDate.'</h3>
 
<div class="mt20 mb20">
 <h3 class="  m0 fs15 mt20 notf mb10" > '.	$ms->$tlang.'</h3>

 
 
 
  
				'.myfunc::exp_fck($ms->$dlang).'
		 
 
 </div>
 
 
 
 
 
 
 </div>
';

	$vi++;
			}
		}else{

$td='
 <div class="col-xs-12 m0 p0 p20 pb10 " >
<h3 class="m0 mb10 fs15 col-xs-6 m0 p0 mt10">'.$this->mytxt('tab_wm').'</h3>
<p class="clearfix col-xs-12 mt20">'.$this->mytxt('noitem').'</p>
 </div>';
 		
}

$str='
<div class="clearfix mb20">
'.$td.'
<p>&nbsp;</p>
 </div>
';
return ($td!='')?$str:'';


}




public function pj_oc($id){


$results=	 DB::table( 'project_oc' )->where('node_id',$id)->where('status',1)->orderBy('rank','asc')->get();		
$td='';

$key='news';

$tlang='title'.$this->lang;

$slang='short'.$this->lang;
$dlang='detail'.$this->lang;
	$vi=0;
	
$cng_arr=Config::get('gbkey.project_oc_onefile');
			
if (count($results )>0){ 
			foreach ($results as $ms) { 
			
			
 
$thumb=''; 
	$ns ='';
	 	if($ms->ff_thumb!=''){
				 	$thumb_val=explode(',',$ms->ff_thumb); 						
				 	$thumb_total=ceil($thumb_val[0]);
				  	$thumb_path=$cng_arr['folder_val'].'/'.$thumb_val[1];  
					
					if( file_exists($this->filepath_dir.$thumb_path) && $thumb_total>0){ 
						 $ns=' class="img-responsive" ' ;
						$thumb='<div class="clearfix mb20"><img src="'. $this->filepath_url.$thumb_path .'" alt="" '.$ns.'/></div>';
					}
		} 
		
		
		
		
	$thisDate= ($this->lang==1)?date('d M, Y',strtotime($ms->setdate)):date('Y.m.d',strtotime($ms->setdate));	

	///	<p>  '.	$thisDate.'</p>
	$inner1_mb='
	 <div class="col-xs-12 col-sm-3 oc_info visible-xs" >
	 
	 '.$thumb.'
	<h3>  '.	$ms->$tlang.'</h3>
	<h4>  '.	$ms->$slang.'</h4> 
	 <p>&nbsp;</p>
	 </div>
 ';
 
	$inner1_b='
	 <div class="col-xs-12 col-sm-3 oc_info hidden-xs" >
	 
	 '.$thumb.'
	<h3>  '.	$ms->$tlang.'</h3>
	<h4>  '.	$ms->$slang.'</h4> 
	  
	 </div>
 ';
	$inner1='
	 <div class="col-xs-12 col-sm-3 oc_info" >
	 
	 '.$thumb.'
	<h3>  '.	$ms->$tlang.'</h3>
	<h4>  '.	$ms->$slang.'</h4> 
	 <p class="m0 visible-xs" style="margin:0">&nbsp;</p>
	  
	 </div>
 ';
	$inner2='
	 <div class="col-xs-12 col-sm-9 oc_detail mb20" >
				'.myfunc::exp_fck($ms->$dlang).'
	
 </div>
 ';
 
$td.=($vi%2==0)?' <div class="col-xs-12 clearfix  m0 p0" ><div class="oc_box clearfix ">
 '.	$inner1.'
 '.	$inner2.'	<p class="text-right" style="  position:absolute; bottom:55px; right:45px;">  '.	$thisDate.'</p>
 </div> <div class="oc_arr right"></div></div>':'<div class="col-xs-12 clearfix  m0 p0 " ><div class="oc_box clearfix  ">
 '.	$inner1_mb.'
 '.	$inner2.'
 '.	$inner1_b.'	<p class="text-right" style="  position:absolute; bottom:55px; left:45px;">  '.	$thisDate.'</p>
 </div> <div class="oc_arr left"></div></div>';

	$vi++;
			}
		}else{

$td='
 <div class="col-xs-12 m0 p0 p20 pb10 " >
<h3 class="m0 mb10 fs15 col-xs-6 m0 p0 mt10">'.$this->mytxt('tab_oc').'</h3>

<p class="clearfix col-xs-12 mt20">'.$this->mytxt('noitem').'</p>
 </div>';
 		
}

$str='
<div class="clearfix mb20">
'.$td.'
<p class="col-xs-12">&nbsp;</p>
 </div>
';
return ($td!='')?$str:'';


}





public function pj_donation($id,$ptype=1){

 $pdVal='';
 
 $Mkwt=($ptype==1)?'node_id':'id';
$results=	 DB::table( 'donation' )->where( $Mkwt,$id)->where('status',1)->orderBy('rank','asc')->get();	
//  $results = DB::select('SELECT  * FROM `'.$prefix.'project`  ');
if (count($results )>0){
$i=0;
foreach ($results as $ms) { 

 

$cng_arr=Config::get('gbkey.donation_onefile');

$tlang='title'.$this->lang;
$slang='detail'.$this->lang;
$thumb=''; 
	$ns ='';
	 	if($ms->ff_thumb!=''){
				 	$thumb_val=explode(',',$ms->ff_thumb); 						
				 	$thumb_total=ceil($thumb_val[0]);
				  	$thumb_path=$cng_arr['folder_val'].'/'.$thumb_val[1]; 
					// $ww=$cng_arr['max_w'];	
					// $hh=$cng_arr['max_h']; 
					 $ww=320;
					 $hh=400; 
					
					if( file_exists($this->filepath_dir.$thumb_path) && $thumb_total>0){
						$newcbsize = myfunc::imgVirtualResize( $this->filepath_dir.$thumb_path,	$ww,  $hh);	
 
					
						//$ns=' width="'.round($newcbsize[0]).'" height="'.round($newcbsize[1]).'"    ';
						
						 $ns=' class="img-responsive" ' ;
						$thumb='<img src="'. $this->filepath_url.$thumb_path .'" alt="" '.$ns.'/>';
					}
		}
		if($thumb=='') $thumb='<img class="img-responsive"  src="'.url('static/images/pj_thumb.jpg') .'" alt=""  />';  
			

$backer=' <p class="m0 mt10 mb0 fz16">999 backers</p>';
if($ms->onoff_count==0)$backer='';


$this_link=' href="'.url($this->lang_name.$this->mytxt('donation','href').'/'.$ms->url_rewrite).'" ';
			
$pdVal.='   <div class=" don_item">
 
 <div class="don_content">
 
<p class="m0 mb10 fz20"> Pledge  $'.$ms->amount .' or more</p>
 '.myfunc::exp_fck($ms->$slang) .' 
 	 '.$backer.'
 </div>
 
 
 <div class="don_img"><a '.$this_link.'>'.$thumb.'</a></div>
 </div>
 ';
 
 
 
}}

return $pdVal;
			
}

 
/*
function pj_oc($spf,$tbname,$id){
$str='';


$dlang='detail'.$this->lang;
	
$ms=	 DB::table( 'optionlist'  )
->where('parent_id',$id)
->where('sp_field',$spf)
->where('tb_val',$tbname)
-> orderBy('rank','asc')->first();	
 $ocVal='';
 
 if   (count($ms )==0) return '';
// echo $ms->data_val;
$thisArr=json_decode( $ms->data_val,true);
 
foreach ((array)$thisArr as $mK=>$msVal) { 

 
 
 $ocVal.='
 <div class="col-xs-4 text-center">
 <div class="p20">
	 <h3 class="fz20">
	 '.$msVal['num'].'
	 </h3>
	 <p class="fz14">
	 '.$msVal[$dlang].'
	 </p>
 </div>
 </div>
 ';
 

}
$str='<div style="min-height:300px;">
'.$ocVal.'
</div>

	';

 $str='';
	 
return $str;	 
}*/

public function showProjectDetail($p1,$p2,$p3=null){
	
$p2=myfunc::only_az2($p2);
if($p2=='') return Redirect::to('/'.$this->lang_name.$this->mytxt('on_going','href'), 301);

$str='';
	$tlang='title'.$this->lang;
	$dlang='short'.$this->lang;
	$ddlang='detail'.$this->lang;

$ppms=	 DB::table( 'project'  )->where('url_rewrite',$p2)->where('status',1)->first();		 
if(count($ppms)==0) return $this->notfound();	
$this->layout = View::make('inner_view');


 
$this->site_url=url($this->lang_name.$this->mytxt('projects','href').'/'.$ppms->url_rewrite);

$bn=	$this->clearfixide($ppms->id, $ppms->$tlang );

$pj_basedate=$ppms->setdate;
//$pj_enddate=date('Y-m-d' , strtotime($ppms->setdate.' +'.$ppms->date_count.' days'));
//$date1 = date('Y-m-d');
$pj_enddate=date('Y-m-d' , strtotime($ppms->date_count));
$date1 = date('Y-m-d');
$date2 = $pj_enddate; 


$diff = abs(strtotime($date2) - strtotime($date1));
/*
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
printf("%d years, %d months, %d days\n", $years, $months, $days);
*/
$day2go= $diff/(60*60*24) ;
 
$pppval=($this->lang==1)?'
<span class="en_v1">'.$day2go.'</span>
<span class="en_v2">day'.(($day2go>1)?'s':'').' to go</span>
':'
<span class="zh_v1">'.$day2go.'</span>
<span class="zh_v2">尚餘日數</span>
';


if($ppms->project_type==1){ 
 $main_col='  class=" col-xs-8 m0 p0" style=" " '; 
 $side_don='<div class="col-xs-4  m0 p0  pull-right pt'.$ppms->project_type.'" style=" width:310px">'.$this->pj_donation($ppms->id).'</div>';
$dc= '<div class="date_cnt">'.$pppval.'			</div>';
}else{
 $main_col='  class="col-xs-12 m0 p0" ';
 $side_don='';
 $dc='';
}

 $main_col='  class="col-xs-12 m0 p0" ';
 $side_don='';
 //$dc='';
 
 
$this->psetting->page_title=$ppms->$tlang.' - '.$this->psetting->page_title;


$actMl='<i class="fa fa-angle-double-down visible-xs" aria-hidden="true"></i>';
$this_content='
 
 <div class="container m0 p0 ma0 hidden-xs  pt'.$ppms->project_type.'" id="projectdetailCnt">
		<div class="col-xs-12 m0 p0 mt20 mb20 " >
			 <h1 class="main_h1 text-center notf">'.$ppms->$tlang .'</h1>
		</div>
</div>
  
 	<div id="project_banner" class="container m0 p0 ma0 clearfix   pt'.$ppms->project_type.'"  >
		<div class="slide"> 
				<div class="owl-carousel" id="myplist">
				  '. $bn.'
				</div>

		</div>
 <div class="container m0 p0 ma0 hidden-md hidden-sm hidden-lg" id="projectdetailCnt2">
		<div class="col-xs-12  mb_pdetail_tt pt'.$ppms->project_type.'"   >
			 <h2 class="main_h1 text-center ">'.$ppms->$tlang .'</h2>
		</div>
</div>		
		<div class="info  pt'.$ppms->project_type.'"> 
			<div class="total_cnt  lg'.$this->lang.'">
				<div class="total_num   "><p>'.$ppms->project_total .'</p></div>
				<div class="total_msg ">'.$this->mytxt('project_total').'</div>
			</div>
			'.	$dc.'
		</div>
	</div>
	

 <div class="container m0 p0 ma0 clearfix pt'.$ppms->project_type.'" id="project_main">
  
  		<div '. $main_col.' >
		
			  <!-- Nav tabs -->
			<div class="nav_cnt  pt'.$ppms->project_type.'" id="pj_tab_cnt">
			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#'.myfunc::only_az($this->mytxt('tab_project'),'').'_tab" aria-controls="'.myfunc::only_az($this->mytxt('tab_project'),'').'" role="tab" data-toggle="tab">'.$this->mytxt('tab_project').''.$actMl.'</a></li>
				<li role="presentation"><a href="#'.myfunc::only_az('tab_wm').'_tab" aria-controls="'.myfunc::only_az($this->mytxt('tab_wm'),'').'_tab" role="tab" data-toggle="tab">'. ($this->mytxt('tab_wm')).''.$actMl.'</a></li>
				<li role="presentation"><a href="#'.myfunc::only_az('tab_our').'_tab" aria-controls="'.myfunc::only_az($this->mytxt('tab_our'),'').'_tab" role="tab" data-toggle="tab">'. ($this->mytxt('tab_our')).''.$actMl.'</a></li>
				<li role="presentation"><a href="#'.myfunc::only_az($this->mytxt('tab_pr_link')).'_tab" aria-controls="'.myfunc::only_az($this->mytxt('tab_project'),'').'_tab" role="tab" data-toggle="tab">'. ($this->mytxt('tab_pr')).''.$actMl.'</a></li>
				<li role="presentation"><a href="#'.myfunc::only_az($this->mytxt('tab_mi_link')).'_tab" aria-controls="'.myfunc::only_az($this->mytxt('tab_project'),'').'_tab" role="tab" data-toggle="tab">'. ($this->mytxt('tab_mi')).''.$actMl.'</a></li>
			  </ul>
			</div>

			  <!-- Tab panes -->
			<div class="tab-content pt'.$ppms->project_type.'">
				<div role="tabpanel" class="tab-pane active" id="'.myfunc::only_az($this->mytxt('tab_project'),'').'_tab"><div class="p20">'.myfunc::exp_fck($ppms->$ddlang).'</div><p>&nbsp;</p></div>
				<div role="tabpanel" class="tab-pane" id="'.myfunc::only_az('tab_wm').'_tab">'.$this->pj_news($ppms->id).'</div>
				<div role="tabpanel" class="tab-pane" id="'.myfunc::only_az('tab_our') .'_tab">'.$this->pj_oc($ppms->id).'</div>
				<div role="tabpanel" class="tab-pane" id="'.myfunc::only_az($this->mytxt('tab_pr_link')) .'_tab">'.$this->pj_pr_mi('pr',$ppms->id).'</div>
				<div role="tabpanel" class="tab-pane" id="'.myfunc::only_az($this->mytxt('tab_mi_link')) .'_tab">'.$this->pj_pr_mi('mi',$ppms->id).'</div>
  			</div>



			</div>
'.$side_don.'

		<div class="col-xs-12  m0 p0 "   >
 <div class="container m0 p0  clearfix pos-rel">
 <span id="project_line"></span>
</div>
</div>

 </div>';
  
  
$this->psetting->head_css_js.=' '; 
$this->psetting->plus_css_js.='<link rel="stylesheet" href="'.url('static/js/owlcarousel/owl.carousel.css').'">
<link rel="stylesheet" href="'.url('static/js/owlcarousel/owl.theme.css').'">
<script src="'.url('static/js/owlcarousel/owl.carousel.js').'"></script>
<link rel="stylesheet" href="'.url('static/js/YouTubePopUp/YouTubePopUp.css').'">
<script src="'.url('static/js/YouTubePopUp/YouTubePopUp.jquery.js').'"></script>
<link rel="stylesheet" href="'.url('static/js/prettyPhoto/prettyPhoto.css').'" type="text/css" />
<script type="text/javascript" src="'.url('static/js/prettyPhoto/jquery.prettyPhoto.min.js').'"></script> 
<script src="'.url('static/js/js.project.js').'"></script>
 
';


	 

 $this->layout->page_title =  	$this->psetting->page_title;
		  
		$this->layout->meta_data=    	$this->psetting->meta_data;
        $this->layout->head_css_js=  	$this->psetting->head_css_js;
		
		$this->layout->nav=    	$this->nav_func($p1,$p2,$p3);
		$this->layout->content=    myfunc::removebreak	 ($this_content);
		$this->layout->plus_css_js=    $this->psetting->plus_css_js;
		 
		
		$this->layout->footer=   	$this->footer_func();
		
		
}

public function getProjectList($ptype_val=1, $cr_year,$page=1){

$perP_base=3;
$perP=($page==1)?4:$perP_base;
 $pdVal='';
 $lm= ($page==1)? (($page-1)*$perP) :  (($page-1)*$perP)+1;

$results = DB::select('SELECT  * FROM `'.DB_START.'project` where YEAR(setdate)='.ceil($cr_year).' and  project_type='.ceil($ptype_val).' and   status=1 order by rank asc  limit  '.$lm.','.$perP.' ') ;
$results_rc = DB::select('SELECT  count(*) as rc  FROM `'.DB_START.'project` where YEAR(setdate)='.ceil($cr_year).' and  project_type='.ceil($ptype_val).' and   status=1    ')  ;
$results_rc_total=$results_rc[0]->rc;
 
$rc_total_page=ceil(($results_rc_total-1)/$perP_base);
 
 

//  $results = DB::select('SELECT  * FROM `'.$prefix.'project`  ');
if (count($results )>0){
$i=-1;
foreach ($results as $ms) { 

if($i>0 && $i%3==0)  $pdVal.=' <div class="col-xs-12 mb10">&nbsp; </div>';

$cng_arr=Config::get('gbkey.project_slide_manyfile');

$tlang='title'.$this->lang;
$slang='short'.$this->lang;
$thumb=''; 
	$ns ='';
	 	if($ms->ff_slide!=''){
				 	$thumb_val=explode(',',$ms->ff_slide); 						
				 	$thumb_total=ceil($thumb_val[0]);
				  	$thumb_path=$cng_arr['folder_val'].'/'.$thumb_val[1]; 
					// $ww=$cng_arr['max_w'];	
					// $hh=$cng_arr['max_h']; 
					 $ww=320;
					 $hh=400; 
					
					if( file_exists($this->filepath_dir.$thumb_path) && $thumb_total>0){
						$newcbsize = myfunc::imgVirtualResize( $this->filepath_dir.$thumb_path,	$ww,  $hh);	
 
					
						//$ns=' width="'.round($newcbsize[0]).'" height="'.round($newcbsize[1]).'"    ';
						
						 $ns=' class="img-responsive" ' ;
						$thumb='<img src="'. $this->filepath_url.$thumb_path .'" alt="" '.$ns.'/>';
					}
		}
		if($thumb=='') $thumb='<img  class="img-responsive"  src="'.url('static/images/pj_thumb.jpg') .'" alt=""  />';  
			
$href=url($this->lang_name.$this->mytxt('projects','href').'/'.$ms->url_rewrite);
$this_link=' href="'.$href.'" ';
 
 
		
$btnA=' <div class="col-xs-6 pitem2Btn"><a class="btn btn-default" href="'.$href.'#'.myfunc::only_az($this->mytxt('tab_pr_link'),'').'" title="'.$this->mytxt('pr','tt').'">'.$this->mytxt('pr','tt').'</a></div>';
$btnB=' <div class="col-xs-6 pitem2Btn"><a  class="btn btn-default"  href="'.$href.'#'.myfunc::only_az($this->mytxt('tab_mi_link'),'').'"  title="'.$this->mytxt('mi','tt').'">'.$this->mytxt('mi','tt').'</a></div>';
if($ms->onoff_pr==0){$btnA='';  $btnB=str_replace('col-xs-6','col-xs-12',$btnB); }
if($ms->onoff_mi==0){$btnB=''; $btnA=str_replace('col-xs-6','col-xs-12',$btnA); }

$isf=0;			
if($i==-1 && $page==1){
				
 $pdVal.=' <div class="col-xs-12 first_item hidden-xs ">
  <div class=" pjlist_item clearfix">
	 <div class="col-sm-7  col-md-6 col-lg-5 col-xs-5 m0 p0">
	 <a '.$this_link.'>'.$thumb.'</a>
	 </div>
	 
	 <div class="col-sm-5  col-md-6  col-lg-7 col-xs-7 first_item_cnt">
	 
	 <a '.$this_link.'><strong>'.$ms->$tlang .'</strong></a> 

 <div class="pc_txt fs dotdotdot">'.nl2br($ms->$slang).'</div> 
 
	 
	 
	 <div class="col-xs-12 clearfix text-center m0 p0 pjlist_btn_cnt" >
	 <div class="pjlist_btn_cnt_inner">
	 '. $btnA.$btnB.'
	  </div>
	 </div>
	 
	 </div>
 
 	 
	  
	 </div>
 </div>
 <div class="col-xs-12 hidden-xs" style="height:50px;">&nbsp; </div>		
 ';

$isf=1;		
}
// '.nl2br(  mb_strimwidth($ms->$slang,0,400,'...','utf-8')) .' 
 
 
$fsStat=($isf==1)?' hidden-sm hidden-md hidden-lg ':'';
			
 $pdVal.=' <div class="col-xs-12 col-sm-4 pjlist_item_col4 '.$fsStat.'" >	 <div class="clearfix pjlist_item">
 <div class="pitem_img"><a '.$this_link.'>'.$thumb.'</a></div>
 
 <div class="pitem_content">
 
 <a '.$this_link.'><strong>'.$ms->$tlang .'</strong></a> 
 <div class="pc_txt dotdotdot">'.nl2br($ms->$slang).'</div> 
 
 </div>
 
 	 
	 <div class="col-xs-12 clearfix text-center m0 p0 pjlist_btn_cnt" >
	 <div class="pjlist_btn_cnt_inner">
	 '. $btnA.$btnB.'
	 </div>
	 </div>
	 
 </div>
 </div>';
 
 
 $pdVal.= ' <div class="col-xs-12 clearfix visible-xs" >&nbsp;</div>';

 
$i++;;


}
}

if( $rc_total_page>$page ){


	$pdVal.=' <div class="col-xs-12 clearfix text-center m0 p0 lmBtn pos-rel " >
	 <a data-year="'.$cr_year.'" data-ptype="'.$ptype_val.'" data-page="'.($page+1).'" class="radBtn tf_upp">'.$this->mytxt('load_more').'</a>
	 </div>';
}
return  $pdVal;

} 

public function showProject($ptype=1, $p1=null,$p2=null,$p3=null){
 
//$this->checkProject(); 

$this->layout = View::make('inner_view');

$p2=myfunc::only_az2($p2);/*
if($p2!='' && !is_numeric($p2)){
return $this->showProjectDetail($p2);
}*/
switch($ptype){
case 1:
$pKey='on_going';
$ptype_val='1';
$bar =' green ';

break;
case 2:
$pKey='project_hg';
$ptype_val='2';
$bar =' orange ';

break;
}

$this->site_url=url($this->lang_name.$this->mytxt($pKey,'href'));

$this->psetting->page_title=$this->mytxt($pKey,'tt').' - '.$this->psetting->page_title;


$prefix=Config::get('database.connections.mysql.prefix');

$yy_arr=array();
 $results = DB::select('SELECT  YEAR(setdate) as yy FROM `'.$prefix.'project` where project_type='.ceil($ptype_val).' and status=1 GROUP BY YEAR(setdate) ');
if (count($results )>0){
$cn=0;
foreach ($results as $ms) { 
$yy_arr[]=$ms->yy;
}
}
rsort($yy_arr);
if(!isset($yy_arr[0])) $yy_arr[0]=date('Y');
$cr_year=( is_numeric($p2) &&  in_array($p2,$yy_arr) )?$p2:$yy_arr[0];
 

$yy_menu='';
$li_val='';
$fyear='';
$yi=0;
$cr='';
foreach($yy_arr as $yVal){
$cr=($p2=='' && $yi==0)?'iscr':'';
$cr=($p2==$yVal)?'iscr':$cr;
/*
$yy_menu.='<li><a class="btn btn-default '.$cr.'" title="'.$yVal.'" href="'.url($this->lang_name.$this->mytxt($pKey,'href').'/'.$yVal).'">'.$yVal.'</a></li>';
*/
if($cr=='iscr'){
$fyear=$yVal;
}else{
$li_val.='<li>
<a class="tyBtn"    title="'.$yVal.'" href="'.url($this->lang_name.$this->mytxt($pKey,'href').'/'.$yVal).'">'.$yVal.'</a>
</li>';
}
$yi++;
}

$pdVal='';



  $ymenu_val=(count($yy_arr)>1)?'<ul id="yearTabs" class="nav nav-tabs col-xs-12  m0 p0 clearfix" role="tablist">
<li class="dropdown active  " role="presentation">
	<a id="myTabDrop1" class="dropdown-toggle" aria-controls="myTabDrop1-contents" data-toggle="dropdown" href="#" aria-expanded="false">
	<span id="cr_pr_year">'.$fyear.'</span>&nbsp;
			<i class="f2 fa fa-angle-down"></i>
	</a>
	<ul id="myTabDrop1-contents" class="dropdown-menu" aria-labelledby="myTabDrop1">
	'.$li_val.'
	</ul>
</li>
</ul>':'
<ul id="yearTabs" class="nav nav-tabs col-xs-12  m0 p0 clearfix" role="tablist">
<li class="dropdown active  " role="presentation">
	<a id="myTabDrop1" class="dropdown-toggle"  ">
	<span id="cr_pr_year">'.$fyear.'</span>
	</a>
</li>
</ul>
';
			
/*
	 <ul id="yy_menu">'.$yy_menu.'</ul>
*/
	
$bann_hmk= ($this->ishome==1)?'<p style="padding-'.(($ptype_val==1)?'right':'left').':15px;"><img src="'.url('static/images/hbanner'.$ptype_val.'_min'.$this->lang.'.jpg').'" alt="" class="img-responsive visible-xs"/></p>':'<img src="'.url('static/images/hbanner'.$ptype_val.'_min'.$this->lang.'.jpg').'" alt="" class="img-responsive visible-xs"/>';

$bnVal=($this->ishome==1)?'

				<span id="'.$this->mytxt($pKey,'href').'_mk"  class="h_marker"></span><span class="line"></span>
				<h3 class="tt">'.$this->mytxt($pKey,'banner').'</h3>
				'.$bann_hmk.'
':'
		<div id="inner_fix"><img src="'.url('static/images/banner_'.$pKey.'_inner.jpg').'" alt="" class="hidden-xs"/></div>
	
				<h3 class="tt">'.$this->mytxt($pKey,'banner').'</h3>
				'.$bann_hmk.'
';
 
 
			
			
 $this_content='
  	<div id="banner" class="'.$pKey.' lg'.$this->lang.'">
		<div id="banner_inner">
				'.$bnVal.'
		</div>
	</div>
	<div class="colorbar '.$bar .'">
	</div>
	
	
 <div class="container m0 p0 ma0 pt'.$ptype_val.'">
 
	 <div class="col-xs-12 clearfix text-center m0 p0" id="project_year_cnt">
	 '.  $ymenu_val.'
	 </div>
	 
	 <div class="col-xs-12 clearfix text-center m0 p0" id="projectListCnt'.$ptype_val.'">
	 '. $this->getProjectList( ceil($ptype_val), $cr_year,1).'
	 </div>
 </div>';
  
  
	$this->psetting->head_css_js.=' '; 
$this->psetting->plus_css_js.='	  ';
	 
$this->psetting->head_css_js.=' '; 
if($this->pjs_loaded==0){
$this->psetting->plus_css_js.='<script src="'.url('static/js/js.project.js').'"></script>';
$this->pjs_loaded=1;
}
 $this->layout->page_title =  	$this->psetting->page_title;
		  
		$this->layout->meta_data=    	$this->psetting->meta_data;
        $this->layout->head_css_js=  	$this->psetting->head_css_js;
		
         $this->layout->nav=    	$this->nav_func($p1,$p2,$p3);
         $this->layout->content= myfunc::removebreak ($this_content);
        $this->layout->plus_css_js=    $this->psetting->plus_css_js;
		 
		
         $this->layout->footer=   	$this->footer_func();
		
		
		 
 
		
		 
}  
  
 
public function notfound(){
	
		$this->layout = View::make('notfound');
		$this->layout->title='404 file not found';
}


  
public function showSAP($p1=null,$p2=null,$p3=null){
	 
$this->layout = View::make('inner_view');

$tlang='title'.$this->lang; 
$dlang='detail'.$this->lang; 
$mblang='mb_txt'.$this->lang; 
		
$bn=$this->load_banner();
$this->site_url=url($this->lang_name.$this->mytxt('sap','href'));


$this->psetting->page_title=$this->mytxt('sap','tt').' - '.$this->psetting->page_title;
 
$ppms=	 DB::table( 'submit_file_page'  )->  where('id',1)->first();		 
if(count($ppms)==0) return $this->notfound();	


$fileBox='';
for($x=1;$x<3;$x++){
		$thumb='';
		if($this->lang==1){
		 $key_cng='spfile'.$x.'_onefile';
		$fdKey='ff_file'.$x; 
		}else{
		 $key_cng='spfile'.$x.'_zh_onefile';
		$fdKey='ff_file_zh'.$x; 
		
		}
		$cng_arr=Config::get('gbkey.'.$key_cng);
	 
 		$this_Kry= $ppms->$fdKey;
		if($this_Kry!=''){
		$thumb_val=explode(',',$this_Kry); 						
		$thumb_total=ceil($thumb_val[0]);
		$thumb_path= $cng_arr['folder_val'].'/'.$thumb_val[1]; 
		
		/*
		<p class="m0">'.$this->mytxt('sapbtn'.$x).'</p>
		*/
		if( file_exists($this->filepath_dir.$thumb_path) && $thumb_total>0){ 
			$fileBox.='
		<div class="col-xs-6 sapItem" >
		
		<table cellpadding="0" cellspacing="0" class="col-xs-12 m0 p0  sapItem_table">
		<tr>
		<td class="text-center"><p class="m0">'.$this->mytxt('sapbtn'.$x).'</p></td>
		</tr>
		</table>
		<a href="'.$this->filepath_url.$thumb_path.'" target="btn" class="btn btn-default radBtn" >'.$this->mytxt('down').'&nbsp;<i class="fa fa-download"></i></a>
		</div>
			';
			}
		}
}
 /*
 
<p class="fs12 text-info mb20">( jpg,jpeg,bmp,png,doc,docx,zip,rar,pdf | 10MB )</p>*/

$fm1='<div class="col-xs-10 col-xs-offset-1 clearfix text-center  p0 hidden-xs"  id="sap_form_cnt" style="border-bottom:1px solid #000;">
<p>&nbsp;</p>
<h2 class=" mt20 mb20 noupp nobold fs26">'.$ppms->$tlang.'</h2>
<h4 class=" mt20 mb10  noupp nobold fs16 ">'.nl2br($ppms->$dlang).'</h4>
	 <div class="col-xs-12 clearfix text-center m0 p0" id="sapUpForm">
	</div>

</div>';

$fm2='<div class="col-xs-12 clearfix text-center  p0 hidden-sm hidden-md hidden-lg"  id="sap_form_cnt2" >
<p>&nbsp;</p>
<h2 class=" mt20 mb20 noupp nobold fs24">'.$ppms->$tlang.'</h2>
<div class=" sap_mbtxt col-xs-12">'.myfunc::exp_fck($ppms->$mblang).'</div>
	 <div class="col-xs-12 clearfix text-center m0 p0" id="sapUpForm">
	</div>

</div>';


$bann_hmk= ($this->ishome==1)?'<p style="padding-right:15px;"><img src="'.url('static/images/hbanner3_min'.$this->lang.'.jpg').'" alt="" class="img-responsive visible-xs"/></p>':'<img src="'.url('static/images/hbanner3_min'.$this->lang.'.jpg').'" alt="" class="img-responsive visible-xs"/>';


$bnVal=($this->ishome==1)?'
		<span id="'.$this->mytxt('sap','href').'_mk"  class="h_marker"></span><span class="line"></span>
				<h3 class="tt">'.$this->mytxt('sap','banner').'</h3>
					'.$bann_hmk.'
':'
		<div id="inner_fix"><img src="'.url('static/images/banner_sap_inner.jpg').'" alt="" class="hidden-xs"/></div>
		<h3 class="tt">'.$this->mytxt('sap','banner').'</h3>
		
		'.$bann_hmk.'
';
$this_content=(' 
 	<div id="banner" class="sap lg'.$this->lang.'">
		<div id="banner_inner">
	 		'.$bnVal.'
		</div>
	</div>
	
	<div class="colorbar lblue">
		<div class="container pos-rel"></div>
	</div>

<div class="container">
	 <div class="col-xs-12 clearfix text-center m0 p0 sapBaseCnt" >
 
'.$fm1.'
'.$fm2.'


<div class="sapdnCnt col-xs-12 col-xs-offset-0 col-sm-10 col-sm-offset-1 clearfix text-center  p0">
	 '.	$fileBox.'
</div>

	 </div>
	 
 </div>
');				
 
  
 

$this->psetting->plus_css_js.='<script src="'.url('static/js/js.sap.js').'" type="text/javascript"></script>';


 $this->layout->page_title =  	$this->psetting->page_title;
		  
		$this->layout->meta_data=    	$this->psetting->meta_data;
        $this->layout->head_css_js=  	$this->psetting->head_css_js;
		
         $this->layout->nav=    	$this->nav_func($p1,$p2,$p3);
         $this->layout->content= myfunc::removebreak ($this_content);
        $this->layout->plus_css_js=    $this->psetting->plus_css_js;
		 
		
         $this->layout->footer=   	$this->footer_func();
		
		
}
  
public function showSON($p1=null,$p2=null,$p3=null){
 
 
		$this->layout = View::make('inner_view');
		
$this->psetting->page_title=$this->mytxt('son','tt').' - '.$this->psetting->page_title;
 

$this->site_url=url($this->lang_name.$this->mytxt('son','href'));



$fm1='<div class="col-xs-10 col-xs-offset-1 clearfix text-center  p0 hidden-xs"  id="sap_form_cnt" >
<h2 class=" mt20 mb20 noupp nobold fs26">'.$this->mytxt('sap_tt').'</h2>
<h4 class=" mt20 mb10  noupp nobold fs16 " style="line-height:1.5em; text-align:center">'.$this->mytxt('sap_msg').'</h4>
 

<p>&nbsp;</p>
</div>';

$fm2='<div class="col-xs-12 clearfix text-center  p0 hidden-sm hidden-md hidden-lg"  id="sap_form_cnt2" >
<h2 class=" mt20 mb20 noupp nobold fs24 col-xs-12">'.$this->mytxt('sap_tt').'</h2>
<div class=" sap_mbtxt col-xs-12" style="text-align:center">'.$this->mytxt('sap_msg').'</div>
 
</div>';



$bnVal=($this->ishome==1)?'

				<h3 class="tt">'.$this->mytxt('son','banner').'</h3>
				<img src="'.url('static/images/hbanner_son_min'.$this->lang.'.jpg').'" alt="" class="img-responsive visible-xs"/>
':'
		<div id="inner_fix"><img src="'.url('static/images/banner_son_inner.jpg').'" alt="" class="hidden-xs"/></div>
				<img src="'.url('static/images/hbanner_son_min'.$this->lang.'.jpg').'" alt="" class="img-responsive visible-xs"/>
	
				<h3 class="tt">'.$this->mytxt('son','banner').'</h3>
';
 
	
	
$this_content=(' 
 	<div id="banner" class="son lg'.$this->lang.'">
		<div id="banner_inner">
			'.$bnVal.'
 		</div>
	</div>
	
	<div class="colorbar violet">
		<div class="container pos-rel"></div>
	</div>
 <div class="container">
 
 
	 
	 <div class="col-xs-12 clearfix text-center m0 p0" style="min-height:400px">
<p>&nbsp;</p>
'.$fm1.'
'.$fm2.'
<p>&nbsp;</p>
<div class="col-xs-12 clearfix text-center m0 p0"  id="sap_form_cnt">
<form id="infoform" class="appform" onsubmit="return false">
<input name="action" type="hidden" value="sap" />

<div class="col-xs-12 clearfix snf_fd"  >
	<div class="col-xs-4 col-sm-2 text-right mt5 text-grey fs16">'.$this->mytxt('name').'</div><div class="col-xs-7  col-sm-9 mb10 clearfix text-left "><input name="sap_name" type="text" value="" class="form-control required snf_fd_inp" style=""/></div> 
</div>

<div class="col-xs-12 clearfix snf_fd" >
	<div class="col-xs-4 col-sm-2 text-right  mt5 text-grey fs16">'.$this->mytxt('email').'</div><div class="col-xs-7  col-sm-9 clearfix text-left "><input name="sap_email" type="text" value="" class="form-control email required snf_fd_inp"  style=" "/></div> 
</div>

<div class="col-xs-12 mt5 mb5" id="error_ct">&nbsp;</div>
<div class="col-xs-12">
	<button type="submit" class="  radBtn btn-violet tf_upp">'.$this->mytxt('subscribe').'</button>

</div>
</form>
</div>

	 </div>
 </div>
');				
 
  
$this->psetting->plus_css_js.='
<script src="'.url('static/js/validate/jquery.form.js').'" type="text/javascript"></script>
<script src="'.url('static/js/validate/jquery.validate.min.js').'" type="text/javascript"></script>';
$this->psetting->plus_css_js.=($this->lang==2)?'<script type="text/javascript" src="'.url('static/js/validate/messages_tw.js').'"></script>':'';
 $this->psetting->plus_css_js.='<script type="text/javascript" src="'.url('static/js/js.son.js').'"></script>';




 $this->layout->page_title =  	$this->psetting->page_title;
		  
		$this->layout->meta_data=    	$this->psetting->meta_data;
        $this->layout->head_css_js=  	$this->psetting->head_css_js;
		
         $this->layout->nav=    	$this->nav_func($p1,$p2,$p3);
         $this->layout->content= myfunc::removebreak ($this_content);
        $this->layout->plus_css_js=    $this->psetting->plus_css_js;
		 
		
         $this->layout->footer=   	$this->footer_func();
		
		
		 
	}
	
	
public function showContact($ptype){
 
 $this->getdefault();
$this->layout = View::make('inner_view');
	
$get_layout=sformController::showForm(  $this->form_setting,1);
	
$this->site_url=url($this->lang_name.$this->mytxt('contact','href'));
 



$bnVal= '
		<div id="inner_fix"><img src="'.url('static/images/banner_contact_inner.jpg').'" alt="" class="hidden-xs"/></div>
	
				<h3 class="tt">'.$this->mytxt('contact','banner').'</h3>
				<img src="'.url('static/images/hbanner_contact_min'.$this->lang.'.jpg').'" alt="" class="img-responsive visible-xs"/>
';
 
	 
if($this->lang==1){

	
	$fm1='<div class="col-xs-12 clearfix text-center    hidden-xs"  id="cat_form_cnt" >
<h2 class=" mt20 mb20 noupp nobold fs26">K&K Charity is always here for any enquiries or comments for improvement.</h2>

 <p>&nbsp;</p>
</div>';

$fm2='<div class="col-xs-12 clearfix text-center    hidden-sm hidden-md hidden-lg"  id="cat_form_cnt2" >
<h2 class=" mt20 mb20 noupp nobold fs24 col-xs-12">K&K Charity is always here for any enquiries or comments for improvement.</h2>

 <p>&nbsp;</p>
</div>';

}else{

	$fm1='<div class="col-xs-12 clearfix text-center    hidden-xs"  id="cat_form_cnt" > 
 
<h2 class=" mt20 mb20 noupp nobold fs26">建灝慈善基金樂意聆聽你的意見。</h2>
<h4 class=" mt20 mb10  noupp nobold fs16 " style="line-height:1.5em; text-align:center">
如對本基金會有任何疑問或查詢，歡迎透過以下方法聯繫我們。
</h4>
 <p>&nbsp;</p>
</div>';

$fm2='<div class="col-xs-12 clearfix text-center    hidden-sm hidden-md hidden-lg"  id="cat_form_cnt2" > 
<h2 class=" mt20 mb20 noupp nobold fs24 col-xs-12">建灝慈善基金有限公司樂意聆聽你的意見。</h2>
<h4 class=" mt20 mb10  noupp nobold fs16 " style="line-height:1.5em; text-align:center"> 
如對本基金會有任何疑問或查詢，歡迎透過以下方法聯繫我們。</h4>
 <p>&nbsp;</p>
</div>';
}
	 /*
	 
	 
建灝慈善基金有限公司 樂意聆聽你的意見。若然閣下對本基金有任何疑問或查詢，或冀更進一步認識 建灝慈善基金有限公司 ，<br/>
歡迎透過以下方法聯繫我們，將有專人在2個工作天內回應你的查詢。<br/>
Whether you have enquiries about us , or any comments for improvement.<br/>
K&K Charity is always there to listen. We will respond to your message within 48 hours. Let\'s stay in touch.<br/>

<div class=" sap_mbtxt col-xs-12" style="text-align:center">'.$this->mytxt('sap_msg').'</div>

	 <div class="col-xs-12 clearfix text-center m0 p0" style="min-height:400px">
<p>&nbsp;</p>
'.$fm1.'
'.$fm2.'
<p>&nbsp;</p>
<div class="col-xs-12 clearfix text-center m0 p0"  id="sap_form_cnt">
*/





$this_content=($this->lang==1)?' 
 	<div id="banner" class="contact lg'.$this->lang.'">
		<div id="banner_inner">
			'.$bnVal.'
		</div>
	</div>
	
	<div class="colorbar dred">
		<div class="container pos-rel"></div>
	</div>
	
<div class="container m0 p0 ma0" style="padding:50px 0 50px 0;">

	'.$fm1.'
	'.$fm2.' 
	<div class="col-xs-12 col-sm-6 fs16">
	
	<h4 class=" noupp nobold fs16 " style="line-height:1.5em; text-align:left">
Address:<br/>
K&K Charity Limited,<br/>
17/F, China Building, <br/>
No.29 Queen&apos;s Road Central,<br/>
Central, Hong Kong<br/>
<br/>
Email: info@kkcharity.org<br/>
Phone: (852) 2217 5888<br/>
Fax: (852) 2217 6996<br/>
 </h4>
 
 
	</div>
	<div class="col-xs-12 col-sm-6 m0 p0" id="contact_form_cnt">

																			'.$get_layout.'
		</div> 
	</div> 
</div>
':'

 	<div id="banner" class="contact lg'.$this->lang.'">
		<div id="banner_inner">
				
			'.$bnVal.'
		</div>
	</div>
	
	<div class="colorbar dred">
		<div class="container pos-rel"></div>
	</div>
	
<div class="container m0 p0 ma0" style="padding:50px 0 50px 0;">

	'.$fm1.'
	'.$fm2.'  
	<div class="col-xs-12 col-sm-6 fs16">
	
	
	<h4 class=" noupp nobold fs16 " style="line-height:1.5em; text-align:left">
地址：<br/>
建灝慈善基金有限公司<br/>
香港中環皇后大道中29號華人行17樓<br/>
<br/>
電郵：info@kkcharity.org<br/>
電話：(852) 2217 5888<br/>
傳真：(852) 2217 6996

</h4>
 
	</div>
	<div class="col-xs-12 col-sm-6 m0 p0" id="contact_form_cnt">
	<p class="visible-xs">&nbsp;</p>
 
																			'.$get_layout.'
		</div> 
	</div> 
</div>

'

;				
 
  
  
	$this->psetting->head_css_js.=' '; 
$lang_js='';
switch($this->lang){
case 2:$lang_js='<script src="'.url('static/js/validate/messages_tw.js').'"></script> '; break;
} 
   
$this->psetting->plus_css_js.='<script src="'.url('static/js/validate/jquery.form.js').'"></script>
<script src="'.url('static/js/validate/jquery.validate.min.js').'"></script> 
'.$lang_js.'
<script src="'.url('static/js/validate/jquery.validate.plus.js').'"></script> 
';

$this->psetting->plus_css_js.='<script type="text/javascript" src="'.url('static/js/js.contact.js').'"></script>'; 

 $this->layout->page_title =  	$this->psetting->page_title;
		  
		$this->layout->meta_data=    	$this->psetting->meta_data;
        $this->layout->head_css_js=  	$this->psetting->head_css_js;
		
         $this->layout->nav=    	$this->nav_func('','','');
         $this->layout->content=myfunc::removebreak ($this_content);
        $this->layout->plus_css_js=    $this->psetting->plus_css_js;
		 
		
         $this->layout->footer=   	$this->footer_func();
		
		
		 
}
 
 
 	
 
public function showOnepage($ptype){
 
 switch($ptype){
	
case 1:
$key='privacy';
break;

case 2:
$key='disc';

break;
	
}
 
$this->site_url=url($this->lang_name.$this->mytxt($key,'href'));
 
$this->layout = View::make('inner_view');
	
$tlang='title'.$this->lang; 
$dlang='detail'.$this->lang; 
		
$bn=$this->load_banner();
 
$ppms=	 DB::table( 'onepage'  )->  where('id',$ptype)->first();		 
if(count($ppms)==0) return $this->notfound();	


$this_content=(' 
<div class="container m0 p0 ma0" id="projectdetailCnt">
	<div class="col-xs-12" style="padding-bottom:60px;">
		<p>&nbsp;</p>
		<h1 class="main_h1 main_h1 tf_upp">'.$ppms->$tlang.'</h1>
		<div>
		'.myfunc::exp_fck($ppms->$dlang).'
		</div>
	</div> 
</div>
');				
 
  
  
	$this->psetting->head_css_js.=' '; 
$this->psetting->plus_css_js.='';



 $this->layout->page_title =  	$this->psetting->page_title;
		  
		$this->layout->meta_data=    	$this->psetting->meta_data;
        $this->layout->head_css_js=  	$this->psetting->head_css_js;
		
         $this->layout->nav=    	$this->nav_func('','','');
         $this->layout->content= myfunc::removebreak ($this_content);
        $this->layout->plus_css_js=    $this->psetting->plus_css_js;
		 
		
         $this->layout->footer=   	$this->footer_func();
		
		
		 
}
 
function load_abs_ppr(){
 	
$tlang='title'.$this->lang; 
$plang='pos'.$this->lang; 
$dlang='detail'.$this->lang; 
	
	
 
$this->site_url=url($this->lang_name.$this->mytxt('about','href'));

	$results=	 DB::table(	'about_partner')->where('status',1	 ) ->orderBy('rank', 'asc')->get();		 
 
 			$ww=160;
	$hh=100;
 			$ww2=120;
	$hh2=80;
					
 	 $str='';
		 $key_cng='about_partner_onefile';
		$cng_arr=Config::get('gbkey.'.$key_cng);
		$fdKey='ff_thumb';
			$str_arr=array();
		if (count($results )>0){
		 $i=1;
			foreach ($results as $ms) { 

					$thumb=''; 
					$thumb2='';
					 
					$st=' style="margin:0 auto; float:none"';
					//$st=($i>1 && $i%2==0)?' style="padding-left:40px; " ':'  style="padding-right:40px; " ';
					
					$this_Kry= $ms->$fdKey;
					
					if($this_Kry!=''){
				 	$thumb_val=explode(',',$this_Kry); 						
				 	$thumb_total=ceil($thumb_val[0]);
				  	$thumb_path= $cng_arr['folder_val'].'/'.$thumb_val[1]; 
		
		
					$thumb='';
						
						if( file_exists($this->filepath_dir.$thumb_path) && $thumb_total>0){
		
					$newcbsize = myfunc::imgVirtualResize( $this->filepath_dir.$thumb_path,	$ww,  $hh);	
					$newcbsize2 = myfunc::imgVirtualResize( $this->filepath_dir.$thumb_path,	$ww2,  $hh2);	
 
					$ns='';	
					$st='';
						// $ns=' class="img-responsive" ' ;
						$mval=($newcbsize[1]<$hh)? ceil(($hh-$newcbsize[1])/2).'px':'0px';;
						$mval2=($newcbsize2[1]<$hh2)? ceil(($hh2-$newcbsize2[1])/2).'px':'0px';;
						$thumb='<img  '.	$st.' src="'. $this->filepath_url.$thumb_path .'"  class="hidden-xs" style="margin:0 auto; margin-top:'.$mval.';float:none; width:'.$newcbsize[0].'px; height:'.$newcbsize[1].'px" alt="'.$ms->$tlang.'" '.$ns.'/>';
						$thumb2='<img  '.	$st.' src="'. $this->filepath_url.$thumb_path .'"  class="img-responsive visible-xs" style="margin:0 auto;  margin-top:'.$mval2.'float:none;  max-width:'.$newcbsize2[0].'px; max-height:'.$newcbsize2[1].'px" alt="'.$ms->$tlang.'" '.$ns.'/>';
								
						}
					}
					
				//	$sval=($i>1 && $i%2==0)?' pull-right ':'';
			 	$sval='';
					
					$href_1=$ms->linkto1;
					$href_2=$ms->linkto2;
					if($this->lang==2){
						$kl=(	$href_2!='')?$href_2:$href_2;
					}
					if($this->lang==1){
						$kl=(	$href_1!='')?$href_1:$href_2;
					}
					$kl=($kl!='')?$kl:'#';
					
					$href=' href="'.$kl.'" target="_blank" ';
	
						
					$str.='
						<div class="col-xs-6 col-sm-3 '.$sval.' mb20 hidden-xs"  style="height:'.$hh.'px"><a '.$href.' title="'.$ms->$tlang.'" class=" text-center btn-block">'.	$thumb.'</a></div> 
						<div class="col-xs-6 col-sm-3 '.$sval.' mb20 visible-xs"  style="height:'.$hh2.'px"><a '.$href.' title="'.$ms->$tlang.'" class=" text-center btn-block">'.	$thumb2.'</a></div> 
	
					';
					
	$str.=($i>1 && $i%2==0)?'<div class="col-xs-12 brline visible-xs">&nbsp;</div> ':'';
	
					$i++;
	}}
	return 
	
	'<div class="col-xs-12 clearfix mt20 mb20" style="border-top:1px solid #000;">	
					<div class="col-xs-12 clearfix mt20 mb20">	 '.$str.'
					</div></div>';
}
function load_abs_ppl(){
	

$tlang='title'.$this->lang; 
$plang='pos'.$this->lang; 
$dlang='detail'.$this->lang; 
	
	
 
$this->site_url=url($this->lang_name.$this->mytxt('about','href'));

	$results=	 DB::table(	'about_ppl')->where('status',1	 ) ->orderBy('rank', 'asc')->get();		 
 
 	 $str='';
		 $key_cng='about_ppl_onefile';
		$cng_arr=Config::get('gbkey.'.$key_cng);
		$fdKey='ff_thumb';
			$str_arr=array();
		if (count($results )>0){
		 $i=1;
			foreach ($results as $ms) { 

					$thumb=''; 
					 
					$st=($i>1 && $i%2==0)?' class="img-responsive ppl_left" ':' class="img-responsive ppl_right"  ';
					
					$this_Kry= $ms->$fdKey;
					
					if($this_Kry!=''){
				 	$thumb_val=explode(',',$this_Kry); 						
				 	$thumb_total=ceil($thumb_val[0]);
				  	$thumb_path= $cng_arr['folder_val'].'/'.$thumb_val[1]; 
		
		
					$thumb='';
						
						if( file_exists($this->filepath_dir.$thumb_path) && $thumb_total>0){
							 
								
						 $ns='   ' ;
						$thumb='<img  '.	$st.' src="'. $this->filepath_url.$thumb_path .'" alt="'.$ms->$tlang.'" '.$ns.'/>';
								
						}
					}
					
					$sval=($i>1 && $i%2==0)?' pull-right ':'';
					 
					
					$mbcnt=($i>1 && $i%2==0)?' 
						<td class="col-xs-6 col-sm-8 visible-xs ">
							<h2 class="m0 p0 mb5 notf">'.$ms->$tlang.'</h2>
							<h3  class="m0 p0 mb10 notf">'.$ms->$plang.'</h3>
						</td>
						<td class="cm_thumb col-xs-6 col-sm-4    ">
							'.	$thumb.'
						</td>
					':'
						<td class="cm_thumb col-xs-6 col-sm-4   ">
							'.	$thumb.'
						</td>
						<td class="col-xs-6 col-sm-8 ">
							<h2 class="m0 p0 mb5 notf">'.$ms->$tlang.'</h2>
							<h3  class="m0 p0 mb10 notf">'.$ms->$plang.'</h3>
						</td>
					';
					
					$str.='
					<div class="col-xs-12 clearfix mt20 mb20 hidden-xs">
					
								
									<div class="cm_thumb col-xs-6 col-sm-4 '.$sval.'"  >'.	$thumb.'</div>
									<div class="col-xs-6 col-sm-8 ">
									<h2 class="m0 p0 mb5 notf">'.$ms->$tlang.'</h2>
									<h3  class="m0 p0 mb10 notf">'.$ms->$plang.'</h3>
									
									<div class="mb20 ">'.myfunc::exp_fck($ms->$dlang).'</div>
									
									</div>
					</div>
								<div class="col-xs-12 clearfix mt20 mb20 visible-xs" >
									
									<table class="col-xs-12 p0 m0 absppl_mb" cellpadding="0" cellspacing="0">
									<tr>
									'.$mbcnt.'
									</tr>
									</table>
								
									<div class="mb20">'.myfunc::exp_fck($ms->$dlang).'</div>
									
								</div>
									 
						
					';
					
					$i++;
	}}
	return 
	
	'<div  style="border-top:1px solid #000; margin-left:15px; margin-right:15px">		<p>&nbsp;</p>
	
	'.$str.'
	</div>';
}
	
function home_cval(){
	$str='';
	$mn='';
	if( isset($this->sysval['opt_kkc_total'])){
	$ctotak=myfunc::zerofill( $this->sysval['opt_kkc_total'],5 );
	
	$arr1 = str_split($ctotak);
	foreach(	$arr1 as $aVal){
	
	$mn.='<li>'.$aVal.'</li>';
	}
	
	}
	
	$mb_msg=($this->lang==1)?str_replace('WE','<br>WE',$this->mytxt('cr_msg')):$this->mytxt('cr_msg');
	$he='
	<div class="msg visible-xs">
	'.$mb_msg.'
	</div>';
	$str=' 
	<div id="home_cnr">
	<ul class="num">
	'.$mn.'
	</ul>
	<div class="msg hidden-xs">
	'.$this->mytxt('cr_msg').'
	</div>
	'.	$he.'
	</div> 
	';
	return $str;
}
 
public function showHome($p1=null,$p2=null,$p3=null){

$isAb=($p1==$this->mytxt('about','href'))?1:0;	
if( isset($this->sysval['opt_uis']) && $this->sysval['opt_uis']==1	&& $isAb==0){		
return $this->uis();		
}else{ 
$this->ishome=1;


$this->showProject(1,$this->mytxt('on_going','href'),'','');
$sp1_val=   $this->layout->content;
 
$this->showProject(2,$this->mytxt('project_hg','href'),'','');
$sp2_val=   $this->layout->content;
  
$this->showSAP( $this->mytxt('sap','href'),$p2,$p3);
$sp3_val=   $this->layout->content;

$sp1_val=str_replace('id="banner" class="','id="hbanner_1" class="homeBanner ',$sp1_val) ;
$sp2_val=str_replace('id="banner" class="','id="hbanner_2" class="homeBanner ',$sp2_val) ;
$sp3_val=str_replace('id="banner" class="','id="hbanner_3" class="homeBanner ',$sp3_val) ;
 
$sp1_val=str_replace('id="banner_inner"','class="banner_inner"',$sp1_val) ;
$sp2_val=str_replace('id="banner_inner"','class="banner_inner"',$sp2_val) ;
$sp3_val=str_replace('id="banner_inner"','class="banner_inner"',$sp3_val) ;

   
$this->layout = View::make('inner_view');
	
	
$tlang='title'.$this->lang; 
	
$dlang='detail'.$this->lang; 
		
 $bn=$this->load_banner();
 
 
$ppms=	 DB::table( 'about'  )->  where('id',1)->first();		 
if(count($ppms)==0) return $this->notfound();	

//container

$ab_tt=($ppms->$tlang!='')?'	<h1  class="main_h1  ">'.$ppms->$tlang.'</h1>':'<p>&nbsp;</p>';
		  $this_content=(' 
<div class="banner_cnt m0 p0 ma0 lg'.$this->lang.'">
<div class="owl-carousel" id="myplist">
  '. $bn.'
</div>
	<div class="colorbar blue">
		<div class="container pos-rel">
		'.$this->home_cval().'
		</div>
	</div>
</div>

<div id="'.$this->mytxt('about','href').'_mk" style="height:1px; overflow:hidden; visiblity:hidden"></div>
  	<div id="hbanner_0" class="homeBanner  mb_abs visible-xs">
		<div class="banner_inner"> 
				<h3 class="tt">'.$this->mytxt('about','banner').'</h3>
				
				<img src="'.url('static/images/hbanner0_min'.$this->lang.'.jpg').'" alt="" class="img-responsive visible-xs"/>
		</div>
	</div>
	
<div class="container m0 p0 ma0" style="margin-top:-1px;">
	<div class="hidden-xs col-sm-5 col-md-4 m0 p0 " id="habs_left" >
		<div class="sidebox about"><span class="h_marker"></span><span class="line"></span>
		<h2>'.$this->mytxt('about','tt').'</h2>
		</div>
	</div>
	<div class="col-xs-12 col-sm-7 col-md-8 mt10"  id="habs_right" >

	'.$ab_tt.'
		<div id="abs_content">
		'.myfunc::exp_fck($ppms->$dlang).'
		</div>
	</div>
	<div class="col-xs-12 text-center">&nbsp;	</div>
	<div class="col-xs-12  col-sm-6  clearfix">
		<a id="cmbtn" class="hhcmbtn" data-tg="#cm_content">
		'.$this->mytxt('cm').'&nbsp;&nbsp;
		<i class="f1 fa fa-angle-double-down"></i>
		<i class="f2 fa fa-angle-double-up"></i></a>
		
	</div>
	<div class="col-xs-12  col-sm-6 clearfix ">
		<a id="ppbtn" class="hhcmbtn" data-tg="#pp_content">
		'.$this->mytxt('pp').'&nbsp;&nbsp;
		<i class="f1 fa fa-angle-double-down"></i>
		<i class="f2 fa fa-angle-double-up"></i></a>
		
	</div>
	
	<div class="col-xs-12 hide m0 p0" id="cm_content">
		<p>&nbsp;</p>
		'.$this->load_abs_ppl().'
		
	</div>
	<div class="col-xs-12 hide  m0 p0" id="pp_content">
		'.$this->load_abs_ppr().'
		
	</div>
</div>

<div class="col-xs-12 m0 p0 " id="home_spart">
	
	<div class="col-xs-12 homebreak ">&nbsp;</div>
'.$sp1_val.'
	<div class="col-xs-12 homebreak">&nbsp;</div>
'.$sp2_val.'
	<div class="col-xs-12 homebreak">&nbsp;</div>
'.$sp3_val.'
	<div class="col-xs-12 homebreak">&nbsp;</div>

 </div>
');				
 
  
  
	$this->psetting->head_css_js.=' '; 
$this->psetting->plus_css_js.='<link rel="stylesheet" href="'.url('static/js/owlcarousel/owl.carousel.css').'">
<link rel="stylesheet" href="'.url('static/js/owlcarousel/owl.theme.css').'">
<script src="'.url('static/js/owlcarousel/owl.carousel.js').'"></script>';



 $this->layout->page_title =  	$this->psetting->site_title;
		  
		$this->layout->meta_data=    	$this->psetting->meta_data;
        $this->layout->head_css_js=  	$this->psetting->head_css_js;
		
         $this->layout->nav=    	$this->nav_func($p1,$p2,$p3);
         $this->layout->content=($this_content);
        $this->layout->plus_css_js=    $this->psetting->plus_css_js;
		 
		
         $this->layout->footer=   	$this->footer_func();
		
		
		 
	}
 
}
		 
}