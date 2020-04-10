<?php

 


$fixedField = array (
	
	array( "ID", "id", 
			array("ID"), 
			array("SHOW", "50", true, false), 			//list		display  ---	search 	===
			array("SHOW", true, false, array()) ,array('list-hidden'=>true)		//edit		insert 	updated	---
	),
	
	
	
	
	
	
	 
 						

		 
array('Committee Member Content'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 ),

	
		
array( "", "----", 
array("TAB-CNT-START",), 
array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'cr'=>'about_ppl_lang1',
									)
								
								)	
),
 
 
	 
 
 
						array( "", "----", 
								array("TAB-START",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'title'=>'English',
												'key'=>'about_ppl_lang1',		
									)
								
								)		//edit		insert 	updated	---
						),
				
				
											array('Title', "title1", 
													array("VAL","required"), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
											 ),
				
											array('Positon', "pos1", 
													array("VAL","required"), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
											 ),
 
	array( '<p class="pull-left">Description</p>', "----", 
								array("CUSTOM",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) 		//edit		insert 	updated	---
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
												'key'=>'about_ppl_lang2',		
									)
								
								)		//edit		insert 	updated	---
						),
			 
										 	array( 'Title(繁體)' , "title2", 
													array("VAL",""), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
											 ),
				
											array('Positon(繁體)', "pos2", 
													array("VAL","required"), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
											 ),
		 								 
	array( '<p class="pull-left">Description(繁體)</p>', "----", 
								array("CUSTOM",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) 		//edit		insert 	updated	---
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
 
  

 /*
	 			 	array( "Url Rewrite", "url_rewrite", 
													array("URL-REWRITE"," urlrewrite"), 
													array('HIDDEN', "220", false, false), 
													array('SHOW', true, true,	array(),),
														
													array(
													'opt'=>array(
																'copy_from'=>'title1'
														)
													)
													
			 ),
	
*/
				
	
			 
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
	'tag'=>'about_ppl',
	'keyfield'=>'id',
	'pageName'=>'Committee Member',
	'tableName'=>'about_ppl', 
	//'tableName_cat'=>'project', 
	
	
	'menuList'=>array( 
	 	'create'=>array('lv'=>1, 		'type'=>'',	'tag'=>'about_ppl&action=create', 'title'=>'Create'	,'core'=>'./core/create.php'),
			'edit'=>array('lv'=>1, 		'type'=>'',	'tag'=>'about_ppl&action=edit', 'title'=>'Edit '	,'core'=>'./core/edit.php'),
		 
			'list'=>array('lv'=>1, 		
			'type'=>'link',	'tag'=>'about_ppl&action=list', 'title'=>'CommitteeMember'	,'core'=>'./core/list.php',
			'width'=>'100%'
			,'sublink'=> array(
					array('lv'=>1,'href'=>'about_ppl&action=sort', 'title'=>$this->txt['sort']	,'width'=>'17%' 		, 'icon'=>'fa-bars' ),
					array('lv'=>1,'href'=>'about_ppl&action=create', 'title'=>$this->txt['create']	,'width'=>'17%'		, 'icon'=>'fa-plus' ),
				)
			
			),
		 
 
			'sort'=>array('lv'=>1, 		'type'=>'',	'tag'=>'about_ppl&action=sort', 'title'=>'Sort','core'=>'./core/sort.php',
			'sort_setting'=>array(
					'cat'=>false,
					'sort_type'=>'asc',
				//	 'cat_array'=>$carSelect,
					'main_field'=>'id',
					'col_val'=>array(
					array('name'=>'rank',	'tt'=>$this->txt['rank'],	'width'=>'15%'),
					 array('name'=>'pos1',	'tt'=>'Position',	'width'=>'10%'),
					array('name'=>'title1',	'tt'=>$this->txt['title'],	'width'=>'60%'),
					)
			
			)
			
			),
			 
	 
			
			
	),
	
	
	
	/*
		'sqlplus_selectadd'=>'	t1.	',
	'sqlplus_select'=>' ',
	'sqlplus_table'=>'	as t1 left join '.DB_START.'project as t2 on( t1.node_id=t2.id) ',
	'sqlplus_where'=>'	',
 
	 */
	
	
 
	'allValue'=>$fixedField,

	/*'firstWidth'=>'120',*/
	'logfield'=>'id',
	
	
	'orderby'=>'  rank ',
	'orderby_dir'=>' asc  ', 
	
'other_function'=>array(
  array('type'=>'onefile','key'=>'about_ppl_onefile'),
	// array('type'=>'onefile','key'=>'about_ppl_img2_onefile'),
)
	
	
	 
 
 /*
	'sqlplus_selectadd'=>'	t1.	',
	'sqlplus_select'=>' ',
	'sqlplus_table'=>'	as t1 left join '.DB_START.'about_ppl_cat as t2 on( t1.node_id=t2.id) ',
	'sqlplus_where'=>'	',
	 
	*/
	
	
	
);
?>