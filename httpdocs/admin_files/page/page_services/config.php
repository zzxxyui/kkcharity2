<?php

 


$fixedField = array (
	
	array( "ID", "id", 
			array("ID"), 
			array("SHOW", "50", true, false), 			//list		display  ---	search 	===
			array("SHOW", true, false, array()) ,array('list-hidden'=>true)		//edit		insert 	updated	---
	),
	
	
	
	
	
	
	 
 			
array('Overylay Text'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 
),				

 		
		
array( "", "----", 
array("TAB-CNT-START",), 
array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'cr'=>'news_lang2',
									)
								
								)	
),						array( "", "----", 
								array("TAB-START",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'title'=>'繁體',
												'key'=>'news_lang2',		
									)
								
								)		//edit		insert 	updated	---
						),
			 /*
										 	array( 'Title' , "title2", 
													array("VAL","required"), 
													array("HIDDEN", "170", true, false), 
													array("SHOW", true, true,	array())
											 ),*/
		 		
										array(  'Description ',"detail2", 
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
												'title'=>'English',
												'key'=>'news_lang1',		
									)
								
								)		//edit		insert 	updated	---
						),
				/*
											array('Title', "title1", 
													array("VAL","required"), 
													array("HIDDEN", "170", true, false), 
													array("SHOW", true, true,	array())
											 ),
 
*/
 					 
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
array("TAB-CNT-END",), 
array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
array("SHOW", false, false, array()) 		//edit		insert 	updated	---
),
		
	
array( "---", "----", 			array("LG-END","---"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),
 
 
 
 
  		
			
 /*
	array($this->txt['status']  , "status", 
			array("STATUS","required"), 
			array("HIDDEN", "60", true, false), 
			array("HIDDEN", true, true, array()),	
				array('search'=>"   stype: 'select', searchoptions:{ sopt:['eq'], value: ':ALL;1:".$this->txt['enabled'] .";0:".$this->txt['disabled'] ."' }") 
	),*/
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
	'tag'=>'page_services',
	'keyfield'=>'id',
	'pageName'=>'Services ',
	'tableName'=>'page_services', 
	
	
	'menuList'=>array( 
		//	'create'=>array('lv'=>1, 		'type'=>'',	'tag'=>'page_services&action=create', 'title'=>'Create'	,'core'=>'./core/create.php'),
			'edit'=>array('lv'=>1, 		'type'=>'',	'tag'=>'page_services&action=edit', 'title'=>'Services '	,'core'=>'./core/edit.php'),
			/*
			'list'=>array('lv'=>1, 		
			'type'=>'link',	'tag'=>'page_services&action=list', 'title'=>'page_servicespage Description'	,'core'=>'./core/list.php',
			'width'=>'100%'
			,'sublink'=> array(
					//  array('lv'=>1,'href'=>'page_services&action=sort', 'title'=>'Sort'	,'width'=>'17%'),
				//	array('lv'=>1,'href'=>'page_services&action=create', 'title'=>'Create'	,'width'=>'17%'),
				)
			
			),
				*/
 /*
			'sort'=>array('lv'=>1, 		'type'=>'',	'tag'=>'page_services&action=sort', 'title'=>'sort '	,'core'=>'./core/sort.php',
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
	 array('type'=>'onefile','key'=>'page_services_bg2_onefile'),
	 array('type'=>'onefile','key'=>'page_services_bg1_onefile'),
)
	
	
	 
 
 /*
	'sqlplus_selectadd'=>'	t1.	',
	'sqlplus_select'=>' ',
	'sqlplus_table'=>'	as t1 left join '.DB_START.'page_services_cat as t2 on( t1.node_id=t2.id) ',
	'sqlplus_where'=>'	',
	 
	*/
	
	
	
);
?>