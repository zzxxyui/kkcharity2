<?php


$fixedField = array (
	
	array( "ID", "id", 
			array("ID"), 
			array("SHOW", "50", true, false), 			//list		display  ---	search 	===
			array("SHOW", true, false, array()) ,array('list-hidden'=>true,/* 'list-order'=>1*/)		//edit		insert 	updated	---
	),


	array( $this->txt['create_date'] , "created_at", 
			array("FIX",""), 
			array("SHOW", "90", true, false), 
			array("SHOW", true, false, array())
	),
  
 
 
			array('IP',"ip", 
													array("FIX","required"), 
													array("SHOW", "90", true, false), 
													array("SHOW", true, true,	array()) 
											 ),	
 
 
			array( 'Original File Name',"old_file_name", 
													array("FIX",""), 
													array("SHOW", "90", true, false), 
													array("SHOW", true, true,	array()) 
											 ),	
 
			array( 'File Path',"ff_file", 
													array("KCP_FILE_PATH",""), 
													array("SHOW", "70", true, false), 
													array("SHOW", true, true,	array()) 
											 ),	
			array( 'Remark',"remark", 
													array("TEXT",""), 
													array("SHOW", "140", true, false), 
													array("SHOW", true, true,	array()) 
											 ),	
 
 
 


	
		 
												
//	array( "Invoice ID", "status", array("ORDER-ID","required"), array("SHOW", "0", true, false), array("SHOW", false, false, array()) ),

);

 

$mycofig=array(

	'list-order'=>false,
	'lv'=>1,
	'tag'=>'submit_file',
	'keyfield'=>'id',
	'pageName'=>'Proposal (Uploaded)',
	'tableName'=>"submit_file",
	'menuList'=>array(
		//	'create'=>array('lv'=>1, 		'type'=>'',	'tag'=>'submit_file&action=create', 'title'=>'Create','core'=>'./core/create.php'),
			//'list'=>array('lv'=>1, 			'type'=>'link',	'tag'=>'submit_file&action=list', 'title'=>'Modify submit_file'	,'core'=>'./core/list.php'),
			'edit'=>array('lv'=>1, 		'type'=>'',	'tag'=>'submit_file&action=list', 'title'=>'Edit'	,'core'=>'./core/edit.php'),
			
 
			'list'=>array('lv'=>1, 		'type'=>'link',	'tag'=>'submit_file&action=list', 'title'=>'Proposal (Uploaded)','core'=>'./core/list.php',
			'width'=>'100%',
			'sublink'=> array( 
				)
			),
			
			
			
	),
  
	'sqlplus_selectadd'=>'	 	',
	'sqlplus_select'=>' ',
	'sqlplus_table'=>'	  ',
	'sqlplus_where'=>'	',
 
	'allValue'=>$fixedField,
	'firstWidth'=>'70',
	'logfield'=>'ip',
	
	
	'orderby'=>'  created_at ',
	'orderby_dir'=>' desc  ', 
	 
	'other_function'=>array( 
  
 
	
	)
	
	
	 
		
		
 /*
		'seo_val'=>array(
		'seo'=>true,
		'title'=>'Seo submit_file',
		'master_val'=>true,
		'table'=>DB_START."submit_file",
		'seo_array'=>$this->seo_array,
		),
 */
);
?>