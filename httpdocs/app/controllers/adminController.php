<?php

class adminController extends adminBaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

/*
	public function showWelcome()
	{
		return View::make('hello');
	}
*/
    protected $layout = 'admin.admin_page';
	public $admin_title='Admin module';
	public $admin_acc_db='users';
	
	public $menu_array;
	public $admin_path='/admin_files/';
	public $admin_file='/static/admin/';
	public $ckf_lang='cm_my_en.js';
	public $MyConfig;
	public $HaveCate=false;
	
	
	
	public $perpage=50;
	public $pageJsAndCss;
	public $page_mainContent;
	public $this_page_body;
	public $edit_page_type='create';
	
	public $filters_val='';
	
	public $itemid=0;
 
	public $form_nav;
 
 
	public $have_fileupload=false;
	public $have_seosetting=false;
  
	public $cate_lv_limit=1;
	public $cate_lv_limit_onoff=false;
	public $cate_lv_limit_val=0;
 
	public $isajax=false;
 
 
	public $TIME_PERIOD=3;
	public $ATTEMPTS_NUMBER=5;
	public $an_try=0;
 
public function doAction_needlogin(){
	$res =  new stdClass();
			$res->success=0;
			$res->msg='Please login Again';
			return 	json_encode(	$res);
		 
	 }
	 
public	function myurl($val){

		$url=URL::to($val);
		return $url;
		
}
	
	
public function doAction(){
	 
	$res =  new stdClass();
	 $data = Input::all();
	 $daction=(isset( $data['action']))? $data['action']:'';
	
	
	if(	Auth::user()->check()){if(	(Auth::user()->get()->roles_id)<=Config::get('gbkey.ADMIN_PM_ID')	 	){
	$res->success=0;
	$res->msg='Error found...';
				switch(	 $daction){
				case 'load_list':
				
			$vartb=array(
			'page'=>(isset( $data['page']))?ceil($data['page']):1,
			'limit'=>(isset( $data['rows']))?ceil($data['rows']):30,
			'sidx'=>(isset( $data['sidx']))?$data['sidx']:'',
			'sord'=>(isset( $data['sord']))?$data['sord']:'',
			'searchField'=>(isset( $data['searchField']))?$data['searchField']:'',
			'searchString'=>(isset( $data['searchString']))?$data['searchString']:'',
			);
			$this->filters_val=(isset( $data['filters']))?$data['filters']:'';
			return $this->listTableVal($vartb,((isset( $data['key']))?$data['key']:'')	);
			
				break;
	
				
				case 'todb':
				return	$this->TODB($data);
				break;
				
				case 'delone': 
				return $this->DEL_ONE($data);
				break;
				
				
				
	case 'load_mcat':
		return $this->MYF_db_CatSort();
	break;
 	
	case 'db_delete_mcat':
	
 
		return $this->MYF_db_delCart();
	break;
	case 'load_sort_mcat':
		return $this->MYF_sort_Cart();
	break;
 
	case 'load_mcat_goSort':
		return $this->MYF_mCart_goSort();
	break; 
			
				
	case 'save_sort':
		return $this->MYF_saveSort();
	break; 
	
	
	case 'load_seo_setting':
		return $this->MYF_seo_setting();
	break; 
			
	case 'save_seo_setting':
	
		return $this->MYF_save_seo_setting();
	break; 
	
	
	case 'load_thumbpreview':
		return $this->load_OtherFunction_preview();
	break; 
			
				
				
				
	case 'clone_item':
		return $this->clone_item(	 $data);
	break; 
				
				
	case 'replace_clone_item':
		return $this->replace_clone_item(	 $data);
	break; 
	
	
	
	
	
	

case 'db_optionlist_ajax':
 
		$postdata=array( 
			
			'sp_field'=>e($data['sp_field']) , 
			'pid'=>e($data['pid'])  ,
			'tb_val'=>e($data['tb_val'])  
		);		
		return $this->MYF_optionlist_box( e($data['tag']),	$postdata);
 
break;


case 'load_optlist_val':

 
		$postdata=array(
			'sp_field'=>e($data['sp_field'])  ,
			'thisid'=>e($data['thisid'])  ,
			'pid'=>e($data['pid'])  
			
			
		);
		return $this->MYF_optionlist_editbox( e($data['tag']),	$postdata);
 
break;


case 'db_save_optlist':
 
		return $this->MYF_optionlist_save( e($data['tag']) ,	$data);
	 
break;

 	
case 'del_optlist_val':
		$postdata=array(
			'sp_field'=>e($data['sp_field']),
			'thisid'=>e($data['thisid'])  
		);
		return $this->MYF_optionlist_del( e($data['tag']) ,	$postdata);
break;
case 'db_optionlist_savesort':
		$postdata=array(
			'sp_field'=>e($data['sp_field']),
			'sortdata'=>e($data['sortdata']) , 
		);
		return $this->MYF_optionlist_savesort( e($data['tag']) ,	$postdata);
 
break;
 

	
	
	
				
				}	
	}}
	$res->success=0;
	$res->msg='Please login Again';
	return 	json_encode(	$res);
	 
}



function MYF_optionlist_del($keyName,$postdata){
	
	$res=new stdClass();
	
$res->success=0;
$res->msg='<p>Error...</p>';
		 
$config='page/'.$keyName.'/config.php';
		if(file_exists(	 base_path().$this->admin_path.	$config)){
		$thisConfig=$this->Get_Config(		$config);
		}else{
		return json_encode($res);
}
$myconfig=	$thisConfig;

	
	
	$del_id=$postdata['thisid'];

			$res->success=1;
			$res->msg='Deleted';
 
 
DB::table($myconfig['optionlist']['tablename'] )->where('id',   $del_id)->delete();
 
		return json_encode($res);
}


function MYF_optionlist_save($keyName,$postdata){
	

$res=new stdClass();
	
$res->success=0;
$res->msg='<p>Error...</p>';
		 
$config='page/'.$keyName.'/config.php';
		if(file_exists(	 base_path().$this->admin_path.	$config)){
		$thisConfig=$this->Get_Config(		$config);
		}else{
		return json_encode($res);
}
$myconfig=	$thisConfig;


	
$thisid=ceil($postdata['thisid']);


 $get_array_f=$myconfig['optionlist']['data'];

 foreach((array) $get_array_f as $gf){
	
	if($gf['sp_field']==$postdata['sp_field']){
	$gf_array=	$gf;
 	break;
	}
}
$postD=array();
foreach(	$gf_array['cols'] as  $gval){
//$postD[$gval[0]]=$this->checkItem_sp($postdata[$gval[0]]);
$postD[$gval[0]]=$postdata[$gval[0]];
}
$postD= json_encode($postD);

$res->success=0;
if($postD!=''){
	//$total_row=$this->conn->GetOne(sprintf("select max(rank) from ".$myconfig['optionlist']['tablename']." where sp_field='%s'  ",	$gf_array['sp_field']));
	$total_row=	DB::table($myconfig['optionlist']['tablename'] )->where('id',$gf_array['sp_field']) ->max('rank') ;
	
	$fields['data_val'] =$postD;
  
if($thisid>0){
	$ss_sql=sprintf(' id=%d ',ceil($postdata['thisid']));
	 
	$remsg='Updated';
	
	$isok=	DB::table($myconfig['optionlist']['tablename']) ->where('id', ceil($postdata['thisid']) )->update(
				 $fields	);
	 
			
			
}else{
	$fields['id'] = '';
	$fields['rank'] =	$total_row+1;
	$fields['sp_field'] = $gf_array['sp_field'] ;
	$fields['tb_val'] =$myconfig['optionlist']['tb_val'];
	$fields['parent_id'] =ceil($postdata['pid']); 
	$addd = DB::table($myconfig['optionlist']['tablename'])->insertGetId(
   $fields
);


	$remsg='Added';
}

	/*
	if($addd){
		$res->success=1;
		
		$res->msg=$remsg;
	}else{
		$res->msg='db error';
	
	}
	*/
	
		$res->success=1;
		
		$res->msg=$remsg;
 
	
}else{
$res->msg='No Value';
}

return json_encode($res);

}







function MYF_optionlist_savesort($keyName,$postdata){

$res=new stdClass();	
$res->success=0;
$res->msg='<p>Error...</p>';		 
$config='page/'.$keyName.'/config.php';
		if(file_exists(	 base_path().$this->admin_path.	$config)){
		$thisConfig=$this->Get_Config(		$config);
		}else{
		return json_encode($res);
}
$myconfig=	$thisConfig;



$list_postid=$postdata['sortdata'];
$list_postid=explode(',',$list_postid);
$error=0;
if(is_array($list_postid)){
	
	$i=0;
		 $fields=array();
	foreach($list_postid as $pval){
		 $fields['rank']=$i;
		$isok=	DB::table($myconfig['optionlist']['tablename']) ->where('id', ceil($pval))->update(
			$fields	);
		  
		$i++;
	}
} 
$res->success=0;
$res->msg='db error';
if($error==0){
$res->success=1;
$res->msg='';

}
return json_encode($res);
}










function MYF_optionlist_editbox(  $keyName,$dbval){

	
$res=new stdClass();
	
$res->success=0;
$res->msg='<p>Error...</p>';
		 
$config='page/'.$keyName.'/config.php';
		if(file_exists(	 base_path().$this->admin_path.	$config)){
		$thisConfig=$this->Get_Config(		$config);
		}else{
		return json_encode($res);
}
$myconfig=	$thisConfig;

 $get_array_f=$myconfig['optionlist']['data'];

 foreach((array) $get_array_f as $gf){
	
	if($gf['sp_field']==$dbval['sp_field']){
	$gf_array=	$gf;
 	break;
	}
}


$loaddd=($dbval['thisid']>0)?   DB::table($myconfig['optionlist']['tablename'] )->where('id',$dbval['thisid'] )->first() :'';
$loaddd=(	$loaddd!='')?   json_decode($loaddd->data_val ,true)  :array();
$form_head='
<input type="hidden" name="action" value="db_save_optlist"/>
<input type="hidden" name="thisid" value="'.ceil($dbval['thisid'] ).'"/>
<input type="hidden" name="tag" value="'.$myconfig['tag'].'"/>
<input type="hidden" name="tb_val" value="'.$myconfig['optionlist']['tb_val'].'"/>
<input type="hidden" name="tablename" value="'.$myconfig['optionlist']['tablename'].'"/>
<input type="hidden" name="sp_field" value="'.$dbval['sp_field'].'"/>
<input type="hidden" name="pid" value="'.$dbval['pid'].'"/>
';
$form_in=$this->db_load_opldata($gf, $form_head, $loaddd);

return $form_in;
}


