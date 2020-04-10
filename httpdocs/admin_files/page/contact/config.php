<?php

 


$fixedField = array (
	
	array( "ID", "id", 
			array("ID"), 
			array("SHOW", "50", true, false), 			//list		display  ---	search 	===
			array("SHOW", true, false, array()) ,array('list-hidden'=>true)		//edit		insert 	updated	---
	),
	
	
	


array(  'Name ',"name", 
													array("FIX",""), 
													array("SHOW", "90", false, false), 
													array("SHOW", true, true,	array())
											 ),
 
array(  'Email ',"email", 
													array("FIX",""), 
													array("SHOW", "90", false, false), 
													array("SHOW", true, true,	array())
											 ),
array(  'IP ',"ip", 
													array("FIX",""), 
													array("SHOW", "90", false, false), 
													array("SHOW", true, true,	array())
											 ),
	array(  'Total Sent ',"total_val", 
													array("FIX",""), 
													array("SHOW", "90", false, false), 
													array("SHOW", true, true,	array())
											 ),
											 										 
											 
array(  'Date ',"created_at", 
													array("FIX",""), 
													array("SHOW", "90", false, false), 
													array("SHOW", true, true,	array())
											 ),
											 
											 
											 
											 
);

 
	
$mycofig=array(

		'userright'=>array(
			'save'=>array(
				'lv'=>-1
			),
			'delete'=>array(
				'lv'=>-1
			)
		),
		
		
	'lv'=>1,
	'tag'=>'contact',
	'keyfield'=>'id',
	'pageName'=>'Contact Us - Email List',
	'tableName'=>'contact', 
	
	'io_no_import'=>1,
	'io_no_del'=>1,
	
	'menuList'=>array( 
		//	'create'=>array('lv'=>1, 		'type'=>'',	'tag'=>'contact&action=create', 'title'=>'Create'	,'core'=>'./core/create.php'),
			'edit'=>array('lv'=>1, 		'type'=>'',	'tag'=>'contact&action=edit', 'title'=>'Contact Us - Email List '	,'core'=>'./core/edit.php'),
		 								
			'io'=>array('lv'=>1, 		
			'type'=>'',	'tag'=>'contact&action=io', 'title'=>'Export'	,'core'=>'./core/inout.php',
					),	
					
					
			'list'=>array('lv'=>1, 		
			'type'=>'link',	'tag'=>'contact&action=list', 'title'=>'Contact Us - Email List'	,'core'=>'./core/list.php',
			'width'=>'79%'
			,'sublink'=> array(
				 array('lv'=>2,'href'=>'contact&action=io', 'title'=>'Export'	,'width'=>'17%'	, 'icon'=>'fa-exchange' ),
					//  array('lv'=>1,'href'=>'contact&action=sort', 'title'=>'Sort'	,'width'=>'17%'),
				//	array('lv'=>1,'href'=>'contact&action=create', 'title'=>'Create'	,'width'=>'17%'),
				)
			
			),
 
 
			 
	 
			
			
	),
 
	'allValue'=>$fixedField,

 'firstWidth'=>'40', 
	'logfield'=>'id',
	
	
	'orderby'=>'  id ',
	'orderby_dir'=>' desc  ', 
	
'other_function'=>array( 
)
	
	
	 
 
 /*
	'sqlplus_selectadd'=>'	t1.	',
	'sqlplus_select'=>' ',
	'sqlplus_table'=>'	as t1 left join '.DB_START.'contact_cat as t2 on( t1.node_id=t2.id) ',
	'sqlplus_where'=>'	',
	 
	*/
	
	
	
);
?>