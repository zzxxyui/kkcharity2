<?php

 


$fixedField = array (
	
	array( "ID", "id", 
			array("ID"), 
			array("SHOW", "50", true, false), 			//list		display  ---	search 	===
			array("SHOW", true, false, array()) ,array('list-hidden'=>true)		//edit		insert 	updated	---
	),
	
	
	
	 						 
 
	 				array('Rank', "rank", 
													array("RANK","required"), 
													array("HIDDEN", "60", true, false), 
													array("HIDDEN", true, true,	array())
											 ),
 
 								
						 	 
 
 
array('Content'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 ),

	
		
array( "", "----", 
array("TAB-CNT-START",), 
array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'cr'=>'onepage_lang1',
									)
								
								)	
),
 
 
	 
 
 
						array( "", "----", 
								array("TAB-START",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'title'=>'English',
												'key'=>'onepage_lang1',		
									)
								
								)		//edit		insert 	updated	---
						),
				
				
											array('Title', "title1", 
													array("FIX","required"), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
											 ),
 
 		 								 
 
 					 
										array(  'Description ',"detail1", 
													array("CK-TEXT","required"), 
													array("HIDDEN", "340", false, false), 
													array("SHOW", true, true,	array())
											 ),
	
 
 
				 
											 										 
						array( "", "----", 
								array("TAB-END",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) 		//edit		insert 	updated	---
						),
 
 
						
						array( "", "----", 
								array("TAB-START",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'title'=>'繁體',
												'key'=>'onepage_lang2',		
									)
								
								)		//edit		insert 	updated	---
						),
			 
											array('Title', "title2", 
													array("FIX","required"), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
											 ),
 
 
	
 
										array(  'Description ',"detail2", 
													array("CK-TEXT",""), 
													array("HIDDEN", "340", false, false), 
													array("SHOW", true, true,	array())
											 ),
	
 
			 
											 
						array( "", "----", 
								array("TAB-END",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) 		//edit		insert 	updated	---
						),
 
						
array( "", "----", 
array("TAB-CNT-END",), 
array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
array("SHOW", false, false, array()) 		//edit		insert 	updated	---
),

 
 array( "---", "----", 			array("LG-END","---"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),
 
				
	
			 
	 array($this->txt['status']  , "status", 
			array("STATUS","required"), 
			array("SHOW", "60", true, false), 
			array("SHOW", true, true, array()),	
				array(
				'search'=>"   stype: 'select', searchoptions:{ sopt:['eq'], value: ':ALL;1:".$this->txt['enabled'] .";0:".$this->txt['disabled'] ."' }",
		 
				'option'=>array(
					'array'=>array(
						array('val'=>1,'tt'=>'Enabled'),
						array('val'=>0,'tt'=>'Disabled'),
					),
					'default'=>0,
					)
				
				) 


	),
 
 
 
 					 
					  
	array( "CreateDate", "created_at", 
			array("FIX",""), 
			array("HIDDEN", "110", true, false), 
			array("HIDDEN", true, false, array()) 
	),
	array( $this->txt['mod_date']  , "updated_at", 
	array("FIX",""), 
	array("SHOW", "110", true, false), 
	array("HIDDEN", true, true, array()) 
	),
	
 
 	 
												
//	array( "Invoice ID", "status", array("ORDER-ID","required"), array("SHOW", "0", true, false), array("SHOW", false, false, array()) ),

);
  
 
 
 
	
	
$mycofig=array(
	'lv'=>1,
	'tag'=>'onepage',
	'keyfield'=>'id',
	'pageName'=>'Other',
	'tableName'=>'onepage', 
	//'tableName_cat'=>'project', 
	
	
	'menuList'=>array( 
	 //	'create'=>array('lv'=>1, 		'type'=>'',	'tag'=>'onepage&action=create', 'title'=>'Create'	,'core'=>'./core/create.php'),
			'edit'=>array('lv'=>1, 		'type'=>'',	'tag'=>'onepage&action=edit', 'title'=>'Edit '	,'core'=>'./core/edit.php'),
		 
			'list'=>array('lv'=>1, 		
			'type'=>'link',	'tag'=>'onepage&action=list', 'title'=>'Other'	,'core'=>'./core/list.php',
			'width'=>'100%'
			,'sublink'=> array( 
					//array('lv'=>1,'href'=>'onepage&action=create', 'title'=>$this->txt['create']	,'width'=>'17%'		, 'icon'=>'fa-plus' ),
				)
			
			),
		 
 
			
			
	),
	
	
	
 
	
	
 
	'allValue'=>$fixedField,

	/*'firstWidth'=>'120',*/
	'logfield'=>'id',
	
	
	'orderby'=>' t1. rank ',
	'orderby_dir'=>' asc  ', 
	
'other_function'=>array(
	// array('type'=>'onefile','key'=>'onepage_img1_onefile'),
	// array('type'=>'onefile','key'=>'onepage_img2_onefile'),
)
	
	
	 
 
 /*
	'sqlplus_selectadd'=>'	t1.	',
	'sqlplus_select'=>' ',
	'sqlplus_table'=>'	as t1 left join '.DB_START.'onepage_cat as t2 on( t1.node_id=t2.id) ',
	'sqlplus_where'=>'	',
	 
	*/
	
	
	
);
?>