function db_load_opldata($col,  $form_head,$data){
$str=''; 
foreach($col['cols'] as $inp){

$colsname=$inp[0];
$type=$inp[1];	
$title=$inp[2];	
 
 $thisVal= (isset($data[$colsname]))?$data[$colsname]:'';
switch($type){

case 'text':
$str.='

<div  class="col-xs-4  text-left mb10">
'.$title.'
</div>
<div  class="col-xs-7 mb10"><input class="form-control input-sm" type="text" name="'.$colsname.'" value="'. $thisVal.'"/></div>

 

';
break;

case 'region':

$getArr= DB::table('region') -> orderBy('id','asc')->get();	
$selVal='';
if (count($getArr )>0){	foreach ($getArr as $ms) {
	$selected=( $ms->id== $thisVal)?' selected="selected" ':'';
	$selVal.='<option '.$selected.' value="'.$ms->id.'">'.$ms->title1.'</option>';
}}
$selVal='
<select class="form-control input-sm required" name="'.$colsname.'">
<option value="">---Please select a region---</option>
'.$selVal.'
</select>
';
$str.='
<div  class="col-xs-4  text-left mb10">
'.$title.'
</div> 
<div  class="col-xs-7 mb10">'.$selVal.'</div>

';
break;


case 'vimeo':
$str.='

<div  class="col-xs-7 lh40">
'.$title.'
</div>
<div  class="col-xs-7"><input type="text" class="required" name="'.$colsname.'" value="'. $thisVal.'"/></div>

<div  class="col-xs-7">
please just ender the video number, eg:  http://vimeo.com/<strong>8245346</strong>
</div>
 

';
break;

}	
	

}
return '<form id="optform" method="post" onsubmit="return false">
'. $form_head.'
<div class="  row col-xs-12 clearfix" style="width:600px;"> '.$str.' </div>

<p class="text-center col-xs-12" id="cap_error"></p>
<p class="text-center  col-xs-12"><input type="submit" value="Submit" class="Save btn btn-success"/></p>
</form>';

}


function MYF_optionlist_box(  $keyName,	$postdata){


	
	
$res=new stdClass();
	
$res->success=0;
$res->msg='<p>Error...</p>';
		 
$config='page/'.$keyName.'/config.php';
		if(file_exists(	 base_path().$this->admin_path.	$config)){
		$thisConfig=$this->Get_Config(		$config);
		}else{
		return json_encode($res);
}

$my_array=array();
$thisconfig=$thisConfig;

$get_array_f=$thisconfig['optionlist']['data'];

$head_val='';

foreach((array) $get_array_f as $gf){	
	if($gf['sp_field']==$postdata['sp_field']){
	$gf_array=	$gf;
 	break;
	}
} 
$colVal=12;


$vx=0;
foreach((array) $gf_array['cols'] as $gf){	 if($gf[3]){ $vx++; } }
 $colVal=floor(98/$vx);
 
 foreach((array) $gf_array['cols'] as $gf){	
if($gf[3]){
	$head_val.=	'<div class="col-xs-1" style="width:'.$colVal.'%">'.	$gf[2].'</div>';
}
}

$results = DB::table($thisConfig['optionlist']['tablename']	) -> where('parent_id',$postdata['pid'])-> where('sp_field',$postdata['sp_field'])->where('tb_val',	$postdata['tb_val'])->orderBy('rank','asc')->get();	
if (count($results )>0){	foreach ($results as $ms) {
	
	
		$res->success=1;
 
			$jdata=json_decode($ms->data_val,true);
			$js_ar=array();
			
foreach((array) $get_array_f as $gf){	
	if($gf['sp_field']==$postdata['sp_field']){
	$gf_array=	$gf;
 	break;
	}
}
$my_array2=array();
foreach((array) $gf_array['cols'] as $gf){	
if($gf[3]){
	
	$thisVal='';
	switch($gf[1]){
	case 'region':
		
	$getArr= DB::table('region') ->select('title1')-> where('id',ceil($jdata[$gf[0]]))->first();	
	$thisVal=	$getArr->title1;
	break;

	default:
	$thisVal=stripslashes($jdata[$gf[0]]);
	}
	$my_array2[]=	'<div class="col-xs-1" style="width:'.$colVal.'%">'.	$thisVal.'</div>';
}
}


			$my_array[]=array(
				'id'=>$ms->id,
				'mydata'=>implode(' ',	$my_array2),
				'ptitle'=>$gf_array['title'],
			);

	//	$res_array[]=array_merge($my_array,	$jdata);

}}

$res->success=0;
$res->rows=$my_array;
$res->head='
<div class="col-xs-12 m0 p0 clearfix mb5" style="border-bottom:1px solid #ccc;">
<div class="col-xs-1  m0 p0 ">&nbsp;</div>
<div class="col-xs-1  m0 p0 ">&nbsp;</div>
<div class="col-xs-9  m0 p0 ">
'.$head_val.'</div>
<div class="col-xs-1  m0 p0 ">&nbsp;</div>
</div>
';
return json_encode($res);

}



function aar_title($val,$thisconfig){
$thisconfig=$thisconfig['allValue'];
foreach($thisconfig as $fg){
	if( $val==$fg[1]) return $fg[0];
} 
}
 
	 
function clone_copy_edt_image($handle){

$handle=myfunc::exp_fck($handle);

$ck_folder= Config::get('gbkey.ck_upload_folder');

$ck_folder=str_replace('/','',$ck_folder);

 $replist=preg_match_all('~<img ([^>]+)>~i', $handle, $matches);
 
$images = array();
foreach ($matches[1] as $str) {

$mg=$str;
preg_match_all('~([a-z]([a-z0-9]*)?)=("|\')(.*?)("|\')~is', $str, $pairs);

//$images[] = array_combine($pairs[1], $pairs[4]);
$imageX= array_combine($pairs[1], $pairs[4]);

foreach($imageX as $sKey=>$sVal){
	if($sKey=='src'){
	
		if (preg_match("/".$ck_folder."/i", $sVal)) {
			$old_name=basename($sVal);
			$new_name= md5('clone-'.time().	$old_name).myfunc::get_ext(	$old_name);
			$repPath=str_replace($old_name,$new_name,$sVal);
			
		//	echo  $_SERVER['DOCUMENT_ROOT'].'/'.$sVal;
			if (copy(  $_SERVER['DOCUMENT_ROOT'].'/'.$sVal,$_SERVER['DOCUMENT_ROOT'].'/'.$repPath)) {
				
$handle=str_replace($sVal,$repPath,$handle);
				
			}
				
		}	


	};
}

}
 
return e($handle);



}
function clone_item($data){
	
	

	
	
$res=new stdClass();
	
$res->success=0;
$res->msg='<p>Error...</p>';
		
$keyName=$data['fld'];
$this->itemid=ceil($data['tagid']);

$config='page/'.$keyName.'/config.php';
		if(file_exists(	 base_path().$this->admin_path.	$config)){
		$thisConfig=$this->Get_Config(		$config);
		}else{
		return json_encode($res);
}
if($this->itemid==0)  return json_encode($res);
		  
$base_data= DB::table($thisConfig['tableName']  )->where('id',$this->itemid)->first();		 
 
$base_data_arr=myfunc::objectToArray($base_data);

$base_data_arr['id']=''; 
if( isset($base_data_arr ['url_rewrite'])) $base_data_arr ['url_rewrite']=$base_data_arr ['url_rewrite'].'-clone-'.time();;

$base_data_arr['status']=0; 
$base_data_arr['clone_by']=$this->itemid; 


if( isset($thisConfig['clone']['textbox'])){
	foreach($thisConfig['clone']['textbox'] as $tbxval){
	
$base_data_arr[$tbxval]=$this->clone_copy_edt_image( $base_data_arr[$tbxval] );
	
	} 
	
}



$base_new_id = DB::table($thisConfig['tableName'])->insertGetId(
   $base_data_arr
);


/*---------------FILE CLONE-------------------*/

if( isset($thisConfig ['other_function'])){
foreach ($thisConfig ['other_function'] as $ofval){

switch($ofval['type']){
case 'manyfile':
case 'onefile':
$of_config= Config::get('gbkey.'.$ofval['key']);

$results = DB::table($of_config['table']	) -> where('tb_val',$of_config['tb_val'])-> where('sp_field',$of_config['sp_field'])->where('parent_id',$this->itemid)->get();	

if (count($results )>0){	foreach ($results as $ms) {
			
			$file_arr=myfunc::objectToArray($ms);
			$file_arr['id']='';
			$file_arr['parent_id']=$base_new_id;
			$bfn=$file_arr['old_file_name'];
			$new_fn= md5('clone-'.time().$file_arr['old_file_name']).myfunc::get_ext($bfn);
			if (@copy( $of_config['upload_dir'].$file_arr['full_path'],		$of_config['upload_dir'].$of_config['folder_val'].'/'. $new_fn)) {
				$file_arr['full_path']=$of_config['folder_val'].'/'. $new_fn;
				$file_arr['file_name']=$new_fn;
				
				if ( $of_config['thumbnail']==1	&& $file_arr['thumbnail_path']!='') {
						if (@copy( $of_config['upload_dir'].$file_arr['thumbnail_path'],		$of_config['upload_dir'].$of_config['folder_val'].'/thumb/'. $new_fn)) {
							$file_arr['thumbnail_path']=$of_config['folder_val'].'/'. $new_fn;
						}
					
				}			
				
			}
			
			$file_new_id = DB::table($of_config['table'])->insertGetId(
			   $file_arr
			);
			
			if($file_new_id>0){
			$upd_total=DB::table($of_config['table']	) -> where('tb_val',$of_config['tb_val'])-> where('sp_field',$of_config['sp_field'])->where('parent_id',$base_new_id)->count();
			$isok=	DB::table($thisConfig['tableName']) ->where('id', $base_new_id)->update(
				array($of_config['sp_field']=>$upd_total.','.$new_fn)		);
			}
			
}}
break;
}
}}

/*---------------FILE CLONE-------------------*/

		  
$res->msg='<div><p> Cloned. </p><p><a class="btn btn-info" href="'.$this->myurl(ADMIN_PATH.'?q='.$thisConfig['tag'].'&action=edit&id='.$base_new_id).'">View Cloned Item&nbsp;<i class="fa  chevron-right"></i></a></p></div>';
		  
return json_encode($res);
	
}
	 
	 
	 
