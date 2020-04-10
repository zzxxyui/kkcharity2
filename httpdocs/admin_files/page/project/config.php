<?php

 


$fixedField = array (
	
	array( "ID", "id", 
			array("ID"), 
			array("SHOW", "50", true, false), 			//list		display  ---	search 	===
			array("SHOW", true, false, array()) ,array('list-hidden'=>true)		//edit		insert 	updated	---
	),
	
	
	
	
	
	
	 
 						

		

array('Project Info'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 ),									 
 
	 				array('Rank', "rank", 
													array("RANK","required"), 
													array("SHOW", "60", true, false), 
													array("SHOW", true, true,	array())
											 ),
 
 								
				array(  'Project Type',"project_type", 
													array("SELECT-ARR","required"), 
													array("SHOW", "120", false, false), 
													array("SHOW", true, true,	array())
												 ,array(
												 
				'search'=>"   stype: 'select', searchoptions:{ sopt:['eq'], value: ':ALL;1:Ongoing Project;2:Project Highlight' }",
				
				
												 'null_start'=>false,
												 'plus_opt'=>' style="width:200px" ',
												 'valArray'=>array(
												 	array('name'=>'1','tt'=>'Ongoing Project'),
												 	array('name'=>'2','tt'=>'Project Highlight'),
												 ),
												 				

											//	 'orderby'=>array('rank','asc'),
												 //'list-order'=>3
												 ),
				 ),
				 
array('Start Date', "setdate", 
													array("DATE","required"), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
), 
	
array('End Date', "date_count", 
													//array("VAL","required number"), 
													array("DATE","required"), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
), 

array('Total of Served', "project_total", 
													array("VAL","required number"), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
), 

 array( "---", "----", 			array("LG-END","---"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),				

array('Project Content'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 ),

	
		
array( "", "----", 
array("TAB-CNT-START",), 
array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'cr'=>'project_lang1',
									)
								
								)	
),
 
 
	 
 
 
						array( "", "----", 
								array("TAB-START",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'title'=>'English',
												'key'=>'project_lang1',		
									)
								
								)		//edit		insert 	updated	---
						),
				
				
											array('Title', "title1", 
													array("VAL","required"), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
											 ),
 
 					 
										array(  'Short Desc ',"short1", 
													array("TEXT","required"), 
													array("HIDDEN", "340", false, false), 
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
												'key'=>'project_lang2',		
									)
								
								)		//edit		insert 	updated	---
						),
			 
										 	array( 'Title(繁體)' , "title2", 
													array("VAL",""), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
											 ),
 					 
										array(  'Short Desc (繁體)',"short2", 
													array("TEXT","required"), 
													array("HIDDEN", "340", false, false), 
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
/*
							array( "Youtube Link", "project_video", 
													array("VAL",""), 
													array("HIDDEN", "220", true, false), 
													array("SHOW", true, true,	array())
											 ), 
	*/	
 array( "---", "----", 			array("LG-END","---"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),
 
 

array('Project Status'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 ),

 
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
	
	
 
	
	
	 array('Press Releases ' , "onoff_pr", 
			array("STATUS","required"), 
			array("SHOW", "60", true, false), 
			array("SHOW", true, true, array()),	
				array(
				'search'=>"   stype: 'select', searchoptions:{ sopt:['eq'], value: ':ALL;1:".$this->txt['enabled'] .";0:".$this->txt['disabled'] ."' }",
		 
				'option'=>array(
					'array'=>array(
						array('val'=>1,'tt'=>'On'),
						array('val'=>0,'tt'=>'Off'),
					),
					'default'=>0,
					)
				
				) 


	),
 

	 array('Media Interview' , "onoff_mi", 
			array("STATUS","required"), 
			array("SHOW", "60", true, false), 
			array("SHOW", true, true, array()),	
				array(
				'search'=>"   stype: 'select', searchoptions:{ sopt:['eq'], value: ':ALL;1:".$this->txt['enabled'] .";0:".$this->txt['disabled'] ."' }",
		 
				'option'=>array(
					'array'=>array(
						array('val'=>1,'tt'=>'On'),
						array('val'=>0,'tt'=>'Off'),
					),
					'default'=>0,
					)
				
				) 


	),
  
 
		 								 
	array( '<p>&nbsp;</p>', "----", 
								array("CUSTOM",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) 		//edit		insert 	updated	---
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
	
 
 array( "---", "----", 			array("LG-END","---"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),
	 
		  
		
 array( "What's News", "----", 			array("KKC-LIST","project_news"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),
 array( "Our Community", "----", 			array("KKC-LIST","project_oc"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),
 array( "Press Releases", "----", 			array("KKC-LIST","project_pr"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),
 array( "Media interview", "----", 			array("KKC-LIST","project_mi"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),
 array( "Donation", "----", 			array("KKC-LIST","donation"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),
  
												
//	array( "Invoice ID", "status", array("ORDER-ID","required"), array("SHOW", "0", true, false), array("SHOW", false, false, array()) ),

);
  
 
 
 
	
	
$mycofig=array(
	'lv'=>1,
	'tag'=>'project',
	'keyfield'=>'id',
	'pageName'=>'Project',
	'tableName'=>'project', 
	'tableName'=>'project', 
	
	
	'menuList'=>array( 
	 	'create'=>array('lv'=>1, 		'type'=>'',	'tag'=>'project&action=create', 'title'=>'Create'	,'core'=>'./core/create.php'),
			'edit'=>array('lv'=>1, 		'type'=>'',	'tag'=>'project&action=edit', 'title'=>'Edit '	,'core'=>'./core/edit.php'),
		 
			'list'=>array('lv'=>1, 		
			'type'=>'link',	'tag'=>'project&action=list', 'title'=>'Project List'	,'core'=>'./core/list.php',
			'width'=>'100%'
			,'sublink'=> array(
					array('lv'=>1,'href'=>'project&action=sort', 'title'=>$this->txt['sort']	,'width'=>'17%' 		, 'icon'=>'fa-bars' ),
					array('lv'=>1,'href'=>'project&action=create', 'title'=>$this->txt['create']	,'width'=>'17%'		, 'icon'=>'fa-plus' ),
				)
			
			),
		 
 
			'sort'=>array('lv'=>1, 		'type'=>'',	'tag'=>'project&action=sort', 'title'=>'Sort','core'=>'./core/sort.php',
			'sort_setting'=>array(
					'cat'=>false,
					'sort_type'=>'asc',
				//	 'cat_array'=>$carSelect,
					'main_field'=>'id',
					'col_val'=>array(
					array('name'=>'rank',	'tt'=>$this->txt['rank'],	'width'=>'5%'),
					 array('name'=>'project_type',	'tt'=>'Project Type',	'width'=>'10%'),
					 array('name'=>'setdate',	'tt'=>'Start Date',	'width'=>'10%'),
					array('name'=>'title1',	'tt'=>$this->txt['title'],	'width'=>'50%'),
					)
			
			)
			
			),
			 
	 
			
			
	),
	
	
	
	
	
	/*
	 	
	'optionlist'=>array(
	
	
		'option'=>true,		
		'tablename'=>'optionlist', 	
		'tb_val'=>'project',		
				
		
		'data'=>array(
		
			array(
	 
					'title'=>'Our Community',	
						
					'sp_field'=>'json_oc',	
					'cols'=>array(
							array('num','text',"Number",true),
							array('detail1','text',"Text (EN)",true),
							array('detail2','text',"Text (中文)",true),
						),
			),
			

 
  
		),	
	
	),
	*/
	
 
	'allValue'=>$fixedField,

	/*'firstWidth'=>'120',*/
	'logfield'=>'id',
	
	
	'orderby'=>'  rank ',
	'orderby_dir'=>' asc  ', 
	
'other_function'=>array(
	// array('type'=>'onefile','key'=>'project_img1_onefile'), 
	 array('type'=>'manyfile','key'=>'project_slide_manyfile'),
)
	
	
	 
 
 /*
	'sqlplus_selectadd'=>'	t1.	',
	'sqlplus_select'=>' ',
	'sqlplus_table'=>'	as t1 left join '.DB_START.'project_cat as t2 on( t1.node_id=t2.id) ',
	'sqlplus_where'=>'	',
	 
	*/
	
	
	
);
?>