<?php

class sformController extends frontEndController {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
 
	 
	public    function appSubmit_cs(){
	 
	 $res= new stdClass;
	  $res->success=0;
	 $data = Input::all();
	 $val_captcha=$data['captcha'];
	 	if($this->captchaCheck( $val_captcha)	&& $val_captcha!=''){
		 
		 	return $this->StartAppSubmit( $data,2); 
		 }else{
			  $res->msg=$this->mytxt('invalid_captcha');
		 		return json_encode(  $res);
		}
			
	}
	
	
	 
	function SendNow_app($res){
	 
	Mail::send('email.base' , array('logo'=>'static/images/mail-logo.jpg', 'msg'=>$res->bodymsg), function($message) use ($res)
{
    $message->from( $res->ml_from,  $res->ml_tt);

if($res->ml_cc!=''){
    $message->to( $res->ml_to)->cc(	 $res->ml_cc)->subject($res->ml_tt.' - '.$res->ml_subject);
}else{
    $message->to( $res->ml_to)->subject($res->ml_tt.' - '.$res->ml_subject);

}
 /*
  $message->attach('static/images/mail-logo.jpg', array('as' => 'logo'
	 //, 'mime' => $mime
	 ));
	 */
 //   $message->attach($pathToFile);
});

	 $ggx= new stdClass;
	  $ggx->success=1;
	  $ggx->url=DOMAIN;
	  $ggx->msg=$res->okmsg;
	  
	  return json_encode($ggx);

	}
	 
