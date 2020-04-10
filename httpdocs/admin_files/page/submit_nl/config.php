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
	'tag'=>'submit_nl',
	'keyfield'=>'id',
	'pageName'=>'Subscriber ',
	'tableName'=>'submit_nl', 
	
	'io_no_import'=>1,
	'io_no_del'=>1,
	
	'menuList'=>array( 
		//	'create'=>array('lv'=>1, 		'type'=>'',	'tag'=>'submit_nl&action=create', 'title'=>'Create'	,'core'=>'./core/create.php'),
			'edit'=>array('lv'=>1, 		'type'=>'',	'tag'=>'submit_nl&action=edit', 'title'=>'Submit Out Newsletter '	,'core'=>'./core/edit.php'),
		 								
			'io'=>array('lv'=>1, 		
			'type'=>'',	'tag'=>'submit_nl&action=io', 'title'=>'Export'	,'core'=>'./core/inout.php',
					),	
					
					
			'list'=>array('lv'=>1, 		
			'type'=>'link',	'tag'=>'submit_nl&action=list', 'title'=>'Subscriber'	,'core'=>'./core/list.php',
			'width'=>'79%'
			,'sublink'=> array(
				 array('lv'=>2,'href'=>'submit_nl&action=io', 'title'=>'Export'	,'width'=>'17%'	, 'icon'=>'fa-exchange' ),
					//  array('lv'=>1,'href'=>'submit_nl&action=sort', 'title'=>'Sort'	,'width'=>'17%'),
				//	array('lv'=>1,'href'=>'submit_nl&action=create', 'title'=>'Create'	,'width'=>'17%'),
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
	'sqlplus_table'=>'	as t1 left join '.DB_START.'submit_nl_cat as t2 on( t1.node_id=t2.id) ',
	'sqlplus_where'=>'	',
	 
	*/
	
	
	
);
?>