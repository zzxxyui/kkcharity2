<?php

$res=  new stdClass;
$thisConfig='';
 
$this->itemid=(isset( $data['id']))?ceil( $data['id']):0;
$this->tag=(isset( $data['fld']))? $data['fld']:0;

$config='page/'.$this->tag.'/config.php';
$thisConfig=$this->Get_Config($config);

if(!is_array($thisConfig)) exit();


$tbname=$thisConfig['tableName'];
$LvLimit=$thisConfig['lv'];

$res->success=0;

if($LvLimit<$this->user_lv){	$res->msg='no right '; $res->success=0; return json_encode($res); }


switch($tbname){
	
	
case 'items':

$haveItem=DB::table('items_orderlist_item')->where('item_id',   $this->itemid)->count();
if(ceil($haveItem)>0){

	$res->msg='This Item have order records.';
	$res->success=0;
	return json_encode($res);
}
break;



case 'items_orderlist':

DB::table('items_orderlist_item')->where('order_id',   $this->itemid)->delete();
break;

case $this->admin_acc_db:

//$valArray = DB::table($tbname)->where('id', $this->itemid)->first();	
 
if($this->user_lv>1  ){
	$res->msg='no right';
	$res->success=0;
	return json_encode($res);
}
break;	
 


case 'submit_file':

$getFile= DB::table($tbname)->where('id',   $this->itemid)->first();

if( @unlink($_SERVER['DOCUMENT_ROOT'].ROOT_PATH.$getFile->ff_file)){

} 
break;	

}
/*

case $thisConfig['tableName']:
if($thisConfig['uploadImage']['upload']){
$dltb=str_replace(DB_START,'',$thisConfig['tableName']);
$thissql_del=sprintf(" select * from ".DB_START."gb_files where parent_id=%d and tb_val='%s'",ceil($_POST['id']),$dltb);
			$rs = $this->conn->Execute($thissql_del);
			$tord = $rs->RecordCount();
			if($tord >0 ) {
					while (!$rs->EOF) {
								$copy_id=$rs->fields['id'];
								$clear_tb_1=$this->conn->Execute(sprintf("delete from %s where  id=%d",DB_START.'gb_files',$copy_id));
								if($clear_tb_1){
								$this_path=$_SERVER['DOCUMENT_ROOT'].ROOT_PATH.'userfile/files/'.$rs->fields['full_path'];							
									if($rs->fields['full_path']!='' && file_exists($this_path)	){
										@unlink($this_path);
									}
									$this_path2=$_SERVER['DOCUMENT_ROOT'].ROOT_PATH.'userfile/files/'.$rs->fields['thumbnail_path'];							
									if($rs->fields['thumbnail_path']!='' && file_exists($this_path2)	){
										@unlink($this_path2);
									}
								$rs->MoveNext();
					}
				}
			}
}
break;

}

*/
/*
$del_info = DB::table($tbname)->where('id',   $this->itemid)->first();
$del_log_name=( property_exists($del_info, $thisConfig['logfield']	)  )?$mgg->$thisConfig['logfield']:'';	
if($del_log_name!=''){
	$this->add_log('DELETE','  '.$thisConfig['pageName'].' - '.$del_log_name.' ');
}
*/
 	
$ofn=( isset($thisConfig['other_function']) ?$thisConfig['other_function']:false);	
 
if($ofn) $this->delete_with_OtherFunctionBtn ($ofn,$this->itemid);

DB::table($tbname)->where('id',   $this->itemid)->delete();
		
$res->success=1;	$res->msg='Deleted'; 




?>