function replace_clone_item($data){
	
	
$res=new stdClass();	
$res->success=0;
$res->msg='<p>Error...</p>';
		
$keyName=$data['fld'];
$this->itemid=ceil($data['tagid']);

$config='page/'.$keyName.'/config.php';
		if(file_exists(	 base_path().$this->admin_path.	$config)){
		$thisConfig=$this->Get_Config(		$config);
		}else{
		return json_encode($res);
}
if($this->itemid==0)  return json_encode($res);
		  
		  
$base_data= DB::table($thisConfig['tableName']  )->where('id',$this->itemid)->first();	
 
$og_id=$base_data->clone_by;
$og_data= DB::table($thisConfig['tableName']  )->where('id',$og_id)->first();	

$ofn=( isset($thisConfig['other_function']) ?$thisConfig['other_function']:false);	
if($ofn) $this->delete_with_OtherFunctionBtn ($ofn,$og_id);
DB::table($thisConfig['tableName'] )->where('id',   $og_id)->delete();


		$isok=	DB::table($thisConfig['tableName']) ->where('id', $this->itemid)->update(
				array(
				'id'=> $og_id,
				'url_rewrite'=>$og_data->url_rewrite,
				'status'=>1,
				'clone_by'=>0,
				)		);
	
	
	
if( isset($thisConfig ['other_function'])){
		foreach ($thisConfig ['other_function'] as $ofval){
		
		switch($ofval['type']){
		case 'manyfile':
		case 'onefile':
		$of_config= Config::get('gbkey.'.$ofval['key']);
		
		$results = DB::table($of_config['table']	) -> where('tb_val',$of_config['tb_val'])-> where('sp_field',$of_config['sp_field'])->where('parent_id',$this->itemid)->get();	
		
			if (count($results )>0){	foreach ($results as $ms) {
				
				$isok=	DB::table($of_config['table']) ->where('id', $ms->id)->update(
				array('parent_id'=>$og_id)		);
			 
				
			}}
		}
}}
	
	
	
	
	
	
	
	
	
	
$res->success=1;		  
$res->msg='<p> Replaced. </p>';
		  
$res->go2path=$this->myurl(ADMIN_PATH.'?q='.$thisConfig['tag'].'&action=edit&id='.$og_id );
return json_encode($res);
	

}


	 
 /*-------------------------Seo function-----------------------*/
function MYF_save_seo_setting(){
	
	
$res=new stdClass();
$res->success=0;
$res->msg='db error';
$data = Input::all();
$this->itemid=(isset( $data['id']))?ceil( $data['id']):0;
$this->tag=(isset( $data['fld']))? $data['fld']:0;
$config='page/'.$this->tag.'/config.php';
$thisConfig=$this->Get_Config($config);
if(!is_array($thisConfig)) exit();

$tbname=$thisConfig['tableName'];
	
$tp_arr=array();
foreach($data  as $ky=>$vl){
if($ky!='id' && $ky!='action' && $ky!='fld') $tp_arr[$ky]=$vl;
}
	
$check_exist = DB::table($tbname)->where('id', $this->itemid) ->count();
$isok=false;
	if(ceil($check_exist)>0){
		$isok=	DB::table($tbname) ->where('id', $this->itemid)->update(
				array('seo_field'=>json_encode($tp_arr))		);
				//if($isok) {
					$res->success=1;
					$res->msg='Saved';
				//}
	}
	
	//	 var_dump( DB::getQueryLog());
		
	$getOg=	DB::table($tbname)->select('seo_field')->where('id', $this->itemid) ->first();
 
	
	 

	return json_encode($res);
}
function MYF_seo_setting(){

$myStdCLass=new stdClass();
$myStdCLass->success=1;

$thisConfig='';

$data = Input::all();
$this->itemid=(isset( $data['pid']))?ceil( $data['pid']):0;
$this->tag=(isset( $data['tag']))? $data['tag']:0;
	 
$this->type=(isset( $data['type']))? $data['type']:0;


$config='page/'.$this->tag.'/config.php';
$thisConfig=$this->Get_Config($config);
if(!is_array($thisConfig)) exit();

$tbname=$thisConfig['tableName'];
$LvLimit=$thisConfig['lv'];
$farray=$thisConfig['allValue'];
$pageUrl=$thisConfig['tag'];

$res ='';
$this->MyConfig=$thisConfig;
$this->have_seosetting=true;
$get_seo_val_raw=	 DB::table($tbname)->select('seo_field')->where('id', $this->itemid)->first();	
$get_seo_val=( 	property_exists($get_seo_val_raw, 'seo_field')  )?stripslashes($get_seo_val_raw->seo_field):'';
$this->seo_val=	($get_seo_val!='') ? json_decode($get_seo_val,true):'';

 
$foreach_array=array();
include_once(base_path().$this->admin_path.'core/seo_config.php');


include_once(base_path().$this->admin_path.'core/Switch_edit.php');
		
$myStdCLass->msg=
'

	<form id="vforms_seo" 	class="form-horizontal" role="form">
'.
$res.'
<button   type="submit"  class="btn btn-primary btn-lg btn-block"><i class="fa fa-save fa-lg"></i>&nbsp;&nbsp; Save</button>
';		
return json_encode($myStdCLass);
// var_dump( DB::getQueryLog());

}
	 
 /*-------------------------Seo function-----------------------*/
	 
 function db_load_admin_level($title,$name,$val){


$results = DB::table('roles')  ->where('id','>=', ((Auth::user()->get()->roles_id) ))->orderBy('id', 'asc') ->get();	

		$sdasd='		<div class="form-group clearfix">
    <label   class="col-sm-3 control-label">'.$title.' </label>
    <div class="col-sm-9"><select class="form-control input-sm" id="'.$name.'" name="'.$name.'"  style="width:240px">';
 foreach ($results as $ms) {
		$ched=($val==$ms->id)?' selected="selected" ':'';
		$sdasd.='<option value="'.$ms->id.'" '.$ched.'>'.$ms->name.'</option>';
		
		
		
}
	$sdasd.='</select>  </div>
  </div>
   ';
	return $sdasd;
}


 /*-------------------------Other function-----------------------*/
 
 
function delete_with_OtherFunctionBtn($Array,$thisid){
	foreach($Array as $vk){
	
	$cng_arr= Config::get('gbkey.'.$vk['key']);
	
	switch($vk['type']){
	
	case 'onefile':
	case 'manyfile':
 
		$results = DB::table($cng_arr['table']	)
													->where('parent_id',   $thisid)
													->where('tb_val',   $cng_arr['tb_val'])
													->where('sp_field',   $cng_arr['sp_field'])
													->get();	
													
		if (count($results )>0){
		$i=0;
		foreach ($results as $ms) {
													
													@unlink($cng_arr['upload_dir']. $ms->full_path);
													@unlink($cng_arr['upload_dir']. $ms->thumbnail_path);
													
													DB::table($cng_arr['table']	)
													->where('id',   $ms->id)
													->delete();
													
		}}
 


	break;
	}
	}
}
function load_OtherFunction_preview(){
	
		
$data = Input::all();
$this->itemid=(isset( $data['id']))?ceil( $data['id']):0;
$this->tag=(isset( $data['fld']))? $data['fld']:0;
	 

$config='page/'.$this->tag.'/config.php';
$thisConfig=$this->Get_Config($config);
if(!is_array($thisConfig)) exit();

$have_one=false;
	$resVal='';
	 
foreach( (array)$thisConfig['other_function'] as $ofval){
switch( $ofval['type']){

case 'onefile':
case 'manyfile':
$cs_arr= Config::get('gbkey.'.$ofval['key']);

	
$thumb='<span class="noval img-responsive img-thumbnail m0">NO ITEM</span>';
//$results_ar=	 DB::table( $cs_arr['tb_val']  ) ->where('parent_id',$this->itemid)->orderby('rank','asc')->get();	
$results_ar = DB::table($cs_arr['table']	) -> where('tb_val',$cs_arr['tb_val'])-> where('sp_field',$cs_arr['sp_field'])->where('parent_id',$this->itemid)
  ->orderBy('rank', 'asc')
->get();	

$ctt=0;
if (count($results_ar )>0){

					$thumb='';
			foreach ($results_ar as $results) {
				
 
					$thumb_path='';
 
		if( 	 	property_exists($results,'full_path') 	 && $results->full_path!=''		){
			
					if($results->full_path!=''){
					
					$thumb_path=$results->full_path; 
					if($results->thumbnail_path!=''){
					$thumb_path=$results->thumbnail_path;
					}
					
						
						
					}else{
					$thumb_path=''; 
	}
						//	$thumb.=$cs_arr['upload_dir'].$thumb_path;
						if( file_exists($cs_arr['upload_dir'].$thumb_path) ){
							
							//switch( $cs_arr['data_type']){	case 'image':
							$newcbsize = myfunc::imgVirtualResize( $cs_arr['upload_dir'].$thumb_path,	200,  200);	
							if($newcbsize[0]>0){
							$thumb.='<a style="max-width:200px" href="'.$cs_arr['upload_url'].$thumb_path.'" target="_blank"><img class="img-responsive img-thumbnail"     src="'.$cs_arr['upload_url'].$thumb_path.'" alt=""/></a>';
							}else{
							$thumb.='<a style="width:100%;" class="img-responsive img-thumbnail text-center"    href="'.$cs_arr['upload_url'].$thumb_path.'" target="_blank"><img    src="'.$this->myurl('static/admin/images/ico_file.jpg').'"   alt=""/>
							<br/><span>'.$results->old_file_name.'</span>
							</a>';
							}
$ctt++;
							//break;}
					
						}
				
		} 
					
			}
			
			

			
			} // >0
						switch( $ofval['type']){
					
					case 'onefile':
					$have_one=true;
					$resVal.='
					<div class="cnt-div clearfix">  
					
<button class="btn btn-primary btn-block" type="button">
 '.$cs_arr['btn_title'].'   <span class="badge">'.$ctt.'</span>
</button>
						<div class="item-list">'.$thumb.'</div>
					</div>
					';
					break;
					case 'manyfile':
					
					//$resVal.=($have_one)?' have one':'';
					$resVal.='
					<div class="cnt-div clearfix"  >
		<button class="btn btn-primary btn-block" type="button">
 '.$cs_arr['btn_title'].'   <span class="badge">'.$ctt.'</span>
</button>
						<div class="item-list">'.$thumb.'</div>
					</div>
					';
					break;		
				} // forearch
break;

}
};

$res =  new stdClass();



$res->success=1;
		
$res->msg=$resVal;

		
 return  json_encode($res);


	
	
	
}
function load_OtherFunctionBtn($Array,$pageType){
	if(is_array($Array)){
	$isEdit=($pageType=='edit')?true:false;
	$str='';
	foreach($Array as $vk){
	switch($vk['type']){
	
	case 'onefile':
	$this_config= Config::get('gbkey.'.$vk['key']);
	$bs=(isset($this_config['btn_style']))?$this_config['btn_style']:'';
	$this->have_fileupload=true;
	$addIthBtn=($isEdit)?'  <div class="btn-group" style="'.	$bs.'">
    <button id="btn_'.$this_config['sp_field'].'"  type="button" class="btn btn-warning btnOneFile" rel="'.$this->itemid.'" data-opt="'.$vk['key'].'" title="'.	$this_config['btn_title'].$this_config['btn_subtitle'].'"><i class="fa fa-upload fa-lg"></i>&nbsp;&nbsp;'.	$this_config['btn_title'].'</button>
  </div>':'
   <div class="btn-group" style="'.$bs.'"> 
		<button  disabled="disabled" type="button" class="btn btn-default" style="line-height:0.6em"><i class="fa fa-lock fa-lg pull-left"></i>  '.	$this_config['btn_title'].'<br/>
			<small>(Please create an item first)</small>
		</button> 
	</div>
  ';
  if( Auth::user()->get()->roles_id==3) 	$addIthBtn='';
	
  	$str.=$addIthBtn;
	break;
	case 'manyfile':
//	print_r($vk);
	$this_config= Config::get('gbkey.'.$vk['key']);
	$bs=(isset($this_config['btn_style']))?$this_config['btn_style']:'';

	
	$bs1=(isset($this_config['btn_style']))?$this_config['btn_style']:'';
	$this->have_fileupload=true;
	$addIthBtn=(	$isEdit   )?'<div class="btn-group" style="'.	$bs.'">
    <button id="btn_'.$this_config['sp_field'].'" type="button" class="btn btn-warning btnManyFile" rel="'.$this->itemid.'" data-opt="'.$vk['key'].'"	title="'.	$this_config['btn_title'].	$this_config['btn_subtitle'].'"><i class="fa fa-upload fa-lg"></i>&nbsp;&nbsp;'.	$this_config['btn_title'].'</button>
  </div>':'
   <div class="btn-group" style="'.	$bs1.'"> 
		<button     disabled="disabled" type="button" class="btn btn-default" style="line-height:0.6em"><i class="fa fa-lock fa-lg pull-left"></i>  '.	$this_config['btn_title'].'<br/>
			<small>(Please create an item first)</small>
		</button> 
	</div>
  ';	
  
  $str.=	$addIthBtn;
  
 // if( Auth::user()->get()->roles_id==3) 	$addIthBtn='';
  
	break;
	case 'seo':
	$this->have_seosetting=true;
	$bs=(isset($this_config['btn_style']))?$this_config['btn_style']:'';
	$str.=(	$isEdit)?'  <div class="btn-group" style="'.$bs.'">
    <button type="button" id="editSeoBtn"   class="btn btn-info btnSeo" data-type="'.$vk['seo_settype'].'" data-pid="'.$this->itemid.'" title="'.	$vk['btn_tt'].'"><i class="fa fa-cog fa-lg"></i>&nbsp;&nbsp;'.	$vk['btn_tt'].'</button>
  </div>':'
  
  ';
	break;/*
	case '':
	break;*/
	
	} //switch
	} //for
return $str;
	}
}
 
 /*-------------------------Other function-----------------------*/
 /*-------------------------List Cat selection-----------------------*/
 
 /*-------------------------List Cat selection-----------------------*/
 function Config_db_cate_level($tbname){

	
 $str=':All;';
$Lvarray=array();
$this->Cat_subLv=array();
$this->Cat_cnfLV=array();
$this->Cat_crid='';
		// $this->conn->debug=1;
$results = DB::select(sprintf('SELECT * FROM  %s order by rank asc',$tbname)); 
foreach ($results as $mgg) {
		if($mgg->parent_id==0){}
		$Lvarray[]=$mgg->parent_id;
		 $this->Cat_subLv['lv'.$mgg->parent_id][]=array($mgg->id,$mgg->title1);
}
	if(isset($this->Cat_subLv['lv0'])){
		if(count($this->Cat_subLv['lv0'])>0){
			 foreach(  $this->Cat_subLv['lv0'] as $val){
				// $isdd=($this->itemid==$val[0])?' disabled="disabled" ':'';
			 
				 $iscsuLv=( isset($this->Cat_subLv['lv'.$val[0]])) ? $this->Cat_subLv['lv'.$val[0]] :'';
			$str.=$val[0].':'.$val[1].';'.$this->Config_getSubCaLv(  $iscsuLv,$val[0],''	,$val[1]);	
			}
		}
	}
	return $str;
}

