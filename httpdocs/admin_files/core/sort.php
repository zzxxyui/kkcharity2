<?php

function Str2CateArray($strArray,$crid,$tt){
$strArray=explode(';',$strArray);
$reeStr='

<div class="well well-sm" style="width:700px">
	
	<div class="row mp p0" >
	<div class="col-xs-2"><p class="m0  mt5">'.$tt['category'].'</p></div>
	<div class="col-xs-10">
	<select id="selectCatVal" class="form-control">';
	$i=0;
	foreach((array)$strArray as $value){
			$value_arr=explode(':',$value);
			$isSelected=($crid ==$value_arr[0] ) ?' selected="selected" ':'';
			$reeStr.=($i==0)?'<option value="">'.$tt['sort_msg'].'</option>':'<option '.$isSelected.' value="'.$value_arr[0].'">'.$value_arr[1].'</option>';
	$i++;		
	}
$reeStr.='
</select>
</div>
	</div>
</div>
';
return $reeStr;
}
if($this->user_lv>$this->MyConfig['menuList']['sort']['lv']){
exit;
};
	
$data = Input::all();
$this->itemid=(isset( $data['id']))?ceil( $data['id']):0;
 
	
$catJs='';
$sortDiv='';
$show_result=false;
$catDiv='';
  
if($this->MyConfig['menuList']['sort']['sort_setting']['cat']==true){
	$this->HaveCate=true;
 
	$plus_action='?q='.$this->MyConfig['tag'].'&action=sort&id='.$this->itemid;
	
 	 $carSelect= $this->Config_db_cate_level(DB_START.$this->MyConfig['tableName_cat']);
	 $carSelect=substr($carSelect,0,(strlen($carSelect)-1));
	 
	$this->sortVal['cat_array']	= $carSelect;
	$catDiv=Str2CateArray($this->sortVal['cat_array'],$this->itemid,$this->txt);
	$show_result=false;	 
	
	$catJs="
	$('#selectCatVal').change(function(){
		//alert(' ./?q=".$this->MyConfig['tag']."&action=sort&id='+$(this).val() );
	 	window.location.href='?q=".$this->MyConfig['tag']."&action=sort&id='+$(this).val();
	})
	";

}else{
	$this->HaveCate=false;
	$show_result=true;	
	$plus_action='?q='.$this->MyConfig['tag'].'&action=sort';
}

$this->sortVal['col_val']=$this->MyConfig['menuList']['sort']['sort_setting']['col_val']; 
$this->sortVal['main_field']=$this->MyConfig['menuList']['sort']['sort_setting']['main_field'];
$stype=$this->MyConfig['menuList']['sort']['sort_setting']['sort_type'];
$this->sortVal['sort_type']=($stype!='')?$stype:'asc';		

$varCount=count($_POST);
		if(ceil($varCount)>0){
			//	$this->conn->debug=1;
				$sort_str=$this->checkItem_sp( $_POST['sorting']);
				
				if($sort_str!=''){
				$sort_Array=explode(',',$sort_str); 
				if(count($sort_Array)>0){
					if($this->sortVal['sort_type']=='asc'){
						if($this->HaveCate){
						
								$i=0;
								foreach( $sort_Array as $Sid){
			
				 $geUpp=	DB::table($this->MyConfig['tableName']) ->where('node_id',$this->itemid)->where($this->sortVal['main_field'], $Sid)->update(
				array('rank'=>$i));
								
								$i++;	
								}
						
						}else{
								$i=0;
								foreach( $sort_Array as $Sid){
									
				 $geUpp=	DB::table($this->MyConfig['tableName']) ->where($this->sortVal['main_field'], $Sid)->update(
				array('rank'=>$i));
				
				
								$i++;	
								}
							
						}
					}else{
						if($this->HaveCate){
						
								$i=count( $sort_Array);
								foreach( $sort_Array as $Sid){

				 $geUpp=	DB::table($this->MyConfig['tableName']) ->where('node_id',$this->itemid)->where($this->sortVal['main_field'], $Sid)->update(
				array('rank'=>$i));
				
								$i=$i-1;	
								}
						
						}else{
								$i=count( $sort_Array);
								foreach( $sort_Array as $Sid){
									
				 $geUpp=	DB::table($this->MyConfig['tableName']) ->where($this->sortVal['main_field'], $Sid)->update(
				array('rank'=>$i));
								$i=$i-1;	
								}
							
						}
					
					
					}
				}
				}
				
				//header('location:'.$plus_action);
				//exit;
		}

