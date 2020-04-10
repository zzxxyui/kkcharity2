<?php

 


$fixedField = array (
	
	array( "ID", "id", 
			array("ID"), 
			array("SHOW", "50", true, false), 			//list		display  ---	search 	===
			array("SHOW", true, false, array()) ,array('list-hidden'=>true)		//edit		insert 	updated	---
	),
	
	
	
	
	
	
	 
 			
array('Submit A Proposal(File)'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 
),				

 		
		
array( "", "----", 
array("TAB-CNT-START",), 
array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'cr'=>'news_lang1',
									)
								
								)	
),	
 
	 
						array( "", "----", 
								array("TAB-START",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'title'=>'English',
												'key'=>'news_lang1',		
									)
								
								)		//edit		insert 	updated	---
						),
			 
											array('Title', "title1", 
													array("VAL","required"), 
													array("HIDDEN", "170", true, false), 
													array("SHOW", true, true,	array())
											 ),
 
 
 					 
										array(  'Description ',"detail1", 
													array("TEXT","required"), 
													array("HIDDEN", "340", false, false), 
													array("SHOW", true, true,	array())
	
											 ),
								 
						array( '<p style="float:none;text-align:left">Mobile Description</p>', "----", 
								array("CUSTOM",), 
								array("HIDDEN", "0", false, false), 		 
								array("SHOW", false, false, array()) 		 
						),
											 
										array(  'Mobile Description ',"mb_txt1", 
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
								array("TAB-START",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'title'=>'繁體',
												'key'=>'news_lang2',		
									)
								
								)		//edit		insert 	updated	---
						),
	 
										 	array( 'Title' , "title2", 
													array("VAL",""), 
													array("HIDDEN", "170", true, false), 
													array("SHOW", true, true,	array())
											 ), 
		 		
										array(  'Description ',"detail2", 
													array("TEXT",""), 
													array("HIDDEN", "340", false, false), 
													array("SHOW", true, true,	array())
											 ),
											 
											 
										array(  'Mobile Description ',"mb_txt2", 
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
			array("HIDDEN", "60", true, false), 
			array("SHOW", true, true, array()),	
				array('search'=>"   stype: 'select', searchoptions:{ sopt:['eq'], value: ':ALL;1:".$this->txt['enabled'] .";0:".$this->txt['disabled'] ."' }") 
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
	'tag'=>'submit_file_page',
	'keyfield'=>'id',
	'pageName'=>'Submit A Proposal',
	'tableName'=>'submit_file_page', 
	
	
	'menuList'=>array( 
		//	'create'=>array('lv'=>1, 		'type'=>'',	'tag'=>'submit_file_page&action=create', 'title'=>'Create'	,'core'=>'./core/create.php'),
			'edit'=>array('lv'=>1, 		'type'=>'',	'tag'=>'submit_file_page&action=edit', 'title'=>'Submit A Proposal(File)'	,'core'=>'./core/edit.php'),
			/*
			'list'=>array('lv'=>1, 		
			'type'=>'link',	'tag'=>'submit_file_page&action=list', 'title'=>'submit_file_pagepage Description'	,'core'=>'./core/list.php',
			'width'=>'100%'
			,'sublink'=> array(
					//  array('lv'=>1,'href'=>'submit_file_page&action=sort', 'title'=>'Sort'	,'width'=>'17%'),
				//	array('lv'=>1,'href'=>'submit_file_page&action=create', 'title'=>'Create'	,'width'=>'17%'),
				)
			
			),
				*/
 /*
			'sort'=>array('lv'=>1, 		'type'=>'',	'tag'=>'submit_file_page&action=sort', 'title'=>'sort '	,'core'=>'./core/sort.php',
			'sort_setting'=>array(
					'cat'=>false,
				//	 'cat_array'=>$carSelect,
					'main_field'=>'id',
					'col_val'=>array(
					array('name'=>'rank',	'tt'=>$tval['rank'],	'width'=>'15%'),
					array('name'=>'title1',	'tt'=>$tval['title'],	'width'=>'80%'), 
					)
			)
			),
			*/
			 
	 
			
			
	),
 
	'allValue'=>$fixedField,

	/*'firstWidth'=>'120',*/
	'logfield'=>'id',
	
	
	'orderby'=>'  id ',
	'orderby_dir'=>' asc  ', 
	
'other_function'=>array(
  array('type'=>'onefile','key'=>'spfile1_onefile'),
  array('type'=>'onefile','key'=>'spfile2_onefile'),
  array('type'=>'onefile','key'=>'spfile1_zh_onefile'),
  array('type'=>'onefile','key'=>'spfile2_zh_onefile'),
)
	
	
	 
 
 /*
	'sqlplus_selectadd'=>'	t1.	',
	'sqlplus_select'=>' ',
	'sqlplus_table'=>'	as t1 left join '.DB_START.'submit_file_page_cat as t2 on( t1.node_id=t2.id) ',
	'sqlplus_where'=>'	',
	 
	*/
	
	
	
);
?>