function Config_getSubCaLv($array,$lvId,$plusVal='|',$catname){
	$str='';
	if(count($array)>0){
		$cnfVal=( isset($this->Cat_cnfLV['lv'.$lvId]) )? $this->Cat_cnfLV['lv'.$lvId] :false;
			$plusVal=($cnfVal)?$plusVal.$plusVal:'|';
			$countVV= explode('|',$plusVal);
			$countVV_num=count($countVV);
			$countVV_num=str_repeat("--", $countVV_num);
			$txtStart=$countVV_num.'['.$catname.'] ';
			$this->Cat_cnfLV['lv'.$lvId]=true;
			if(is_array($array)){
			 foreach( $array as $val){
				 $isdd=($this->itemid==$val[0])?' disabled="disabled" ':'';
				 $iscsuLv=( isset($this->Cat_subLv['lv'.$val[0]])) ? $this->Cat_subLv['lv'.$val[0]] :'';
				$str.=   $val[0].':'.$txtStart.$val[1].';'.$this->Config_getSubCaLv( $iscsuLv,$lvId,$plusVal,	$val[1]);
			}}
		return $str;
	}
}

 /*-------------------------List Cat selection-----------------------*/


 
 
 
 
 function Layout_db_cate_level($tbname,$title,$name,$val,$isItem=false,$toplevel=false,$reqStar=''){
$this->cate_lv_limit=1;
if($toplevel){
 $str=' 	 
   '.$this->txt['top_lv'].'	<input type="hidden" value="0" id="'.$name.'" name="'.$name.'"   />
 
 
		';
}else{
	
if($isItem){
$reqClass=' required chosen';
$topLevel=' <option value="">Please select a Value</option> ';
}else{
$reqClass=' ';
$topLevel=' <option value="0">---'.$this->txt['top_lv'].'---</option> ';

}	
 $isdd='';	
 $str=' 
  
  <select class="  form-control   '.$reqClass.' "  id="'.$name.'" name="'.$name.'"  >'.$topLevel.' ';
$Lvarray=array();
$this->Cat_subLv=array();
$this->Cat_cnfLV=array();
$this->Cat_crid=$val;

$tbname=$tbname;
$results = DB::select(sprintf('SELECT * FROM  %s order by rank asc',$tbname)); 

foreach ($results as $mgg) {
		if($mgg->parent_id==0){}
		$Lvarray[]=$mgg->parent_id;
		 $this->Cat_subLv['lv'.$mgg->parent_id][]=array($mgg->id,$mgg->title1);
}
if(isset($this->Cat_subLv['lv0'])){
		if(count($this->Cat_subLv['lv0'])>0){
			 foreach(  $this->Cat_subLv['lv0'] as $val){
				 if(!$isItem){
				// $isdd=($this->itemid==$val[0])?' disabled="disabled" ':'';
				 }
				 $this_have_sub=(	isset($this->Cat_subLv['lv'.$val[0]]) )? $this->Cat_subLv['lv'.$val[0] ]:'';
				 
		$this->cate_lv_limit++;
		
		$with_subCat='';
		if($this->cate_lv_limit_val >= $this->cate_lv_limit 	 ){
		$with_subCat=$this->getSubCaLv( $this_have_sub,$val[0],''	,$val[1]);
		}
		if(!$this->cate_lv_limit_onoff){
		$with_subCat=$this->getSubCaLv( $this_have_sub,$val[0],''	,$val[1]);
		}
				 
		  $str.= '<option '. $isdd.' value="'.$val[0].'"	'.(($this->Cat_crid==$val[0]?' selected="selected" ':'')).' style=" font-weight:bold">'.$val[1].'</option>'.		$with_subCat;
			}
		}
}
		
 $str.='</select> 
 ';
 
}
	return $str;
/*
		$sql = sprintf("SELECT * FROM  %s order by rank asc",$tbname); 
		$rs = $this->conn->Execute($sql);
		$totalRecord = $rs->RecordCount();
		if($totalRecord > 0) {
			while (!$rs->EOF) {
				if($rs->fields["parent_id"]==0){}
				$Lvarray[]=$rs->fields["parent_id"];
				 $this->Cat_subLv['lv'.$rs->fields["parent_id"]][]=array($rs->fields["id"],$rs->fields["title1"]);
			$rs->MoveNext();
			}
		}  
		
		if(count($this->Cat_subLv['lv0'])>0){
			 foreach(  $this->Cat_subLv['lv0'] as $val){
				 if(!$isItem){
				 $isdd=($this->itemid==$val[0])?' disabled="disabled" ':'';
				 }
			 $str.= '<option '. $isdd.' value="'.$val[0].'"	'.(($this->Cat_crid==$val[0]?' selected="selected" ':'')).' style=" font-weight:bold">'.$val[1].'</option>'.$this->getSubCaLv( $this->Cat_subLv['lv'.$val[0]],$val[0],''	,$val[1]);
			}
		}
 $str.='</select></div>
		</div>';

}
	return $str;*/
}
























function MYF_db_CatSort(){
	
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




//$this->conn->debug=1;
$str='<dl class="adminCart-dl">';
//<dd style="border:0"><a class="Create minbutton mid mbtn" style="  display:block" href="?q='.$mycofig['tag'].'&action=create">'.$this->txt['create_new_cat'].'</a></dd>
$Lvarray=array();
$this->Cat_title=array();
$this->Cat_subLv=array();
$this->Cat_cnfLV=array();
$this->Cat_crid='';

$results = DB::table($tbname	)  ->orderBy('rank', 'asc') ->get();	
		if (count($results )>0){
		$i=0;
			foreach ($results as $ms) {
				
				
				
				$Lvarray[]=$ms->parent_id;
				
				$this->Cat_title['cid'.$ms->id]=array($ms->title1,$ms->parent_id,$ms->status);
				$tvs2=( $ms->title2!='')?' / '.$ms->title2:'';
				 $this->Cat_subLv['lv'.$ms->parent_id][]=array($ms->id,$ms->title1.$tvs2,$ms->status);
			}
		}
if(isset($this->Cat_subLv['lv0'])){			
	if(count($this->Cat_subLv['lv0'] )>0){
		
				 foreach(  $this->Cat_subLv['lv0'] as $val){
					  
 
			$cvid=( 	isset($this->Cat_title['cid'.$val[0]])	)?$this->Cat_title['cid'.$val[0]]:array();
		//	print_r($cvid);
			$cvid_1=( isset($cvid[1]))?$cvid[1]:0;
			$cvid_2=( isset($cvid[2]))?$cvid[2]:0;
			
				 $cr=($this->itemid==$val[0])?' cr ':'';
				 $status_div=(	$cvid_2==0)?'	<b   class="btn-default btn status pull-right">'.$this->txt['disabled'].'</b>	':'';
				 
				 $this_catLv=(isset( $this->Cat_subLv['lv'.$val[0]]))?$this->Cat_subLv['lv'.$val[0]]:array();
				 $str.= '<dd><div class="well  well-sm mb5"> 
				 
				 <div class="cartLine '.$cr.'">
				 <a class="btn btn-info edit mbtn"  title="'.$this->txt['edit'].'" href="?q='.$this->keyName.'&action=edit&id='.$val[0].'">'.$this->txt['edit'].'</a>
				<a class="btn btn-warning sort mbtn"  title="'.$this->txt['sort'].'" data-pid="'.	$cvid_1.'">'.$this->txt['sort'].'</a>	
			
				<a class="btn btn-danger mbtn del" data-mid="'.$val[0].'">Del</a>
					<span class="fs18">&nbsp;'.$val[1].' </span>
				 '. $status_div.'
				 </div>
				 </div>
				  '.$this->MYF_db_CatSort_Sub(  $this_catLv,$val[0]).'
</dd>';
 
				}		
			
		}else{
		 $str.='<dd><div class="well  well-sm"> <p class="p_center padding55">'.$this->txt['no_cat'].'</p></div></dd>';
		}					
}else{
		 $str.='<dd><div class="well  well-sm"> <p class="p_center padding55">'.$this->txt['no_cat'].'</p></div></dd>';
}
 $str.='</dl>';		
	return $str;
 
}