if($this->HaveCate){
	if($this->itemid>0){
		
		 
	$show_result=true;
	}else{ 
	$sortDiv.='';
	}
}
 

if($show_result){
 
$sortDiv='';

$stype=$this->MyConfig['menuList']['sort']['sort_setting']['sort_type'];
$this->sortVal['sort_type']=($stype!='')?$stype:'asc';		

if($this->HaveCate){
	$results = DB::table($this->MyConfig['tableName'] 	)->where('node_id', $this->itemid)->	orderBy('rank', $this->sortVal['sort_type'])->get();	
}else{
	$results = DB::table($this->MyConfig['tableName'] 	)->	orderBy('rank', $this->sortVal['sort_type'])->get();	 
}

	$totalRecord=count($results );											
	if ($totalRecord >0){
		$i=0;
			$sortDiv.='
			<form method="post" onsubmit="return false" id="vforms">
			<input name="sorting" id="sorting" value="" type="hidden" />
			<input  id="sort_node_id" value="'.$this->itemid.'" type="hidden" /> 
			<div class="well well-sm sortUU_header row m0 mb5" >';
			$sortDiv.='<div class="col-xs-2" style="width:2%">&nbsp;	</div>';
			foreach((array) $this->sortVal['col_val'] as $solas){
				$sortDiv.='<div class="col-xs-2" style="width:'.$solas['width'].'">'.$solas['tt'].'	</div>';
			}
			$sortDiv.='<div class="col-xs-2 pull-right" style="width:2%">&nbsp;	</div>';
			$sortDiv.='</div>';
			$sortDiv.='<ul id="sortable" class="nav sortUU m0 p0">';
		foreach ($results as $ms) {
			
			$mf_key=$this->sortVal['main_field'];
			$main_field=( 	property_exists($ms, $mf_key) 	)?$ms->$mf_key:'';
			
			
			
				$sortDiv.='<li id="'.	$main_field.'"><div class="row well well-sm m0 mb5">';
				
				$sortDiv.='<div class="col-xs-2" style="width:2%"><i class="fa fa-arrows-v fa-lg"></i></div>';
				
				foreach((array) $this->sortVal['col_val'] as $solas){
				
					$sName='';
switch($solas['name']){

case 'project_type':
$sName=(  ceil($ms->$solas['name'])==2	)?'Project Highlight':'Ongoing Project';
												
break;
default:	
$sName=( 	property_exists($ms, $solas['name']) 	)?$ms->$solas['name']:'';
}
					
					
				$sortDiv.='<div class="col-xs-2"  style="width:'.$solas['width'].'">'.str_limit($sName,80,'...').'&nbsp;</div>';
				}
				$sortDiv.='<div class="col-xs-2"  style="width:2%">'.(($ms->status==1)?'<i class="fa  fa-check fa-lg"></i>':'<i class="fa fa-times fa-lg"></i>').'	</div>';
				$sortDiv.='</div></li>';
			
				}
			$sortDiv.='</ul><p class="text-center mt10">
			<a id="upcateSort" class="btn btn-primary"  >'.$this->txt['update'].'</a> </p>
			</form>
			';
	}else{
			$sortDiv.='
					<h3 class="p_center">'.$this->txt['no_record'].'</h3>';
	}
	/*
		$rs = $this->conn->Execute($sql);
		$totalRecord = $rs->RecordCount();
		if($totalRecord > 0) {
			
			
			$sortDiv.='
			<form method="post" action="'.$plus_action.'">
			<input name="sorting" id="sorting" value="" type="hidden" /><div class="sortUU_header">';
			foreach((array) $this->sortVal['col_val'] as $solas){
				$sortDiv.='<span class="col" style="width:'.$solas['width'].'">'.$solas['tt'].'	</span>';
			}
			$sortDiv.='</div>';
			
			$sortDiv.='<ul id="sortable" class="sortUU">';
			while (!$rs->EOF) {
				
				$sortDiv.='<li id="'.$rs->fields[$this->sortVal['main_field']].'">';
				foreach((array) $this->sortVal['col_val'] as $solas){
				$sortDiv.='<span class="col"  style="width:'.$solas['width'].'">'.DraftText(80,$rs->fields[$solas['name']],'').'&nbsp;</span>';
				}
				$sortDiv.='<span class="col"  style="width:2%">'.(($rs->fields['status']==1)?'<img src="./img/ico_on.png" alt=""/>':'<img src="./img/ico_off.png" alt=""/>').'	</span>';
				$sortDiv.='</li>';
		  
			$rs->MoveNext();
			} 
			$sortDiv.='</ul><p>
			<input id="upcateSort" class="minbutton mid" value="'.$this->txt['update'].'" type="submit"> </p>
			</form>
			';
		}else{
			$sortDiv.='
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<h3 class="p_center">'.$this->txt['no_record'].'</h3>
					<p>&nbsp;</p>
					<p>&nbsp;</p>';
		} 
		*/
}
		

