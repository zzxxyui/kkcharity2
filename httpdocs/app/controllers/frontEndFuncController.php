<?php


class frontEndFuncController extends frontEndBaseController {
	
	
public function adminconfig(){
}
 
 	
	
	public function doAction(){
	 
	 $data = Input::all();
 
	$lang= isset($data['langcode'])?$data['langcode']:1;
	$this->lang=$lang;
	
	$lang_key=array('@','en','zh');
	App::setLocale($lang_key[	$this->lang]);
		
	 $daction=(isset( $data['action']))? $data['action']:'';
	
	switch( $daction){
		
		case 'loadProjectList':
			$res= new stdClass;
			  $res->success=1;
		$ptype_val=e($data['ptype']);
		$cr_year=e($data['year']);
		$page=e($data['page']);
	
			$res->msg=  $this->getProjectList( ceil($ptype_val), $cr_year,$page) ;
				 
		return json_encode(  $res);
		break;
 
		case 'sap':
		return $this->sap_func($data);
		break;
		}

	}
	
 function createFileAttachmentValidator( $file)
{
	$this->errMsg='';
	$maxfs=1*1024*1024;
$validator =Validator::make(
       array( 
            'attachment' => $file,
            'extension'  => \Str::lower( File::extension($file) ),
        ),
        array( 
            'attachment' => 'required|max:10000|',
            'extension'  => 'required|in:jpg,jpeg,bmp,png,doc,docx,zip,rar,pdf,rtf,xlsx,xls,txt',
        ),
        array(
    'required'    => 'must have name',
    'max'    => 'must have name',
    'in'    => 'Invalid File format'
	
	
	)
    ); 
		if ($validator->fails()) { 
	 
	 if(is_array($validator->errors()->all())){
		 	foreach($validator->errors()->all() as $eV){
			
					$this->errMsg.=$eV.'<br/>' ;
			}
	 } 
			return false;
		} else {
			return 1;
		}
}	
	
function doOimgUpload(){


	 $res= new stdClass;
	 $res->success=0; 
	$error = false;
	$files = array();
	 $thisInput = Input::all();
	 
 
	$lang= isset($thisInput['langcode'])?$thisInput['langcode']:1;
	$this->lang=$lang;
	
	$lang_key=array('@','en','zh');
	App::setLocale($lang_key[	$this->lang]);
	
		$nextNewName='';
	$uploaddir = './userfile/user_proposal/';
 

	foreach($_FILES as $file)
	{
		$nextNewName=md5(basename($file['name']).time()).myfunc::get_ext(basename($file['name']));
		
 //if($this->createFileAttachmentValidator($file['name'])){
$validator2 = Validator::make($thisInput , array(
    '0' => 'required|mimes:jpg,jpeg,bmp,png,doc,docx,zip,rar,pdf|max:10240',
),
        array(
    'required'    => 'must have file',
    'mimes'    => $this->mytxt('ind_format'),
    'max'    => $this->mytxt('ind_size')
	)
	
);

 
  

if ($validator2->fails()) { 
		
	 $res->success=0;
	 	 $errMsg='';
	 if(is_array($validator2->errors()->all())){
		 	foreach($validator2->errors()->all() as $eV){
			
					$errMsg.=$eV.'<br/>' ;
			}
	 } 
	 $res->msg=	 $errMsg;
	return json_encode($res);
}

		if(move_uploaded_file($file['tmp_name'], $uploaddir .$nextNewName))
		{
			//$files[] = $uploaddir .$file['name'];
			
	/*		
$getOldFile= DB::table('cardlist')->where('id',$thisInput['id'])->first();
if( $getOldFile->file_path !=''){
File::delete( './userfile/user_proposal/'.$getOldFile->file_path);	
}*/
 
$gid = DB::table('submit_file')->insert(
	array(
	
	'ip'=>	myfunc::getIp_user(),
	'remark'=>	'',
	'old_file_name'=>	$file['name'],
	'ff_file'=> $uploaddir .	$nextNewName,
	'created_at'=>date('Y-m-d H:i:s'),
	)

); 
		}
		else
		{
		    $error = true;
		}
		/*
}else{
	 $res->success=0;
	 $res->msg=	 ($this->errMsg);
	return json_encode($res);

		
}		*/
		
	}
	

 
	
	
	if($error){
	
	 $res->success=0;
	 $res->msg='Upload Error';
	}else{
	
	 $res->success=1;
	 $res->msg='<div class="col-xs-12 text-center"><p class="alert alert-success col-xs-6 " style="margin: 0 auto; float:none"><i class="fa fa-check"></i>&nbsp;'.$this->mytxt('upload_ok').'</p></div>'; 
	}

 
return json_encode($res);

		
}



	 
	public function sap_func($data){
	
			 $res= new stdClass;
	  $res->success=0;
				
				
	$getName=e($data['sap_name']);
	$getEmail=$data['sap_email'];
 	if( !myfunc::isValidInetAddress($getEmail) ) {
	
	
	  $res->success=0;
	  $res->msg='Invalid Email format';
	return json_encode(  $res);
	}
	
	$haveM=	 DB::table( 'submit_nl'  )->where('email', 	$getEmail )-> count();	
	if(	$haveM>0){
		
	  $res->success=0;
	  $res->msg='You have submitted before.';
	return json_encode(  $res);
	}
	
	
	
				$isok=	DB::table('submit_nl') ->insertGetId(
				array(
				
				'id'=>'',
				'name'=>$getName,
				'email'=>$getEmail,
				'ip'=>myfunc::getIp_user(),
				'created_at'=>date('Y-m-d H:i:s:u'),
				
  
				));
	
	  $res->success=1;
	  $res->msg='
	<div class="alert alert-success text-center p10 ma0" style="width:500px; "> <h4 class="mt10">Submitted</h3>
	<p class="fz14">Thank you.</p></div>
	  ';
	  
	  
	return json_encode(  $res);
	
	}
	
	
	function sendInvMail($res){
	
	
@Mail::send('email.base' , array('logo'=>'static/images/mail-logo.jpg', 'msg'=>$res->bodymsg), function($message) use ($res)
{
    $message->from( $res->ml_from,  $res->ml_tt);

if($res->ml_cc!=''){
    $message->to( $res->ml_to)->cc(	 $res->ml_cc)->subject($res->ml_tt.' - '.$res->ml_subject);
}else{
    $message->to( $res->ml_to)->subject($res->ml_tt.' - '.$res->ml_subject);
}
 
 
	 
 //   $message->attach($pathToFile);
});


	
	}
}
?>