function getSubCaLv($array,$lvId,$plusVal='|',$catname){
	$str='';
	if(count($array)>0){
		//	$plusVal=($this->Cat_cnfLV['lv'.$lvId])?$plusVal.$plusVal:'|';
		$cnflv=( isset($this->Cat_cnfLV['lv'.$lvId]) )? $this->Cat_cnfLV['lv'.$lvId]:false;
			$plusVal=($cnflv)?$plusVal.$plusVal:'|';
			$countVV= explode('|',$plusVal);
			$countVV_num=count($countVV);
			$countVV_num=str_repeat("&nbsp;&nbsp;&nbsp;", $countVV_num);
			$txtStart=$countVV_num.'['.$catname.']&nbsp;';
			$this->Cat_cnfLV['lv'.$lvId]=true;
			if(is_array($array)){
			 foreach( $array as $val){ 
				 $isdd=($this->itemid==$val[0])?' disabled="disabled" ':'';
				 
				 $this_have_sub=(	isset($this->Cat_subLv['lv'.$val[0]]) )? $this->Cat_subLv['lv'.$val[0] ]:'';
				 
				$str.=  '<option value="'.$val[0].'" '.$isdd.'	'.(($this->Cat_crid==$val[0]?' selected="selected" ':'')).'>'.$txtStart.$val[1].'</option>'.$this->getSubCaLv(  $this_have_sub,$lvId,$plusVal,	$val[1]);
			}}
		return $str;
	}
}
function MYF_db_CatSort_Sub($array,$lvId,$plusVal='>'){
	$str='';
	if(count($array)>0){
		
		
			//$plusVal=($this->Cat_cnfLV['lv'.$lvId])?$plusVal.$plusVal:'>';
			$this->Cat_cnfLV['lv'.$lvId]=true;
			
		
			
			$str='<dl class="adminCartSub-dl m0 p0"  style="margin-left:40px;">';
			 foreach( $array as $val){
				 $thisSubLv=(isset($this->Cat_subLv['lv'.$val[0]]))?$this->Cat_subLv['lv'.$val[0]]:array();
				 
				 $havere=$this->MYF_db_CatSort_Sub( $thisSubLv,$lvId,$plusVal);
				 $havere=($havere!='')?$havere:'';
				//	 $ppx=count(explode('>',$plusVal))*10;
				//margin-left:'.$ppx.'px;"
				 $parid= (isset($this->Cat_title['cid'.$val[0]]))?$this->Cat_title['cid'.$val[0]]:'';
				 $parid_title= (isset($this->Cat_title['cid'. $parid][1]))?$this->Cat_title['cid'. $parid][1]:'';
				 //<span style="float:right; color:#999;">under ['. $parid_title.']</span>
				 
	$car_tt_v1=(isset($this->Cat_title['cid'.$val[0]][1]))?$this->Cat_title['cid'.$val[0]][1]:''	;
	$car_tt_v2=(isset($this->Cat_title['cid'.$val[0]][2]))?$this->Cat_title['cid'.$val[0]][2]:''	;		 
				 
	 $status_div=(	$car_tt_v2==0)?'	<b class="btn-default btn status pull-right">'.$this->txt['disabled'].'</b>	':'';
	 $cr=($this->itemid==$val[0])?' cr ':'';
				$str.=  '<dd>
				<div class="well well-sm mb5">
	<div class="cartLine	'.$cr.'">
	<a class="btn btn-info edit mbtn"   href="?q='.$this->keyName.'&action=edit&id='.$val[0].'">'.$this->txt['edit'].'</a>
	<a class="btn btn-warning sort mbtn" data-pid="'.$car_tt_v1.'">'.$this->txt['sort'].'</a>	
	<a class="btn btn-danger mbtn del" data-mid="'.$val[0].'">Del</a>	
	<span class="fs18">&nbsp;'.$val[1].' </span>	
	 '. $status_div.'
	</div>
			</div>	</dd>'. $havere;
			}$str.= '</dl>	';
		return $str;
	}
}




function MYF_sort_Cart(){
	
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



		$str='';
	 	$results = DB::table($tbname	)->where('parent_id', $this->itemid) ->orderBy('rank', 'asc') ->get();	 
													
		if (count($results )>0){
		$i=0;
			$str='
			<input id="sorting" value="" type="hidden" />
			<ul id="sortable" class="sortUU mo p0 nav">';
		foreach ($results as $ms) {
						$str.='<li id="'.$ms->id.'" class="well well-sm mb5 clearfix"><b class="pull-left btn btn-link"><i class="fa fa-arrows-v  fa-lg"></i></b><p class="p55em m0 step10 pull-left">'.$ms->title1.'</p></li>';				
		}
			$str.='</ul><p class="text-right ">
			<a id="upcateSort" class="btn btn-info text-white "><span class="text-white">'.$this->txt['update'].'</span></a></p>
			';
	
}
		return $str;
	 
}

function MYF_mCart_goSort(){
	
$thisConfig='';

$data = Input::all();
$this->pid=(isset( $data['pid']))?ceil( $data['pid']):0;
$this->tag=(isset( $data['tag']))? $data['tag']:0;	 

$this->sortval=(isset( $data['sortval']))? $data['sortval']:0;	 


$config='page/'.$this->tag.'/config.php';
$thisConfig=$this->Get_Config($config);
if(!is_array($thisConfig)) exit();

$this->main_field='id';
 
$this->keyName=$thisConfig['tag'];
$tbname=$thisConfig['tableName'];
$LvLimit=$thisConfig['lv'];
$farray=$thisConfig['allValue'];
$pageUrl=$thisConfig['tag'];


	
	
$sortval=$this->sortval;
$sortval_arr=explode(',',$sortval);
if(count($sortval_arr)>0){
	$i=0;
	foreach((array)$sortval_arr as $vlss){
	//	$geUpp=$this->conn->Execute(sprintf("update  %s  SET rank=%d  WHERE  parent_id =%d and id=%d",$myconfig['tableName'],$i,$this->parent_id,$vlss));
		
			 $sv=	DB::table($tbname) ->where('parent_id', $this->pid)->where('id', $vlss)->update(
				array(
				'rank'=>$i 
				)
			);
		$i++;	
}
	
	}
		$res =  new stdClass();
		$res->success=1;
 return  json_encode($res);

}

function MYF_db_delCart( ){
	
$thisConfig='';

$data = Input::all();
$this->cid=(isset( $data['cid']))?ceil( $data['cid']):0;
$this->tag=(isset( $data['tag']))? $data['tag']:0;	  	 


$config='page/'.$this->tag.'/config.php';
$thisConfig=$this->Get_Config($config);
if(!is_array($thisConfig)) exit();

$this->main_field='id';
 
$this->keyName=$thisConfig['tag'];
$tbname=$thisConfig['tableName'];
$LvLimit=$thisConfig['lv'];
$farray=$thisConfig['allValue'];
$pageUrl=$thisConfig['tag'];

 
 
	
	
		$res =  new stdClass();
		$res->success=0;
		$res->msg=$thisConfig['pageName'];
		
		$ghj=DB::table($tbname	)->where('id',  $this->cid)->delete();
		if($ghj){	
		$res->success=1;		
		$res->msg='Ok';	
		}
 return  json_encode($res);;

}

 
 






 /*

function Old_MYF_db_CatSort($tbname,$mycofig){
//$this->conn->debug=1;
$str='<dl class="adminCart-dl">';
//<dd style="border:0"><a class="Create minbutton mid mbtn" style="  display:block" href="?q='.$mycofig['tag'].'&action=create">'.$this->txt['create_new_cat'].'</a></dd>
$Lvarray=array();
$this->Cat_title=array();
$this->Cat_subLv=array();
$this->Cat_cnfLV=array();
$this->Cat_crid=$val;
		$sql = sprintf("SELECT * FROM  %s order by cast(rank as unsigned) asc",$tbname); 
		$rs = $this->conn->Execute($sql);
		$totalRecord = $rs->RecordCount();
		if($totalRecord > 0) {
			while (!$rs->EOF) {
				if($rs->fields["parent_id"]==0){}
				$Lvarray[]=$rs->fields["parent_id"];
				
				$this->Cat_title['cid'.$rs->fields["id"]]=array($rs->fields["title1"],$rs->fields["parent_id"],$rs->fields["status"]);
				
				 $this->Cat_subLv['lv'.$rs->fields["parent_id"]][]=array($rs->fields["id"],$rs->fields["title1"],$rs->fields["status"]);
			$rs->MoveNext();
			}
		} 
if(count($this->Cat_subLv['lv0'] )>0){
	 foreach(  $this->Cat_subLv['lv0'] as $val){
	 $cr=($this->itemid==$val[0])?' cr ':'';
	 $status_div=($this->Cat_title['cid'.$val[0]][2]==0)?'	<b class="status">'.$this->txt['disabled'].'</b>	':'';
	 $str.= '<dd>
	 
	 <p class="cartLine '.$cr.'">
	 <a class="btn btn-info edit mbtn"  title="'.$this->txt['edit'].'" href="?q='.$this->tag_name.'&action=edit&id='.$val[0].'">'.$this->txt['edit'].'</a>
	<a class="btn btn-success sort mbtn"  title="'.$this->txt['sort'].'" data-pid="'.$this->Cat_title['cid'.$val[0]][1].'">'.$this->txt['sort'].'</a>	

	<a class="btn btn-danger mbtn del" data-mid="'.$val[0].'">Del</a>		 <span>'.$val[1].' </span>
	 '. $status_div.'
	 </p>
	 
	 
	  '.$this->MYF_db_CatSort_Sub( $this->Cat_subLv['lv'.$val[0]],$val[0]).'</dd>';
	}
}else{
 $str.='<dd><p class="p_center padding55">'.$this->txt['no_cat'].'</p></dd>';
}
 $str.='</dl>';		
	return $str;

}
function Old_MYF_db_CatSort_Sub($array,$lvId,$plusVal='>'){
	$str='';
	if(count($array)>0){
			$plusVal=($this->Cat_cnfLV['lv'.$lvId])?$plusVal.$plusVal:'>';
			$this->Cat_cnfLV['lv'.$lvId]=true;
			
		
			
			$str='<dl class="adminCartSub-dl">';
			 foreach( $array as $val){
				 $havere=$this->MYF_db_CatSort_Sub( $this->Cat_subLv['lv'.$val[0]],$lvId,$plusVal);
				 $havere=($havere!='')?$havere:'';
				//	 $ppx=count(explode('>',$plusVal))*10;
				//margin-left:'.$ppx.'px;"
				 $parid= $this->Cat_title['cid'.$val[0]];
				 $parid_title= $this->Cat_title['cid'. $parid][1];
				 //<span style="float:right; color:#999;">under ['. $parid_title.']</span>
				 
	 $status_div=($this->Cat_title['cid'.$val[0]][2]==0)?'	<b class="status">'.$this->txt['disabled'].'</b>	':'';
	 $cr=($this->itemid==$val[0])?' cr ':'';
				$str.=  '<dd>
				
	<p class="cartLine	'.$cr.'">
	<a class="edit mbtn"   href="?q='.$this->tag_name.'&action=edit&id='.$val[0].'">'.$this->txt['edit'].'</a>
	<a class="sort mbtn" data-pid="'.$this->Cat_title['cid'.$val[0]][1].'">'.$this->txt['sort'].'</a>	
	<a class="mbtn del" data-mid="'.$val[0].'">Del</a>	
	<span>'.$val[1].' </span>	
	 '. $status_div.'
	</p>
				</dd>'. $havere;
			}$str.= '</dl>';
		return $str;
	}
}

function Old_getSubCaLv($array,$lvId,$plusVal='|',$catname){
	$str='';
	if(count($array)>0){
		//	$plusVal=($this->Cat_cnfLV['lv'.$lvId])?$plusVal.$plusVal:'|';
		$cnflv=( isset($this->Cat_cnfLV['lv'.$lvId]) )? $this->Cat_cnfLV['lv'.$lvId]:false;
			$plusVal=($cnflv)?$plusVal.$plusVal:'|';
			$countVV= explode('|',$plusVal);
			$countVV_num=count($countVV);
			$countVV_num=str_repeat("&nbsp;&nbsp;&nbsp;", $countVV_num);
			$txtStart=$countVV_num.'['.$catname.']&nbsp;';
			$this->Cat_cnfLV['lv'.$lvId]=true;
			if(is_array($array)){
			 foreach( $array as $val){ 
				 $isdd=($this->itemid==$val[0])?' disabled="disabled" ':'';
				 
				 $this_have_sub=(	isset($this->Cat_subLv['lv'.$val[0]]) )? $this->Cat_subLv['lv'.$val[0] ]:'';
				 
				$str.=  '<option value="'.$val[0].'" '.$isdd.'	'.(($this->Cat_crid==$val[0]?' selected="selected" ':'')).'>'.$txtStart.$val[1].'</option>'.$this->getSubCaLv(  $this_have_sub,$lvId,$plusVal,	$val[1]);
			}}
		return $str;
	}
}

*/