/*
	 
		$sql = sprintf("SELECT * FROM  %s where parent_id=%d order by cast(rank as unsigned) asc",$tbname,$this->parent_id); 
		$rs = $this->conn->Execute($sql);
		$totalRecord = $rs->RecordCount();
		if($totalRecord > 0) {
			$str='
			<input id="sorting" value="" type="hidden" />
			<ul id="sortable" class="sortUU">';
			while (!$rs->EOF) {
				$str.='<li id="'.$rs->fields["id"].'">'.$rs->fields["title1"].'</li>';
			$rs->MoveNext();
			}
			$str.='</ul><p>
			<a id="upcateSort" class="minbutton mid">Update</a></p>
			';
		} 
		return $str;
		'.$sub_page_content.'
*/

$this_page_content='


<div class="box">
				  <div class="p1010em clearfix">
		<h2 class="m0 pull-left" >'.$this->MyConfig['pageName'].' <small>('.$this->title.')</small>'.'</h2>
	</div>
					<div class="block" id="forms">';
		
$this_page_content.=$catDiv;		
		
$this_page_content.=$sortDiv;		
$this_page_content.='</div></div>';	 
					
/*
					
								<div class="clear"></div>
								<div class="grid_6"><p class="p_left"><input type="button" value="&lsaquo;&lsaquo;Back" class="minbutton mid backbtn" /></p></div>
								<div class="grid_6"><p class="p_right"><input type="submit" value="'.$this->submitBtnName.'" class="register-button minbutton mid" /></p></div>
								
*/


//print_r($this->MyConfig['seo_val']['seo_array']);	
					
$sortJs="				
<script type=\"text/javascript\">
 

$(document).ready( function() {		
".$catJs."
					$('#sortable').sortable({
					create:function ()
					{
					serial = $('#sortable').sortable('toArray');
					$('#sorting').attr('value',serial);
					},
					update : function ()
					{
					serial = $('#sortable').sortable('toArray');
					$('#sorting').attr('value',serial);
					
					}
	});
 
 
 

									 
		
	})	
</script>
"; 
$this->pageJsAndCss.='<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/ui/jquery-ui-1.10.3.custom.min.js').'"></script>';

$this->pageJsAndCss.=$sortJs;
$this->pageJsAndCss.=$this->AJAX_valideform($this->MyConfig['tag']);
//$this->page_mainMenu= $this->Layout_SideMenu($this->inc_list);

$this->page_mainContent=$this_page_content;
/*
require_once('page/inc_baseFrame.php');
$this->this_page_body=$this_page_body;
require_once('page/inc_admin_home.php');
$this->pageJsAndCss.=$this->last_pageJsAndCss;
*/
?>