	function StartAppSubmit($data,$stype=1){
	
			
		$thisLnag=		$data['lang_val'];
		$this->lang=1;
		switch(	$thisLnag){		
		
		case 2:		$this->lang=2;	
		App::setLocale('zh');
		
			break;
		case 1:		$this->lang=1;	
		App::setLocale('en');
		
			break;
			
			 
		}
		$this->getdefault();
		
		$fs= $this->form_setting;
		
		$ml_title=$fs['title'];
		$ml_array=$fs['option_list'];
		$tdval='';
		
		$ml_cc=		( myfunc::isValidInetAddress($data['app-email']))?$data['app-email']:'';;
		$ml_subject=$fs['mail_subject'];
 
 
		 $fs_formval='';
		foreach($ml_array as $mval){
		
		
			switch($mval['type']){
	
 		
			case 'select':
			case 'text':
			case 'radio':
			case 'textarea':
	 
					$tdval.='
						<tr><td width="180" style="border-bottom:1px solid #ccc;"><strong>'.$mval['tt'].'</strong></td><td  style="border-bottom:1px solid #ccc;">';
						
						$this_val='-----';
						$this_val=($data[	$mval['name']]!='')?$data[	$mval['name']]:$this_val;
						$plus_val='';
						
 
							if( $mval['type']=='textarea'){
						
						$this_val=nl2br(						$this_val);
						}
					$tdval.=$this_val.$plus_val;
						
					
					if(isset($mval['tt_mail']) && $mval['tt_mail']!='')  	$ml_tt	= $data[	$mval['name']];
						
					if(isset($mval['cc_mail']) && $mval['cc_mail']!='')  	$ml_cc	= $data[	$mval['name']];
						
					$tdval.='</td></tr>';
		
	 
 
			break;
			}
		}
 
 
		
		$desc='
		<table  border="0" cellspacing="0"  cellpadding="10" width="100%" >
			<tr><td colspan="2"><h3>'.$ml_title.'</h3></td></tr>
			'.	$tdval.'
		</table>
		';
	 $res= new stdClass;
		
	 $res->ml_to=	 $this->sysval['opt_key_admin_email'];
	 $res->ml_from=	$this->sysval['opt_key_admin_email'];
	 $res->ml_subject=		$ml_subject;
	 $res->ml_cc=			$ml_cc;
	 $res->ml_tt=		$ml_tt;
	  
	 $res->bodymsg=		myfunc::removebreak($desc);
 
	 $res->okmsg=	  $this->mytxt('mail_success');
 

			$subeded=	DB::table('contact') ->where('email', $ml_cc)->count();
if(	$subeded==0){
   
			$isok=	DB::table('contact') ->insertGetId(
				array(
				
				'id'=>'',
				'name'=>	e($data['app-name']),
				'email'=> 	$ml_cc,
				'ip'=>myfunc::getIp_user(),
				'total_val'=>'1',
				'created_at'=>date('Y-m-d H:i:s:u'),
				
  
				));
}else{			
$get_tt=DB::table('contact')->select('total_val') ->where('email', $ml_cc)->first();

DB::table('contact')->where('email', $ml_cc) ->update(
				array(
				'total_val'=> ceil($get_tt->total_val)+1,
				'created_at'=>date('Y-m-d H:i:s:u')
				));
				

}
 
  
			 return $this->SendNow_app(	$res);
 
	 
		
		 	
	}
public    function captchaCheck($val){
	 
$SiteController = (new captchaController); 
		$value=$SiteController->check($val);
		if($value){
			return true;
		}else{
			return false;
		}   
}

public  static  function captchaDiv(){
	
	$v0='';
	$vl='process/captchaImg';
	$v2='static/images/refresh.gif';
	
	
 
	$v0=URL::to('process/captchaImg?sid='.md5(time()));
	$vl=URL::to('process/captchaImg');
	$v2=URL::to('static/images/refresh.gif');
			
 
		
	 $show_captcha='<div style="width:150px; float: left; height: 38px">
      <img id="siimage" align="left" style="padding-right: 3px; border: 0" src="'.	$v0.'" />
        <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById(\'siimage\').src = \''.$vl.'?sid=\' + Math.random(); return false"><img src="'.$v2.'" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" style=" margin:0 0 0 0" /></a>
</div>';
return  $show_captcha;
	}
	
 
 
 
 
 
 
 
 
 
 
	public static  function switchInput($oval)
	{
	
	 

 //Session::put('securimage_code_ctime', time());
		 
$formval='';
$insval='';
$req_lb='';
$req_class='';

$null_start=(isset($oval['null-start']) && $oval['null-start'])?true:false;
if( isset($oval['req']) && $oval['req']!=''){

$req_lb='<span class="text-red">*</span>';
$req_class=' required ';
}
$with_group=false;
switch($oval['type']){


case 'select':

$oc=(isset($oval['class']))?$oval['class']:'';



switch($oval['name']){

 


default:
	$insval.=($null_start)?'<option  value=""></option>':'';
 
	
	foreach($oval['arr'] as $vl){
		
	if( isset( $oval['opt_val']) && $oval['opt_val']==true){
	$insval.='
	 <option  value="'.$vl.'" > '.$vl.'</option>
	';
	
	}else{	
	$insval.='
	 <option  value="'.$vl[0].'" > '.$vl[1].'</option>
	';
	}
	
	
	
	}
}


 
$st=( isset($oval['subtt']) && $oval['subtt']!='')?'<p class="mt5 fs12">'.$oval['subtt'].'</p>':'';
$formval.='
<div class="col-xs-3"><p class="text-right m0 mt5">'.$oval['tt'].''.$req_lb.'</p></div>
<div class="col-xs-8"><select  class="'.$oval['class'].' '.$req_class.'"  name="'.$oval['name'].'"  id="'.$oval['name'].'" >'.$insval.'</select>'.$st.'</div>
<div class="col-xs-12 mb10"></div>
';

break;


case 'radio':

$oc=(isset($oval['class']))?$oval['class']:'';

$rv=1;
foreach($oval['arr'] as $vl){
	
	if(isset($oval['withval']) && ($oval['withval'])==true){
$insval.='
<label class="radio-inline"><input type="radio" value="'.$vl[0].'"  class="'.$req_class.'" name="'.$oval['name'].'"  id="'.$oval['name'].'_'.$rv.'"/> '.$vl[1].'</label>';
	}else{
$insval.='
<label class="radio-inline"><input type="radio" value="'.$vl.'"  class="'.$req_class.'" name="'.$oval['name'].'"  id="'.$oval['name'].'_'.$rv.'"/> '.$vl.'</label>';
	
	}
 
$rv++;

}


switch($oval['name']){
case 'app-other':
$insval.=' 
<label class="radio-inline p0 m0"><input type="text"  class="form-control pull-right "  style="width:120px" name="appother_val"  id="appother_val"   /></label>
<div class="clearfix fs12 mb10">('.$oval['subtt'].')</div><br/>';
break;
}


$formval.='
<div class="col-xs-3"><p class="text-right m0">'.$oval['tt'].''.$req_lb.'</p></div>
<div class="col-xs-8"><p class="radio-cnt">'.$insval.'</p></div>
<div class="col-xs-12"></div>
';

break;
case 'text':

$oc=(isset($oval['class']))?$oval['class']:'';
$insval='<input type="text" name="'.$oval['name'].'" class="'.$oc.' '.$req_class.'" /> ';
$formval.='
<div class="col-xs-3"><p class="text-right m0 mt5">'.$oval['tt'].''.$req_lb.'</p></div>
<div class="col-xs-8"><p>'.$insval.'</p></div>
<div class="col-xs-12"></div>
';

break;
case 'textarea':

$oc=(isset($oval['class']))?$oval['class']:'';
$insval='<textarea  name="'.$oval['name'].'" class="'.$oc.' '.$req_class.'" ></textarea> ';
$formval.='
<div class="col-xs-3"><p class="text-right m0 mt5">'.$oval['tt'].''.$req_lb.'</p></div>
<div class="col-xs-8"><p>'.$insval.'</p></div>
<div class="col-xs-12"></div>
';

break;
case 'captcha':


//include_once("./static/js/captcha/captcha_inc.php");
$formval.='

<div class="col-xs-3"><p class="text-right m0 mt5">'.$oval['tt'].'<span class="text-red">*</span></p></div>
<div class="col-xs-8">   <div  id="captcha" style="float:left; height:31px; width:110px;z-index:5;  border:1px solid #aaa;">
'.sformController::captchaDiv().'</div>
       <input id="security_code" name="'.$oval['name'].'"  type="text"  class="required form-control" style="float:left; height:31px; text-align:center; font-size:20px;"/>   </div>
<div class="col-xs-12"></div>
  
 ';


break;




case 'CUSTOM':
 
$formval.=$oval['tt'];

break;


case 'submit_app':
  
$formval.='
<div class="col-xs-12 mt10">&nbsp;</div> 
<div class="col-xs-12  m0 p0 "> 
	<div class="col-xs-12 col-sm-8 mt10"><p id="error_ct" class="text-info mt10 fs14"></p></div>
	<div class="col-xs-12 col-sm-4 text-right m0 mt5" id="sb_div"><input  type="submit" class="btn btn-info btn-lg '.$oval['class'].'" value="'.$oval['tt'].'"/></div>
</div> 
<div class="col-xs-12"></div>
';

break;





case 'submit_cs':
  
$formval.='
<div class="col-xs-12 mt10">&nbsp;</div> 
<div class="col-xs-5 text-right m0 mt5" id="sb_div" style="width:43%"><input  type="submit" class="btn btn-info btn-lg" value="'.$oval['tt'].'"/></div>
<div class="col-xs-6"><p id="error_ct" class="text-info mt10 fs14"></p></div>
<div class="col-xs-12"></div>
';

break;





}


return 	$formval;
		
		
	}
	
	public static  function showForm($arr,$form_type=1)
	{
	 
		
 
$var_tgarr=$arr['option_list'];
$this_title=$arr['title'];
$this_subtitle=$arr['subtitle'];
$option_list=$var_tgarr;

$formval='';
foreach($option_list as $oval){
	
$formval.=	sformController::switchInput( $oval);
}
$str='
	
	<form id="infoform" id="infoform" class="form appform"  onsubmibt="return false">
'.$formval.'
</form>

';
	
	return $str;
	}

}