function AJAX_valideform($acttg){
$str='<script type="text/javascript">var fld="'.$acttg.'"; </script><script type="text/javascript" src="'.$this->myurl($this->admin_file.'js/js.submit.js').'"></script>';
 



/*

$.ajax({
 	 url: 'admin/process',
    type : 'POST',
    dataType :'json',
    data :$('#vforms').serialize() + '&action=todb&fld=".$acttg."',
	success: function(jdata){
		var chc=parseInt(jdata.success)
	 
		var tgaa=$('#vforms .lodingDiv p.msg');
		tgaa.css('background','#fff');
		var closeBtn=$('<a class=\"minbutton mid\">Closef</a>').click(function(){ $('#vforms').reDxloader(); });
		 $('#vforms .lodingDiv').css('background-image','$this->myurl(img/blank.gif)'); 
		var viewOther=$('<a class=\"minbutton mid\">continue</a>').click(function(){ window.location.href=jdata.itemurl; });
		var BackOther=$('<a class=\"minbutton mid\">b21</a>').click(function(){ window.location.href=jdata.backurl; });
		var btncnt=$('<div/>').css({width:'100%'});
			tgaa.empty();
		if(chc==1){
			if(jdata.action=='insert'){
				btncnt.html(jdata.msg+'<br/><br/>').append(viewOther).append(BackOther);
				tgaa.append(btncnt);
			}else{
				btncnt.html(jdata.msg+'<br/><br/>').append(closeBtn);
				tgaa.append(btncnt);
			}
		}else{
			tgaa.html(jdata.msg+'<br/><br/>').append(closeBtn);
		} 
					
		$(\"input[type='password']\").val('');
				if(jdata.action!='insert'){
				tgaa.parent().css({ cursor:'pointer'}).click(function(){ $('#page-wrapper').reDxloader(); });
				}
	 }
})
		}//	submitHandler:
	});
	*/

 
return $str;
}


private function MYF_saveSort(){
$res =  new stdClass();
$res->success=0;
	
$thisConfig='';
$data = Input::all();
$this->node_id=(isset( $data['sort_node_id']))?ceil( $data['sort_node_id']):0;
$this->tag=(isset( $data['tag']))? $data['tag']:0;	 
$this->sortval=(isset( $data['sort_val']))? $data['sort_val']:0;	 

$config='page/'.$this->tag.'/config.php';

$thisConfig=$this->Get_Config($config);

if(!is_array($thisConfig)) {
$res->success=0;
 return  json_encode($res);
}
 
 
$this->keyName=$thisConfig['tag'];
$tbname=$thisConfig['tableName'];
$LvLimit=$thisConfig['lv'];
$farray=$thisConfig['allValue']; 

	
$sortval=$this->sortval;
$sortval_arr=explode(',',$sortval);
//print_r($sortval_arr);
if(count($sortval_arr)>0){
if(  $thisConfig['menuList']['sort']['sort_setting']['sort_type']=='desc'){	
	$i=count($sortval_arr);
	foreach((array)$sortval_arr as $vlss){
	//	$geUpp=$this->conn->Execute(sprintf("update  %s  SET rank=%d  WHERE  parent_id =%d and id=%d",$myconfig['tableName'],$i,$this->parent_id,$vlss));
		
		if($this->node_id>0){
			$sv=	DB::table($tbname) ->where('node_id', $this->node_id)->where('id', $vlss)->update(
				array('rank'=>$i));
		}else{
			$sv=	DB::table($tbname) ->where('id', $vlss)->update(
				array('rank'=>$i));
	//	echo $vlss.'@'.$i.'@@'."<br/>\n";
		}
			
			
		$i=$i-1;
	}

}else{

	$i=0;
	foreach((array)$sortval_arr as $vlss){
	//	$geUpp=$this->conn->Execute(sprintf("update  %s  SET rank=%d  WHERE  parent_id =%d and id=%d",$myconfig['tableName'],$i,$this->parent_id,$vlss));
		
		if($this->node_id>0){
			$sv=	DB::table($tbname) ->where('node_id', $this->node_id)->where('id', $vlss)->update(
				array('rank'=>$i));
		}else{
			$sv=	DB::table($tbname) ->where('id', $vlss)->update(
				array('rank'=>$i));
		
		}
			
			
		$i++;	
	}
	
}
	
	
}
		$res->success=1;
 return  json_encode($res);

	
}


function Layout_listval_grid($val,$type,$cr_config='',$cr_itemid=0,$allval){
 
	switch($type){
		
			case 'CLONE':
			$str=(ceil($val)==0)?'---':'<a class="btn btn-default" href="'.$this->myurl(ADMIN_PATH.'?q='.$this->keyName.'&action=edit&id='.$val).'" target="_blank">&nbsp;&nbsp;CLONE&nbsp;&nbsp;</a>';
			
			break;
			
			
			case 'STATUS':
			$str=(ceil($val)==0)?'<span class="fa fa-times"></span>':'<span class="fa   fa-check"></span>';
			
			break;
 
 
			
			case 'KCP_FILE_PATH':
			$str=($val!='')?'<a href="'.$val.'" title="'.$val.'" target="_blank" class="btn btn-info btn-sm text-white" style="color:#fff;">&nbsp;&nbsp;Open File&nbsp;&nbsp;</a>':'---';
			
			break;
 
 
 
 
			case 'PICKUP':
	 $str='';
					switch(ceil($val)){
			 
					case 2:$str='<span class="text-black sprows ret">Returned</span>';	break;
					case 1:$str='<span class="text-black sprows pik">Picked up</span>';	break;
					case 0:$str='<span class="text-black">---</span>';	break;
					}
				
			break;
 
 
 
			case 'PAYMENT_INFO':
	 $str='';
					switch($allval->payment_type){
					case 'paypal':
						if($allval->payment_id!=''){
								$str='<span class="text-success">SUCCESS</span>';
						}else{
						
								$str='<span class="text-grey">INCOMPLETE</span>';
						}
						
						
					break;
					case 'direct_pay':
					
								$str='<span class="text-primary">DIRECT PAY</span>';
					
					
					break;
					case 'other':
					
								$str='<span class="text-warning">OTHER</span>';
					
					
					break;
					}
				
			break;
 

			case 'TEXT':
			$str=str_replace("\n",'',$val);
			break;
			
			case 'PRCENTAGE':
			$str=sprintf("%.2f",($val*100)).'%';
			break;
 

			case 'CAT-LEVEL"':
			$str=$val;
			break;
	 
			 case 'SELECT-TB-PRODUCT': 
			 case 'SELECT-TB': 
  
		 	$stbval=	 DB::table($cr_config[5]['sqlset'][0]  )->select($cr_config[5]['sqlset'][2])->where('id', $val)->first();		 
			$str=	(isset($stbval->$cr_config[5]['sqlset'][2]))?	 	$stbval->$cr_config[5]['sqlset'][2]:'';
				
			break;
			
			
						 case 'SELECT-ARR': 
			$str='';
  			$sa_array=$cr_config[5]['valArray'];
			foreach($sa_array as $saVal){
			if($saVal['name']==$val) $str=$saVal['tt'];
			}
			break;
			
				 
			 case 'SP-LIST': 
			 $ckb5= $cr_config[5]['checkbox'];
			 
		 
					
		 	$results=	 DB::table( $ckb5['table']  )->select(	 $ckb5['val2'])->whereIn('id', explode(',',myfunc::removeQuote($val)	))->get();		 
		  
			$str_arr=array();
		if (count($results )>0){
		 
			foreach ($results as $ms) {
						$str_arr[]=$ms->	 $ckb5['val2'];
			}
		}
							$str=implode(', ',		$str_arr);
				
			break;
			
			

			case 'FIX-NUM':
			$str=myfunc::dgVal($val,2);
			break;
			

			case 'FIX':
			$str=$val;
			break;
			
			case 'DPM':
			case 'VAL':
			$str=$val;
			break;
			
			default: 
			$str=$val;
	}
	/*
	switch($clname){
			default: 
			$str=$val;
	}*/
	
	$str=str_replace('\n','',$str);
	return $str;
}



	 
function Get_Config($path){
	
	$mycofig=array();
	$isAjax=false;
	require(public_path().$this->admin_path.$path);
	
	return $mycofig;
}
 

