<?php

				
	 
	  $this->isajax=true;
	
		$config='page/'.$keyName.'/config.php';
		if(file_exists(	 base_path().$this->admin_path.	$config)){
		$thisConfig=$this->Get_Config(		$config);
		}else{
		exit;
		}

 
			$tableName=$thisConfig['tableName'];
			
			$this->keyName=$thisConfig['tag'];
			$pageUrl=$thisConfig['tag'];
			$sqlplus_selectadd= ( isset($thisConfig['sqlplus_selectadd']))?$thisConfig['sqlplus_selectadd']:'';
			$this->tbName=$tableName; 
			$this->tbName_cat=(isset($thisConfig['tableName_cat']))?$thisConfig['tableName_cat']:$tableName.'_cat';
			$search_sq= $this->this_fititer(	$sqlplus_selectadd);
			 
		
			$sqlval=array();
			$sqlval_type=array();
			$sqlval_name=array();
			 foreach($thisConfig['allValue'] as $cll){
					$cll[5]['list-order']=(isset($cll[5]['list-order'])		&& 	$thisConfig['list-order']==true	)?$cll[5]['list-order']:'';
			
	$ch_nosql=(isset($cll[5]['nosql']))?$cll[5]['nosql']:'';		
 
					 
	if($ch_nosql==''){
				 
				if($cll[3][0]=='SHOW'){
					if($cll[5]['list-order']!=''	&&   $thisConfig['list-order']==true ){
						
						
						$cll[5]['listsql']=(isset($cll[5]['listsql']))?$cll[5]['listsql']:'';
						$thisConfig['sqlplus_selectadd']=(isset($thisConfig['sqlplus_selectadd']))?$thisConfig['sqlplus_selectadd']:'';
							
							
						$sqlval[$cll[5]['list-order']]=($cll[5]['listsql'])?$cll[5]['listsql']:$thisConfig['sqlplus_selectadd'].$cll[1];
						$sqlval_type[$cll[5]['list-order']]=$cll[2][0];
						$sqlval_name[$cll[5]['list-order']]=$cll[1];
						$sqlval_all_type[]=$cll;
					}else{
						$cll[5]['listsql']=(isset($cll[5]['listsql']))?$cll[5]['listsql']:'';
						$thisConfig['sqlplus_selectadd']=(isset($thisConfig['sqlplus_selectadd']))?$thisConfig['sqlplus_selectadd']:'';
						$sqlval[]=($cll[5]['listsql'])?$cll[5]['listsql']:$thisConfig['sqlplus_selectadd'].$cll[1];
					//	echo 	$cll[2][0].'<br/>';
						$sqlval_type[]=$cll[2][0];
						$sqlval_name[]=$cll[1];
						$sqlval_all_type[]=$cll;
					}
				}
	}else{
					//$sqlval[]='';
				//	$sqlval_type[]=$cll[2][0];
					$sqlval_type[]=$cll[2][0];
					$sqlval_all_type[]=$cll;
				
	}
		
	
				
			}
			ksort($sqlval);
			ksort($sqlval_type);
			ksort($sqlval_name);
		 //	print_r($sqlval_name);
		//	print_r($sqlval_type);
			//	print_r( $sqlval);
			$sqlStr=implode(',',$sqlval);
			
			
						
					switch($tableName){
						
					case $this->admin_acc_db:
						 
					$extb_plus_sql=sprintf(" and roles_id>=%d",($this->user_lv+1));
					if($this->user_lv==2){
					
					
					$extb_plus_sql=sprintf(" and id=%d",$this->user_id);
					
					}

					
					break;
					}
			
	
	
	
	
	
	
			$thisConfig['sqlplus_select']=(isset($thisConfig['sqlplus_select']))?$thisConfig['sqlplus_select']:'';
			$thisConfig['sqlplus_table']=(isset($thisConfig['sqlplus_table']))?$thisConfig['sqlplus_table']:'';
			$thisConfig['where']=(isset($thisConfig['where']))?$thisConfig['where']:'';
			$thisConfig['sqlplus_where']=(isset($thisConfig['sqlplus_where']))?$thisConfig['sqlplus_where']:'';
			
			$extb_plus_sql=(isset($extb_plus_sql))?$extb_plus_sql:'';
			$admin_vl_sql=(isset($admin_vl_sql))?$admin_vl_sql:'';
			$thisConfig['orderby']=(isset($thisConfig['orderby']))?$thisConfig['orderby']:'';
			$thisConfig['orderby_dir']=(isset($thisConfig['orderby_dir']))?$thisConfig['orderby_dir']:'';
			$thisConfig['sql_plus']=(isset($thisConfig['sql_plus']))?$thisConfig['sql_plus']:'';
			
			
			$orderPlus=$thisConfig['sqlplus_selectadd'];
	
				$orderby=''; 
				$sidx=$ck_val['sidx'];
				$sord=$ck_val['sord'];
			
	if(	$tableName=='model')	{	
			switch($sidx){
			case 'spcat':
			$sidx='pd_id';
			break;
		
			}
	}else 
	if(	$tableName=='product')	{	
		
		
			switch($sidx){
			case 'node_id':
				$orderPlus='';
			$sidx=' t2.rank '.$sord.' , t1.rank   ';
			break;
			case 'rank':
				$orderPlus='';
			$sidx=' t2.rank '.$sord.' , t1.rank   ';
			break;

	}
		}
		
		
				$searchField=$ck_val['searchField'];
				$searchString=$ck_val['searchString'];
			$default_orderby=($thisConfig['orderby']!='')?''.$thisConfig['orderby']:$thisConfig['sqlplus_selectadd'].' id ';	
			$default_orderby_dir=($thisConfig['orderby_dir']!='')?$thisConfig['orderby_dir']:'  desc';	
			$orderby=($sidx!='')?sprintf(" %s %s",	$orderPlus.$sidx,$sord):$default_orderby.$default_orderby_dir; 
			
			/*
			$thissql="
			select ".$sqlStr."	".$thisConfig['sqlplus_select']." 
			from ".$tableName." ".$thisConfig['sqlplus_table']."   where 1 ".$search_sq['where']."  ".$thisConfig['sqlplus_where']." ".$extb_plus_sql."	".$admin_vl_sql."
			".$thisConfig['sql_plus']."  order by ".$orderby;
			*/
 $strval='';			
