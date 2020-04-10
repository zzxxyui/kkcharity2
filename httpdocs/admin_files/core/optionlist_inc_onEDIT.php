<?php

$opl_page_content='';


if( isset($this->MyConfig['optionlist']) && $this->MyConfig['optionlist']['option']){
$opl_val=$this->MyConfig['optionlist'];
	if($this->itemid>0){ 
	
	 
	$optionlist_js='';	
	foreach( $opl_val['data'] as $op_key=>$op_opt){	
	
 
	$optionlist_js.='
	
	
	$("#optionlist_'.$op_opt['sp_field'].'").setOptionAjax('.$this->itemid.',"'.$this->MyConfig['tag'].'","'.$opl_val['tb_val'].'","'.$op_opt['sp_field'].'" );
	
		
	';
	


	$opl_page_content.='
	<div class="panel panel-primary" id="oplst_cnt" style="position:relative">
  <div class="panel-heading"><strong>'.$op_opt['title'].'</div>
  <div class="panel-body">
   
	

	<div class="optionlist_cnt clearfix mt10 mb10  " id="optionlist_'.$op_opt['sp_field'].'"><p>&nbsp;</p></div>
 
	<div class="opt_addbox">
			<a class="opl_addbtn btn btn-info" title="'.$op_opt['title'].'" data-thisid="0" data-pid="'.$this->itemid.'" data-tag="'.$this->MyConfig['tag'].'" data-tb_val="'.$opl_val['tb_val'].'" data-sp_field="'.$op_opt['sp_field'].'" >Add</a>
	</div>

	<p>&nbsp;</p>
</div>
</div>
	
	';
	
		}
		 $this->pageJsAndCss.='
 <script type="text/javascript" src="'.$this->myurl('static/admin/js/js.optionlist.js').'"></script> 
 <script  type="text/javascript" >
$(window).load(function(){	
'.$optionlist_js.'
})
</script>';


		
	}else{
			 
			foreach( $opl_val['data'] as $op_key=>$op_opt){	
			
	$opl_page_content.='
	<div class="panel panel-primary" id="oplst_cnt" style="position:relative">
  <div class="panel-heading"><strong>'.$op_opt['title'].'</div>
  <div class="panel-body">
    <div class="alert alert-warning">Please create an item first</div>
	 
</div>
</div>
	
';
			
			} 
	}

$sub_page_content.=	$opl_page_content;
}
?>