private function show_menu(){
	 $this->menu_array =Config::get('admin_menu_list');
	return $this->show_menu_dp( $this->menu_array);
}
private function show_menu_dp($menuval,$type=0){

//	$menuval=Config::get('admin_menu_list');

 
 //print_r($menuval);
 
	$str='';
	$link_one='';
	$data = Input::all();
	$data['q']=(isset($data['q']))?$data['q']:'';
	$data['action']=(isset($data['action']))?$data['action']:'';
foreach($menuval as $val){
	
	
	if($this->user_lv<=$val['lv']){
		
	// print_r($val );
	 if($type==1){
	//	print_r($menuval);
		}

	switch( $val['type']){
		
		case 'one_page':		
		
		$crc=($val['link']=='?'.$_SERVER['QUERY_STRING'])?' active ':'';
	 
		$str.='<li class="one_li"><a class="'.$crc.'" href="'.$val['link'].'" >'.$val['title'].'</a></li>';		
		
		break;
		
		case 'page':		
 		$thisConfig=$this->Get_Config($val['path']);
		$cv=0;
		foreach($thisConfig['menuList'] as $cg){
			if(isset($cg['sublink'])){
			$cv++;
			}
		}
		//$str.=($cv>=1)?'<ul class="nav nav-second-level">'.$this->show_menu_dp($thisConfig['menuList'],1).'</ul>':$this->show_menu_dp($thisConfig['menuList'],1);
		$mdl_cnt=$this->show_menu_dp($thisConfig['menuList'],1);
		$mdl_cnt=($mdl_cnt!='')?'<li class="one_li">'.$mdl_cnt.'</li>':'';
		$str.=($cv>=1)?$mdl_cnt:$mdl_cnt;
		 break;

		case 'title':		$str.=' <li> <a href="#"><strong>  '.$val['title'].'</strong><span class="fa arrow"></span></a><ul class="nav nav-second-level">';	 break;
		case 'title-end':		$str.='</ul></li>';			break;
		case 'link':	
		
		$link_content='';
		$crc='';
		$valSkc=(isset($val['sublink']))?count($val['sublink']):0;
	if($valSkc>0){

				$vc=(isset($val['class']))?$val['class']:'';
				
				$link_content.='<div class="pull-left"><a class="btn link '.$crc.' '.$vc.'"  href="?q='.$val['tag'].'" title="'.$val['title'].'">'.$val['title'].'</a></div>';
				
				$valSkc=(isset($val['sublink']))?count($val['sublink']):0;
				for($sub=0; $sub<$valSkc; $sub++){
							/*
							$req_url=basename($_SERVER['REQUEST_URI']);
							$req_url=strtolower($req_url);
							$req_url=str_replace('index.php','',	$req_url);
						*/
							$crcSub='';
							if(($this->user_lv<=$val['sublink'][$sub]['lv'])){
								
								$vcs=(isset($val['sublink'][$sub]['class']))?$val['sublink'][$sub]['class']:'';
								
							$isIcon=(isset($val['sublink'][$sub]['icon']))?'<i class="fa '.$val['sublink'][$sub]['icon'].' lg"></i>':$val['sublink'][$sub]['title'];
								$link_content.='<a class="btn btn-primary  pull-right  p_center '.$crcSub.'	'.$vcs.'"  href="?q='.$val['sublink'][$sub]['href'].'" title="'.$val['sublink'][$sub]['title'].'">'.$isIcon.'</a>';
							}
					
				}
	}else{
 		$val['class']=(isset($val['class']))?$val['class']:'';
		$link_one='   <a class="  '.$crc.' '.$val['class'].'" href="?q='.$val['tag'].'" >'.$val['title'].'</a> ';
	}
	
	
 
	$valSkc=(isset($val['sublink']))?count($val['sublink']):0;
	if($valSkc>0){
		$link_c='<li class="clearfix"><div class="sublink">'.$link_content.'</div></li>';
		$str.=$link_c;
	}else{
		$str.=$link_one;
	}
	
	 
		 break;
		case 'custom':		$str.=$val['value'];		 break;
		 break;
	} // if lv
	
	
	
	
	
	
	
	
	
	
	
	} //for
}
return $str;
 /*
$menu_start='<div class="clear"></div><div class="box menubox">
						<h2>
							<a href="#"  class="menuBtnClass ">Menu</a>
						</h2>
<div class="block" id="menu-items">
	';
 
$menu_end='</div></div>';
 */
}
	
function listTableVal($ck_val='',$keyName){
		include_once(base_path().$this->admin_path.'core/ajax_list.php');
		return json_encode($responce);
}
public function Layout_edit_form_val(){
		$foreach_array=$this->MyConfig['allValue'];
		include_once(base_path().$this->admin_path.'core/Switch_edit.php');
		return $res;
}	
	function Layout_event_list_grid(){
		include_once(base_path().$this->admin_path.'core/Switch_list.php');
		//return $res;
}
 public function show_page_content($data)
    {	
		if(isset($data['q'])){
		$config='page/'.$data['q'].'/config.php';
		if(file_exists(	 base_path().$this->admin_path.	$config)){
		$ThisConfig=$this->Get_Config(		$config);

								$haveCore=false;
								foreach($ThisConfig['menuList'] as $key=>$mtVal){	
				 
									if($_GET['action'] == $key){
										$haveCore=true;
										$this->MyConfig=$ThisConfig;
										$this->title=$mtVal['title'];
									
										include_once(	 base_path().$this->admin_path.$mtVal['core']);
							 
									}
								}
								if(!$haveCore){
										return $this->LAYOUT_notfound($val);
								}
									
	}// is exist
	}//isset
}

	function DEL_ONE($data){
 
			include_once(base_path().$this->admin_path.'core/del.php');
			return json_encode($res);
	}

	function TODB($data){
			//include_once('../core/todb.php');
			include_once(base_path().$this->admin_path.'core/todb.php');
			return json_encode($res);
	}
	
	
function log_lastaction_update(){ 
	$isok=	DB::table('users_status') ->where('user_id',Auth::user()->get()->id)->update(
				array('last_action'=> time()  )
				);
 
}