$responce=new stdClass();
 
$perpage=$this->perpage;
$pageNo=$ck_val['page'];
$thisDB=Config::get('database.connections.mysql.prefix').$thisConfig['tableName'];
$c_pp=$perpage*($pageNo-1);


$results = DB::select('select '.$sqlStr.' '.$thisConfig['sqlplus_select'].' from '.$thisDB.'  '.$thisConfig['sqlplus_table'].'   
 where '.$thisConfig['sqlplus_selectadd'].'id >? '.$search_sq['where'].'  '.$thisConfig['sqlplus_where'].' '.$extb_plus_sql.'	'.$admin_vl_sql.'  	'.$thisConfig['sql_plus'].'  order by '.$orderby.'	 limit '.$c_pp.' , '.($c_pp+$perpage).'		', array(0));

//$results_records = count($results);
//$results_records = $results_records[0]->rc;

$totalss = DB::select('select count(*) as rc from '.$thisDB.'  '.$thisConfig['sqlplus_table'].'   
 where '.$thisConfig['sqlplus_selectadd'].'id >? '.$search_sq['where'].'  '.$thisConfig['sqlplus_where'].' '.$extb_plus_sql.'	'.$admin_vl_sql.'  '.$thisConfig['sql_plus'].'  order by '.$orderby.'			', array(0));
$totalss = $totalss[0]->rc;
 
 
//->skip(	($perpage*($pageNo-1))	)->take($perpage)->get();					
//$results= DB::table(	$thisConfig['tableName'])->skip(	($perpage*($pageNo-1))	)->take($perpage)->get();			
//$results_records= DB::table(	$thisConfig['tableName'])->skip(	($perpage*($pageNo-1))	)->take($perpage)->count();	
//$results_nn = DB::table(	$thisConfig['tableName'])->get();
//$totalss = DB::table(	$thisConfig['tableName'])->count();

// var_dump( DB::getQueryLog());

if (count($results )>0){
$i=0;
$responce->page = $pageNo;
$responce->total = ceil($totalss/$perpage);
$responce->records = $totalss;
foreach ($results as $mgg) {
					
			$responce->rows[$i]['id']=$i;  
// $strval.=$message->id;
			$get_del_right= (isset($thisConfig['userright']['delete']['lv']))?$thisConfig['userright']['delete']['lv']:1;
			
			$canDelete= ( 	$get_del_right>=$this->user_lv)?true:false  ;
			
 			$action_btn='<div class="btnCnt">';
			
			
			if (isset($thisConfig['clone']['onoff']) && $thisConfig['clone']['onoff']==true) {
				$action_btn.=($mgg->clone_by==0)?' <a class="btn btn-primary btn-purple CloneBtn " title="Clone" data-title="'.$mgg->$thisConfig['clone']['name_key'].'" style="color:#fff;" data-id="'.$mgg->id.'"><i class="fa fa-fw fa-files-o"></i></a> ':
				'<a class="btn btn-default  disable"><i class="fa fa-fw fa-files-o"></i></a>';
			}
		if( isset($thisConfig['menuList']['edit'])){	
			if( isset($thisConfig['menuList']['edit']['newpage']) && $thisConfig['menuList']['edit']['newpage']==true){
			$action_btn.=' <a title="Detail" class="btn btn-primary gray-lighter" target="_blank" style="color:#fff;" href="?q='.$pageUrl.'&action=edit&id='.$mgg->id.'"><i class="fa  fa-info-circle "></i></a> ';
			}else{
			$action_btn.=' <a title="Edit" class="btn btn-primary gray-lighter " style="color:#fff;" href="?q='.$pageUrl.'&action=edit&id='.$mgg->id.'"><i class="fa fa-fw fa-wrench"></i></a> ';
			}
		}
			$action_btn.=($canDelete)?' <a title="Delete" class="btn btn-danger ListDelBtn" style="color:#fff;" data-option=\'{"id":"'.$mgg->id.'","key":"'.$this->keyName.'"}\'><i class="fa fa-times fa-fw"></i></a>':'';
			$action_btn.='</div>';
			
					$cr=0;
					$tg=(isset($thisConfig['list-order'])	&&   $thisConfig['list-order']==true )?2:1;
					$tc=2;
					$responce->rows[$i]['cell'][0]=$action_btn;
					$responce->rows[$i]['cell'][1]=$mgg->id;
					
						foreach($sqlval_type as $st){
						  if(isset( $sqlval_name[$tg])	&&	$st!="ID"){
							  
										$vghc=( property_exists($mgg, $sqlval_name[$tg]	)  )?$mgg->$sqlval_name[$tg]:'';
										$vg_all_type=( isset($sqlval_all_type[$tg])  )?$sqlval_all_type[$tg]:'';
										
										
										$responce->rows[$i]['cell'][$tc]=	$this->Layout_listval_grid(trim($vghc),$st,		$vg_all_type,$mgg->id,$mgg);
										
										/*
										$vghc=( property_exists($mgg, $sqlval_name[$tg]	)  )?$mgg->$sqlval_name[$tg]:'';
										$responce->rows[$i]['cell'][$tc]=	$this->Layout_listval_grid(trim($vghc),$st,$sqlval_all_type[$tg],$mgg->id,$mgg);
   */
									$tg++;	
									$tc++;	
							
						  }
						  
						}
 
					
	$i++; 
}

}else{


					$responce->page = 1;
					$responce->total = 0;
					$responce->records =0;
					$responce->rows[0]['id']=0; 		$responce->rows[0]['cell']=array(		'No record',		'0',		'---',		'---',		'---',    		'---',		);
}
 
  

		 
				
?>