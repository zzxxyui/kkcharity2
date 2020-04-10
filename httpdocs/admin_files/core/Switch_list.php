<?php

$this->MyConfig['firstWidth']=(isset($this->MyConfig['firstWidth']))?$this->MyConfig['firstWidth']:120;
 $js_model_val='';
 $js_title_val='';
$js_start='['; 
$js_end='';
$i=1;
$a_setting=(isset($this->MyConfig['action_setting']))?$this->MyConfig['action_setting']:'';
if( isset($this->MyConfig['list-order'])	&&	$this->MyConfig['list-order']==true 	){

	
$array_js_title_val[0]="'Action'";
$array_model_val[0]=" {firstsortorder:'', name: '' ,index:  '',  sortable: false ,width:".(($this->MyConfig['firstWidth']!=''?$this->MyConfig['firstWidth']:70))." ,search:false  ".$a_setting." }	";
	}else{

$array_js_title_val[0]="'Action'";
$array_model_val[0]=" {firstsortorder:'', name: '' ,index:  '',  sortable: false ,width:".(($this->MyConfig['firstWidth']!=''?$this->MyConfig['firstWidth']:70))." ,search:false  ".$a_setting." }	";
}
$count_tt_w=0;
foreach($this->MyConfig['allValue'] as $cll){
	if($cll[3][0]=='SHOW'){
		$count_tt_w=$count_tt_w+$cll[3][1];
 
	}
}
 	$plus_set='';
 	$plus_search='';
 	$plus_align='';
 	$plus_hidden='';
 	$plus_custom=''; 
 
foreach($this->MyConfig['allValue'] as $cll){
	if($cll[3][0]=='SHOW'){
		$thisval=$cll[0];
		$js_model_val.=',';
		
	$this_width=$cll[3][1];
 	//$this_width=" (def_page_width)*".($this_width/$count_tt_w)." "	;
 
	
	if(isset($cll[5]['search'])){
		if( isset($cll[5]['search_select_cat'])){
 
			 $carSelect= $this->Config_db_cate_level($cll[5]['search_select_cat']);
			 $carSelect=substr($carSelect,0,(strlen($carSelect)-1)); 
			
			$plus_search=" ,  sortable: false ,    stype: 'select', searchoptions:{ sopt:['eq'], value: '".	$carSelect	."' }";
			
			
			
			}else if( isset($cll[5]['search_select_custom_id'])){
		
		
					
						$cus_arr=$cll[5]['search_select_custom_id'];
						
						$cus_str=array();
						if( isset(  $cll[5]['search_raw'] )){
						$cus_results=	DB::select($cll[5]['search_raw'] );
						}else{
							if( isset(  $cll[5]['search_orderby'] )){
								$cus_results=	 DB::table( 	$cus_arr[0] )->where(	'status',1)->orderBy( $cll[5]['search_orderby'][0] , $cll[5]['search_orderby'][1] )->get();	
							}else{
								$cus_results=	 DB::table( 	$cus_arr[0] )->where(	'status',1)->get();		 
							}
						}
						$str_arr=array();
						$str_arr[0]=':ALL';
					if (count($cus_results )>0){
					 
						foreach ($cus_results as $ms) {
									if(is_array($cus_arr[2])){
										
										$gar=$cus_arr[2];
										$gar_nn=array();
										for($kl=0;$kl<count($cus_arr[2]); $kl++){
											
											$gar_nn=$ms->$cus_arr[2][$kl];
										}
									$str_arr[]=	$ms->$cus_arr[1].':'.implode(' ',$gar_nn);
										}else{
									$str_arr[]=	$ms->$cus_arr[1].':'.$ms->$cus_arr[2];
										
										}
						}
					}
					
					
					
						$plus_search=" ,   sortable: false ,   stype: 'select', searchoptions:{ sopt:['eq'], value: '".	implode(';',$str_arr)	."' }";
					
		
		
		
			}else if( isset($cll[5]['search_select_custom'])){
		
		
					
						$cus_arr=$cll[5]['search_select_custom'];
						
						$cus_str=array();
						$cus_results=	 DB::table( 	$cus_arr[0] )->where(	'status',1)->get();		 
					  
						$str_arr=array();
						$str_arr[0]=':ALL';
					if (count($cus_results )>0){
					 
						foreach ($cus_results as $ms) {
									$str_arr[]=	'['.$ms->$cus_arr[1].']:'.$ms->$cus_arr[2];
						}
					}
					
					
					
			$plus_search=" ,  sortable: false ,    stype: 'select', searchoptions:{ sopt:['eq'], value: '".	implode(';',$str_arr)	."' }";
		
			}else{
			$plus_search=' , '.$cll[5]['search'];
			}
			
			
		}else{
	$plus_search=" ,search:".(($cll[3][2])?'true':'false')." ";
	}
	
	if( isset($cll[5]['list-hidden'])	&&	$cll[5]['list-hidden']==true){
	$plus_hidden=' ,hidden:true ';
	}else{
	$plus_hidden=' ';
	
	}
	if(isset($cll[5]['custom'])){
	$plus_custom=' '.$cll[5]['custom'].' ';
		}else{
	$plus_custom="   ";
	}
		
	
	if(isset($cll[5]['list-align'])){
	$plus_align=' ,align:"'.$cll[5]['list-align'].'" ';
		}else{
	$plus_align=', align:"center" ';
	}	
			
		//$js_model[]=$cll[2];
	//$plus_set.=($clval['type'][0]!='')?' ,sorttype:"number" , formatter: "number", formatoptions:{decimalSeparator:".", thousandsSeparator: ",", decimalPlaces: '.$clval['type'][1].', defaultValue: "0"}, align:"right" ':'';
	
	if( isset($this->MyConfig['list-order'])  &&	$this->MyConfig['list-order']==true 	){
		
		$cll[5]['list-order'] =isset($cll[5]['list-order'])?$cll[5]['list-order']:'';
		
		$array_js_title_val[ceil($cll[5]['list-order'])]="'".$cll[0]."'";
		$array_model_val[ceil($cll[5]['list-order'])]=" {firstsortorder:'desc', name: '".$cll[1]."' ,index:  '".$cll[1]."', width:".$this_width." ".$plus_set." ".$plus_search." ".$plus_align."	".$plus_hidden."  ".	$plus_custom."}	";
	}else{ 
	  
		$array_js_title_val[$i]="'".$cll[0]."'";
	 
		$array_model_val[$i]=" {firstsortorder:'desc', name: '".$cll[1]."' , width:".$this_width." ".$plus_set." ".$plus_search." ".$plus_align."	".$plus_hidden."  ".	$plus_custom."}	"; 
	}
		
	$i++;
	}
}
$js_end.=']';