function log_lastaction(){ 
$check_exist = DB::table('users_status')->where('user_id', Auth::user()->get()->id) ->count();
if(ceil($check_exist)==0){
		$gid = DB::table('users_status')->insertGetId(
	   array(
	   'user_id'=>Auth::user()->get()->id,
	   'last_action'=>time(),
	   )
	);
}else{
	$this->log_lastaction_update();
}
}

	function log_loginLog($arr){
		
	$ltype=($arr['login_type']==1)?'success':'failed';
 
	$gid = DB::table('admin_login_log')->insertGetId(
   array(
   'username'=>$arr['username'],
   'login_type'=>$ltype,
   'ip'=>$arr['ip'],
   'created_at'=>date('Y-m-d H:i:s:u'),
   'lv_act'=>$arr['lv'],
   )
);

   
	}	
	private function page_top_bar(){
	/*
	return '<ul class="nav navbar-top-links navbar-right">
               
                <!-- /.dropdown -->
              
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
					
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->';
		*/
			return '<ul class="nav navbar-top-links navbar-right">
			
             <li><a href="'.ROOT_PATH.'"><i class="fa  fa-paper-plane fa-fw"></i><span class="hidden-xs">&nbsp;&nbsp;Preview Website</span></a>  </li>
             <li><a href="'.ADMIN_PATH.'?q=madmin&action=edit&id='.$this->user_id.'"><i class="fa fa-cog fa-lg"></i><span  class="hidden-xs">&nbsp;&nbsp;Account Setting</span></a>  </li>
             <li><a href="'.ADMIN_PATH.'/logout"><i class="fa fa-sign-out fa-lg"></i><span  class="hidden-xs">&nbsp;&nbsp;Logout</span></a>  </li>
			</ul>';
	}
	function adminHome(){
	$cr_date = new DateTime(date('Y-m-d H:i:s', strtotime("-10 minutes ")));
	$online_user='';
	$results =DB::table('users_status')
            ->join('users', 'users_status.user_id', '=', 'users.id')
            ->where('users_status.last_action','>', $cr_date->getTimestamp())
            ->select('users.username','users.name','users_status.last_action')
            ->get(); 
	if (count($results )>0){
		foreach ($results as $ms) {
$datetime1 =new DateTime( date('Y-m-d H:i:s', time()) );
$datetime2 =new DateTime(  date('Y-m-d H:i:s', $ms->last_action) );
$interval = $datetime1->diff($datetime2);
$diff= (time()!=$ms->last_action)?$interval->format('%R %i Min(s)'):'Now';
		//$diff=1;
	//	$tval=	( $ms->last_action ==time() )?'Now':myfunc::dateDiff( $ms->last_action ,time());	
	$online_user.='  <li class="list-group-item clearfix"><strong>'.$ms->name.'</strong> ('.$ms->username.') <strong class="pull-right"> '.		$diff.'</strong></li>';
	}}
	
	$access_log='';
		$results =DB::table('admin_login_log') ->  where('lv_act','>=',$this->user_lv)->          orderby('created_at','desc')->take(10)->get(); 
	if (count($results )>0){
		foreach ($results as $ms) {
 
 
		//$diff=1;
	//	$tval=	( $ms->last_action ==time() )?'Now':myfunc::dateDiff( $ms->last_action ,time());	
	$ak=($ms->login_type=='failed')?'text-red':'text-success';
	$access_log.='  <li class="list-group-item clearfix">
	<div class="col-sm-6 col-lg-2"><span class="'.$ak.' text-uppercase">'.$ms->login_type.'</span> </div>
	<div class="col-sm-6 col-lg-3 text-right "><strong>'.$ms->username.'</strong> </div>
	<div class="col-sm-6 col-lg-3">'.$ms->ip.' </div>
	<div class="col-sm-6 col-lg-4 text-right">'.date('Y-m-d H:i:s',strtotime($ms->created_at)).'</div>
	
	</li>';
	}}
	 
	 
	
	
	
	$str='
	<div class="row">


	
	
	
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	
<div  class="panel panel-primary">
<div class="panel-heading clearfix">
<strong class="pull-left">Access Log</strong>
<div class="pull-right"><a class="label label-info fs14">More</a></div >
</div>
<div class="panel-body m0 p0">
<ul class="list-group m0 p0">
'.	$access_log.'

</ul>
</div>
</div>

	</div>
	
	
	
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	
<div  class="panel panel-primary">
<div class="panel-heading">
<strong>Online User</strong>
</div>
<div class="panel-body m0 p0">
<ul class="list-group m0 p0">
'.	$online_user.'

</ul>
</div>
</div>

	</div> 
	

	
	
	
	</div>
	';		
	
	
	/*
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	
<div  class="panel panel-primary">
<div class="panel-heading clearfix">
<strong class="pull-left">Operation Log</strong>
<div class="pull-right"><a class="label label-info fs14">More</a></div >
</div>
<div class="panel-body m0 p0">
<ul class="list-group m0 p0">
	<li class="list-group-item ">--------</li>
	<li class="list-group-item ">--------</li>
	<li class="list-group-item ">--------</li>
	<li class="list-group-item ">--------</li>
	<li class="list-group-item ">--------</li>
	<li class="list-group-item ">--------</li>
</ul>
</div>
</div>

	</div>
	*/
			
	 $this->page_mainContent=$str;;
	}
	public function doLogout()
	{
		Auth::user()->logout(); // log the user out of our application
		
 		Session::forget('ckFinder_Authentication');
 		Session::forget('ckFinder_path');
		return Redirect::to(ADMIN_PATH); // redirect the user to the login screen
	}

	
    public function showAdmin()
    {	
		$data = Input::all();
        $this->layout->admin_title =$this->admin_title;
        $this->layout->topbar =$this->page_top_bar();
        $this->layout->sidemenu =
		'<div class="navbar-default sidebar" role="navigation" style="display:none;">
		<div id="side-mask"></div>
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">'.
		 $this->show_menu($data).'
                    </ul>
                </div>
         </div>';
		 if(isset($data['q'])){
		$this->show_page_content($data );
		}else{ 
		$this->adminHome();
		}
        $this->layout->content = $this->page_mainContent;
        $this->layout->plus_css_js=$this->pageJsAndCss;
    }


	public function showLogin()
	{
		// show the form
        $this->layout->admin_title =$this->admin_title;
     	   $this->layout->topbar ='';
        $this->layout->sidemenu = '';
		 $this->layout->content = View::make('admin.admin_login');
        $this->layout->plus_css_js='
		<script>var this_root="'.ROOT_PATH.'";</script>
		<script src="'.ROOT_PATH.'static/admin/js/md5.js"></script><script src="'.ROOT_PATH.'static/admin/js/js.admin_lg.js"></script>';
	}

	public function doLogin()
	{
	
	$res =  new stdClass(); 
	$res->success=0;

		// validate the info, create rules for the inputs
		$rules = array(
			'log_username'    => 'required|min:4', // make sure the email is an actual email
			'log_pwd' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
	$messages = array(
    'min'    => 'The :attribute required at least :min characters ',
    'required'    => 'The :attribute is required.',
    //'same'    => 'The :attribute and :other must match.',
    //'size'    => 'The :attribute must be exactly :size.',
    //'between' => 'The :attribute must be between :min - :max.',
  //  'in'      => 'The :attribute must be one of the following types: :values',
);

		$validator = Validator::make(Input::all(), $rules,	$messages );


		// if the validator fails, redirect back to the form
		if ($validator->fails()) {/*
			return Redirect::to('admin')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
*/
						$res->msg='Invalid Format';
					 return json_encode($res);
		 

		} else {
			
	
			$this->ip= myfunc::getIp_user();
			$checkuIp_res=	$this->checkip();
 			 if($checkuIp_res==1) {
					// return Redirect::to('admin')->with('result', 'Access denied for '.$this->TIME_PERIOD.' minutes');
				 
						$res->msg='You have enter incorrect Username or Password '.$this->ATTEMPTS_NUMBER.' times, please try again after '.$this->TIME_PERIOD.' mins.';
					 return json_encode($res);
				 }
			  

			// create our user data for the authentication
			$userdata = array(
				'username' 	=> Input::get('log_username'),
				'password' 	=> Input::get('log_pwd'),
				'status' 	=> 1,
			);

			// attempt to do the login
			if (Auth::user()->attempt($userdata)) {

				// validation successful!
				// redirect them to the secure section or whatever
				// return Redirect::to('secure');
				// for now we'll just echo success (even though echoing in a controller is bad)
				//echo 'SUCCESS!';
				
				if(	(Auth::user()->get()->roles_id)<= Config::get('gbkey.ADMIN_PM_ID')	 	){
					//	$this->user 
					
					Session::put('ckFinder_Authentication',true);
					Session::put('ckFinder_path',			Config::get('gbkey.ck_upload_folder'));
		

						$this->log_loginLog(array(
							'login_type'=>1,
							'username'=>Auth::user()->get()->username.' | '.Auth::user()->get()->id,
							'ip'=>myfunc::getRealIpAddr(),
							'lv'=>Auth::user()->get()->roles_id
						));
						$this->log_lastaction();
						$this->clearLoginAttempts();
 

					//return Redirect::to('admin'); // redirect the user to the login screen
					 // redirect the user to the login screen
				
					$res->success='1';
					$res->msg='Welcome';
					 return json_encode($res);
				}else{

						$this->log_loginLog(array(
							'login_type'=>0,
							'username'=>Input::get('log_username'),
							'ip'=>myfunc::getRealIpAddr(),
							'lv'=>999
						));

					// return Redirect::to('admin')->with('result', 'failed');
					 
					$res->msg='Username or Password is ncorrect';
					 return json_encode($res);
				}

			} else {	 	

						$this->log_loginLog(array(
							'login_type'=>0,
							'username'=>Input::get('log_username'),
							'ip'=>myfunc::getRealIpAddr(),
							'lv'=>999
						));

					$this->add_checkip();
				// validation not successful, send back to form	
				// return Redirect::to('admin')->with('result', 'failed');
				 
					$res->msg='Username or Password is ncorrect';
					 return json_encode($res);

			}

		}
		
		
		
	}
	 
	 
	 	
/*----------------------------------------*/	
function checkip() {	
	$tsip=substr($this->ip,0,20);
$results = DB::select( "SELECT attempts, (CASE when lastlogin is not NULL and DATE_ADD(LastLogin, INTERVAL ".$this->TIME_PERIOD." MINUTE)>NOW() then 1 else 0 end) as Denied ".
   " FROM ".DB_START."admin_login_attempts WHERE ip = '".$tsip."'");


		if (count($results )>0){
			foreach ($results as $ms) {
					   if ($ms->attempts== $this->ATTEMPTS_NUMBER)
					   {
						  if($ms->Denied == 1){
							 return 1;
						  }else{
							$this->clearLoginAttempts();
							return 0;
						 }
					   }
			}
		}else{
		$this->clearLoginAttempts();
		return 0;
		
		}
   return 0;  
  }
function clearLoginAttempts() {
	$tsip=substr($this->ip,0,20);
			$isok=	DB::table('admin_login_attempts') ->where('ip', $tsip)->update(
				array('attempts'=>0)		);
}
function add_checkip(){
		$tsip=substr($this->ip,0,20);
		$results = DB::table('admin_login_attempts'	)  ->where('ip',$tsip) ->get();	
		if (count($results )>0){
			foreach ($results as $ms) {
				$attempts = ceil($ms->attempts)+1;
				if($attempts== $this->ATTEMPTS_NUMBER) {
							
					$isok=	DB::table('admin_login_attempts') ->where('ip', $tsip)->update(
						array('attempts'=>	$attempts ,'lastlogin'=>date("Y-m-d H:i:s"))		);
				}else{
					$isok=	DB::table('admin_login_attempts') ->where('ip', $tsip)->update(
						array('attempts'=>	$attempts)		);
					
				}
			}
		
		}else{
					$isok=	DB::table('admin_login_attempts') ->where('ip', $tsip)->insert(
						array(
						'attempts'=>	1,
						'ip'=>	$tsip,
						'lastlogin'=>	date("Y-m-d H:i:s")
						
						)		);
		
		}
				
	 
}
/*----------------------------------------*/	


		public function mytxt($name,$key=''){
		$vt1=Lang::get('txt.'.$name);
			if($key!=''){
				$vt1=(isset($vt1[$key]))?$vt1[$key]:false;
			}
		return $vt1;
	}
	
	function this_fititer($selval=''){
		$nockech=false;
 			$ret=array();
      	  $where = "";
      	  $sm = "";

            $filters = json_decode(stripslashes($this->filters_val),true);
 
			if(is_array( $filters)){
					$where = " and ";
					$whereArray = array();
					$whereArray2 = array();
					$rules = $filters['rules'];
 				
					foreach($rules as $rule) {
						if( $rule['field']=='image_id'){
							if(ceil($rule['data'])==0){
								  $whereArray[] = " t2.item_id is null   ";
							}else{
								  $whereArray[] = " t2.item_id is not null  ";
							}
							
						  
						}else{
							
							
						 $thisfd=$rule['field'];
						 switch( $thisfd){
							 case 'roles_id':
								 $whereArray[] = sprintf(' '.$selval.$thisfd." = %s	",$rule['data']);	 
							 break;
							 case 'node_id':
							 $thisCatTb=(isset($this->tbName_cat))?$this->tbName_cat:$this->tbName.'_cat';
								 $parentSql=' || '.$selval.'node_id in (select id from '.DB_START. $thisCatTb.' where  parent_id='.$rule['data'].' )';
							 
								 $whereArray[] = '( '.sprintf(' '.$selval.$thisfd." = %s	",$rule['data']).$parentSql.' ) ';	
								  
							 break;
							 case 'spcat':
								 $whereArray[] = sprintf(' '.$selval.'pd_id in  (select id from '.DB_START.'product   where node_id=%s ) ',ceil($rule['data']));	 
							 break;
							 
							 case 'status':
								 $whereArray[] = sprintf(' '.$selval.$thisfd." = %s	",$rule['data']);	 
							 break;
						default:	
						  $whereArray[] = ' '.$selval.$thisfd." like '%".$rule['data']."%'";
						}
						 // $whereArray[] = $thisfd." like '%". $this->checkItem_sp($rule['data'])."%'";
						//  print_r($whereArray);
						  
						}
					}
						
							if (count($whereArray)>0) {
								$groupOp=$filters['groupOp'];
								$groupOp=($groupOp!='')?$groupOp:' and ';
								$where .= join(" ".$groupOp." ", $whereArray);
							} else {
								$where = "";
							}
							
							if (count($whereArray2)>0) {
								$groupOp2=$filters['groupOp'];
								$groupOp2=($groupOp2!='')?$groupOp2:' and ';
								$sm .= join(" ".$groupOp2." ", $whereArray2);
							} else {
								$sm = "";
							}
							
				
							
			}

		$ret['where']=$where;
			 $ret['sum']=$sm;
		return    $ret;
		}
}