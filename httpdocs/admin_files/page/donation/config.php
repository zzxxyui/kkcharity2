<?php

 
$cnf_get = Input::all();
$this_status=(isset($cnf_get['id']) && $cnf_get['id']>0)?'update':'new';

$fixedField = array (
	
	array( "ID", "id", 
			array("ID"), 
			array("SHOW", "50", true, false), 			//list		display  ---	search 	===
			array("SHOW", true, false, array()) ,array('list-hidden'=>true)		//edit		insert 	updated	---
	),
	
	
	
	
	
	
	 

 
		

array('Donation Info'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 ),									 
 
	 				array('Rank', "rank", 
													array("RANK","required"), 
													array("SHOW", "60", true, false), 
													array("SHOW", true, true,	array())
											 ),
 
array('Hash Key'  , "hash_key", 			array("FIX",""),array("HIDDEN", "0", false, false),array(
(($this_status=='update')?'SHOW':'HIDDEN')
, false, false, array()) 	 ),		
 								 	 
											 
				array(  'Related Project',"node_id", 
									array("CAT-LEVEL","required chosen"), 
									array("SHOW", "140", true, false), 			//list		display  ---	search 	===
									array("SHOW", true, true, array()) 	,	//edit		insert 	updated	---
									array( 
									'kkc_cat'=>true,
										'cat_setting'=>array(
										'cattb'=>DB_START."project" ,
										'tag'=>'project',
										'isItem'=>true,
										'one_lv'=>false	),
										'listsql'=>'   
										
										  CASE when  t2.parent_id = 0    THEN    t2.title1   ELSE   
									 
										 t2.title1 
								END 	  as node_id  
					
										
										', 
										'search'=>true,
										'search_select_cat'=>DB_START.'project'
										)
							),

				 
array('Start Date', "setdate", 
													array("DATE","required"), 
													array("SHOW", "90", true, false), 
													array("SHOW", true, true,	array())
), 
				 
array('End Date', "enddate", 
													array("DATE","required"), 
													array("SHOW", "90", true, false), 
													array("SHOW", true, true,	array())
), 
	 
array('Amount', "amount", 
													array("VAL","required number"), 
													array("SHOW", "90", true, false), 
													array("SHOW", true, true,	array())
), 
array('Shippment', "amount_ship", 
													array("VAL","required number"), 
													array("SHOW", "90", true, false), 
													array("SHOW", true, true,	array())
), 
	
			 
	 array('Number of Backer' , "onoff_count", 
			array("STATUS","required"), 
			array("SHOW", "60", true, false), 
			array("SHOW", true, true, array()),	
				array(
				'search'=>"   stype: 'select', searchoptions:{ sopt:['eq'], value: ':ALL;1:Show;0:Hidden' }",
		 
				'option'=>array(
					'array'=>array(
						array('val'=>1,'tt'=>'Show'),
						array('val'=>0,'tt'=>'Hidden'),
					),
					'default'=>1,
					)
				
				) 


	),
 
 

 array( "---", "----", 			array("LG-END","---"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),				

array('Donation Content'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 ),

	
		
array( "", "----", 
array("TAB-CNT-START",), 
array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'cr'=>'donation_lang1',
									)
								
								)	
),
 
 
	 
 
 
						array( "", "----", 
								array("TAB-START",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'title'=>'English',
												'key'=>'donation_lang1',		
									)
								
								)		//edit		insert 	updated	---
						),
				
				
											array('Title', "title1", 
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
												'key'=>'donation_lang2',		
									)
								
								)		//edit		insert 	updated	---
						),
			 
										 	array( 'Title(繁體)' , "title2", 
													array("VAL",""), 
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
	'tag'=>'donation',
	'keyfield'=>'id',
	'pageName'=>'Donation',
	'tableName'=>'donation', 
	'tableName_cat'=>'project', 
	
	
	'menuList'=>array( 
	 	'create'=>array('lv'=>1, 		'type'=>'',	'tag'=>'donation&action=create', 'title'=>'Create'	,'core'=>'./core/create.php'),
			'edit'=>array('lv'=>1, 		'type'=>'',	'tag'=>'donation&action=edit', 'title'=>'Edit '	,'core'=>'./core/edit.php'),
		 
			'list'=>array('lv'=>1, 		
			'type'=>'link',	'tag'=>'donation&action=list', 'title'=>'Donation'	,'core'=>'./core/list.php',
			'width'=>'100%'
			,'sublink'=> array(
					array('lv'=>1,'href'=>'donation&action=sort', 'title'=>$this->txt['sort']	,'width'=>'17%' 		, 'icon'=>'fa-bars' ),
					array('lv'=>1,'href'=>'donation&action=create', 'title'=>$this->txt['create']	,'width'=>'17%'		, 'icon'=>'fa-plus' ),
				)
			
			),
		 
 
			'sort'=>array('lv'=>1, 		'type'=>'',	'tag'=>'donation&action=sort', 'title'=>'Sort','core'=>'./core/sort.php',
			'sort_setting'=>array(
					'cat'=>true,
					'sort_type'=>'asc',
				//	 'cat_array'=>$carSelect,
					'main_field'=>'id',
					'col_val'=>array(
					array('name'=>'rank',	'tt'=>$this->txt['rank'],	'width'=>'15%'),
					 array('name'=>'setdate',	'tt'=>'Date',	'width'=>'10%'),
					array('name'=>'title1',	'tt'=>$this->txt['title'],	'width'=>'60%'),
					)
			
			)
			
			),
			 
	 
			
			
	),
	
	
	
	
		'sqlplus_selectadd'=>'	t1.	',
	'sqlplus_select'=>' ',
	'sqlplus_table'=>'	as t1 left join '.DB_START.'project as t2 on( t1.node_id=t2.id) ',
	'sqlplus_where'=>'	',
 
	 
	
	
 
	'allValue'=>$fixedField,

	/*'firstWidth'=>'120',*/
	'logfield'=>'id',
	
	
	'orderby'=>' t1. rank ',
	'orderby_dir'=>' asc  ', 
	
'other_function'=>array(
  array('type'=>'onefile','key'=>'donation_onefile'),
	// array('type'=>'onefile','key'=>'donation_img2_onefile'),
)
	
	
	 
 
 /*
	'sqlplus_selectadd'=>'	t1.	',
	'sqlplus_select'=>' ',
	'sqlplus_table'=>'	as t1 left join '.DB_START.'donation_cat as t2 on( t1.node_id=t2.id) ',
	'sqlplus_where'=>'	',
	 
	*/
	
	
	
);
?>