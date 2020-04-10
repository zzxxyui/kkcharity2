<?php

$res=  new stdClass;

$plus_log='';
$thisConfig='';

$data = Input::all();
$this->itemid=(isset( $data['id']))?ceil( $data['id']):0;
$this->tag=(isset( $data['fld']))? $data['fld']:0;
	 

$config='page/'.$this->tag.'/config.php';
$thisConfig=$this->Get_Config($config);

if(!is_array($thisConfig)) exit();

 
$this->main_field='id';
 
$this->keyName=$thisConfig['tag'];
$tbname=$thisConfig['tableName'];
$LvLimit=$thisConfig['lv'];
$farray=$thisConfig['allValue'];
$pageUrl=$thisConfig['tag'];

 

$res->isreload=0;
$res->success=0;

if($this->itemid>0){	  
$valArray = DB::table($tbname)->where('id', $this->itemid)->first();	
}
if($this->itemid>0	&&	$valArray->id >0){
	$acType='UPDATE';
	$res->action='update';
	$isupdated=true; 
}else{
	$acType='INSERT';
	$res->success=0;
	$res->action='insert';
	$isupdated=false; 
} 

 
if($LvLimit<$this->user_lv){	$res->msg='no right '; $res->success=0; return json_encode($res); }




foreach($farray as $ff){
	
	/*
	if($thisConfig['logfield']==$ff[1]){
		$this->logVal=($isupdated)?$data[$ff[1]].'('.$this->itemid.')':$data[$ff[1]];
	}
	*/
	
	
	$valtye=($isupdated)? $ff[4][2]:$ff[4][1];
	if($valtye==true){


	
	
	switch($ff[1]){
	
	case 'password':
	$get_cr_password = DB::table($tbname)->where('id',$this->itemid )->first();
	
										
	if($data[$ff[1]]=='' && $isupdated){
	$get_cr_password=( property_exists($get_cr_password,'password'	)  )?$get_cr_password->password:'';
		$fields[$ff[1]] =	$get_cr_password;
	}else{
		$fields[$ff[1]] =	 Hash::make(md5($data[$ff[1]]));
		if($isupdated){
			$plus_log.=' - (CHANGE PASSWORD)';
		}
	}
	break;
	case 'created_at':
	$fields[$ff[1]] = date("Y-m-d H:i:s");
	break;
	case 'updated_at':
	$fields[$ff[1]] = date("Y-m-d H:i:s");
	break;
	case 'username':
		
		if($isupdated){
			$chceck_exot = DB::table($tbname)->where('id','!=',$this->itemid )->where('username',$data[$ff[1]] )->count();	 
		}else{
			$chceck_exot = DB::table($tbname)->where('username',$data[$ff[1]] )->count();	 
		}
			if(	$chceck_exot>0){
			$res->success=0;
			$res->msg='username is exist';
			return json_encode($res);
			}else{
						$fields[$ff[1]] =$data[$ff[1]] ;
			}
	
	break;
	
	case 'item_code':
		if($isupdated){
			$chceck_exot = DB::table($tbname)->where('id','!=',$this->itemid )->where('item_code',$data[$ff[1]] )->count();	 
		}else{
			$chceck_exot = DB::table($tbname)->where('item_code',$data[$ff[1]] )->count();	 
		}
			if(	$chceck_exot>0){
			$res->success=0;
			$res->msg='Item Code is exist';
			return json_encode($res);
			}else{
						$fields[$ff[1]] =$data[$ff[1]] ;
			}
	
	break;
	
	
	default:

  			if(isset($data[$ff[1]])){
				
				if($ff[1]=='clone_by') $res->isreload=1;



				$fields[$ff[1]]  = 	$data[$ff[1]] ;
			}
	
	} 
	
	
	/*------------------------------------------------------------------------------------*/
	switch($ff[2][0]){ 
			case "CK-TEXT":	
						$fields[$ff[1]]  = 	e($data[$ff[1]]) ;
			break;
		
	}
	
	
	/*------------------------------------------------------------------------------------*/
	
	

	
	}
					 
	
}

 $chk_id='';
 
if($isupdated){
	
if( isset($data['url_rewrite']) && $fields['url_rewrite']==''){
	 $fields['url_rewrite']=$this->itemid;
}

$chk= DB::table($tbname)->where('id', $this->itemid )->update($fields);


/*
	
	$this->admin_addlog( 
	 array(
   'log_type'=>'update',
   'msg'=>$thisConfig['pageName'].' - '.	$fields[$thisConfig['logfield']],
    ));
	*/
	


//var_dump( DB::getQueryLog());
$res->success=1;
$res->notouchclose=0;
$res->msg='
 <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Updated</h4>
      </div>
    </div>';
 			
			
		}else{
			
$chk_id=  DB::table($tbname)->insertGetId($fields);



/*
	
	$this->admin_addlog( 
	 array(
   'log_type'=>'insert',
   'msg'=>$thisConfig['pageName'].' - '.	$fields[$thisConfig['logfield']],
    ));
	
	*/



if( isset($data['url_rewrite']) && $data['url_rewrite']==''){
  DB::table($tbname)->where('id', $chk_id)->update(
  array('url_rewrite'=> $chk_id)
  );
}


	
	
$res->success=1;
$res->notouchclose=1;

	$res->msg='
 <div class="modal-content">
 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">New Item Created</h4>
      </div>
      <div class="modal-body text-right">
        <a type="button" class="btn btn-primary" href="?q='.$this->keyName.'&action=edit&id='.$chk_id.'">Continue</a>
        <a type="button" class="btn btn-default" href="?q='.$this->keyName.'&action=list">Back</a>
      </div>
    </div>';
				
}

/*------------------------------------------------------------------------------------*/
	switch($tbname){ 
			case "donation":	
			$dnGid=($isupdated)?$this->itemid: $chk_id;
					  DB::table($tbname)->where('id', $dnGid)->update(
					  array('hash_key'=> md5($tbname.'_hashKey_'.$dnGid) )
					  );
			break;
	}
/*------------------------------------------------------------------------------------*/
	
	

//$queries = DB::getQueryLog();

/*
 
$inp=$this->conn->AutoExecute($tbname, $fields, $acType,$acType_sql);
	if($inp){
	$res->success=1;
		
	$res->backurl='?q='.$pageUrl.'&action=list';
 
	$return_last_id=$this->conn->Insert_ID();
	$res->itemurl='?q='.$pageUrl.'&action=edit&id='.$return_last_id;
	if($isupdated){
		$res->action='update';
		$this->add_log('UPDATE','  '.$thisConfig['pageName'].' - '.$this->logVal.' '.$plus_log);
	}else{
		$res->action='insert';
		$this->add_log('INSERT',' '.$thisConfig['pageName'].' - '.$this->logVal.' ');
	}
		
	$res->with_seo= 0;
	if($isupdated){
	
	$res->msg= $this->txt['updated'];
	}else{
		if($thisConfig['seo_val']['seo']){
				if( $this->	db_seoform_create($thisConfig['tableName'],	$return_last_id	,$_POST['url_rewrite'])	){
				$res->with_seo= 1;
				$res->msg= $this->txt['created_with_seo']; 
				}else{
				$res->success=0;
				$res->msg= 'seo error';
				}
		}else{
				$res->msg= $this->txt['created']; 
		}
	}	
		
	
	
	
	}else{
	$res->msg='db error';
	$res->success=0;
	}
	*/
	
?>