$js_title='';
$js_model='';
 
	if( isset($this->MyConfig['list-order'])){
	ksort($array_model_val);
	
	ksort($array_js_title_val);

//	print_r($array_model_val);
	
	//print_r($array_js_title_val);
$js_model=$js_start.implode(',',$array_model_val).$js_end;
$js_title=$js_start.implode(',',$array_js_title_val).$js_title_val.$js_end;

	}else{
$js_model=$js_start.implode(',',$array_model_val).$js_end;
$js_title=$js_start.implode(',',$array_js_title_val).$js_title_val.$js_end;
	}

$df_admin_path=ROOT_PATH.'static/admin/';
$my_js_file='';
$my_js_file.='<link rel="stylesheet" type="text/css" href="'.$df_admin_path.'js/ui/jquery-ui-1.10.3.custom.css" /> 
<link rel="stylesheet" type="text/css" media="screen" href="'.$df_admin_path.'js/jquery.jqGrid-4.4.0/src/css/ui.multiselect.css" />
<link rel="stylesheet" type="text/css" media="screen" href="'.$df_admin_path.'js/jquery.jqGrid-4.4.0/src/css/ui.jqgrid.css" />   
<link rel="stylesheet" type="text/css" media="screen" href="'.$df_admin_path.'css/css.override.css" />  ';

$my_js_file.='<script type="text/javascript" src="'.$df_admin_path.'js/ui/jquery-ui-1.10.3.custom.min.js"></script> 
<script src="'.$df_admin_path.'js/jquery.jqGrid-4.4.0/plugins/ui.multiselect.js" type="text/javascript"></script> 
<script type="text/javascript" src="'.$df_admin_path.'js/jquery.jqGrid-4.4.0/js/jquery.jqGrid.min.js"></script>  
<script src="'.$df_admin_path.'js/jquery.jqGrid-4.4.0/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script type="text/javascript">	$.jgrid.no_legacy_api = true;	$.jgrid.useJSON = true; 
var pagetype=""; 
var mysetup_ctitle='.$js_title.';
var mysetup_cmodel='.$js_model.'; 
var mysetup_sortname="";
var mysetup_sortorder="";
var mysetup_paging=true;
</script>
<script src="'.$df_admin_path.'js/jquery.jqGrid-4.4.0/plugins/jquery.tablednd.js" type="text/javascript"></script>
<script src="'.$df_admin_path.'js/jquery.jqGrid-4.4.0/plugins/jquery.contextmenu.js" type="text/javascript"></script>
<script  type="text/javascript">
var ajax_pageAction="load_list";
var ajax_pageKey="'.$this->MyConfig['tag'].'";
</script>
<script src="'.$df_admin_path.'js/js.list.js" type="text/javascript"></script>

';
$this->pageJsAndCss=$my_js_file;

 








?>